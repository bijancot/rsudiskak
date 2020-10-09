@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">

            @include('includes.subNavbar')
            
            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h5">Diagnosa Awal Pasien</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-6">
                        <form method="POST" action="{{action('DiagnosaController@InsertDiagnosaAwal')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="anamnesis">Anamnesis</label>
                                    <input type="text" name="anamnesis" value="Sesak Napas, Muntah Darah 3x, BAB Hitam pekat">
                                </div>
                                <div class="col-4">
                                    <label for="tekanandarah">Tekanan Darah</label>
                                    <input type="text" name="tekanandarah" placeholder="Tekanan">
                                </div>
                                <div class="col-3 pl-0">
                                    <label for="suhutubuh">Suhu Tubuh</label>
                                    <input type="text" name="suhutubuh" placeholder="Suhu">
                                </div>
                                <div class="col-3 pl-0">
                                    <label for="beratbadan">Berat Badan</label>
                                    <input type="text" name="beratbadan" placeholder="Berat">
                                </div>
                                <div class="col-2 pl-0">
                                    <label class="separator">Y</label>
                                    <input type="text" name="beratbadan" value="Kg" disabled>
                                </div>
                                <div class="col-12">
                                    <label for="pemeriksaanfisik">Pemeriksaan Fisik</label>
                                    <input type="text" name="pemeriksaanfisik" placeholder="Pemeriksaan Fisik">
                                </div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <label for="alamat">Diagnosa</label>
                                    <select class="custom-select">
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Jenis Pelayanan</label>
                                    <select class="custom-select">
                                        <option selected>Dalam</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="alamat">Dokter Pemeriksa</label>
                                    <select class="custom-select">
                                        <option selected>dr. Agam Putanto sp. PD</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-dark green-long m-0" data-toggle="modal" data-target="#modal_diagnosaAwal">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection