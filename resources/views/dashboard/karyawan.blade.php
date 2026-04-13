@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Data Karyawan</h2>
        <p class="text-sm text-slate-500">Daftar akun pengguna sistem manajemen karyawan.</p>
    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-200">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Nama</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Username</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Terdaftar</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 bg-white">
                @foreach ($employees as $employee)
                    <tr>
                        <td class="px-4 py-3">{{ $employee->name }}</td>
                        <td class="px-4 py-3">{{ $employee->username }}</td>
                        <td class="px-4 py-3">{{ $employee->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
