@extends('layouts.layout')

@section('content')

    @include('includes.navbar')
    <div id="slider">
        <div style="padding:15px">
            <div class="diagnosa">
                <div class="float-left"> 
                    <h4>Riwayat Pasien</h4> 
                </div> 
                <br>
            </div>
            <hr>
            <div class="content mt-3 soft-shadow collapsible">
                <div class="p-3 collapsible-head inactive" id="upload_section">
                    <p class="h6">
                        <i class="fa fa-upload" style="color: #0F4F2C;"></i>
                        Upload Dokumen
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M7,10L12,15L17,10H7Z" /></svg>
                    </p>
                </div>
                <div class="collapsible-body">
                    <hr>
                    <form id="form-tambah" action="{{ action ('DokumenController@store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="namaForm" class="col-form-label">No Rekam Medis :</label>
                                <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control inptNoCm" id="noRekamMedis" value="{{$NoCM}}" disabled>
                                <input type="hidden" onkeypress="return onlyNumberKey(event)" class="form-control inptNoCm" id="noRekamMedis" value="{{$NoCM}}" name="NoCM">
                                <input type="hidden" id="noRekamMedis_checkValid" value="1">
                                <div class="noRekamMedis_isNull invalid-feedback">
                                    No Rekam Medis Harus Diisi.
                                </div>
                                <div class="noRekamMedis_duplicated isInvalid-feedback">
                                    Data No Rekam Medis Tidak Ditemukan.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="KodeRuangan" class="col-form-label">Kode Ruangan :</label>
                                <select class="form-control" disabled>
                                    @foreach ($kdRuangan as $index)
                                        @foreach ($index as $item)
                                            @if ($item['KdRuangan'] == $dataMasukPoli['KdRuangan'])
                                                <option value="{{$item['KdRuangan']}}" selected>{{$item['KdRuangan']}} - {{$item['NamaRuangan']}}</option>
                                            @else
                                                <option value="{{$item['KdRuangan']}}">{{$item['KdRuangan']}} - {{$item['NamaRuangan']}}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                                <input type="hidden" name="KodeRuangan" value="{{$dataMasukPoli['KdRuangan']}}">
                            </div>
                            <div class="form-group">
                                <label for="idForm" class="col-form-label">No Pendaftaran :</label>
                                <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control inptId" id="noPendaftaran" name="NoPendaftaran">
                                <input type="hidden" id="noPendaftaran_checkValid" value="0">
                                <div class="noPendaftaran_isNull invalid-feedback">
                                    No Pendaftaran Harus Diisi.
                                </div>
                                <div class="noPendaftaran_duplicated isInvalid-feedback">
                                    Data No Pendaftaran Sudah Terdaftar.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namaForm" class="col-form-label">Nama Lengkap :</label>
                                <input type="text" class="form-control frm-input" id="namaLengkap" value="{{$dataMasukPoli['NamaLengkap']}}" disabled>
                                <div class="namaLengkap_isNull invalid-feedback">
                                    Nama Lengkap Harus Diisi.
                                </div>
                                <input type="hidden" value="{{$dataMasukPoli['NamaLengkap']}}" id="namaLengkap_hidden" name="NamaLengkap">
                            </div>
                            <div class="form-group">
                                <label for="namaForm" class="col-form-label">Tanggal Masuk :</label>
                                <input type="date" id="tglMasuk" name="TanggalMasuk" class="custom-select frm-tanggal">
                                <div class="tglMasuk_isNull invalid-feedback">
                                    Tanggal Masuk Harus Diisi.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="namaFile" class="col-form-label">Upload File (.pdf)</label>
                                <div>
                                    <label for="file-upload1">
                                        <input id="fileTambah" type="file" name="file">
                                    </label>
                                </div>
                                <div class="fileTambah_isNull invalid-feedback">
                                    Upload File Harus Diisi.
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <div id="fileExtension_isNull" class="alert alert-danger mt-4" role="alert" style="display: none;">
                                    Format file upload tidak sesuai
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="Status" id="" value="1">
                            <input type="hidden" name="urlPengkajian" id="" value="{{$urlPengkajian}}">
                            <div id="btn_tambah_submit" class="btn btn-dark diagnosa">Simpan</div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn_batal_upload">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content float-none">
            <table class="table table-bordered" id="sliderTable">
                <thead>
                    <tr>
                        <th scope="col">Nomor Pendaftaran</th>
                        <th scope="col">Tanggal Berkunjung</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($dataRiwayat as $item)
                        @if($item['StatusPengkajian']=='2')

                        @php
                            $date = date_create($item['TglWaktuMasukPoli']);
                        @endphp
                        <tr>
                            <td>{{ $item['NoPendaftaran'] }}</td>
                            <td>{{date_format($date, 'd/m/Y - h:i')}}</td>
                            <td><a href="#"><i class="fas fa-eye"></i> Lihat </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    @foreach ($dataDokumen as $item)
                        @php
                            $date = date_create($item['TanggalMasuk']);
                        @endphp
                        <tr>
                            <td>{{ $item['NoPendaftaran'] }}</td>
                            <td>{{date_format($date, 'd/m/Y - h:i')}}</td>
                            <td><a href="#"><i class="fas fa-eye"></i> Lihat </a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
                </table>
                <h4>
                    Preview
                </h4>
                <embed src="{{ URL::asset('dokumenRM/11600094/1603100066_2020-12-07_1603100066_2020-12-07_listRiwayatAwal_2011240007.pdf') }}" width="100%" height="300px" />
            </div>
        </div>
    </div>
    <div class="bg-greenishwhite">
        <div class="wrapper">
       
            <div class="d-flex align-items-center mb-5">
                <a href="{{url('/listPasien/masukPoliRedirect')}}" class="mr-auto">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                        Kembali
                    </span>
                </a>
                <a class="capsule-btn capsule-left active tabPengkajian" id="tab_section-form" data-active='section-form' data-notactive1='section-riwayat' data-notactive2='section-berkas' href="#">Form</a>
                <a class="capsule-btn capsule-middle tabPengkajian" id="tab_section-riwayat" data-active='section-riwayat' data-notactive1='section-form' data-notactive2='section-berkas' href="#">Riwayat</a>
                <a class="capsule-btn capsule-right tabPengkajian" id="tab_section-berkas" data-active='section-berkas' data-notactive1='section-form' data-notactive2='section-riwayat' href="#">Berkas</a>
            </div>

            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h4">Data Pasien <a href="/profilRingkas/{{$idForm}}/{{ $dataMasukPoli['NoCM'] }}/{{$dataMasukPoli['NoPendaftaran'] }}/{{$dataMasukPoli['TglMasukPoli']}}" target="_blank" class="btn btn-primary print_button" id="print_button" hidden>Print</a></p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-lg-2 col-12 mt-3 mt-lg-0">
                        <label for="nopendaftaran">No Pendaftaran</label>
                        <input type="text" name="nopendaftaran" value="{{ $dataMasukPoli['NoPendaftaran'] }}" disabled>
                    </div>
                    <div class="col-lg-2 pl-lg-0 col-12 mt-3 mt-lg-0">
                        <label for="norekammedis">No Rekam Medis</label>
                        <input type="text" name="norekammedis" value="{{ $dataMasukPoli['NoCM'] }}" disabled>
                    </div>
                
                    <div class="col-lg-8 pl-lg-0 col-12 mt-3 mt-lg-0">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" value="{{ $dataMasukPoli['NamaLengkap'] }}" disabled>
                    </div>
                    <div class="col-lg-2 col-6 mt-3 mt-lg-0">
                        <label for="jk">Jenis Kelamin</label>
                        <input type="text" name="jk" value="{{ $dataMasukPoli['JenisKelamin']=='L'?'Laki-laki':'Perempuan' }}" disabled>
                    </div>              
                    <div class="col-lg-2 pl-0 pl-lg-0 col-6 mt-3 mt-lg-0">
                        <label for="umur">Umur Pasien</label>
                        <input type="text" name="umur" value="{{ $dataMasukPoli['UmurTahun'] }}" disabled>
                    </div>
                    <div class="col-lg-2 pl-lg-0 col-6 mt-3 mt-lg-0">
                        <label for="kelas">Kelas Pelayanan</label>
                        <input type="text" name="kelas" value="{{ $dataMasukPoli['Kelas'] }}" disabled>
                    </div>
                    <div class="col-lg-2 pl-0 col-6 mt-3 mt-lg-0">
                        <label for="penjamin">Penjamin</label>
                        <input type="text" name="penjamin" value="{{ $dataMasukPoli['jenisPasien'] }}" disabled>
                    </div>
                        @php
                            $date = date_create($dataMasukPoli['TglMasuk']);
                        @endphp
                    <div class="col-lg-4 pl-lg-0 col-12 mt-3 mt-lg-0">
                        <label for="tanggalmasuk">Tanggal Masuk</label>
                        <input type="text" name="tanggalmasuk" value="{{ date_format($date,"d/m/Y")}}" disabled>
                    </div>
                </div>   
            </div>
            <div id="section-form">
                @php
                    // set subform data
                    $dataPengkajian = $dataMasukPoli['DataPengkajian'];
                @endphp
                <form id="form-pengkajian" action="{{action('FormPengkajianController@storeFormPengkajian', [$idForm, $NoCM, $noPendaftaran, $tglMasukPoli])}}" class="needs-validation" method="POST" novalidate>
                    @csrf
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
                                            <label for="tekananDarah">Tekanan Darah <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[TekananDarah]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['TekananDarah']) ? $dataPengkajian['PengkajianKeperawatan']['TekananDarah'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Tekanan Darah Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3 mt-lg-0">
                                            <label for="norekammedis"></label>
                                            <input type="text" name="" value="mmHg" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="nopendaftaran">Frekuensi Nadi <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[FrekuensiNadi]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['FrekuensiNadi']) ? $dataPengkajian['PengkajianKeperawatan']['FrekuensiNadi'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Frekuensi Nadi Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="norekammedis"></label>
                                            <input type="text" name="" value="x/menit" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="nopendaftaran">Suhu <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[Suhu]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['Suhu']) ? $dataPengkajian['PengkajianKeperawatan']['Suhu'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Suhu Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="norekammedis"></label>
                                            <input type="text" name="" value="C" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="nopendaftaran">Frekuensi Nafas <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[FrekuensiNafas]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['FrekuensiNafas']) ? $dataPengkajian['PengkajianKeperawatan']['FrekuensiNafas'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Frekuensi Nafas Harus Diisi.
                                            </div>
                                        </div>  
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="norekammedis"></label>
                                            <input type="text" name="" value="x/menit" disabled>
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
                                            <label for="nopendaftaran">Berat Badan <span>*</span></label>
                                            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan[BeratBadan]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['BeratBadan']) ? $dataPengkajian['PengkajianKeperawatan']['BeratBadan'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Berat Badan Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3 mt-lg-0">
                                            <label for="norekammedis"></label>
                                            <input type="text" name="" value="Kg" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="nopendaftaran">Tinggi Badan <span>*</span></label>
                                            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan[TinggiBadan]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['TinggiBadan']) ? $dataPengkajian['PengkajianKeperawatan']['TinggiBadan'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Tinggi Badan Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="norekammedis"></label>
                                            <input type="text" name="" value="cm" disabled>
                                        </div>
        
                                        <div class="col-8 mt-3">
                                            <label for="nopendaftaran">Skor Nyeri</label>
                                            <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan[SkorNyeri]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['SkorNyeri']) ? $dataPengkajian['PengkajianKeperawatan']['SkorNyeri'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Skor Nyeri Harus Diisi.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mt-3 pr-5">
                                            <label for="nopendaftaran" class="pb-3">Skor Jatuh</label>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check" hidden>
                                                    <input type="radio" class="form-check-input" id="skorJatuh_isNull" class="form" name="PengkajianKeperawatan[SkorJatuh]" value="-" {{(empty($dataPengkajian['PengkajianKeperawatan']['SkorJatuh']) || $dataPengkajian['PengkajianKeperawatan']['SkorJatuh'] == '-' ? 'checked' : '')}} >
                                                    <label for="rendah">-</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="rendah" name="PengkajianKeperawatan[SkorJatuh]" value="rendah" {{(!empty($dataPengkajian['PengkajianKeperawatan']['SkorJatuh']) && $dataPengkajian['PengkajianKeperawatan']['SkorJatuh'] == 'rendah' ? 'checked' : '')}} >
                                                    <label for="rendah">Rendah</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="sedang" name="PengkajianKeperawatan[SkorJatuh]" value="sedang" {{(!empty($dataPengkajian['PengkajianKeperawatan']['SkorJatuh']) && $dataPengkajian['PengkajianKeperawatan']['SkorJatuh'] == 'sedang' ? 'checked' : '')}} >
                                                    <label for="sedang">Sedang</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="tinggi" name="PengkajianKeperawatan[SkorJatuh]" value="tinggi" {{(!empty($dataPengkajian['PengkajianKeperawatan']['SkorJatuh']) && $dataPengkajian['PengkajianKeperawatan']['SkorJatuh'] == 'tinggi' ? 'checked' : '')}} >
                                                    <label for="tinggi">Tinggi</label>
                                                    <div class="invalid-feedback">
                                                        Data Skor Jatuh Harus Diisi.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <button type="submit" class="btn green-long w-50 ml-auto mr-3"> Submit</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="content mt-3 soft-shadow collapsible">
                        <div class="p-3 collapsible-head inactive">
                            <p class="h6">II. Pengkajian Medis <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M7,10L12,15L17,10H7Z" /></svg></p>
                        </div>
                        <hr>
                        <div class="collapsible-body">
                            <div class="row m-3 py-3">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group h-100">
                                                <label for="anamnesis">Anamesis (S) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea class="form-control inpt-isRequired" name="PengkajianMedis[Anamnesis]" id="Anamnesis">{{(!empty($dataPengkajian['PengkajianMedis']['Anamnesis']) ? $dataPengkajian['PengkajianMedis']['Anamnesis'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Anamnesis Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group h-100">
                                                <label for="pemeriksaanFisik">Pemeriksaan Fisik (O) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea class="form-control inpt-isRequired" class="form-control" name="PengkajianMedis[PemeriksaanFisik]" id="PemeriksaanFisik" >{{(!empty($dataPengkajian['PengkajianMedis']['PemeriksaanFisik']) ? $dataPengkajian['PengkajianMedis']['PemeriksaanFisik'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Pemeriksaan Fisik Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                        <div class="form-group h-100">
                                            <label for="diagnosa">Kode ICD 10 <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            {{-- <input type="text" class="form-control inpt-isRequired" name="PengkajianMedis[Diagnosa]" value="{{(!empty($dataPengkajian['PengkajianMedis']['Diagnosa']) ? $dataPengkajian['PengkajianMedis']['Diagnosa'] : '')}}"> --}}
                                            <select type="text" multiple="multiple" class="form-control inpt-isRequired pilihDiagnosa" name="PengkajianMedis[Diagnosa][]" id="pilihDiagnosa" required>
                                                @if ( !empty($diagnosa['KodeDiagnosa']) && !empty($diagnosa['NamaDiagnosa']) ) 
                                                    @for ($item = 0; $item < count($ICD10T); $item++ )
                                                        <option value="{{ $ICD10V[$item] }}" selected >{{$ICD10T[$item]}}</option>
                                                    @endfor
                                                @else
                                                    
                                                @endif                             
                                            </select>
                                            <div class="invalid-feedback">
                                                Data Diagnosa Harus Diisi.
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="kodeICD10">Diagnosa (A)</label>
                                            <textarea class="form-control"></textarea>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="komplikasi">Komplikasi</label>
                                            <input class="form-control" type="text" name="PengkajianMedis[Komplikasi]" value="{{(!empty($dataPengkajian['PengkajianMedis']['Komplikasi']) ? $dataPengkajian['PengkajianMedis']['Komplikasi'] : '')}}">
                                            <div class="invalid-feedback">
                                                Data Komplikasi Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="komorbid">Komorbid</label>
                                            <input type="text" class="form-control" name="PengkajianMedis[Komorbid]" value="{{(!empty($dataPengkajian['PengkajianMedis']['Komorbid']) ? $dataPengkajian['PengkajianMedis']['Komorbid'] : '')}}">
                                            <div class="invalid-feedback">
                                                Data Komorbid Harus Diisi.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group h-100">
                                                <label for="rencanadanterapi">Rencana dan Terapi (P) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea class="form-control inpt-isRequired" name="PengkajianMedis[RencanaDanTerapi]" id="rencanadanterapi">{{(!empty($dataPengkajian['PengkajianMedis']['RencanaDanTerapi']) ? $dataPengkajian['PengkajianMedis']['RencanaDanTerapi'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Rencana dan Terapi Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="kodeICD09">Kode ICD 9</label>
                                            <select multiple="multiple" class="form-control pilihDiagnosaTindakan" name="PengkajianMedis[KodeICD9][]" id="kodeICD09">
                                                @if ( !empty($diagnosaT['KodeDiagnosaT']) && !empty($diagnosaT['DiagnosaTindakan']) ) 
                                                    @for ($item = 0; $item < count($ICD09T); $item++ )
                                                        <option value="{{ $ICD09V[$item] }}" selected >{{$ICD09T[$item]}}</option>
                                                    @endfor
                                                @else
                                                    
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group h-100">
                                                <label for="edukasi">Edukasi <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea class="form-control inpt-isRequired" name="PengkajianMedis[Edukasi]" id="edukasi">{{(!empty($dataPengkajian['PengkajianMedis']['Edukasi']) ? $dataPengkajian['PengkajianMedis']['Edukasi'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Ediukasi Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="penyakitmenular">Penyakit Menular</label>
                                            <input type="text" class="form-control" name="PengkajianMedis[PenyakitMenular]" value="{{(!empty($dataPengkajian['PengkajianMedis']['PenyakitMenular']) ? $dataPengkajian['PengkajianMedis']['PenyakitMenular'] : '')}}">
                                            <div class="invalid-feedback">
                                                Data Penyakit Menular Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 pr-5">
                                            <label for="kesanstatusgizi" class="pb-3">Kesan Status Gizi</label>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check" hidden>
                                                    <input type="radio" class="form-check-input" id="kesanStatusGizi" name="PengkajianMedis[KesanStatusGizi]" value="-" {{(empty($dataPengkajian['PengkajianMedis']['KesanStatusGizi']) || $dataPengkajian['PengkajianMedis']['KesanStatusGizi'] == '-' ? 'checked' : '')}} >
                                                    <label for="cukup">-</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="kurang" name="PengkajianMedis[KesanStatusGizi]" value="kurang" {{(!empty($dataPengkajian['PengkajianMedis']['KesanStatusGizi']) && $dataPengkajian['PengkajianMedis']['KesanStatusGizi'] == 'kurang' ? 'checked' : '')}} >
                                                    <label for="kurang">Gizi Kurang/Buruk</label>
                                                    <div class="invalid-feedback">
                                                        Data Kesan Status Gizi Harus Diisi.
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="cukup" name="PengkajianMedis[KesanStatusGizi]" value="cukup" {{(!empty($dataPengkajian['PengkajianMedis']['KesanStatusGizi']) && $dataPengkajian['PengkajianMedis']['KesanStatusGizi'] == 'cukup' ? 'checked' : '')}}>
                                                    <label for="cukup">Gizi Cukup</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input" id="lebih" name="PengkajianMedis[KesanStatusGizi]" value="lebih" {{(!empty($dataPengkajian['PengkajianMedis']['KesanStatusGizi']) && $dataPengkajian['PengkajianMedis']['KesanStatusGizi'] == 'lebih' ? 'checked' : '')}}>
                                                    <label for="lebih">Gizi Lebih</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <a href="#" id="profilRingkas" class="btn secondary">List dirujuk/konsul ke</a>
                                            @if(Auth::user()->Role == "1")
                                            <input type="checkbox" id="verifikasi">
                                            <label for="verifikasi"> Verifikasi final pasien</label><br>
                                            <div class="invalid-feedback">
                                                Verifikasi Harus Tercentang
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12 mt-3">
                                            <input type="hidden" id="statusPengkajian" name="StatusPengkajian">
                                            <button type="submit" class="btn green-long">Submit</button> 
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12">
                                    <button type="submit" class="btn green-long w-50 ml-auto mr-3"> Submit</button>
                                </div> -->
                            </div>         
                        </div>
                    </div>
                </form>
            </div>
            @include('includes.tabSectionPengkajian')
        </div>
    </div>
    <script>

        $(document).ready(function(){

            $('#sliderTable_filter').hide();
            // set hide field required
            $('.lbl-isRequired').hide();
            $('.inpt-isRequired').prop('required', false);

            @if($dataMasukPoli['StatusPengkajian'] == '2')
                $('#verifikasi').prop('checked', true);
            @else
                $('#verifikasi').prop('checked', false);
            @endif

            // check required if statusPenkajian == 2
            @if($dataMasukPoli['StatusPengkajian'] == '2')
                $('.lbl-isRequired').show();
                $('.inpt-isRequired').prop('required', true);
                $('#statusPengkajian').val('2');
            @else
                $('.lbl-isRequired').hide();
                $('.inpt-isRequired').prop('required', false);
                $('#statusPengkajian').val('1');
            @endif

            var table = $('#tbl_dokumen').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup', function () {
                table.search( this.value ).draw();
            });
            $('#tbl_filter').show();
            $('#tbl_dokumen tbody').on('click', '.pratinjau-data', function(){
                let noPendaftaran = $(this).data('nopendaftaran');
                let noCm = $(this).data('nocm');
                $('#title-pratinjau').html('No Pendaftaran '+noPendaftaran);
                // get data
                $.ajax({
                        url: "{{url('/dokumen/getData')}}",
                        method: 'post',
                        data: {noPendaftaran: noPendaftaran, noCm : noCm, _token: '<?php echo csrf_token()?>'},
                        success : function(res){
                            $('#pratinjauDokumen').attr('src', res.FullPath);
                            $('#pathFile_pratinjau').val(res.PathFile);
                        }
                    })
            })
            $('.btn-unduh').click(function(){
                let noPendaftaran = $(this).data('nopendaftaran');
                let noCm = $(this).data('nocm');
                // get data
                $.ajax({
                        url: "{{url('/dokumen/getData')}}",
                        method: 'post',
                        data: {noPendaftaran: noPendaftaran, noCm : noCm, _token: '<?php echo csrf_token()?>'},
                        success : function(res){
                            $('#pathFile_pratinjau').val(res.PathFile);
                            $('#form-unduh').submit()
                        }
                    })
            })

            $('.tabPengkajian').click(function(){
                let tabActive = $(this).data('active');
                let tabNotActive1 = $(this).data('notactive1');
                let tabNotActive2 = $(this).data('notactive2');

                // set tab isActive
                $('#tab_'+tabActive).addClass('active')
                $('#tab_'+tabNotActive1).removeClass('active')
                $('#tab_'+tabNotActive2).removeClass('active')

                // set visible in section
                $('#'+tabActive).css('display', 'block');
                $('#'+tabNotActive1).css('display', 'none');
                $('#'+tabNotActive2).css('display', 'none');
                
            })

            $("#tab_section-riwayat").on("click", function(){
                $(".print_button").prop('hidden', false);
            });
            $("#tab_section-form").on("click", function(){
                $(".print_button").prop('hidden', true);
            });
            $("#tab_section-berkas").on("click", function(){
                $(".print_button").prop('hidden', true);
            });

            $("#profilRingkas").on("click", function(){
                $('#tab_section-form').removeClass('active');
                $('#tab_section-riwayat').addClass('active');
                $(".print_button").prop('hidden', false);
                $('#section-riwayat').css('display', 'block');
                $('#section-berkas').css('display', 'none');
                $('#section-form').css('display', 'none');
                
            });    
            
        })
        $(document).on('hidden.bs.modal','#modal_pratinjau', function () {
            $('#pratinjauDokumen').attr('src', "");
        })

        $(document).ready(function() {
            // $('.pilihDiagnosa').selectpicker();
            $('.pilihDiagnosa').select2({
                
                placeholder: 'Cari...',
                // console.log(diagnosa);

                ajax :{

                    type    : 'get',
                    url     : "{{ url('formPengkajian/getICD10') }}",
                    dataType: 'json',
                    delay   : 250,
                    data    : function (params) {
                        var queryParameters = {
                        q: params.term
                        }

                        return queryParameters;
                    },
                    processResults: function (data) {
                        // console.log(data);
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.kodeDiagnosa +" - "+ item.NamaDiagnosa,
                                    id: item.kodeDiagnosa +":"+ item.NamaDiagnosa
                                }
                            })
                        };
                    },
                    cache: true
                    
                }
            });
            $('.pilihDiagnosaTindakan').select2({
                placeholder: 'Cari...',
                ajax :{

                    type    : 'get',
                    url     : "{{ url('formPengkajian/getICD09') }}",
                    dataType: 'json',
                    delay   : 250,
                    data    : function (params) {
                        var queryParameters = {
                        q: params.term
                        }

                        return queryParameters;
                    },
                    processResults: function (data) {
                        // console.log(data);
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.KodeDiagnosaT +" - "+ item.DiagnosaTindakan,
                                    id: item.KodeDiagnosaT +":"+ item.DiagnosaTindakan
                                }
                            })
                        };
                    },
                    cache: true
                    
                }
            });
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
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

        function onlyNumberKey(evt) { 
          
            // Only ASCII charactar in that range allowed 
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57) && ASCIICode != 45) 
                return false; 
            return true; 
        } 

        $('#verifikasi').change(function(){
            if($(this).prop('checked') == true){
                $('.lbl-isRequired').show();
                $('.inpt-isRequired').prop('required', true);
                $('#statusPengkajian').val('2');
            }else{
                $('.lbl-isRequired').hide();
                $('.inpt-isRequired').prop('required', false);
                $('#statusPengkajian').val('1');
            }
        })

        $('#form-pengkajian').submit(function () {
            let statusPengkajian = $('#statusPengkajian').val()
            let dataForm = $(this).serializeArray()

            if(statusPengkajian == '2'){
                
                $("form :input").each(function(index, elm){
                    if(elm.name != ''){
                        if(elm.type == 'text'){
                            let tagInput = 'input[name="'+elm.name+'"]';
                            if($(tagInput).attr('required') != 'required' && $(tagInput).val() == ''){
                                $(tagInput).val("-")
                            }
                        }else if(elm.type == 'textarea'){
                            let tagInput = 'textarea[name="'+elm.name+'"]';
                            if($(tagInput).attr("required") != 'required' && $(tagInput).html() == ''){
                                $(tagInput).html("-")
                            }
                        }else if(elm.type == 'select-one'){
                            let tagInput = 'select[name="'+elm.name+'"]';
                            if($(tagInput).attr("required") != 'required' && $(tagInput).val() == ''){
                                $(tagInput).val("-")
                            }
                        }
                    }
                });
            }
            console.log(dataForm)
            return true;
        });
        
        </script>
        {{-- upload dokumen --}}
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btn_tambah_submit').click(function(){
                    let noPendaftaran = $('#noPendaftaran').val();
                    let noRekamMedis = $('#noRekamMedis').val();
                    let namaLengkap = $('#namaLengkap').val();
                    let tglMasuk = $('#tglMasuk').val();
                    let fileVal = $('#fileTambah').val();
                    let file = $('#fileTambah');
                    let fileExtension = ""
                    // set var file fileExtension
                    if(fileVal != ""){
                        fileExtension = file[0].files[0].name;
                        fileExtension = fileExtension.replace(/^.*\./, '');
                    }
                    
                    if(noPendaftaran == ""){
                        $('#noPendaftaran').addClass('isInValid')
                        $('.noPendaftaran_isNull').css('display', 'block');
                    }else{
                        CheckIdDuplicate('noPendaftaran', noPendaftaran, noRekamMedis, 'tambah')
                    }
                    
                    // if(noRekamMedis == ""){
                    //     $('#noRekamMedis').addClass('isInValid')
                    //     $('.noRekamMedis_isNull').css('display', 'block');
                    // }else{
                    //     CheckNoCmIsNull('noRekamMedis', noRekamMedis, 'tambah');
                    // }
    
                    if(namaLengkap == ""){
                        $('#namaLengkap').addClass('isInValid')
                        $('.namaLengkap_isNull').css('display', 'block');
                    }
    
                    if(tglMasuk == ""){
                        $('#tglMasuk').addClass('isInValid')
                        $('.tglMasuk_isNull').css('display', 'block');
                    }
    
                    if(fileVal == ""){
                        $('.fileTambah_isNull').css('display', 'block');
                    }
                    
                    let noPendaftaranCheckValid = $('#noPendaftaran_checkValid').val()
                    let noCmCheckValid = $('#noRekamMedis_checkValid').val()
                    if(fileExtension != 'pdf'){
                        $('#fileExtension_isNull').css('display', 'block');
                    }else{
                        $('#fileExtension_isNull').css('display', 'none');
                        if(noPendaftaran != "" && noRekamMedis != "" && namaLengkap != "" && tglMasuk != "" && fileVal != "" && noPendaftaranCheckValid == '1' && noCmCheckValid == '1'){
                            // $('#form-tambah').submit();
                        }
                    }
    
                })
                $('#btn_batal_upload').click(function(){
                    $('#upload_section').removeClass('active')
                    $('#upload_section').addClass('inactive')
                })
                $('.frm-input').keyup(function(){
                    let id = $(this).attr('id');
                    if($(this).val() == ""){
                        $(this).removeClass('isInValid')
                        $(this).removeClass('isValid')
                        $('.'+id+'_isNull').css('display', 'none')
                        $('.'+id+'_duplicated').css('display', 'none')
                    }else{
                        $(this).removeClass('isInValid')
                        $(this).addClass('isValid')
                        $('.'+id+'_isNull').css('display', 'none')
                        $('.'+id+'_duplicated').css('display', 'none')
                    }
                })
                $('.inptId').keyup(function(){
                    let tagId = $(this).prop('id');
                    let val = $(this).val();
                    if($('#noRekamMedis').val() != ''){
                        CheckIdDuplicate(tagId, val, $('#noRekamMedis').val(), 'tambah');
                    }
                })
                $('.frm-tanggal').change(function(){
                    let id = $(this).attr('id')
                    if($(this).val() == ""){
                        $(this).removeClass('isInValid')
                        $(this).removeClass('isValid')
                        $('.'+id+'_isNull').css('display', 'none')
                    }else{
                        $(this).removeClass('isInValid')
                        $(this).addClass('isValid')
                        $('.'+id+'_isNull').css('display', 'none')
                    }
                })
                $('#fileTambah').change(function(){
                    if($(this).val() != ""){
                        $('.fileTambah_isNull').css('display', 'none')
                    }
                })
                function onlyNumberKey(evt) { 
                // Only ASCII charactar in that range allowed 
                    var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
                    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
                        return false; 
                    return true; 
                }
    
                const CheckIdDuplicate = (tagId, val, noCm, method) => {
                    let isUbah
                    if(method == 'ubah'){
                        isUbah = true;
                    }else{
                        isUbah = false;
                    }
    
                    $.ajax({
                        url: "{{url('dokumen/checkIdDuplicate')}}",
                        method: 'post',
                        data: {noPendaftaran: val, noCm: noCm, _token: '<?php echo csrf_token()?>'},
                        success : function(res){
                            if(val == ''){
                                $('#'+tagId).removeClass('isInValid');
                                $('#'+tagId).removeClass('isValid');
                                $('.'+tagId+'_duplicated').css('display', 'none');
                                $('.'+tagId+'_isNull').css('display', 'none');
                                $('#'+tagId+'_checkValid').val('0');
                            }else if(isUbah == true && res.ID == $('#ID_ubah_hidden').val()){
                                $('#'+tagId).removeClass('isInValid');
                                $('#'+tagId).removeClass('isValid');
                                $('.'+tagId+'_duplicated').css('display', 'none');
                                $('.'+tagId+'_isNull').css('display', 'none');
                                $('#'+tagId+'_checkValid').val('1');
                            }else if(res.status == true){
                                $('#'+tagId).removeClass('isValid');
                                $('#'+tagId).addClass('isInValid');
                                $('.'+tagId+'_duplicated').css('display', 'block');
                                $('#'+tagId+'_checkValid').val('0');
                            }else{
                                $('#'+tagId).removeClass('isInValid');
                                $('#'+tagId).addClass('isValid');
                                $('.'+tagId+'_duplicated').css('display', 'none');
                                $('.'+tagId+'_isNull').css('display', 'none');
                                $('#'+tagId+'_checkValid').val('1');
                            }
                        }
                    })
    
                }
    
                const AjaxStore = () => {
                    let dataForm = $('#form-tambah').serializeArray();
                    console.log(dataForm)
    
                    // dataForm[6]['name'] = 'file';
                    var dataFile = new FormData();
                    jQuery.each(jQuery('#fileTambah')[0].files, function(i, file) {
                        dataFile.append('file-'+i, file);
                    });
    
                    console.log(dataFile)
                    console.log(dataFile.FormData)
    
                    $.ajax({
                        url: "{{url('dokumen/ajaxStore')}}",
                        method: 'post',
                        data: {dataForm: dataForm, _token: '<?php echo csrf_token()?>'},
                        success: function(res){
                            
                        }
                    })
                    $.ajax({
                        url: "{{url('dokumen/ajaxStore')}}",
                        method: 'post',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: dataFile,
                        success: function(res){
    
                        }
                    })
                }
            })
            </script>
        <!-- slider -->
        <script type="text/javascript">
            //$('#test').BootSideMenu({side:"left", autoClose:false});
            $('#slider').BootSideMenu({
                side: "right",
                autoClose: true,
                width: "43%",
                closeOnClick: false
            });

            $('#sliderTable').dataTable( {
                "scrollY": "100px",
                "scrollCollapse": true,
                "paging": false,
                "order": [[ 1, "desc" ]]
            } );
        </script>
@endsection
