<x-layouts.auth title="Konfirmasi Mahasiswa">
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Konfirmasi Mahasiswa</h2>
            <form action="{{ route('check.email') }}" method="POST" autocomplete="off">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}"
                        placeholder="contoh@email.com" required autofocus>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.auth>
