@extends('layouts.layout')

@section('content')

    @include('includes.admin.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">
            
            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h5">Submit Data</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-12">
                        <form method="POST" action="{{ action('UploadFileController@store') }}" enctype="multipart/form-data">>
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-lg-5">
                                            <label for="">No Rekam Medis</label>
                                            <select name="dokter" class="custom-select" id="submit_data">
                                                <option selected>8709089089</option>
                                                
                                            </select>
                                        </div>
                                        <div class="col-8 col-lg-4 pl-lg-0 mt-3 mt-lg-0">
                                            <label for="">Tanggal Transaksi</label>
                                            <input type="date" name="" value="27 Agustus 2020" class="custom-select">
                                        </div>
                                        <div class="col-4 col-lg-3 pl-0 mt-3 mt-lg-0">
                                            <label for="">Jam</label>
                                            <input type="time" name="" value="27 Agustus 2020" class="custom-select">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="">Nama Pasien</label>
                                            <input type="text" name="" value="Jacob Jones Harianto P" disabled>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-12 col-lg-6 mt-3 mt-lg-0">

                                    <div class="row">
    
                                        <div class="col-12 my-3 d-block d-lg-none">
                                            <hr class="d-block d-lg-none">
                                        </div>
                                        
                                        <div class="col-12 mt-3 mt-lg-0">
                                            <label for="submit_data">Upload File</label>
                                            <div class="file-area">
                                                <label for="file-upload1">
                                                    <input type="file" name="file">
                                                </label>
                                                <label for="file-upload1">
                                                    <input type="file">
                                                    
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn green-long m-0" data-toggle="modal" data-target="#modal_success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#msg_modal').html('Pilih Dokter Berhasil');
        })
    </script>
@endsection
