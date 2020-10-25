@extends('layouts.layout')

@section('content')
    <div class="content">

        <div class="row w-100 h-100 m-0 fullvh">
            
            <div class="d-block d-lg-none login-bg-sm" style="background: linear-gradient(0deg, rgba(247, 250, 248, 0.95), rgba(247, 250, 248, 0.95)), url({{asset('img/doktor.png')}})"></div>
            <div class="col-12 col-lg-5">
                <div class="p-3 p-lg-5">

                    <div class="d-flex flex-column my-auto px-lg-5">
                        <img src="{{URL::asset('/img/logo-3.png')}}" alt="logo" width="266px" class="mx-auto">
                        <p class="h2 mb-3 font-weight-bold" style="margin-top: 5rem">
                            Masuk
                        </p>
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <label for="IdDokter" class="my-2">Username</label>
                            <input type="text" name="IdDokter"  placeholder="username" class="form-control{{ $errors->has('Error') ? ' is-invalid' : '' }}" name="IdDokter" value="{{ old('IdDokter') }}">
                                @if ($errors->has('IdDokter'))
                                <div class="modal fade" id="modal_login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title text-white text-center">Error</h5>
                                            </div>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="keterangan" class="col-form-label" style="color:#2e3131">Username / Password Salah</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-dark diagnosa">Okee</button>
                                                </div>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                                @endif
                            <label for="password" class="mb-2 mt-3">Password</label>
                            <input type="password" name="password" placeholder="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                               
                            <button type="submit" class="btn diagnosa submit-btn ml-auto mr-0 mt-4">
                                    Masuk
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 p-0 m-0 d-none d-lg-block">
                <div class="doktor" style="background: url({{ asset('img/doktor.png') }})">
                    <div class="asd">

                        <p class="top">Sistem Elektronik Riwayat Pasien</p>
                        <p class="copyright">Copyright © 2020 RSUD dr.Iskak Tulungagung</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
