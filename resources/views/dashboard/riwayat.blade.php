@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Riwayat Absensi</h2>
        <p class="text-sm text-slate-500">Seluruh histori absensi wajah karyawan.</p>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Username</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Waktu</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Foto</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @forelse ($attendances as $attendance)
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
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada riwayat absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $attendances->links() }}
    </div>
@endsection
