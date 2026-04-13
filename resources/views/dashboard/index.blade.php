@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-900">Dashboard Admin</h2>
        <p class="text-sm text-slate-500">Monitoring absensi karyawan tanpa approval.</p>
    </div>

    <div class="mb-8 grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Total Karyawan</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalEmployees }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Absensi Hari Ini</p>
            <p class="mt-2 text-3xl font-bold text-emerald-600">{{ $todayAttendanceCount }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
            <p class="text-xs uppercase tracking-[0.18em] text-slate-500">Tanggal</p>
            <p class="mt-2 text-lg font-semibold text-slate-900">{{ now()->format('d M Y') }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Username</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Waktu Absensi</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Foto</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($recentAttendances as $attendance)
                    <tr>
                        <td class="px-4 py-3">{{ $attendance->user->name }}</td>
                        <td class="px-4 py-3">{{ $attendance->user->username }}</td>
                        <td class="px-4 py-3">{{ $attendance->waktu_absen->format('d-m-Y H:i:s') }}</td>
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/'.$attendance->photo) }}" alt="Wajah {{ $attendance->user->name }}" class="h-14 w-14 rounded-lg object-cover">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada data absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
