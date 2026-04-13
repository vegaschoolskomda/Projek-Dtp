<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Karyawan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-slate-100 text-slate-800">
    <main class="flex min-h-screen items-center justify-center p-4">
        <div class="w-full max-w-4xl overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:grid md:grid-cols-2">
            <section class="relative hidden bg-slate-900 p-8 text-white md:flex md:flex-col md:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-300">CV Berkah Pratama Sejahtera</p>
                    <h1 class="mt-3 text-3xl font-bold">Sistem Manajemen Karyawan</h1>
                    <p class="mt-4 text-sm text-slate-300">Login menggunakan username untuk melanjutkan absensi berbasis wajah.</p>
                </div>

                <div class="rounded-2xl border border-slate-700 bg-slate-800/70 p-4 text-sm text-slate-300">
                    Setelah login, semua halaman akan dikunci sampai absensi harian selesai.
                </div>
            </section>

            <section class="p-6 md:p-10">
                <h2 class="text-2xl font-bold text-slate-900">Masuk</h2>
                <p class="mt-1 text-sm text-slate-500">Gunakan username dan password akun karyawan.</p>

                @if ($errors->any())
                    <div class="mt-4 rounded-xl border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.attempt') }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label for="username" class="mb-1 block text-sm font-medium text-slate-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required
                               class="w-full rounded-xl border border-slate-300 px-3 py-2.5 outline-none ring-sky-200 focus:ring-4">
                    </div>

                    <div>
                        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full rounded-xl border border-slate-300 px-3 py-2.5 outline-none ring-sky-200 focus:ring-4">
                    </div>

                    <button type="submit" class="w-full rounded-xl bg-sky-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-sky-700">
                        Login
                    </button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>