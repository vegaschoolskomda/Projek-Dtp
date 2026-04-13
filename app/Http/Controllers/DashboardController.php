<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        return view('dashboard.index', [
            'hasAttendanceToday' => true,
            'totalEmployees' => User::count(),
            'todayAttendanceCount' => Attendance::whereDate('waktu_absen', now()->toDateString())->count(),
            'recentAttendances' => Attendance::with('user')->latest('waktu_absen')->limit(15)->get(),
        ]);
    }

    public function karyawan(Request $request): View
    {
        return view('dashboard.karyawan', [
            'hasAttendanceToday' => true,
            'employees' => User::orderBy('name')->get(),
        ]);
    }

    public function riwayat(Request $request): View
    {
        return view('dashboard.riwayat', [
            'hasAttendanceToday' => true,
            'attendances' => Attendance::with('user')->latest('waktu_absen')->paginate(20),
        ]);
    }
}
