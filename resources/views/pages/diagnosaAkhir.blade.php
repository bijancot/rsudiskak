@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">
            <div class="d-flex align-items-center mb-5">
                <a href="{{url('/listPasien')}}" class="mr-auto">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                        Kembali
                    </span>
                </a>
                <a class="capsule-btn secondary" href="{{ url('/diagnosa\/') }}{{ $data['NoCM'] }}">Diagnosa Awal</a>
                <a class="capsule-btn active" href="{{ url('/diagnosaAkhir\/') }}{{ $data['NoCM'] }}">Diagnosa Akhir</a>
                <a class="capsule-btn " href="{{ url('/riwayat\/') }}{{ $data['NoCM'] }}">Riwayat</a>
            </div>
            <form action="{{action('DiagnosaController@storeDiagnosaAkhir')}}" method="POST">
                @csrf
                <div class="content soft-shadow">
                    <div class="p-3">
                        <p class="h5">Diagnosa Akhir Pasien</p>
                    </div>
                    <hr>
                    <div class="row p-3 py-4">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="anamnesis">Dokter Pemeriksa</label>
                                    <input type="text" name="anamnesis" value="dr. Heri Sutrisno Sp. PD" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Pemeriksaan</label>
                                    <select class="custom-select" disabled>
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Penunjang</label>
                                    <select class="custom-select" disabled>
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-8">
                                    <label for="beratbadan">Kompilasi</label>
                                    <input type="text" name="beratbadan" placeholder="Berat" disabled>
                                </div>
                                <div class="col-4 pl-0">
                                    <label >Triase</label>
                                    <select class="custom-select" disabled>
                                        <option selected>Hitam</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="alamat">Riwayat Alergi</label>
                                    <input type="text" name="beratbadan" value="-" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Diagnosa Akhir</label>
                                    <select class="custom-select" disabled>
                                        <option selected>Animeia</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="content soft-shadow mt-4">
                    <div class="d-flex">
                        <p class="h5 p-3">Data Resep</p>
                        <button type="submit" class="ml-auto btn diagnosa px-5 m-2 mr-3" data-toggle="modal" data-target="#modal_success">Simpan</button>
                    </div>
                    <hr>
                    <div class="row p-3 py-4">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="anamnesis">No Resep</label>
                                    <input type="text" name="anamnesis" value="5151185" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Apotek Tujuan</label>
                                    <select class="custom-select" {{ $isDisabled }}>
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Penunjang</label>
                                    <select class="custom-select" {{ $isDisabled }}>
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-8">
                                    <label for="beratbadan">Kompilasi</label>
                                    <input type="text" name="beratbadan" placeholder="Berat" {{ $isDisabled }}>
                                </div>
                                <div class="col-4 pl-0">
                                    <label >Triase</label>
                                    <select class="custom-select" {{ $isDisabled }}>
                                        <option selected>Hitam</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="alamat">Riwayat Alergi</label>
                                    <input type="text" name="beratbadan" value="-" {{ $isDisabled }}>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Diagnosa Akhir</label>
                                    <select class="custom-select" {{ $isDisabled }}>
                                        <option selected>Animeia</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="p-3">
                        <p class="h5">Laboratorium</p>
                    </div>
                    <hr>
                    <div class="row p-3 py-4">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="alamat">Pemeriksaan</label>
                                    <select class="custom-select" {{ $isDisabled }}>
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Penunjang</label>
                                    <select class="custom-select" {{ $isDisabled }}>
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="row h-100">
                                <div class="col-12">
                                    <div class="form-group h-100">
                                        <label for="exampleFormControlTextarea1">Riwayat Alergi</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" {{ $isDisabled }}></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#msg_modal').html('Dignosa Akhir Berhasil');
        })
    </script>
    @include('includes.footer')

@endsection