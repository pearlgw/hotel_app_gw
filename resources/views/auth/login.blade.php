@extends('components.layouts.auth')

@section('contentAuth')
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6 col-lg-5">
            {{-- Card Login --}}
            <div class="card shadow rounded-4 border-0" style="background-color: #f8f9fa;">
                <div class="card-body px-4 py-4">
                    <div class="card-header bg-white text-center rounded-top-4 border-bottom-0">
                        <h4 class="mb-0 text-primary fw-semibold">Selamat Datang 👋</h4>
                        <small class="text-muted">Silakan masuk untuk melanjutkan</small>
                    </div>
                    {{-- Status Session --}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label text-primary">Email</label>
                            <input id="email" type="email"
                                class="form-control rounded-3 @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-4">
                            <label for="password" class="form-label text-primary">Password</label>
                            <input id="password" type="password"
                                class="form-control rounded-3 @error('password') is-invalid @enderror" name="password"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                                Belum punya akun?
                            </a>

                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                                Log in
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
