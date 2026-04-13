@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-900">Absensi Wajah</h2>
        <p class="text-sm text-slate-500">Ambil foto wajah Anda untuk menyelesaikan absensi harian.</p>
    </div>

    @if ($attendanceToday)
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5">
            <p class="text-sm font-semibold text-emerald-700">Anda sudah absen hari ini pada {{ $attendanceToday->waktu_absen->format('H:i:s') }}.</p>
            <img src="{{ asset('storage/'.$attendanceToday->photo) }}" alt="Foto absensi" class="mt-4 h-64 w-full rounded-xl object-cover md:w-96">
        </div>
    @else
        <div class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <video id="camera" autoplay playsinline class="aspect-video w-full rounded-xl bg-slate-900 object-cover"></video>
                <canvas id="snapshot" class="hidden"></canvas>
                <img id="preview" class="mt-4 hidden aspect-video w-full rounded-xl object-cover" alt="Preview foto">
            </div>

            <form action="{{ route('absensi.store') }}" method="POST" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-5">
                @csrf
                <input type="hidden" name="photo_data" id="photo_data">

                <h3 class="text-lg font-semibold text-slate-900">Konfirmasi Absensi</h3>
                <p class="text-sm text-slate-500">Tekan tombol ambil foto, cek hasil, lalu simpan absensi.</p>

                @if ($errors->any())
                    <div class="rounded-xl border border-rose-200 bg-rose-50 p-3 text-sm text-rose-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="flex flex-wrap gap-3">
                    <button type="button" id="captureBtn" class="rounded-xl bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700">
                        Ambil Foto
                    </button>
                    <button type="submit" id="submitBtn" disabled class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white disabled:cursor-not-allowed disabled:bg-slate-300">
                        Simpan Absensi
                    </button>
                </div>
            </form>
        </div>

        <script>
            const camera = document.getElementById('camera');
            const snapshot = document.getElementById('snapshot');
            const preview = document.getElementById('preview');
            const captureBtn = document.getElementById('captureBtn');
            const submitBtn = document.getElementById('submitBtn');
            const photoDataInput = document.getElementById('photo_data');

            async function initCamera() {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                    camera.srcObject = stream;
                } catch (error) {
                    alert('Kamera tidak dapat diakses. Izinkan akses kamera di browser Anda.');
                }
            }

            captureBtn.addEventListener('click', () => {
                const context = snapshot.getContext('2d');
                snapshot.width = camera.videoWidth;
                snapshot.height = camera.videoHeight;
                context.drawImage(camera, 0, 0, snapshot.width, snapshot.height);

                const dataUrl = snapshot.toDataURL('image/jpeg', 0.9);
                photoDataInput.value = dataUrl;
                preview.src = dataUrl;
                preview.classList.remove('hidden');
                submitBtn.disabled = false;
            });

            initCamera();
        </script>
    @endif
@endsection
