<x-layouts.auth title="Konfirmasi OTP">
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Konfirmasi Kode OTP</h2>
            <form action="{{ route('otp.check') }}" method="POST" autocomplete="off">

                @csrf

                <input name="mahasiswaId" type="hidden" value="{{ $mahasiswa->id }}">

                <div class="mb-3">
                    <label class="form-label">Kode OTP</label>
                    <input class="form-control" type="number" name="otp" value="{{ old('otp') }}" required autofocus>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.auth>
