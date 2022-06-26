@extends('layouts.app')

@section('content')
<div class="container p-lg-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-4">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="card-body p-lg-5" method="POST" action="{{ route('password.email') }}">
                        <h2 class="text-center">รีเซ็ตรหัสผ่าน</h2><br>
                        @csrf

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

                        <div class="form-group ">
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-block">
                                    รีเซ็ตรหัสผ่าน
                                </button>
                            </div>
                            <br>
                            <div class="text-center">
                                <a class=" btn btn-link" href="{{ route('login') }}">คุณบัญชีผู้ใช้งานอยู่แล้ว</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection