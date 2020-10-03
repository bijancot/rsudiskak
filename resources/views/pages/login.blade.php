@extends('layouts.layout')

@section('content')
    <div class="content">

        <div class="row w-100 h-100 m-0 fullvh">
            <div class="col-12 col-lg-5">
                <div class="p-3 p-lg-5">

                    <div class="d-flex flex-column my-auto px-lg-5">
                        <img src="{{URL::asset('/img/logo-3.png')}}" alt="logo" width="266px" class="mx-auto">
                        <p class="h2 mb-3 font-weight-bold" style="margin-top: 5rem">
                            Masuk
                        </p>
        
                        <label for="username" class="my-2">Username</label>
                        <input type="text" placeholder="username">
                        
                        <label for="password" class="mb-2 mt-3">Password</label>
                        <input type="password" placeholder="password">
                        
                        <input type="submit" value="Masuk" class="btn diagnosa submit-btn ml-auto mr-0 mt-4">
                    </div>
                </div>
            </div>
            <div class="col-lg-7 p-0 m-0 d-none d-lg-block">
                <div class="doktor" style="background: url({{asset('img/doktor.png')}})">
                    <div class="asd">

                        <p class="top">Sistem Elektronik Riwayat Pasien</p>
                        <p class="copyright">Copyright © 2020 RSUD dr.Iskak Tulungagung</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection