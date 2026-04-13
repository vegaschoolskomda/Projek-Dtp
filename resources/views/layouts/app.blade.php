<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Karyawan' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-slate-100 text-slate-800">
    <div class="min-h-screen bg-[radial-gradient(circle_at_top,_rgba(14,165,233,0.12),_transparent_50%),radial-gradient(circle_at_bottom,_rgba(16,185,129,0.12),_transparent_45%)]">
        <div class="mx-auto flex max-w-7xl gap-6 p-4 md:p-6">
            @php
                $locked = ! ($hasAttendanceToday ?? false);
            @endphp

            <aside class="w-full max-w-64 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="mb-8 rounded-2xl bg-slate-900 p-4 text-white">
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-300">BPS</p>
                    <h1 class="text-lg font-semibold">Manajemen Karyawan</h1>
                    <p class="mt-1 text-xs text-slate-300">{{ auth()->user()->name }}</p>
                </div>

                <nav class="space-y-2 text-sm font-medium">
                    <a href="{{ route('dashboard') }}"
                       class="block rounded-xl px-3 py-2 {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700' : ($locked ? 'cursor-not-allowed bg-slate-100 text-slate-400' : 'text-slate-700 hover:bg-slate-100') }}"
                       @if($locked) aria-disabled="true" onclick="return false;" @endif>
                        Dashboard
                    </a>

                    <a href="{{ route('absensi.index') }}"
                       class="block rounded-xl px-3 py-2 {{ request()->routeIs('absensi.*') ? 'bg-emerald-100 text-emerald-700' : 'text-slate-700 hover:bg-slate-100' }}">
                        Absensi
                    </a>

                    <a href="{{ route('karyawan') }}"
                       class="block rounded-xl px-3 py-2 {{ request()->routeIs('karyawan') ? 'bg-sky-100 text-sky-700' : ($locked ? 'cursor-not-allowed bg-slate-100 text-slate-400' : 'text-slate-700 hover:bg-slate-100') }}"
                       @if($locked) aria-disabled="true" onclick="return false;" @endif>
                        Data Karyawan
                    </a>

                    <a href="{{ route('riwayat') }}"
                       class="block rounded-xl px-3 py-2 {{ request()->routeIs('riwayat') ? 'bg-sky-100 text-sky-700' : ($locked ? 'cursor-not-allowed bg-slate-100 text-slate-400' : 'text-slate-700 hover:bg-slate-100') }}"
                       @if($locked) aria-disabled="true" onclick="return false;" @endif>
                        Riwayat
                    </a>
                </nav>

                @if ($locked)
                    <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-3 text-xs text-amber-700">
                        Sidebar terkunci sampai absensi harian berhasil.
                    </div>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit" class="w-full rounded-xl bg-rose-600 px-3 py-2 text-sm font-semibold text-white hover:bg-rose-700">
                        Logout
                    </button>
                </form>
            </aside>

            <main class="flex-1 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                @if (session('success'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="mb-4 rounded-xl border border-amber-200 bg-amber-50 p-3 text-sm text-amber-700">
                        {{ session('warning') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
