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
                            <label for="KodeDokter" class="col-md-4 col-form-label text-md-right">Kode Dokter</label>

                            <div class="col-md-6">
                                <input id="KodeDokter" type="text" class="form-control{{ $errors->has('KodeDokter') ? ' is-invalid' : '' }}" name="KodeDokter" value="{{ old('KodeDokter') }}" required autofocus>

                                @if ($errors->has('KodeDokter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('KodeDokter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="NamaDokter" class="col-md-4 col-form-label text-md-right">Nama Dokter</label>

                            <div class="col-md-6">
                                <input id="NamaDokter" type="text" class="form-control{{ $errors->has('NamaDokter') ? ' is-invalid' : '' }}" name="NamaDokter" value="{{ old('NamaDokter') }}" required autofocus>

                                @if ($errors->has('NamaDokter'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('NamaDokter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="JK" class="col-md-4 col-form-label text-md-right">JK</label>

                            <div class="col-md-6">
                                <input id="JK" type="text" class="form-control{{ $errors->has('JK') ? ' is-invalid' : '' }}" name="JK" value="{{ old('JK') }}" required autofocus>

                                @if ($errors->has('JK'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('JK') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Jabatan" class="col-md-4 col-form-label text-md-right">Jabatan</label>

                            <div class="col-md-6">
                                <input id="Jabatan" type="text" class="form-control{{ $errors->has('Jabatan') ? ' is-invalid' : '' }}" name="Jabatan" value="{{ old('Jabatan') }}" required autofocus>

                                @if ($errors->has('Jabatan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Jabatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdStatus" class="col-md-4 col-form-label text-md-right">KdStatus</label>

                            <div class="col-md-6">
                                <input id="KdStatus" type="text" class="form-control{{ $errors->has('KdStatus') ? ' is-invalid' : '' }}" name="KdStatus" value="{{ old('KdStatus') }}" required autofocus>

                                @if ($errors->has('KdStatus'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('KdStatus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="KdJenisPegawai" class="col-md-4 col-form-label text-md-right">KdJenisPegawai</label>

                            <div class="col-md-6">
                                <input id="KdJenisPegawai" type="text" class="form-control{{ $errors->has('KdJenisPegawai') ? ' is-invalid' : '' }}" name="KdJenisPegawai" value="{{ old('KdJenisPegawai') }}" required autofocus>

                                @if ($errors->has('KdJenisPegawai'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('KdJenisPegawai') }}</strong>
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
