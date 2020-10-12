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
                <a class="capsule-btn active" href="{{ url('/dataPasien\/') }}{{ $data['NoCM'] }}">Data Pasien</a>
                <a class="capsule-btn" href="{{ url('/diagnosa\/') }}{{ $data['NoCM'] }}">Diagnosa Awal</a>
                <a class="capsule-btn" href="{{ url('/diagnosaAkhir') }}{{ $data['NoCM'] }}">Diagnosa Akhir</a>
            </div>

            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h4">Data Pasien</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-6">
                        <form action="{{ action('DiagnosaController@diagnosaAwal', $data['NoCM']) }}" method="POST">
                        {{-- <form action="{{ action('DiagnosaController@diagnosaAwal') }}" > --}}
                            @csrf
                            <div class="row">
                                <div class="col-5">
                                    <label for="nopendaftaran">No Pendaftaran</label>
                                    <input type="text" name="nopendaftaran" value="??" disabled>
                                </div>
                                <div class="col-7 pl-0">
                                    <label for="norekammedis">No Rekam Medis</label>
                                    <input type="text" name="norekammedis" value="{{$data['NoCM']}}" disabled>
                                </div>
                            
                                <div class="col-8">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" value="{{$data['NamaLengkap']}}" disabled>
                                </div>
                                <div class="col-4 pl-0">
                                    <label for="agama">Agama Pasien</label>
                                    <input type="text" name="agama" value="Islam" disabled>
                                </div>
                            
                                <div class="col-8">
                                    <label for="tanggallahir">Tanggal Lahir</label>
                                    <input type="text" name="tanggallahir" value="{{$data['TglLahir']}}" disabled>
                                </div>
                                <div class="col-2 pl-0">
                                    <label for="umur">Umur Pasien</label>
                                    <input type="text" name="umur" value="{{$data['UmurTahun']}} Tahun" disabled>
                                </div>
                                <div class="col-2 pl-0">
                                    <label for="jk">Jenis Kelamin</label>
                                    <input type="text" name="jk" value="{{($data['JenisKelamin']=='L'?'Laki-laki':'Perempuan')}}" disabled>
                                </div>
                            
                                <div class="col-12">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" value="{{$data['Alamat']}}" disabled>
                                </div>
                            
                                <div class="col-4">
                                    <label for="nopendaftaran">Desa</label>
                                    <input type="text" name="nopendaftaran" value="{{$data['Kelurahan']}}" disabled>
                                </div>
                                <div class="col-4 pl-0">
                                    <label for="norekammedis">Kecamatan</label>
                                    <input type="text" name="norekammedis" value="{{$data['Kecamatan']}}" disabled>
                                </div>
                                <div class="col-4 pl-0">
                                    <label for="norekammedis">Kota/Kabupaten</label>
                                    <input type="text" name="norekammedis" value="{{$data['Kota']}}" disabled>
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
                                    
                                    <button type="submit" class="btn btn-dark green-long m-0">Diagnosa awal</button>
                                    {{-- <a class="btn btn-dark green-long m-0" href="{{ action ('DiagnosaController@diagnosaAwal', $data['NoCM'])}}">Diagnosa awal</a> --}}

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
@endsection