@extends('layouts.layout')

@section('content')

@include('includes.admin.navbar')
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <div class="search-box-box">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="search-box-box">
                            <input id="cstm_search" type="text" placeholder="Cari Nama Pasien" class="soft-shadow">
                            <span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9167 11.6667H12.2583L12.025 11.4417C12.8417 10.4917 13.3333 9.25833 13.3333 7.91667C13.3333 4.925 10.9083 2.5 7.91667 2.5C4.925 2.5 2.5 4.925 2.5 7.91667C2.5 10.9083 4.925 13.3333 7.91667 13.3333C9.25833 13.3333 10.4917 12.8417 11.4417 12.025L11.6667 12.2583V12.9167L15.8333 17.075L17.075 15.8333L12.9167 11.6667ZM7.91667 11.6667C5.84167 11.6667 4.16667 9.99167 4.16667 7.91667C4.16667 5.84167 5.84167 4.16667 7.91667 4.16667C9.99167 4.16667 11.6667 5.84167 11.6667 7.91667C11.6667 9.99167 9.99167 11.6667 7.91667 11.6667Z" fill="#C7D3CC"/></svg></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 mt-4 mt-lg-0">
                        <div class="d-flex align-items-center">
                            @if(Auth::user()->KdJabatan =='003') 
                            <a style="visibility:hidden" id="nav_antrianPoli" class="capsule-btn capsule-left active ml-auto">Antrian Pasien</a>
                            <a style="visibility:hidden" id="nav_masukPoli" class="capsule-btn capsule-right">Masuk Poli</a>
                            @else
                            <a id="nav_antrianPoli" class="capsule-btn capsule-left active ml-auto">Antrian Pasien</a>
                            <a id="nav_masukPoli" class="capsule-btn capsule-right">Masuk Poli</a>
                            @endif
                            
                        </div>
                    </div>
                </div>    
            </div>
            <div class="table-container soft-shadow">
                <div class="card">
                    <div class="card-title mt-3 ml-3">
                        <a data-toggle="modal" data-target="#modal_tambah" class="btn diagnosa">Tambah</a>
                    </div>
                    <div class="card-body">
                        <table id="tbl_user" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Kode Ruangan</th>
                                    <th>Nama Ruangan</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataUser as $item)
                                    @php
                                        $role = "";
                                        if($item['Role'] == "1"){
                                            $role = "Dokter";
                                        }else if($item['Role'] == "2"){
                                            $role = "Perawat";
                                        }else if($item['Role'] == "3"){
                                            $role = "Admin Poli";
                                        }
                                    @endphp
                                    <tr>
                                        <td data-label="ID">{{$item['ID']}}</td>
                                        <td data-label="Nama">{{$item['Nama']}}</td>
                                        <td data-label="Role">{{$role}}</td>
                                        <td data-label="KodeRuangan">{{$item['KodeRuangan']}}</td>
                                        <td data-label="NamaRuangn">{{$item['NamaRuangan']}}</td>
                                        <td data-label="Action" class="p-lg-1"><div class="d-flex flex-row"><a href="#" data-toggle="modal" data-target="#modal_reset" data-id="{{$item['ID']}}" class="btn btn-secondary reset-password ml-auto">Reset Password</a><a href="#" data-toggle="modal" data-target="#modal_ubah" data-id="{{$item['ID']}}" class="btn btn-primary ubah-data">Ubah</a><a href="#" data-toggle="modal" data-target="#modal_hapus" data-id="{{$item['ID']}}" class="btn hapus-data batal">Hapus</a></div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal tambah --}}
    <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Tambah User </h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ action('ManajemenUserController@store')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ID" class="col-form-label">ID :</label>
                        <input type="text" class="form-control" name="ID" required>
                        <div class="invalid-feedback">
                            Data ID Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Nama" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" name="Nama" required>
                        <div class="invalid-feedback">
                            Data Nama Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Nama" class="col-form-label">Password :</label>
                        <input type="text" class="form-control" value="rsudiskak" disabled>
                    </div>
                    <div class="form-group">
                        <label for="Role" class="col-form-label">Role :</label>
                        <select name="Role" class="form-control">
                            <option value="1">Dokter</option>
                            <option value="2">Perawat</option>
                            <option value="3">Admin Poli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="KodeRuangan" class="col-form-label">Kode Ruangan :</label>
                        <select name="KodeRuangan" class="form-control">
                            @foreach ($kdRuangan as $item)
                                <option value="{{$item['KdRuangan']}}" selected>{{$item['KdRuangan']}} - {{$item['NamaRuangan']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="StatusLogin" value="0">
                    <input type="hidden" name="Status" value="1">
                    <button type="submit" class="btn btn-dark diagnosa">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    {{-- modal ubah --}}
    <div class="modal fade" id="modal_ubah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Ubah User '<span class="title-id"></span>'</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ action('ManajemenUserController@update')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ID" class="col-form-label">ID :</label>
                        <input type="text" class="form-control" id="ID" name="ID" required>
                        <div class="invalid-feedback">
                            Data ID Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Nama" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" id="Nama" name="Nama" required>
                        <div class="invalid-feedback">
                            Data Nama Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Role" class="col-form-label">Role :</label>
                        <select name="Role" class="form-control" id="Role">
                            <option value="Dokter">Dokter</option>
                            <option value="Perawat">Perawat</option>
                            <option value="Admin Poli">Admin Poli</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="KodeRuangan" class="col-form-label">Kode Ruangan :</label>
                        <select name="KodeRuangan" class="form-control" id="KodeRuangan">
                            @foreach ($kdRuangan as $item)
                                <option value="{{$item['KdRuangan']}}">{{$item['KdRuangan']}} - {{$item['NamaRuangan']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="IDOld" id="IDOld">
                    <button type="submit" class="btn btn-dark diagnosa">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div> 
    </div>
    {{-- modal reset password --}}
    <div class="modal fade" id="modal_reset" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white">Reset Password User '<span class="title-id"></span>'</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ action('ManajemenUserController@resetPassword')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                <p style="text-align:center;margin:20px;">Apakah anda yakin untuk mereset user '<span class="title-id"></span>'</p>
                <div class="modal-footer">
                    <input type="hidden" name="ID_reset" id="ID_reset">
                    <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div> 
    </div>
    {{-- modal hapus --}}
    <div class="modal fade" id="modal_hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Reset Password User '<span class="title-id"></span>'</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ action('ManajemenUserController@delete')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                <p style="text-align:center;margin:20px;">Apakah anda yakin untuk menghapus user '<span class="title-id"></span>'</p>
                <div class="modal-footer">
                    <input type="hidden" name="ID_hapus" id="ID_hapus">
                    <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div> 
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#tbl_user').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup', function () {
                table.search( this.value ).draw();
            });
            $('#tbl_user_filter').hide();
        });
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
        $('#tbl_user tbody').on('click', '.ubah-data', function(){
            let ID = $(this).data('id');
            $('.title-id').html(ID);
            $('#IDOld').val(ID);
            $.ajax({
                url: "{{url('/m_user/getData')}}",
                method: 'post',
                data: {ID: ID, _token: '<?php echo csrf_token()?>'},
                success : function(res){
                    $('#ID').val(res.ID);
                    $('#Nama').val(res.Nama);
                    $('#Role').val(res.Role);
                    $('#KodeRuangan').val(res.KodeRuangan);
                }
            })
        })
        $('#tbl_user tbody').on('click', '.reset-password', function(){
            let ID = $(this).data('id');
            $('.title-id').html(ID);
            $('#ID_reset').val(ID);
        })
        $('#tbl_user tbody').on('click', '.hapus-data', function(){
            let ID = $(this).data('id');
            $('.title-id').html(ID);
            $('#ID_hapus').val(ID);
        })
    </script>
@endsection