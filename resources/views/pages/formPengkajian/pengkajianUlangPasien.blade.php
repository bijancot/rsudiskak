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
                <div class="p-3 collapsible-head inactive" id="upload_section" style="cursor: pointer;">
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
                                <label for="KodeRuanganx" class="col-form-label">Kode Ruangan :</label>
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
                                <label for="namaFile" class="col-form-label">Upload File (.pdf; < 2Mb)</label>
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
                                <div id="fileExtension_isMaxSize" class="alert alert-danger mt-4" role="alert" style="display: none;">
                                    File melebihi batas maksimal
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
            <div id="log-success" class="alert alert-success mt-4" role="alert" hidden>
                Upload dokumen berhasil
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
                    {{-- @foreach ($dataRiwayat as $item)
                        @if($item['StatusPengkajian']=='2')

                        @php
                            $date = date_create($item['TglWaktuMasukPoli']);
                        @endphp
                        <tr>
                            <td>{{ $item['NoPendaftaran'] }}</td>
                            <td>{{date_format($date, 'd/m/Y - h:i')}}</td>
                            <td><a href="#" onClick="previewPDF('{{$item['NoCM']}}', '{{$item['NoPendaftaran']}}', '{{$item['TglMasukPoli']}}');" data-lihatNoCM="{{$item['NoCM']}}" class="clickLihat"><i class="fas fa-eye"></i> Lihat </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach --}}
                    @foreach ($dataDokumen as $item)
                        @php
                            $date = date_create($item['TanggalMasuk']);
                        @endphp
                        <tr>
                            <td>{{ $item['NoPendaftaran'] }}</td>
                            <td>{{date_format($date, 'd/m/Y - h:i')}}</td>
                            <td><a href="#" onClick="previewPDF('{{$item['NoCM']}}', '{{$item['NoPendaftaran']}}', '{{$item['TanggalMasuk']}}');" data-noCM="{{$item['NoCM']}}" class="clickLihat"><i class="fas fa-eye"></i> Lihat </a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
                </table>
                <h4>
                    Preview
                </h4>
                <div class="arema1"></div> 
                <!-- <embed src="{{ URL::asset('dokumenRM/11600094/1603100066_2020-12-07_1603100066_2020-12-07_listRiwayatAwal_2011240007.pdf') }}" width="100%" height="300px" /> -->
            </div>
        </div>
    </div>
    <div class="bg-greenishwhite">
        <div class="wrapper">
       
            <div class="d-flex align-items-center mb-5">
                <a href="{{url('/listPasien/masukPoliRedirect/'.$tglMasukPoli)}}" class="mr-auto">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                        Kembali
                    </span>
                </a>
                <a class="capsule-btn capsule-left active tabPengkajian" id="tab_section-form" data-active='section-form' data-notactive1='section-riwayat' data-notactive2='section-berkas' href="#">Form</a>
                <a class="capsule-btn capsule-middle tabPengkajian" id="tab_section-riwayat" data-active='section-riwayat' data-notactive1='section-form' data-notactive2='section-berkas' href="#">Riwayat</a>
                <a class="capsule-btn capsule-right tabPengkajian" id="tab_section-berkas" data-active='section-berkas' data-notactive1='section-form' data-notactive2='section-riwayat' href="#">Berkas</a>
            </div>

            <!-- Data Pasien -->
            @include('pages.formPengkajian.dataPasien')
            <!-- end of Data Pasien -->


            <div id="section-form">
                @php
                    // set subform data
                    $dataPengkajian = $dataMasukPoli['DataPengkajian'];
                @endphp
                <form id="form-pengkajian" action="{{action('FormPengkajianController@storeFormPengkajian', [$idForm, $NoCM, $noPendaftaran, $tglMasukPoli])}}" class="needs-validation" method="POST" novalidate>
                    @csrf
                    <div class="content mt-3 soft-shadow collapsible" style="cursor: pointer;">
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
                                            <label for="TekananDarah">Tekanan Darah <span class="lbl-isRequired" style="color:red;">*</span></label>
                                        </div>
                                        <div class="col-8 mt-3 mt-lg-0">
                                            <label for="Sistolik">Sistolik <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input id="Sistolik" type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[TekananDarah][Sistolik]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['TekananDarah']['Sistolik']) ? $dataPengkajian['PengkajianKeperawatan']['TekananDarah']['Sistolik'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Tekanan Darah Sistolik Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3 mt-lg-0">
                                            <label for="mmHgS"></label>
                                            <input type="text" name="" value="mmHg" disabled>
                                        </div>
                                        
                                        <div class="col-8 mt-3 mt-lg-0">
                                            <label for="Diastolik">Diastolik <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input id="Diastolik" type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[TekananDarah][Diastolik]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['TekananDarah']['Diastolik']) ? $dataPengkajian['PengkajianKeperawatan']['TekananDarah']['Diastolik'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Tekanan Darah Diastolik Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3 mt-lg-0">
                                            <label for="mmHgD"></label>
                                            <input type="text" name="" value="mmHg" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="FrekuensiNadi">Frekuensi Nadi <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input id="FrekuensiNadi" type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[FrekuensiNadi]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['FrekuensiNadi']) ? $dataPengkajian['PengkajianKeperawatan']['FrekuensiNadi'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Frekuensi Nadi Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="x/menitFNadi"></label>
                                            <input type="text" name="" value="x/menit" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="Suhu">Suhu <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input id="Suhu" type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[Suhu]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['Suhu']) ? $dataPengkajian['PengkajianKeperawatan']['Suhu'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Suhu Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="C"></label>
                                            <input type="text" name="" value="C" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="FrekuensiNafas">Frekuensi Nafas <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input id="FrekuensiNafas" type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[FrekuensiNafas]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['FrekuensiNafas']) ? $dataPengkajian['PengkajianKeperawatan']['FrekuensiNafas'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Frekuensi Nafas Harus Diisi.
                                            </div>
                                        </div>  
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="x/menitFNafas"></label>
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
                                            <label for="BeratBadan">Berat Badan <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input id="BeratBadan" type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[BeratBadan]" value="{{(!empty($dataBB['DataPengkajian']['PengkajianKeperawatan']['BeratBadan']) ? $dataBB['DataPengkajian']['PengkajianKeperawatan']['BeratBadan'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Berat Badan Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3 mt-lg-0">
                                            <label for="kg"></label>
                                            <input type="text" name="" value="kg" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="TinggiBadan">Tinggi Badan <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input id="TinggiBadan" type="text" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[TinggiBadan]" value="{{(!empty($dataBB['DataPengkajian']['PengkajianKeperawatan']['TinggiBadan']) ? $dataBB['DataPengkajian']['PengkajianKeperawatan']['TinggiBadan'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Tinggi Badan Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3">
                                            <label for="cm"></label>
                                            <input type="text" name="" value="cm" disabled>
                                        </div>
        
                                        <div class="col-8 mt-3">
                                            <label for="SkorNyeri">Skor Nyeri</label>
                                            <input id="SkorNyeri" type="text" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan[SkorNyeri]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['SkorNyeri']) ? $dataPengkajian['PengkajianKeperawatan']['SkorNyeri'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Skor Nyeri Harus Diisi.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mt-3 pr-5">
                                            <label for="SkorJatuh" class="pb-3">Skor Jatuh</label>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check" hidden>
                                                    <input type="radio" class="form-check-input" id="skorJatuh_isNull" class="form" name="PengkajianKeperawatan[SkorJatuh]" value="Normal/Tidak dilakukan pemeriksaan" {{(empty($dataPengkajian['PengkajianKeperawatan']['SkorJatuh']) || $dataPengkajian['PengkajianKeperawatan']['SkorJatuh'] == 'Normal/Tidak dilakukan pemeriksaan' ? 'checked' : '')}} >
                                                    <label for="skorJatuh_isNull">Normal/Tidak dilakukan pemeriksaan</label>
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

                                    <div class="col-12">
                                        <input id="KodeRuangan" type="hidden" value="{{ $dataMasukPoli['KdRuangan'] }}">
                                        <input id="NoCM" type="hidden" value="{{ $dataMasukPoli['NoCM'] }}">
                                        <a id="btn_get-lastData" class="btn btn-success"> Ambil Data Antropometri Terakhir</a>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="content mt-3 soft-shadow collapsible" style="cursor: pointer;">
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
                                                <label for="Anamnesis">Anamesis (S) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea id="Anamnesis" class="form-control inpt-isRequired" name="PengkajianMedis[Anamnesis]">{{(!empty($dataPengkajian['PengkajianMedis']['Anamnesis']) ? $dataPengkajian['PengkajianMedis']['Anamnesis'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Anamnesis Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group h-100">
                                                <div class="d-flex">
                                                    <label for="pemeriksaanFisik">Pemeriksaan Fisik (O) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                    <a id="btn-pemeriksaanFisik" class="btn diagnosa py-0 mb-1 ml-auto">
                                                       + Ambil Data
                                                    </a>
                                                </div>
                                                <textarea id="txt-pemeriksaanFisik" readonly class="form-control inpt-isRequired" class="form-control" name="PengkajianMedis[PemeriksaanFisik]" >{{(!empty($dataPengkajian['PengkajianMedis']['PemeriksaanFisik']) ? $dataPengkajian['PengkajianMedis']['PemeriksaanFisik'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Pemeriksaan Fisik Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 mt-3">
                                            <div class="form-group h-100">
                                                <label for="kodeICD10">Kode ICD 10 <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <select id="pilihDiagnosa" type="text" multiple="multiple" class="form-control inpt-isRequired pilihDiagnosa" name="PengkajianMedis[Diagnosa][]" required>
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
                                        </div> --}}
                                        <div class="col-12 mt-3">
                                            <div class="form-group h-100">
                                                <label for="Diagnosa">Diagnosa (A) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea id="Diagnosa" class="form-control inpt-isRequired" name="PengkajianMedis[Diagnosa(A)]">{{(!empty($dataPengkajian['PengkajianMedis']['Diagnosa(A)']) ? $dataPengkajian['PengkajianMedis']['Diagnosa(A)'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Diagnosa Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group h-100">
                                                <label for="Komplikasi">Komplikasi<span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea id="Komplikasi" class="form-control inpt-isRequired" name="PengkajianMedis[Komplikasi]">{{(!empty($dataPengkajian['PengkajianMedis']['Komplikasi']) ? $dataPengkajian['PengkajianMedis']['Komplikasi'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Komplikasi Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group h-100">
                                                <label for="Komorbid">Komorbid<span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea id="Komorbid" class="form-control inpt-isRequired" name="PengkajianMedis[Komorbid]">{{(!empty($dataPengkajian['PengkajianMedis']['Komorbid']) ? $dataPengkajian['PengkajianMedis']['Komorbid'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Komorbid Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group h-100">
                                                {{-- @if(Session::has('msg'))
                                                    <div class="alert alert-danger" role="alert">{{ Session::get('msg') }}</div>
                                                @endif --}}
                                                <label for="rencanadanterapi">Rencana dan Terapi (P) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                @php
                                                    $isDisabled = (Auth::user()->Role == "2" ? 'disabled' : '');
                                                @endphp
                                                <a href="{{ route('rencanaTerapi.index', [$idForm, $NoCM, $noPendaftaran, $tglMasukPoli]) }}" id="btn-rencanadanterapi" class="form-control btn secondary ml-auto {{ $isDisabled }}">Form Rencana & Terapi </a>
                                                <div class="invalid-feedback">
                                                    Data Rencana dan Terapi Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 mt-3">
                                            <label for="kodeICD09">Kode ICD 9</label>
                                            <select id="kodeICD09" multiple="multiple" class="form-control pilihDiagnosaTindakan" name="PengkajianMedis[KodeICD9][]">
                                                @if ( !empty($diagnosaT['KodeDiagnosaT']) && !empty($diagnosaT['DiagnosaTindakan']) ) 
                                                    @for ($item = 0; $item < count($ICD09T); $item++ )
                                                        <option value="{{ $ICD09V[$item] }}" selected >{{$ICD09T[$item]}}</option>
                                                    @endfor
                                                @else
                                                    
                                                @endif
                                            </select>
                                        </div> --}}
                                        <div class="col-12 mt-3">
                                            <div class="form-group h-100">
                                                <label for="KodeICD9">Kode ICD  9<span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea id="KodeICD9" class="form-control inpt-isRequired" name="PengkajianMedis[KodeICD9]">{{(!empty($dataPengkajian['PengkajianMedis']['KodeICD9']) ? $dataPengkajian['PengkajianMedis']['KodeICD9'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data KodeICD9 Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group h-100">
                                                <label for="edukasi">Edukasi <span class="lbl-isRequired" style="color:red;">*</span></label>
                                                <textarea id="edukasi" class="form-control inpt-isRequired" name="PengkajianMedis[Edukasi]">{{(!empty($dataPengkajian['PengkajianMedis']['Edukasi']) ? $dataPengkajian['PengkajianMedis']['Edukasi'] : '')}}</textarea>
                                                <div class="invalid-feedback">
                                                    Data Ediukasi Harus Diisi.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="penyakitmenular">Penyakit Menular</label>
                                            <input id="penyakitmenular" type="text" class="form-control" name="PengkajianMedis[PenyakitMenular]" value="{{(!empty($dataPengkajian['PengkajianMedis']['PenyakitMenular']) ? $dataPengkajian['PengkajianMedis']['PenyakitMenular'] : '')}}">
                                            <div class="invalid-feedback">
                                                Data Penyakit Menular Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 pr-5">
                                            <label for="kesanstatusgizi" class="pb-3">Kesan Status Gizi</label>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check" hidden>
                                                    <input type="radio" class="form-check-input" id="kesanStatusGizi" name="PengkajianMedis[KesanStatusGizi]" value="Normal/Tidak dilakukan pemeriksaan" {{(empty($dataPengkajian['PengkajianMedis']['KesanStatusGizi']) || $dataPengkajian['PengkajianMedis']['KesanStatusGizi'] == 'Normal/Tidak dilakukan pemeriksaan' ? 'checked' : '')}} >
                                                    <label for="kesanStatusGizi">Normal/Tidak dilakukan pemeriksaan</label>
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
                                        <div class="col-12 mt-3 d-none">
                                            <a href="#" id="profilRingkas" class="btn secondary">List dirujuk/konsul ke</a>
                                        </div>
                                        <div class="col-12 mt-3">
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
                                            <button type="submit" class="btn green-long">Simpan</button> 
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
            
            @if(session('statusNotif') == 'failed')
                // alert Notification
                @if(Session::has('msg'))
                    var html = '<div class="alert alert-danger" role="alert">{{ Session::get('msg') }}</div>';
                @endif
                $('#msg_modal-failed').html(
                    'Data Rencana Terapi Belum Terverifikasi'+html 
                );
                $('#modal_failed').modal('toggle')
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
            // notification save data
            @if(!empty(session('isSaveRM')))
                $('#msg_modal').html('Berhasil Menyimpan <br> Data Rekam Medis');
                $('#modal_success').modal('toggle')    
            @endIf

            //notification isUploadData
            @if(!empty(session('isUploadDokumen')))
                $('#log-success').prop('hidden', false)
            @endIf
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

        $(document).ready(function(){
            // get data Antropometri terakhir By Pasien(NoCM) and Poli(KdRuangan)
            $('#btn_get-lastData').click(function(){
                let noCM        = $('#NoCM').val();
                let kdRuangan   = $('#KodeRuangan').val();
                $.ajax({
                    url     : "{{ url('getPengkajian/lastPengkajianKeperawatan') }}",
                    method  : 'post',
                    data    : { 
                        _token      : '<?php echo csrf_token()?>' ,
                        noCM        : noCM, 
                        kdRuangan   : kdRuangan, 
                    },
                    success: function(response){
                        // console.log(response);

                        // $('#Sistolik').val(response['TekananDarah']['Sistolik']);
                        // $('#Diastolik').val(response['TekananDarah']['Diastolik']);
                        // $('#FrekuensiNadi').val(response['FrekuensiNadi']);
                        // $('#Suhu').val(response['Suhu']);
                        // $('#FrekuensiNafas').val(response['FrekuensiNafas']);
                        $('#BeratBadan').val(response['BeratBadan']);
                        $('#TinggiBadan').val(response['TinggiBadan']);
                        $('#SkorNyeri').val(response['SkorNyeri']);

                        if (response['SkorJatuh'] == "rendah") {
                            $('#rendah').prop('checked', true);
                        } else if(response['SkorJatuh'] == "sedang") {
                            $('#sedang').prop('checked', true);
                        } else if (response['SkorJatuh'] == "tinggi") {
                            $('#tinggi').prop('checked', true);
                        } else {
                            $('#skorJatuh_isNull').prop('checked', true);
                        }

                    }
                });
            });

            // get data Pemeriksaan Fisik By Tanda Vital Section
            $('#btn-pemeriksaanFisik').click(function(){
                let sistolik        = $('#Sistolik').val();
                let diastolik       = $('#Diastolik').val();
                let frekuensiNadi   = $('#FrekuensiNadi').val();
                let suhu            = $('#Suhu').val();
                let frekuensiNafas  = $('#FrekuensiNafas').val()
                
                $('#txt-pemeriksaanFisik').val(
                    'Sistolik : '+sistolik+'\n'+
                    'Diastolik : '+diastolik+'\n'+
                    'Frekuensi Nadi : '+frekuensiNadi+'\n'+
                    'Suhu : '+suhu+'\n'+
                    'Frekuensi Nafas : '+frekuensiNafas+'\n'
                );
            });

            $('#Anamnesis').tagsInput({
                'autocomplete': {
                    source: (req, res) => {
                        console.log(req)
                        $.ajax({
                            url         : "{{ action('SuggestionController@getSuggestion') }}",
                            type        : 'post',
                            encode      : true,
                            data        : {collection: 'sgsAnamnesis', keyword: req.term},
                            success     : function(results) {
                                let arr = []
                                for(item of results){
                                    arr.push(item.name)
                                }
                                res(arr)
                            }
                        })
                    }
                },
                onAddTag: (res) => {
                    tags        = res.value.split(',')
                    lastIndex   = tags.length - 1

                    $.ajax({
                        url         : "{{ action('SuggestionController@storeSuggestion') }}",
                        type        : 'post',
                        encode      : true,
                        data        : {suggest: tags[lastIndex], collection: 'sgsAnamnesis'},
                    })
                }
            });
            $('#Diagnosa').tagsInput({
                'autocomplete': {
                    source: (req, res) => {
                        console.log(req)
                        $.ajax({
                            url         : "{{ action('SuggestionController@getSuggestion') }}",
                            type        : 'post',
                            encode      : true,
                            data        : {collection: 'sgsDiagnosa', keyword: req.term},
                            success     : function(results) {
                                let arr = []
                                for(item of results){
                                    arr.push(item.name)
                                }
                                res(arr)
                            }
                        })
                    }
                },
                onAddTag: (res) => {
                    tags        = res.value.split(',')
                    lastIndex   = tags.length - 1

                    $.ajax({
                        url         : "{{ action('SuggestionController@storeSuggestion') }}",
                        type        : 'post',
                        encode      : true,
                        data        : {suggest: tags[lastIndex], collection: 'sgsDiagnosa'},
                    })
                }
            });
            $('#Komplikasi').tagsInput({
                'autocomplete': {
                    source: (req, res) => {
                        console.log(req)
                        $.ajax({
                            url         : "{{ action('SuggestionController@getSuggestion') }}",
                            type        : 'post',
                            encode      : true,
                            data        : {collection: 'sgsKomplikasi', keyword: req.term},
                            success     : function(results) {
                                let arr = []
                                for(item of results){
                                    arr.push(item.name)
                                }
                                res(arr)
                            }
                        })
                    }
                },
                onAddTag: (res) => {
                    tags        = res.value.split(',')
                    lastIndex   = tags.length - 1

                    $.ajax({
                        url         : "{{ action('SuggestionController@storeSuggestion') }}",
                        type        : 'post',
                        encode      : true,
                        data        : {suggest: tags[lastIndex], collection: 'sgsKomplikasi'},
                    })
                }
            });
            $('#Komorbid').tagsInput({
                'autocomplete': {
                    source: (req, res) => {
                        console.log(req)
                        $.ajax({
                            url         : "{{ action('SuggestionController@getSuggestion') }}",
                            type        : 'post',
                            encode      : true,
                            data        : {collection: 'sgsKomorbid', keyword: req.term},
                            success     : function(results) {
                                let arr = []
                                for(item of results){
                                    arr.push(item.name)
                                }
                                res(arr)
                            }
                        })
                    }
                },
                onAddTag: (res) => {
                    tags        = res.value.split(',')
                    lastIndex   = tags.length - 1

                    $.ajax({
                        url         : "{{ action('SuggestionController@storeSuggestion') }}",
                        type        : 'post',
                        encode      : true,
                        data        : {suggest: tags[lastIndex], collection: 'sgsKomorbid'},
                    })
                }
            });
            $('#KodeICD9').tagsInput({
                'autocomplete': {
                    source: (req, res) => {
                        console.log(req)
                        $.ajax({
                            url         : "{{ action('SuggestionController@getSuggestion') }}",
                            type        : 'post',
                            encode      : true,
                            data        : {collection: 'sgsKodeICD9', keyword: req.term},
                            success     : function(results) {
                                let arr = []
                                for(item of results){
                                    arr.push(item.name)
                                }
                                res(arr)
                            }
                        })
                    }
                },
                onAddTag: (res) => {
                    tags        = res.value.split(',')
                    lastIndex   = tags.length - 1

                    $.ajax({
                        url         : "{{ action('SuggestionController@storeSuggestion') }}",
                        type        : 'post',
                        encode      : true,
                        data        : {suggest: tags[lastIndex], collection: 'sgsKodeICD9'},
                    })
                }
            });
        });


        // checkbox verifikasi 
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

        // Auto Fill Form bila tidak diisi = "Normal/Tidak dilakukan pemeriksaan"
        $('#form-pengkajian').submit(function () {
            let statusPengkajian = $('#statusPengkajian').val()
            let dataForm = $(this).serializeArray()

            if(statusPengkajian == '2'){
                
                $("form :input").each(function(index, elm){
                    if(elm.name != ''){
                        if(elm.type == 'text'){
                            let tagInput = 'input[name="'+elm.name+'"]';
                            if($(tagInput).attr('required') != 'required' && $(tagInput).val() == ''){
                                $(tagInput).val("Normal/Tidak dilakukan pemeriksaan")
                            }
                        }else if(elm.type == 'textarea'){
                            let tagInput = 'textarea[name="'+elm.name+'"]';
                            if($(tagInput).attr("required") != 'required' && $(tagInput).html() == ''){
                                $(tagInput).html("Normal/Tidak dilakukan pemeriksaan")
                            }
                        }else if(elm.type == 'select-one'){
                            let tagInput = 'select[name="'+elm.name+'"]';
                            if($(tagInput).attr("required") != 'required' && $(tagInput).val() == ''){
                                $(tagInput).val("Normal/Tidak dilakukan pemeriksaan")
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
                        $('#fileExtension_isMaxSize').css('display', 'none');
                        $('#fileExtension_isNull').css('display', 'block');
                    }else{
                        $('#fileExtension_isNull').css('display', 'none');
                        let fileSize = parseInt(file[0].files[0].size)
                        if(fileSize > 2000000){
                            $('#fileExtension_isMaxSize').css('display', 'block');
                        }else{
                            $('#fileExtension_isMaxSize').css('display', 'none');
                            if(noPendaftaran != "" && noRekamMedis != "" && namaLengkap != "" && tglMasuk != "" && fileVal != "" && noPendaftaranCheckValid == '1' && noCmCheckValid == '1'){
                                $('#form-tambah').submit();
                            }
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
            
            function previewPDF(noCM, noPendaftaran, tahun){
                
                // let NoCM = $('.clickLihat').data('lihatNoCM');
                let date = noCM+"/"+noPendaftaran+"_"+tahun+".pdf";
                // alert(date);
                // var test ="URL::asset('"+date+"')";
                // alert(test);
                var str = "<embed src='{{ URL::asset('dokumenRM/') }}/"+noCM+"/"+noPendaftaran+"_"+tahun+".pdf' width='100%' height='300px' />";
                // // // // noPendaftaran + ' ' + noCM+ ' ' + thn;
                $('.arema1').html(str);
                
            }
        </script>
@endsection
