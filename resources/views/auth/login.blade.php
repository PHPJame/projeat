@extends('layouts.app')

@section('content')
<div class="container p-lg-5">
    <div class="row justify-content-center ">
        <div class="col-md-6">
            <div class="card my-4">

                <div class="card-body">
                    <form class="card-body p-lg-5" method="POST" action="{{ route('login') }}">
                        <h2 class="text-center">เข้าสู่ระบบ</h2><br>
                        @csrf

                        @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="อีเมล" required
                                    autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="รหัสผ่าน" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block">
                                    เข้าสู่ระบบ
                                </button>
                            </div>
                            <br>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    คุณลืมรหัสผ่านใช่หรือไหม?
                                </a>
                                @endif
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class=" btn btn-link" href="{{ route('register') }}">สมัครสมาชิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection