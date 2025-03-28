@extends('components.layouts.auth')

@section('contentAuth')
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-7 col-lg-6">
            {{-- Card Register --}}
            <div class="card shadow rounded-4 border-0" style="background-color: #f8f9fa;">
                <div class="card-header bg-white text-center rounded-top-4 border-bottom-0">
                    <h4 class="mb-0 text-primary fw-semibold">Buat Akun Baru ✨</h4>
                    <small class="text-muted">Isi data berikut untuk mendaftar</small>
                </div>

                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label for="name" class="form-label text-primary">Nama Lengkap</label>
                            <input type="text" name="name" id="name"
                                class="form-control rounded-3 @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label text-primary">Email</label>
                            <div class="input-group">
                                <input type="text" name="email" id="email"
                                    class="form-control rounded-start-3 @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required placeholder="tanpa @gmail.com">
                                <span class="input-group-text bg-light rounded-end-3">@gmail.com</span>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label text-primary">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control rounded-3 @error('password') is-invalid @enderror"
                                required placeholder="********">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label text-primary">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control rounded-3 @error('password_confirmation') is-invalid @enderror"
                                required placeholder="********">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- No Phone --}}
                        <div class="mb-3">
                            <label for="no_phone" class="form-label text-primary">No. HP</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">+62</span>
                                <input type="number" name="no_phone" id="no_phone"
                                    class="form-control rounded-end-3 @error('no_phone') is-invalid @enderror"
                                    value="{{ old('no_phone') }}" required placeholder="857xxxxxxx">
                            </div>
                            @error('no_phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label for="address" class="form-label text-primary">Alamat</label>
                            <input type="text" name="address" id="address"
                                class="form-control rounded-3 @error('address') is-invalid @enderror"
                                value="{{ old('address') }}" required placeholder="Alamat lengkap">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('login') }}" class="text-decoration-none text-primary">
                                Sudah punya akun?
                            </a>

                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                Register
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center bg-white border-top-0 rounded-bottom-4">
                    <small class="text-muted">Dengan mendaftar, kamu setuju dengan syarat & ketentuan kami.</small>
                </div>
            </div>
        </div>
    </div>
@endsection
