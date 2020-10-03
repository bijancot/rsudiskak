@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">

            @include('includes.subNavbar')
            
            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h5">Data Resep</p>
                </div>
                <hr>
                <div class="row p-3 py-4">

                    <div class="col-12 col-lg-3">
                        <label for="anamnesis">No Resep</label>
                        <input type="text" name="anamnesis" value="5151185" disabled>
                    </div>
                    <div class="col-12 col-lg-3 pl-0">
                        <label for="tekanandarah">Apotek Tujuan</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="pemeriksaanfisik">Nama Paket</label>
                        <input type="text" name="pemeriksaanfisik" placeholder="Pak Josepsh">
                    </div>
                </div>
                <div class="row p-3 py-4">
                    <div class="col-lg-2">                  <!-- Loop en iki -->
                        <label for="tekanandarah">Jenis Obat</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="tekanandarah">Obat</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="anamnesis">Jumlah</label>
                        <input type="text" name="anamnesis" value="5151185" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="tekanandarah">Aturan Pakai</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="tekanandarah">Keterangan</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="anamnesis">Keterangan Lainnya</label> 
                        <input type="text" name="anamnesis" value="5151185" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="tekanandarah">Jenis Obat</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="tekanandarah">Obat</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="anamnesis">Jumlah</label>
                        <input type="text" name="anamnesis" value="5151185" disabled>
                    </div>
                    <div class="col-lg-2">
                        <label for="tekanandarah">Aturan Pakai</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="tekanandarah">Keterangan</label>
                        <select class="custom-select">
                            <option selected>Apotek 1</option>
                            <option value="1">Apotek One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 pl-0">
                        <label for="anamnesis">Keterangan Lainnya</label> 
                        <input type="text" name="anamnesis" value="5151185" disabled>
                    </div>
                    
                    <div class="col-12">
                        <button class="btn btn-tambah mt-3">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection