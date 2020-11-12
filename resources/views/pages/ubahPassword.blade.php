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
                            Ubah Password
                        </p>
                        
                        <form id="frm-reset" method="POST" action="{{ action('ManajemenUserController@updatePassword') }}" class="needs-validation" novalidate>
                        @csrf
                            <div>
                                <label for="IdDokter" class="my-2">ID</label>
                                <input type="text" id="ID" placeholder="username" class="form-control" name="ID" value="{{ old('IdDokter') }}" required>
                                <div class="ID-isInvalid isInvalid-feedback">
                                    ID Tidak Ditemukan.
                                </div>
                                <div class="ID-isNull invalid-feedback">
                                    ID Harus Diisi.
                                </div>
                                <input type="hidden" id="ID-checkValid" value="0">
                            </div>    
                            <div>
                                <label for="password" class="mb-2 mt-3">Password</label>
                                <input type="password" id="password" name="password" placeholder="password" class="form-control" required>
                                <div class="password-isNull invalid-feedback">
                                    Password Harus Diisi.
                                </div>
                            </div>
                            <div>
                                <label for="password" class="mb-2 mt-3">Konfirmasi Password</label>
                                <input type="password" id="konfirmPassword" placeholder="password" class="form-control" required>
                                <input type="hidden" id="konfirmPassword-checkValid" value="0">
                                <div class="konfirmPassword-isNull invalid-feedback">
                                    Konfirmasi Password Harus Diisi.
                                </div>
                                <div class="konfirmPassword-isInValid isInvalid-feedback">
                                    Konfirmasi Password Tidak Cocok.
                                </div>
                                <div class="konfirmPassword-isValid isValid-feedback">
                                    Konfirmasi Password Cocok.
                                </div>
                            </div>
                            @if ($errors->has('IdDokter'))
                                <div class="alert alert-danger mt-4" role="alert">
                                    Username tidak ditemukan
                                </div>
                            @endif
                            <div id="log-success" class="alert alert-success mt-4" role="alert" style="display: none;">
                                Password berhasil diubah
                            </div>
                            <div id="btn-ubah" class="btn diagnosa submit-btn ml-auto mr-0 mt-4">Ubah</div>
                            <div style="width:100%;margin-top:0.5rem;font-size:90%;">
                                <a style="color:#009241;" href="{{url('login')}}">Log In</a>
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
        $('#ID').on('change', function(){
            let ID = $(this).val();
            if(ID != ""){
                $.ajax({
                    url: "{{url('/m_user/getData')}}",
                    method: 'post',
                    data: {ID: ID, _token: '<?php echo csrf_token()?>'},
                    success : function(res){
                        if(res == "Data Tidak Ditemukan"){
                            $("#ID").removeClass("isValid");
                            $("#ID").addClass("isInValid");
                            $(".ID-isInvalid").css("display", "block");
                            $(".ID-isNull").css("display", "none");
                            $("#ID-checkValid").val('0');
                        }else{
                            $("#ID").removeClass("isInValid");
                            $("#ID").addClass("isValid");
                            $(".ID-isInvalid").css("display", "none");
                            $("#ID-checkValid").val('1');
                        }
                    }
                })
            }else{
                $("#ID").removeClass("isInValid");
                $("#ID").removeClass("isValid");
                $(".ID-isInvalid").css("display", "none");
            }
        })

        $('#password').keyup(function(){
            let pass = $(this).val();
            let konfirmPassword = $(this).val();
            if(pass == ""){
                $("#password").removeClass("isValid");
                $("#password").removeClass("isInValid");
            }else if(pass == konfirmPassword){
                $("#password").removeClass("isInValid");
                $("#password").addClass("isValid");
                $(".password-isNull").css("display", "none");
                
            }
        })

        $('#konfirmPassword').keyup(function(){
            let pass = $('#password').val();
            let konfirmPassword = $(this).val();
            if(konfirmPassword == ""){
                $("#konfirmPassword").removeClass("isInValid");
                $("#konfirmPassword").removeClass("isValid");
                $(".konfirmPassword-isValid").css("display", "none");
                $(".konfirmPassword-isInValid").css("display", "none");
            }else if(pass == konfirmPassword){
                $("#konfirmPassword").removeClass("isInValid");
                $("#konfirmPassword").addClass("isValid");
                $(".konfirmPassword-isValid").css("display", "block");
                $(".konfirmPassword-isInValid").css("display", "none");
                $(".konfirmPassword-isNull").css("display", "none");
                $("#konfirmPassword-checkValid").val('1');
            }else{
                $("#konfirmPassword").removeClass("isValid");
                $("#konfirmPassword").addClass("isInValid");
                $(".konfirmPassword-isValid").css("display", "none");
                $(".konfirmPassword-isInValid").css("display", "block");
                $(".konfirmPassword-isNull").css("display", "none");
                $("#konfirmPassword-checkValid").val('0');
            }
        })

        $('#btn-ubah').click(function(){
            let ID = $('#ID').val()
            let pass = $('#password').val()
            let konfirmPassword = $('#konfirmPassword').val()
            let ID_checkValid = $('#ID-checkValid').val()
            let konfirmPassword_checkValid = $('#konfirmPassword-checkValid').val()
            
            if(ID == ""){
                $("#ID").removeClass("isValid");
                $("#ID").addClass("isInValid");
                $(".ID-isNull").css("display", "block");
            }

            if(pass == ""){
                $("#password").removeClass("isValid");
                $("#password").addClass("isInValid");
                $(".password-isNull").css("display", "block");
            }

            if(konfirmPassword == ""){
                $("#konfirmPassword").removeClass("isValid");
                $("#konfirmPassword").addClass("isInValid");
                $(".konfirmPassword-isNull").css("display", "block");
            }

            if(ID != "" && pass != "" && konfirmPassword != "" && ID_checkValid == "1" && konfirmPassword_checkValid == "1"){
                $.ajax({
                    url: "{{url('/m_user/ubahPassword')}}",
                    method: 'post',
                    data: {ID: ID, Password: pass, _token: '<?php echo csrf_token()?>'},
                    success : function(res){
                        $('#log-success').css('display', 'block');
                    }
                })
            }

        })
    </script>
@endsection
