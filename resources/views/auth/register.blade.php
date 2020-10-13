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
                            <label for="IdDokter" class="col-md-4 col-form-label text-md-right">IdDokter</label>

                            <div class="col-md-6">
                                <input id="IdDokter" type="text" class="form-control{{ $errors->has('IdDokter') ? ' is-invalid' : '' }}" name="IdDokter" value="{{ old('IdDokter') }}" required autofocus>

                                @if ($errors->has('IdDokter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('IdDokter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NamaLengkap" class="col-md-4 col-form-label text-md-right">NamaLengkap</label>

                            <div class="col-md-6">
                                <input id="NamaLengkap" type="text" class="form-control{{ $errors->has('NamaLengkap') ? ' is-invalid' : '' }}" name="NamaLengkap" value="{{ old('NamaLengkap') }}" required autofocus>

                                @if ($errors->has('NamaLengkap'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('NamaLengkap') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdRuangan" class="col-md-4 col-form-label text-md-right">KdRuangan</label>

                            <div class="col-md-6">
                                <input id="KdRuangan" type="text" class="form-control{{ $errors->has('KdRuangan') ? ' is-invalid' : '' }}" name="KdRuangan" value="{{ old('KdRuangan') }}" required autofocus>

                                @if ($errors->has('KdRuangan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('KdRuangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NamaRuangan" class="col-md-4 col-form-label text-md-right">NamaRuangan</label>

                            <div class="col-md-6">
                                <input id="NamaRuangan" type="text" class="form-control{{ $errors->has('NamaRuangan') ? ' is-invalid' : '' }}" name="NamaRuangan" value="{{ old('NamaRuangan') }}" required autofocus>

                                @if ($errors->has('NamaRuangan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('NamaRuangan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdJabatan" class="col-md-4 col-form-label text-md-right">KdJabatan</label>

                            <div class="col-md-6">
                                <input id="KdJabatan" type="text" class="form-control{{ $errors->has('KdJabatan') ? ' is-invalid' : '' }}" name="KdJabatan" value="{{ old('KdJabatan') }}" required autofocus>

                                @if ($errors->has('KdJabatan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('KdJabatan') }}</strong>
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
