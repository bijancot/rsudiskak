@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">
            
            <div class="d-flex flex-column align-items-center mb-5">
                <a href="{{url('/listPasien')}}" class="mr-auto">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                        Kembali
                    </span>
                </a>
                
                <a class="capsule-btn active capsule-single ml-auto mt-3 mt-lg-0" href="#">Pengkajian Ulang Pasien Rawat Jalan</a>
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

            <div class="content mt-3 soft-shadow collapsible">
                <div class="p-3 collapsible-head inactive">
                    <p class="h6">I. Pengkajian Keperawatan <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M7,10L12,15L17,10H7Z" /></svg></p>
                </div>
                <hr>

                <div class="collapsible-body">
    
                    <div class="row py-3">
                        
                        <div class="col-lg-6 col-12">
                            <div class="row m-3 py-3 border-round">
                                <div class="col-12 mb-3">
                                    <p class="text-grey">Tanda Vital</p>
                                <hr>
                                </div>
    
                                <div class="col-8 mt-3 mt-lg-0">
                                    <label for="nopendaftaran">Tekanan Darah</label>
                                    <input type="text" name="nopendaftaran" value="100/80">
                                </div>
                                <div class="pl-0 col-4 mt-3 mt-lg-0">
                                    <label for="norekammedis"></label>
                                    <input type="text" name="norekammedis" value="mmHg" disabled>
                                </div>
    
                                <div class="col-8 mt-3">
                                    <label for="nopendaftaran">Frekuensi Nadi</label>
                                    <input type="text" name="nopendaftaran" value="88">
                                </div>
                                <div class="pl-0 col-4 mt-3">
                                    <label for="norekammedis"></label>
                                    <input type="text" name="norekammedis" value="x/menit" disabled>
                                </div>
    
                                <div class="col-8 mt-3">
                                    <label for="nopendaftaran">Suhu</label>
                                    <input type="text" name="nopendaftaran" value="36.5">
                                </div>
                                <div class="pl-0 col-4 mt-3">
                                    <label for="norekammedis"></label>
                                    <input type="text" name="norekammedis" value="C" disabled>
                                </div>
    
                                <div class="col-8 mt-3">
                                    <label for="nopendaftaran">Frekuensi Nafas</label>
                                    <input type="text" name="nopendaftaran" value="-">
                                </div>
                                <div class="pl-0 col-4 mt-3">
                                    <label for="norekammedis"></label>
                                    <input type="text" name="norekammedis" value="x/menit" disabled>
                                </div>
                    
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-12">
                            <div class="row m-3 py-3 border-round">
                                <div class="col-12 mb-3">
                                    <p class="text-grey">Antropometri</p>
                                <hr>
                                </div>
    
                                <div class="col-8 mt-3 mt-lg-0">
                                    <label for="nopendaftaran">Berat Badan</label>
                                    <input type="text" name="nopendaftaran" value="80">
                                </div>
                                <div class="pl-0 col-4 mt-3 mt-lg-0">
                                    <label for="norekammedis"></label>
                                    <input type="text" name="norekammedis" value="Kg" disabled>
                                </div>
    
                                <div class="col-8 mt-3">
                                    <label for="nopendaftaran">Tinggi Badan</label>
                                    <input type="text" name="nopendaftaran" value="160">
                                </div>
                                <div class="pl-0 col-4 mt-3">
                                    <label for="norekammedis"></label>
                                    <input type="text" name="norekammedis" value="cm" disabled>
                                </div>

                                <div class="col-8 mt-3">
                                    <label for="nopendaftaran">Skor Nyeri</label>
                                    <input type="text" name="nopendaftaran" value="160">
                                </div>
                                
                                <div class="col-12 mt-3 pr-5">
                                    <label for="nopendaftaran" class="pb-3">Skor Jatuh</label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="radio" id="rendah" name="skorJatuh" value="rendah" checked>
                                            <label for="rendah">Rendah</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="sedang" name="skorJatuh" value="sedang">
                                            <label for="sedang">Sedang</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="tinggi" name="skorJatuh" value="tinggi">
                                            <label for="tinggi">Tinggi</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="#" class="btn green-long w-50 ml-auto mr-3"> Submit</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content mt-3 soft-shadow collapsible">
                <div class="p-3 collapsible-head inactive">
                    <p class="h6">II. Pengkajian Keperawatan <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M7,10L12,15L17,10H7Z" /></svg></p>
                </div>
                <hr>
                <div class="collapsible-body">
                    <div class="row m-3 py-3">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group h-100">
                                        <label for="anamnesis">Anamesis (S)</label>
                                        <textarea class="form-control" id="anamnesis"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="form-group h-100">
                                        <label for="pemeriksaanFisik">Pemeriksaan Fisik (O)</label>
                                        <textarea class="form-control" id="pemeriksaanFisik"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="diagnosa">Diagnosa (A)</label>
                                    <input type="text" name="diagnosa" value="">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="kodeICD">Kode ICD 10</label>
                                    <select class="custom-select" id="kodeICD">
                                        <option selected>-</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="komplikasi">Komplikasi</label>
                                    <input type="text" name="komplikasi" value="">
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="komorbid">Komorbid</label>
                                    <input type="text" name="komorbid" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group h-100">
                                        <label for="rencanadanterapi">Rencana dan Terapi (P)</label>
                                        <textarea class="form-control" id="rencanadanterapi"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="kodeICD">Kode ICD 9</label>
                                    <select class="custom-select" id="kodeICD">
                                        <option selected>-</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="form-group h-100">
                                        <label for="edukasi">Edukasi</label>
                                        <textarea class="form-control" id="edukasi"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="penyakitmenular">Penyakit Menular</label>
                                    <input type="text" name="penyakitmenular" value="">
                                </div>
                                <div class="col-12 mt-3 pr-5">
                                    <label for="kesanstatusgizi" class="pb-3">Kesan Status Gizi</label>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <input type="radio" id="kurang" name="kesanstatusgizi" value="kurang" checked>
                                            <label for="kurang">Gizi Kurang/Buruk</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="cukup" name="kesanstatusgizi" value="cukup">
                                            <label for="cukup">Gizi Cukup</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="lebih" name="kesanstatusgizi" value="lebih">
                                            <label for="lebih">Gizi Lebih</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="#" class="btn secondary">List dirujuk/konsul ke</a>
                                </div>
                                <div class="col-12 mt-3">
                                    <a href="#" class="btn green-long">Submit</a>
                                </div>
                            </div>
                        </div>

                    </div>         
                </div>
            </div>

        </div>
    </div>
@endsection
