@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Kode Dokter</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('kodedokter') ? ' is-invalid' : '' }}" name="kodedokter" value="{{ old('kodedokter') }}" required autofocus>

                                @if ($errors->has('kodedokter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kodedokter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="namadokter" class="col-md-4 col-form-label text-md-right">Nama Dokter</label>

                            <div class="col-md-6">
                                <input id="namadokter" type="text" class="form-control{{ $errors->has('namadokter') ? ' is-invalid' : '' }}" name="namadokter" value="{{ old('namadokter') }}" required autofocus>

                                @if ($errors->has('namadokter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('namadokter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <input id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="{{ old('status') }}" required autofocus>

                                @if ($errors->has('status'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
