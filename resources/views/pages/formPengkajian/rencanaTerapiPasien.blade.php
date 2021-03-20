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
                                <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control inptNoCm" id="noRekamMedis" value="{{ $NoCM }}" disabled>
                                <input type="hidden" onkeypress="return onlyNumberKey(event)" class="form-control inptNoCm" id="noRekamMedis" value="{{ $NoCM }}" name="NoCM">
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
                {{-- <a href="{{ url()->previous() }}" class="mr-auto"> --}}
                <a href="/formPengkajian/{{$idForm}}/{{ $dataMasukPoli['NoCM'] }}/{{$dataMasukPoli['NoPendaftaran'] }}/{{$dataMasukPoli['TglMasukPoli']}}" class="mr-auto">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                        Kembali
                    </span>
                </a>
                {{-- <a class="capsule-btn capsule-left active tabPengkajian" id="tab_section-form" data-active='section-form' data-notactive1='section-riwayat' data-notactive2='section-berkas' href="#">Form</a>
                <a class="capsule-btn capsule-middle tabPengkajian" id="tab_section-riwayat" data-active='section-riwayat' data-notactive1='section-form' data-notactive2='section-berkas' href="#">Riwayat</a>
                <a class="capsule-btn capsule-right tabPengkajian" id="tab_section-berkas" data-active='section-berkas' data-notactive1='section-form' data-notactive2='section-riwayat' href="#">Berkas</a> --}}
            </div>

            <!-- Data Pasien -->
            @include('pages.formPengkajian.dataPasien')
            <!-- end of Data Pasien -->

            <div id="section-form">
                @php
                    // set subform data
                    $dataPengkajian = $dataMasukPoli['DataPengkajian'];
                @endphp

                <div class="content mt-3 soft-shadow">
                    <div class="p-4">
                        <p class="h5 d-flex"> Terapi Non Racikan <a id="add-TerapiNonRacikan" class="btn btn-primary print_button ml-auto">Tambah </a></p>
                    </div>
                    <hr>
                    <input type="hidden" id="NoCM" name="NoCM" value="{{ $dataMasukPoli['NoCM'] }}">
                    <input type="hidden" id="KdRuangan" name="KdRuangan" value="{{ $dataMasukPoli['KdRuangan'] }}">
                    <input type="hidden" id="TglMasukPoli" name="TglMasukPoli" value="{{ $dataMasukPoli['TglMasukPoli'] }}">
                    <input type="hidden" id="NoPendaftaran" name="NoPendaftaran" value="{{ $dataMasukPoli['NoPendaftaran'] }}">
                    <table class="table table-striped table-borderless" id="tb-non_racikan">
                        <thead class="text-muted font-weight-light border-bottom px-5">
                            {{-- <th class="font-weight-light"></th> --}}
                            <th class="font-weight-light">Nama Obat</th>
                            <th class="font-weight-light th-number">Dosis</th>
                            <th class="font-weight-light th-number">Jumlah</th>
                            <th class="font-weight-light th-number">Pagi</th>
                            <th class="font-weight-light th-number">Siang</th>
                            <th class="font-weight-light th-number">Malam</th>
                            <th class="font-weight-light">Keterangan</th>
                            <th class="font-weight-light"></th>
                        </thead>
                        <tbody class="font-weight-bold text-black px-5 td-hover-action">
                            {{-- <form action="">
                                <tr class="table-input">
                                    <td></td>
                                    <td class="pr-1"><input type="text" placeholder="Captopril"></td>
                                    <td class="px-1"><input type="text" placeholder="12.5 mg"></td>
                                    <td class="px-1"><input type="text" placeholder="30"></td>
                                    <td class="px-1"><input type="text" placeholder="1"></td>
                                    <td class="px-1"><input type="text" placeholder="0"></td>
                                    <td class="px-1"><input type="text" placeholder="1"></td>
                                    <td class="pl-1 d-flex"><input type="text" placeholder="-"><a href="#"><i class="fas fa-plus ml-2"></i></a></td>
                                </tr>
                            </form> --}}
                        </tbody>
                    </table>
                    <div class="d-flex border-top px-4 py-2">
                        {{-- <button class="ml-auto btn diagnosa-outline"><i class="fas fa-save m-0"></i> Buka Resep</button> --}}
                        @if ($dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatNonRacikan'] == "0")
                            <button data-toggle="modal" data-target="#btn-lock-NonRacik" data-statnonracik="{{ $dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatNonRacikan'] }}" class="ml-auto btn diagnosa"><i class="fas fa-lock m-0"></i> Kunci Resep</button>    
                        @else    
                            <button data-toggle="modal" data-target="#btn-unlock-NonRacik" data-statnonracik="{{ $dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatNonRacikan'] }}" class="ml-auto btn diagnosa-outline"><i class="fas fa-unlock m-0"></i> Buka Resep</button>
                        @endif
                        
                    </div>

                </div>

                <div class="content mt-3 soft-shadow">
                    <div class="p-4">
                        <p class="h5 d-flex"> Terapi Racikan <a id="add-TerapiRacikan" class="btn btn-primary print_button ml-auto">Tambah </a></p>
                    </div>
                    <hr>

                    <table class="table table-striped table-borderless" id="tb-racikan">
                        <thead class="text-muted font-weight-light border-bottom px-5">
                            <th class="font-weight-light">Nama Obat</th>
                            <th class="font-weight-light th-number">Dosis</th>
                            <th class="font-weight-light">Racikan Dalam</th>
                            <th class="font-weight-light th-number">Jumlah</th>
                            <th class="font-weight-light th-number">Pagi</th>
                            <th class="font-weight-light th-number">Siang</th>
                            <th class="font-weight-light th-number">Malam</th>
                            <th class="font-weight-light">Keterangan</th>
                            <th class="font-weight-light"></th>
                        </thead>
                        <tbody class="font-weight-bold text-black px-5 td-hover-action">
                            {{-- <form action="">
                                <tr class="table-input">
                                    <td></td>
                                    <td class="pr-1"><input type="text" placeholder="Captopril"></td>
                                    <td class="px-1"><input type="text" placeholder="12.5 mg"></td>
                                    <td class="px-1"><input type="text" placeholder="Kapsul"></td>
                                    <td class="px-1"><input type="text" placeholder="30"></td>
                                    <td class="px-1"><input type="text" placeholder="1"></td>
                                    <td class="px-1"><input type="text" placeholder="0"></td>
                                    <td class="px-1"><input type="text" placeholder="1"></td>
                                    <td class="pl-1 d-flex"><input type="text" placeholder="-"><a href="#"><i class="fas fa-plus ml-2"></i></a></td>
                                </tr>
                            </form>
                            <tr>
                                <td><a href="#"><i class="fas fa-minus"></i></a></td>
                                <td>Furosemide</td>
                                <td>40 mg</td>
                                <td>Puyer</td>
                                <td class="text-center">30</td>
                                <td class="text-center">1/2</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                <td>Setelah Makan</td>
                            </tr> --}}
                        </tbody>
                    </table>
                    <div class="d-flex border-top px-4 py-2">
                        {{-- <button class="ml-auto btn diagnosa-outline"><i class="fas fa-save m-0"></i> Simpan</button> --}}
                        @if ($dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatRacikan'] == "0")
                            <button data-toggle="modal" data-target="#btn-lock-Racik" data-statracik="{{ $dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatRacikan'] }}" class="ml-auto btn diagnosa"><i class="fas fa-lock m-0"></i> Kunci Resep</button>
                        @else
                            <button data-toggle="modal" data-target="#btn-unlock-Racik" data-statracik="{{ $dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatRacikan'] }}" class="ml-auto btn diagnosa-outline"><i class="fas fa-unlock m-0"></i> Buka Resep</button>
                        @endif
                    </div>

                </div>
                
            </div>
            
        </div>
    </div>

    {{-- Modal lock resep --}}
    <div class="modal fade" id="btn-lock-NonRacik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white text-center">Kunci Resep </h5>
                </div>
                <form id="form-lock-nonRacik" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p style="text-align: center;">Apakah anda yakin mengunci resep ini ? </p>
                            <input type="hidden" name="status" id="StatusTerapiNonRacik-lock" value="">
                            <input type="hidden" name="NoCM" value="{{ $dataMasukPoli['NoCM'] }}">
                            <input type="hidden" name="KdRuangan" value="{{ $dataMasukPoli['KdRuangan'] }}">
                            <input type="hidden" name="TglMasukPoli" value="{{ $dataMasukPoli['TglMasukPoli'] }}">
                            <input type="hidden" name="NoPendaftaran" value="{{ $dataMasukPoli['NoPendaftaran'] }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="btn-lock-Racik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white text-center">Kunci Resep </h5>
                </div>
                <form id="form-lock-Racik" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p style="text-align: center;">Apakah anda yakin mengunci resep ini ? </p>    
                            <input type="hidden" name="status" id="StatusTerapiRacik-lock" value="">
                            <input type="hidden" name="NoCM" value="{{ $dataMasukPoli['NoCM'] }}">
                            <input type="hidden" name="KdRuangan" value="{{ $dataMasukPoli['KdRuangan'] }}">
                            <input type="hidden" name="TglMasukPoli" value="{{ $dataMasukPoli['TglMasukPoli'] }}">
                            <input type="hidden" name="NoPendaftaran" value="{{ $dataMasukPoli['NoPendaftaran'] }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal unlock resep --}}
    <div class="modal fade" id="btn-unlock-NonRacik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white text-center">Kunci Resep </h5>
                </div>
                <form id="form-unlock-nonRacik" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p style="text-align: center;">Apakah anda yakin mengunci resep ini ? </p>
                            <input type="hidden" name="status" id="StatusTerapiNonRacik-unlock" value="">
                            <input type="hidden" name="NoCM" value="{{ $dataMasukPoli['NoCM'] }}">
                            <input type="hidden" name="KdRuangan" value="{{ $dataMasukPoli['KdRuangan'] }}">
                            <input type="hidden" name="TglMasukPoli" value="{{ $dataMasukPoli['TglMasukPoli'] }}">
                            <input type="hidden" name="NoPendaftaran" value="{{ $dataMasukPoli['NoPendaftaran'] }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="btn-unlock-Racik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white text-center">Kunci Resep </h5>
                </div>
                <form id="form-unlock-Racik" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p style="text-align: center;">Apakah anda yakin mengunci resep ini ? </p>    
                            <input type="hidden" name="status" id="StatusTerapiRacik-unlock" value="">
                            <input type="hidden" name="NoCM" value="{{ $dataMasukPoli['NoCM'] }}">
                            <input type="hidden" name="KdRuangan" value="{{ $dataMasukPoli['KdRuangan'] }}">
                            <input type="hidden" name="TglMasukPoli" value="{{ $dataMasukPoli['TglMasukPoli'] }}">
                            <input type="hidden" name="NoPendaftaran" value="{{ $dataMasukPoli['NoPendaftaran'] }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    </div>
                </form>
            </div>
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

            // status Btn-add Obat Non Racikan
            @if($dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatNonRacikan'] == '0')
                $('#add-TerapiNonRacikan').removeClass('disabled');
            @else
                $('#add-TerapiNonRacikan').addClass('disabled');
            @endif

            // status Btn-add Obat Racikan
            @if($dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatRacikan'] == '0')
                $('#add-TerapiRacikan').removeClass('disabled');
            @else
                $('#add-TerapiRacikan').addClass('disabled');
            @endif

            // alert Notification
            @if(session('statusNotif') == 'success')
                // NonRacik
                @if(session('lock') == 'nonRacik')
                    $('#msg_modal').html('Berhasil Mengunci Resep Non Racik');
                    $('#modal_success').modal('toggle')
                @endif
                @if(session('unlock') == 'nonRacik')
                    $('#msg_modal').html('Batal Mengunci Resep Non Racik');
                    $('#modal_success').modal('toggle')
                @endif

                // Racik
                @if(session('lock') == 'Racik')
                    $('#msg_modal').html('Berhasil Mengunci Resep Racik');
                    $('#modal_success').modal('toggle')
                @endif
                @if(session('unlock') == 'Racik')
                    $('#msg_modal').html('Batal Mengunci Resep Racik');
                    $('#modal_success').modal('toggle')
                @endif
            @endif

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

            
        })
        $(document).on('hidden.bs.modal','#modal_pratinjau', function () {
            $('#pratinjauDokumen').attr('src', "");
        })

        // CRUD DataTable Non-Racikan
        $(document).ready(function() {
            fetchNonRacikan();

            function fetchNonRacikan()
            {
                var dataTable = $('#tb-non_racikan').DataTable({
                    paging          : false,
                    searching       : false,
                    bPaginate       : false,
                    bLengthChange   : false,
                    bFilter         : true,
                    bInfo           : false,
                    bAutoWidth      : false, 
                    processing      : true,
                    serverSide      : true,
                    
                    order : [],
                    ajax: {
                        url         : "{{ action('RencanaTerapiController@obatNonRacikan') }}",
                        type        : 'POST',
                        data        : function (d) {
                            d.NoCM          = $('#NoCM').val();
                            d.KdRuangan     = $('#KdRuangan').val();
                            d.TglMasukPoli  = $('#TglMasukPoli').val();
                            // console.log([d.NoCM, d.KdRuangan, d.TglMasukPoli]);
                        },
                    }
                });
            }

            function update_NonRacikan(rows, NoCM, KdRuangan, NoPendaftaran, TglMasukPoli, column_name, value)
            {
                $.ajax({
                    url     : "{{ action('RencanaTerapiController@updateObatNonRacikan') }}",
                    method  : "POST",
                    data    : {
                        NoCM            : NoCM, 
                        KdRuangan       : KdRuangan, 
                        NoPendaftaran   : NoPendaftaran, 
                        TglMasukPoli    : TglMasukPoli, 
                        rows            : rows, 
                        column_name     : column_name, 
                        value           : value,
                    },
                    success:function(data)
                    {
                        // $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                        // console.log(data);
                        $('#msg_modal').html('Berhasil Mengupdate data Obat Non Racikan');
                        $('#modal_success').modal('toggle')
                        $('#tb-non_racikan').DataTable().destroy();
                        fetchNonRacikan();
                    }
                });
                setInterval(function(){
                    $('#msg_modal').html('Berhasil Mengupdate data Obat Non Racikan');
                }, 5000);
            }

            $(document).on('blur', '.update-nonRacikan', function(){
                var rows        = $(this).data("rows");
                var noCM        = $(this).data("nocm");
                var kdRuangan   = $(this).data("kdruangan");
                var column_name = $(this).data("column");
                var value       = $(this).text();

                var noPendaftaran   = $('#NoPendaftaran').val();
                var tglMasukPoli    = $('#TglMasukPoli').val();
                // console.log([rows, noCM, kdRuangan, column_name, value]);

                update_NonRacikan(rows, noCM, kdRuangan, noPendaftaran, tglMasukPoli, column_name, value);
            });

            $('#add-TerapiNonRacikan').click(function(){
                var html = '<tr class="table-input">';
                html += '<td contenteditable id="col1-NonRacikan"></td>';
                html += '<td contenteditable id="col2-NonRacikan"></td>';
                html += '<td contenteditable id="col3-NonRacikan"></td>';
                html += '<td contenteditable id="col4-NonRacikan"></td>';
                html += '<td contenteditable id="col5-NonRacikan"></td>';
                html += '<td contenteditable id="col6-NonRacikan"></td>';
                html += '<td contenteditable id="col7-NonRacikan"></td>';
                html += '<td><a class="row-insert-NonRacikan" id="insert-NonRacikan"><i class="fas fa-plus"></i></a></td>';
                html += '</tr>';
                $('#tb-non_racikan tbody').prepend(html);
            });

            $(document).on('click', '#insert-NonRacikan', function(){
                var namaObat        = $('#col1-NonRacikan').text();
                var dosis           = $('#col2-NonRacikan').text();
                var jumlah          = $('#col3-NonRacikan').text();
                var pagi            = $('#col4-NonRacikan').text();
                var siang           = $('#col5-NonRacikan').text();
                var malam           = $('#col6-NonRacikan').text();
                var keterangan      = $('#col7-NonRacikan').text();
                var noCM            = $('#NoCM').val();
                var kdRuangan       = $('#KdRuangan').val();
                var noPendaftaran   = $('#NoPendaftaran').val();
                var tglMasukPoli    = $('#TglMasukPoli').val();
                // console.log(namaObat, dosis, jumlah, pagi, siang, malam, keterangan);
                // console.log(noCM, kdRuangan, noPendaftaran, tglMasukPoli);
                if(namaObat != '' && dosis != '' && jumlah != '' && pagi != '' && siang != '' && malam != '' )
                {
                    $.ajax({
                        url     :"{{ action('RencanaTerapiController@storeObatNonRacikan') }}",
                        method  :"POST",
                        data    :{
                            NoCM            : noCM, 
                            KdRuangan       : kdRuangan, 
                            NoPendaftaran   : noPendaftaran, 
                            TglMasukPoli    : tglMasukPoli, 
                            NamaObat        : namaObat, 
                            Dosis           : dosis,
                            Jumlah          : jumlah,
                            Pagi            : pagi,
                            Siang           : siang,
                            Malam           : malam,
                            Keterangan      : keterangan,
                        },
                        success:function(data)
                        {
                            // console.log(data);
                            $('#msg_modal').html('Berhasil Menambahkan data Obat Non Racikan');
                            $('#modal_success').modal('toggle');
                            $('#tb-non_racikan').DataTable().destroy();
                            fetchNonRacikan();
                        }
                    });
                    setInterval(function(){
                        $('#msg_modal').html('Berhasil Menambahkan data Obat Non Racikan');
                    }, 5000);
                }
                else
                {
                    alert("Semua data Wajib Diisi");
                }
            });

            $(document).on('click', '.delete-nonRacikan', function(){
                var rows            = $(this).data("rows");
                var noCM            = $('#NoCM').val();
                var kdRuangan       = $('#KdRuangan').val();
                var noPendaftaran   = $('#NoPendaftaran').val();
                var tglMasukPoli    = $('#TglMasukPoli').val();
                // console.log(rows);
                @if($dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatNonRacikan'] == '0')
                    // if(confirm("Are you sure you want to remove this?"))
                    // {
                        $.ajax({
                            url     : "{{ action('RencanaTerapiController@destroyObatNonRacikan') }}",
                            method  : "POST",
                            data    : {
                                rows            : rows,
                                NoCM            : noCM,
                                KdRuangan       : kdRuangan,
                                NoPendaftaran   : noPendaftaran,
                                TglMasukPoli    : tglMasukPoli,
                            },
                            success : function(data){
                                // console.log(data);
                                $('#msg_modal').html('Berhasil Menghapus data Obat Non Racikan');
                                $('#modal_success').modal('toggle');
                                $('#tb-non_racikan').DataTable().destroy();
                                fetchNonRacikan();
                            }
                        });
                        setInterval(function(){
                            $('#msg_modal').html('Berhasil Menghapus data Obat Non Racikan');
                        }, 5000);
                    // }
                @endif
            });
        });

        $(document).ready(function() {
            fetchRacikan();

            function fetchRacikan()
            {
                var dataTable = $('#tb-racikan').DataTable({
                    paging          : false,
                    searching       : false,
                    bPaginate       : false,
                    bLengthChange   : false,
                    bFilter         : true,
                    bInfo           : false,
                    bAutoWidth      : false, 
                    processing      : true,
                    serverSide      : true,
                    
                    order : [],
                    ajax: {
                        url         : "{{ action('RencanaTerapiController@obatRacikan') }}",
                        type        : 'POST',
                        data        : function (d) {
                            d.NoCM          = $('#NoCM').val();
                            d.KdRuangan     = $('#KdRuangan').val();
                            d.TglMasukPoli  = $('#TglMasukPoli').val();
                            // console.log([d.NoCM, d.KdRuangan, d.TglMasukPoli]);
                        },
                    }
                });
            }

            function update_Racikan(rows, NoCM, KdRuangan, NoPendaftaran, TglMasukPoli, column_name, value)
            {
                $.ajax({
                    url     : "{{ action('RencanaTerapiController@updateObatRacikan') }}",
                    method  : "POST",
                    data    : {
                        NoCM            : NoCM, 
                        KdRuangan       : KdRuangan, 
                        NoPendaftaran   : NoPendaftaran, 
                        TglMasukPoli    : TglMasukPoli, 
                        rows            : rows, 
                        column_name     : column_name, 
                        value           : value,
                    },
                    success:function(data)
                    {
                        // $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
                        // console.log(data);
                        $('#msg_modal').html('Berhasil Mengupdate data Obat Racikan');
                        $('#modal_success').modal('toggle')
                        $('#tb-racikan').DataTable().destroy();
                        fetchRacikan();
                    }
                });
                setInterval(function(){
                    $('#msg_modal').html('Berhasil Mengupdate data Obat Racikan');
                }, 5000);
            }

            $(document).on('blur', '.update-Racikan', function(){
                var rows        = $(this).data("rows");
                var noCM        = $(this).data("nocm");
                var kdRuangan   = $(this).data("kdruangan");
                var column_name = $(this).data("column");
                var value       = $(this).text();

                var noPendaftaran   = $('#NoPendaftaran').val();
                var tglMasukPoli    = $('#TglMasukPoli').val();
                // console.log([rows, noCM, kdRuangan, column_name, value]);

                update_Racikan(rows, noCM, kdRuangan, noPendaftaran, tglMasukPoli, column_name, value);
            });

            $('#add-TerapiRacikan').click(function(){
                var html = '<tr class="table-input">';
                html += '<td contenteditable id="col1-Racikan"></td>';
                html += '<td contenteditable id="col2-Racikan"></td>';
                html += '<td contenteditable id="col3-Racikan"></td>';
                html += '<td contenteditable id="col4-Racikan"></td>';
                html += '<td contenteditable id="col5-Racikan"></td>';
                html += '<td contenteditable id="col6-Racikan"></td>';
                html += '<td contenteditable id="col7-Racikan"></td>';
                html += '<td contenteditable id="col8-Racikan"></td>';
                html += '<td><a class="row-insert-Racikan" id="insert-Racikan"><i class="fas fa-plus"></i></a></td>';
                html += '</tr>';
                $('#tb-racikan tbody').prepend(html);
            });

            $(document).on('click', '#insert-Racikan', function(){
                var namaObat        = $('#col1-Racikan').text();
                var dosis           = $('#col2-Racikan').text();
                var racikanDalam    = $('#col3-Racikan').text();
                var jumlah          = $('#col4-Racikan').text();
                var pagi            = $('#col5-Racikan').text();
                var siang           = $('#col6-Racikan').text();
                var malam           = $('#col7-Racikan').text();
                var keterangan      = $('#col8-Racikan').text();
                var noCM            = $('#NoCM').val();
                var kdRuangan       = $('#KdRuangan').val();
                var noPendaftaran   = $('#NoPendaftaran').val();
                var tglMasukPoli    = $('#TglMasukPoli').val();
                // console.log(namaObat, dosis, jumlah, pagi, siang, malam, keterangan);
                // console.log(noCM, kdRuangan, noPendaftaran, tglMasukPoli);
                if(namaObat != '' && dosis != '' && racikanDalam != '' && jumlah != '' && pagi != '' && siang != '' && malam != '' )
                {
                    $.ajax({
                        url     :"{{ action('RencanaTerapiController@storeObatRacikan') }}",
                        method  :"POST",
                        data    :{
                            NoCM            : noCM, 
                            KdRuangan       : kdRuangan, 
                            NoPendaftaran   : noPendaftaran, 
                            TglMasukPoli    : tglMasukPoli, 
                            NamaObat        : namaObat, 
                            Dosis           : dosis,
                            RacikanDalam    : racikanDalam,
                            Jumlah          : jumlah,
                            Pagi            : pagi,
                            Siang           : siang,
                            Malam           : malam,
                            Keterangan      : keterangan,
                        },
                        success:function(data)
                        {
                            // console.log(data);
                            $('#msg_modal').html('Berhasil Menambahkan data Obat Racikan');
                            $('#modal_success').modal('toggle');
                            $('#tb-racikan').DataTable().destroy();
                            fetchRacikan();
                        }
                    });
                    setInterval(function(){
                        $('#msg_modal').html('Berhasil Menambahkan data Obat Racikan');
                    }, 5000);
                }
                else
                {
                    alert("Semua data Wajib Diisi");
                }
            });

            $(document).on('click', '.delete-Racikan', function(){
                var rows            = $(this).data("rows");
                var noCM            = $('#NoCM').val();
                var kdRuangan       = $('#KdRuangan').val();
                var noPendaftaran   = $('#NoPendaftaran').val();
                var tglMasukPoli    = $('#TglMasukPoli').val();
                // console.log(rows);
                @if($dataMasukPoli['RencanaTerapi']['StatusTerapi']['ObatRacikan'] == '0')
                    // if(confirm("Are you sure you want to remove this?"))
                    // {
                        $.ajax({
                            url     : "{{ action('RencanaTerapiController@destroyObatRacikan') }}",
                            method  : "POST",
                            data    : {
                                rows            : rows,
                                NoCM            : noCM,
                                KdRuangan       : kdRuangan,
                                NoPendaftaran   : noPendaftaran,
                                TglMasukPoli    : tglMasukPoli,
                            },
                            success : function(data){
                                // console.log(data);
                                $('#msg_modal').html('Berhasil Menghapus data Obat Racikan');
                                $('#modal_success').modal('toggle');
                                $('#tb-racikan').DataTable().destroy();
                                fetchRacikan();
                            }
                        });
                        setInterval(function(){
                            $('#msg_modal').html('Berhasil Menghapus data Obat Racikan');
                        }, 5000);
                    // }
                @endif
            });
        });

        $(function() {

            $('#btn-lock-NonRacik').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) // Button that triggered the modal
                var title           = "Obat Non Racik"
                var status          = button.data('statnonracik');

                var modal = $(this)
                modal.find('.modal-title').text('Kunci Resep ' + title)
                modal.find('.modal-body #StatusTerapiNonRacik-lock').val(status)
                modal.find('#form-lock-nonRacik').attr('action', "{{ action('RencanaTerapiController@lockObatNonRacikan') }}")
            });

            $('#btn-lock-Racik').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) // Button that triggered the modal
                var title           = "Obat Racik"
                var status          = button.data('statracik');
                var noCM            = $('#NoCM').val();
                var kdRuangan       = $('#KdRuangan').val();
                var noPendaftaran   = $('#NoPendaftaran').val();
                var tglMasukPoli    = $('#TglMasukPoli').val();

                var modal = $(this)
                modal.find('.modal-title').text('Kunci Resep ' + title)
                modal.find('.modal-body #StatusTerapiRacik-lock').val(status)
                modal.find('#form-lock-Racik').attr('action', "{{ action('RencanaTerapiController@lockObatRacikan') }}")
            });

            $('#btn-unlock-NonRacik').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) // Button that triggered the modal
                var title           = "Obat Non Racik"
                var status          = button.data('statnonracik');

                var modal = $(this)
                modal.find('.modal-title').text('Kunci Resep ' + title)
                modal.find('.modal-body #StatusTerapiNonRacik-unlock').val(status)
                modal.find('#form-unlock-nonRacik').attr('action', "{{ action('RencanaTerapiController@unlockObatNonRacikan') }}")
            });

            $('#btn-unlock-Racik').on('show.bs.modal', function (event) {
                var button          = $(event.relatedTarget) // Button that triggered the modal
                var title           = "Obat Racik"
                var status          = button.data('statracik');

                var modal = $(this)
                modal.find('.modal-title').text('Kunci Resep ' + title)
                modal.find('.modal-body #StatusTerapiRacik-unlock').val(status)
                modal.find('#form-unlock-Racik').attr('action', "{{ action('RencanaTerapiController@unlockObatRacikan') }}")
            });

            $('#form-nonRacik').submit(function () {
            
                // var status          = $('#StatusTerapiNonRacik-lock').val();
                // var noCM            = $('#NoCM').val();
                // var kdRuangan       = $('#KdRuangan').val();
                // var noPendaftaran   = $('#NoPendaftaran').val();
                // var tglMasukPoli    = $('#TglMasukPoli').val();
                // console.log([status, noCM, kdRuangan, noPendaftaran, tglMasukPoli]);
                // $.ajax({
                //     url     : "{{ action('RencanaTerapiController@lockObatNonRacikan') }}",
                //     method  : "POST",
                //     data    : {
                //         status          : status,
                //         NoCM            : noCM,
                //         KdRuangan       : kdRuangan,
                //         NoPendaftaran   : noPendaftaran,
                //         TglMasukPoli    : tglMasukPoli,
                //     },
                //     success : function(data){
                //         console.log(data);
                //         // $('#msg_modal').html('Berhasil Mengunci data Obat Non Racikan');
                //         // $('#modal_success').modal('toggle');
                //     }
                // });
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
