<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('absensi.index', [
            'hasAttendanceToday' => $user->hasAttendedToday(),
            'attendanceToday' => $user->attendances()
                ->whereDate('waktu_absen', now()->toDateString())
                ->latest('waktu_absen')
                ->first(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'photo_data' => ['required', 'string'],
        ]);

        $user = $request->user();

        if ($user->hasAttendedToday()) {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Absensi hari ini sudah tercatat.');
        }

        $photoData = $request->input('photo_data');

        if (! preg_match('/^data:image\/(\w+);base64,/', $photoData, $matches)) {
            return back()->with('error', 'Format foto tidak valid.');
        }

        $extension = strtolower($matches[1]);
        if (! in_array($extension, ['jpeg', 'jpg', 'png', 'webp'], true)) {
            return back()->with('error', 'Jenis file foto tidak didukung.');
        }

        $rawData = substr($photoData, strpos($photoData, ',') + 1);
        $binaryData = base64_decode($rawData, true);

        if ($binaryData === false) {
            return back()->with('error', 'Foto gagal diproses.');
        }

        $relativePath = 'absensi/'.now()->format('Y-m-d').'/'.Str::uuid().'.'.$extension;
        Storage::disk('public')->put($relativePath, $binaryData);

        Attendance::create([
            'user_id' => $user->id,
            'photo' => $relativePath,
            'waktu_absen' => now(),
            'created_at' => now(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Absensi berhasil direkam. Anda sekarang dapat mengakses dashboard.');
    }
}
