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
                        
                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf
                            <div>
                                <label for="IdDokter" class="my-2">ID</label>
                                <input type="text" name="ID"  placeholder="id" class="form-control{{ $errors->has('Error') ? ' is-invalid' : '' }}" value="{{ old('IdDokter') }}" required>
                                <div class="invalid-feedback">
                                    Username Harus Diisi.
                                </div>
                            </div>    
                            <div>
                                <label for="password" class="mb-2 mt-3">Password</label>
                                <input type="password" name="password" placeholder="password" class="form-control{{ $errors->has('Password') ? ' is-invalid' : '' }}" required>
                                <div class="invalid-feedback">
                                    Password Harus Diisi.
                                </div>
                            </div>
                            @if ($errors->has('ID'))
                                <div class="alert alert-danger mt-4" role="alert">
                                    Username / Password Salah
                                </div>
                            @endif
                            <button type="submit" class="btn diagnosa submit-btn ml-auto mr-0 mt-4">
                                    Masuk
                            </button>
                            <div style="width:100%;margin-top:0.5rem;font-size:90%;">
                                <a style="color:#009241;" href="{{url('m_user/lupaPassword')}}">Lupa Password ?</a>
                            </div>
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
    <script>
         (function() {
            'use strict';
            window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                }, false);
            });
            }, false);
        })();
    </script>
@endsection
