@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">
            
            @include('includes.subNavbar')

            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h4">Data Pasien</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-5">
                                <label for="nopendaftaran">No Pendaftaran</label>
                                <input type="text" name="nopendaftaran" value="32161512151" disabled>
                            </div>
                            <div class="col-7 pl-0">
                                <label for="norekammedis">No Rekam Medis</label>
                                <input type="text" name="norekammedis" value="11930222" disabled>
                            </div>
                        
                            <div class="col-8">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" value="Jacob Jones Harianto Putra" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="agama">Agama Pasien</label>
                                <input type="text" name="agama" value="Islam" disabled>
                            </div>
                        
                            <div class="col-8">
                                <label for="tanggallahir">Tanggal Lahir</label>
                                <input type="text" name="tanggallahir" value="27 Desember 1981" disabled>
                            </div>
                            <div class="col-2 pl-0">
                                <label for="umur">Umur Pasien</label>
                                <input type="text" name="umur" value="25 Tahun" disabled>
                            </div>
                            <div class="col-2 pl-0">
                                <label for="jk">Jenis Kelamin</label>
                                <input type="text" name="jk" value="Laki-laki" disabled>
                            </div>
                        
                            <div class="col-12">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" value="3891 Ranchview Dr. Richardson, California 62639" disabled>
                            </div>
                        
                            <div class="col-4">
                                <label for="nopendaftaran">Desa</label>
                                <input type="text" name="nopendaftaran" value="Kunir" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="norekammedis">Kecamatan</label>
                                <input type="text" name="norekammedis" value="Wonodadi" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="norekammedis">Kota/Kabupaten</label>
                                <input type="text" name="norekammedis" value="Kab. Blitar" disabled>
                            </div>
                        
                            <div class="col-4">
                                <label for="status">Status</label>
                                <input type="text" name="status" value="Kawin" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="tanggungjawab">Tanggung Jawab</label>
                                <input type="text" name="tanggungjawab" value="Istri" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="namapenanggungjawab">Nama Penangggung Jawab</label>
                                <input type="text" name="namapenanggungjawab" value="Yelena Putri Dana" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="alamat">Alamat Penangggung Jawab</label>
                                <input type="text" name="alamat" value="3891 Ranchview Dr. Richardson, California 62639" disabled>
                            </div>
                        
                            <div class="col-4">
                                <label for="nopendaftaran">Desa</label>
                                <input type="text" name="nopendaftaran" value="Kunir" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="norekammedis">Kecamatan</label>
                                <input type="text" name="norekammedis" value="Wonodadi" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="norekammedis">Kota/Kabupaten</label>
                                <input type="text" name="norekammedis" value="Kab. Blitar" disabled>
                            </div>
                        
                            <div class="col-6">
                                <label for="caramasuk">Cara Masuk RS</label>
                                <input type="text" name="caramasuk" value="Sendiri" disabled>
                            </div>
                            <div class="col-6 pl-0">
                                <label for="carapenerimaan">Cara Penerimaan</label>
                                <input type="text" name="carapenerimaan" value="Inst Kesehatan - Klinik Bunga Teratai" disabled>
                            </div>
                        
                            <div class="col-3">
                                <label for="kelas">Kelas Pelayanan</label>
                                <input type="text" name="kelas" value="Kelas III" disabled>
                            </div>
                            <div class="col-3 pl-0">
                                <label for="penjamin">Penjamin</label>
                                <input type="text" name="penjamin" value="BPJS" disabled>
                            </div>
                            <div class="col-4 pl-0">
                                <label for="tanggalmasuk">Tanggal Masuk</label>
                                <input type="text" name="tanggalmasuk" value="27 Agustus 2020" disabled>
                            </div>
                            <div class="col-2 pl-0">
                                <label for="jam">Jam</label>
                                <input type="text" name="jam" value="13.02" disabled>
                            </div>

                            <div class="col-12">
                                <label class="separator">Y</label>      <!-- KOSONGAN LUR, CUMA SEPARATOR, PUSING -->
                                <input type="text" class="separator">               <!-- KOSONGAN LUR, BEN BUTTON E NDEK ISOR -->
                            </div>
                            <div class="col-12 mt-auto">
                                <label class="separator">Y</label>      <!-- KOSONGAN LUR -->
                                
                                <button class="btn btn-dark green-long m-0">Diagnosa</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
@endsection