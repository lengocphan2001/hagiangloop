@extends('adminlte::auth.login')

@section('auth_header', 'Đăng nhập Admin Panel')

@section('auth_body')
    <form action="{{ route('admin.login') }}" method="post">
        @csrf
        
        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   placeholder="Email" value="{{ old('email') }}" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Mật khẩu" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                        Ghi nhớ đăng nhập
                    </label>
                </div>
            </div>
            {{-- /.col --}}
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block text-nowrap">
                    Đăng nhập
                </button>
            </div>
            {{-- /.col --}}
        </div>
    </form>
@stop


