@extends('layouts.layout')

@section('content')

    @include('includes.admin.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">
            
            <div class="d-flex flex-column align-items-center mb-5">
                <a href="{{url('/listPasien')}}" class="mr-auto">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                        Kembali
                    </span>
                </a>
                
                <a class="capsule-btn active capsule-single ml-auto mt-3 mt-lg-0" href="#">Pengkajian Awal Pasien Rawat Jalan</a>
            </div>

            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h4">Data Pasien</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-lg-2 col-12 mt-3 mt-lg-0">
                        <label for="nopendaftaran">No Pendaftaran</label>
                        <input type="text" name="nopendaftaran" value="2010180076" disabled>
                    </div>
                    <div class="col-lg-2 pl-lg-0 col-12 mt-3 mt-lg-0">
                        <label for="norekammedis">No Rekam Medis</label>
                        <input type="text" name="norekammedis" value="11930222" disabled>
                    </div>
                
                    <div class="col-lg-8 pl-lg-0 col-12 mt-3 mt-lg-0">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" value="Jacob Jones Harianto Putra" disabled>
                    </div>
                    <div class="col-lg-2 col-6 mt-3 mt-lg-0">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" name="jk" value="Laki-laki" disabled>
                    </div>              
                    <div class="col-lg-2 pl-0 pl-lg-0 col-6 mt-3 mt-lg-0">
                        <label for="umur">Umur Pasien</label>
                        <input type="text" name="umur" value="25 Tahun" disabled>
                    </div>
                    <div class="col-lg-2 pl-lg-0 col-6 mt-3 mt-lg-0">
                        <label for="kelas">Kelas Pelayanan</label>
                        <input type="text" name="kelas" value="Kelas III" disabled>
                    </div>
                    <div class="col-lg-2 pl-0 col-6 mt-3 mt-lg-0">
                        <label for="penjamin">Penjamin</label>
                        <input type="text" name="penjamin" value="BPJS" disabled>
                    </div>
                    <div class="col-lg-4 pl-lg-0 col-12 mt-3 mt-lg-0">
                        <label for="tanggalmasuk">Tanggal Masuk</label>
                        <input type="text" name="tanggalmasuk" value="27/08/2020 13:12" disabled>
                    </div>
                </div>  
            </div>

            <div class="table-container soft-shadow pt-5">
                <table id="tbl_antrianPoli" class="table table-striped">
                    <thead>
                        <th>Tgl Berkunjung</th>
                        <th>Poliklinik</th>
                        <th>Diagnosis</th>
                        <th>Penatalaksanaan</th>
                        <th>Riwayat Rawat Inap</th>
                        <th>Verifikasi Petugas Kesehatan</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Tgl Berkunjung">13/09/2020 - 08:30</td>
                            <td data-label="Poliklinik">Poli Jantung</td>
                            <td data-label="Diagnosis">CAD, HF</td>
                            <td data-label="Penatalaksanaan">-</td>
                            <td data-label="Riwayat Rawat Inap">-</td>
                            <td data-label="Verifikasi Petugas Kesehatan" class="p-lg-1">
                                <a href="#" class="btn diagnosa ml-auto px-5">
                                    <svg width="20" height="20" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M53.1884 4.76378C45.2787 11.6094 38.5868 18.126 32.4602 26.6282C29.7584 30.3782 26.7537 34.7919 24.7896 38.9591C23.6684 41.1688 21.6471 44.6216 20.9581 47.9413C17.1893 44.435 13.1412 40.4553 8.99931 37.3382C6.04712 35.1172 -2.456 39.6453 1.00525 42.2497C7.20868 46.9157 12.3677 52.7272 18.4015 57.6013C20.9252 59.6375 26.5184 55.2153 27.8327 53.36C32.1471 47.2475 32.7368 39.7757 35.8812 33.1082C40.6821 22.911 49.1965 14.5344 57.6031 7.26034C63.1727 2.06566 57.4202 1.10753 53.1968 4.76378" fill="#FFFFFF"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Tgl Berkunjung">13/09/2020 - 08:30</td>
                            <td data-label="Poliklinik">Poli Jantung</td>
                            <td data-label="Diagnosis">CAD, HF</td>
                            <td data-label="Penatalaksanaan">-</td>
                            <td data-label="Riwayat Rawat Inap">-</td>
                            <td data-label="Verifikasi Petugas Kesehatan" class="p-lg-1">
                                <a href="#" class="btn diagnosa ml-auto px-5">
                                    <svg width="20" height="20" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M53.1884 4.76378C45.2787 11.6094 38.5868 18.126 32.4602 26.6282C29.7584 30.3782 26.7537 34.7919 24.7896 38.9591C23.6684 41.1688 21.6471 44.6216 20.9581 47.9413C17.1893 44.435 13.1412 40.4553 8.99931 37.3382C6.04712 35.1172 -2.456 39.6453 1.00525 42.2497C7.20868 46.9157 12.3677 52.7272 18.4015 57.6013C20.9252 59.6375 26.5184 55.2153 27.8327 53.36C32.1471 47.2475 32.7368 39.7757 35.8812 33.1082C40.6821 22.911 49.1965 14.5344 57.6031 7.26034C63.1727 2.06566 57.4202 1.10753 53.1968 4.76378" fill="#FFFFFF"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Tgl Berkunjung">13/09/2020 - 08:30</td>
                            <td data-label="Poliklinik">Poli Jantung</td>
                            <td data-label="Diagnosis">CAD, HF</td>
                            <td data-label="Penatalaksanaan">-</td>
                            <td data-label="Riwayat Rawat Inap">-</td>
                            <td data-label="Verifikasi Petugas Kesehatan" class="p-lg-1">
                                <a href="#" class="btn diagnosa ml-auto px-5">
                                    <svg width="20" height="20" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M53.1884 4.76378C45.2787 11.6094 38.5868 18.126 32.4602 26.6282C29.7584 30.3782 26.7537 34.7919 24.7896 38.9591C23.6684 41.1688 21.6471 44.6216 20.9581 47.9413C17.1893 44.435 13.1412 40.4553 8.99931 37.3382C6.04712 35.1172 -2.456 39.6453 1.00525 42.2497C7.20868 46.9157 12.3677 52.7272 18.4015 57.6013C20.9252 59.6375 26.5184 55.2153 27.8327 53.36C32.1471 47.2475 32.7368 39.7757 35.8812 33.1082C40.6821 22.911 49.1965 14.5344 57.6031 7.26034C63.1727 2.06566 57.4202 1.10753 53.1968 4.76378" fill="#FFFFFF"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
