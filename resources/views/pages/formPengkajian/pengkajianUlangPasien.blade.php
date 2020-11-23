@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

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
                    <p class="h4">Data Pasien <a href="/profilRingkas/{{$idForm}}/{{ $dataMasukPoli['NoCM'] }}/{{$dataMasukPoli['NoPendaftaran'] }}" target="_blank" class="btn btn-primary print_button" id="print_button">Print</a></p>
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
                <form action="{{action('FormPengkajianController@storeFormPengkajian', [$idForm, $NoCM, $noPendaftaran, 'tes', '0'])}}" class="needs-validation" method="POST" novalidate>
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
                                            <label for="nopendaftaran">Tekanan Darah <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[TekananDarah]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['TekananDarah']) ? $dataPengkajian['PengkajianKeperawatan']['TekananDarah'] : '')}}" >
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
                                            <input class="form-control inpt-isRequired" type="number" onkeypress="return onlyNumberKey(event)" name="PengkajianKeperawatan[FrekuensiNadi]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['FrekuensiNadi']) ? $dataPengkajian['PengkajianKeperawatan']['FrekuensiNadi'] : '')}}" >
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
                                            <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control inpt-isRequired" name="PengkajianKeperawatan[Suhu]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['Suhu']) ? $dataPengkajian['PengkajianKeperawatan']['Suhu'] : '')}}">
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
                                            <input class="form-control inpt-isRequired" type="number" onkeypress="return onlyNumberKey(event)" name="PengkajianKeperawatan[FrekuensiNafas]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['FrekuensiNafas']) ? $dataPengkajian['PengkajianKeperawatan']['FrekuensiNafas'] : '')}}">
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
                                            <label for="nopendaftaran">Berat Badan</label>
                                            <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan[BeratBadan]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['BeratBadan']) ? $dataPengkajian['PengkajianKeperawatan']['BeratBadan'] : '')}}">
                                            <div class="invalid-feedback">
                                                Data Berat Badan Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="pl-0 col-4 mt-3 mt-lg-0">
                                            <label for="norekammedis"></label>
                                            <input type="text" name="" value="Kg" disabled>
                                        </div>
            
                                        <div class="col-8 mt-3">
                                            <label for="nopendaftaran">Tinggi Badan</label>
                                            <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan[TinggiBadan]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['TinggiBadan']) ? $dataPengkajian['PengkajianKeperawatan']['TinggiBadan'] : '')}}">
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
                                            <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan[SkorNyeri]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan']['SkorNyeri']) ? $dataPengkajian['PengkajianKeperawatan']['SkorNyeri'] : '')}}" >
                                            <div class="invalid-feedback">
                                                Data Skor Nyeri Harus Diisi.
                                            </div>
                                        </div>
                                        
                                        <div class="col-12 mt-3 pr-5">
                                            <label for="nopendaftaran" class="pb-3">Skor Jatuh</label>
                                            <div class="d-flex justify-content-between align-items-center">
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
                                <div class="col-12">
                                    <button type="submit" class="btn green-long w-50 ml-auto mr-3"> Submit</button>
                                </div>
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
                                            <label for="diagnosa">Diagnosa (A) <span class="lbl-isRequired" style="color:red;">*</span></label>
                                            <input type="text" class="form-control inpt-isRequired" name="PengkajianMedis[Diagnosa]" value="{{(!empty($dataPengkajian['PengkajianMedis']['Diagnosa']) ? $dataPengkajian['PengkajianMedis']['Diagnosa'] : '')}}">
                                            <div class="invalid-feedback">
                                                Data Diagnosa Harus Diisi.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="kodeICD">Kode ICD 10</label>
                                            <select class="custom-select" name="PengkajianMedis[KodeICD10]" id="kodeICD">
                                                <option selected>-</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
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
                                            <label for="kodeICD">Kode ICD 9</label>
                                            <select class="custom-select" name="PengkajianMedis[KodeICD9]" id="kodeICD">
                                                <option selected>-</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
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
                                            <a href="#" class="btn secondary">List dirujuk/konsul ke</a>
                                            @if(Auth::user()->Role == "1")
                                            <input type="checkbox" id="verifikasi" name="verifikasi" value="verifikasi" >
                                            <label for="verifikasi"> Verifikasi final pasien</label><br>
                                            <div class="invalid-feedback">
                                                Verifikasi Harus Tercentang
                                            </div>
                                            @endif
                                        </div>
                                        <div class="col-12 mt-3">
                                            <input type="hidden" id="statusPengkajian" name="StatusPengkajian" value="1">
                                            {{-- <button type="submit" class="btn green-long">Submit</button> --}}
                                        </div>
                                    </div>
                                </div>
        
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
            // set hide field required
            $('.lbl-isRequired').hide();
            $('.print_button').hide();
            $("#tab_section-riwayat").on("click", function(){
                    $(".print_button").show();
                });
                $("#tab_section-form").on("click", function(){
                    $(".print_button").hide();
                });
                $("#tab_section-berkas").on("click", function(){
                    $(".print_button").hide();
                });
            $('#verifikasi').prop('checked', false);
            $('.inpt-isRequired').prop('required', false);

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
            
        })
        $(document).on('hidden.bs.modal','#modal_pratinjau', function () {
            $('#pratinjauDokumen').attr('src', "");
        })

        $(document).ready(function() {
            // $('.pilihDiagnosa').selectpicker();
            $('.pilihDiagnosa').select2();

            $('#pilihDiagnosa').on('change', function () {
                // console.log("its change");
                
                let diagnosa = $(this).val();
                // console.log(diagnosa);

                $.ajax({

                    type    : 'post',
                    url     : "{{ url('formPengkajian/getICD10') }}",
                    data    : { NamaDiagnosa: diagnosa , _token: '<?php echo csrf_token()?>' },
                    success : function (data) {
                        console.log("Success");
                        console.log(data);
                        // alert(data);
                    },
                    error   : function() {
                        console.error();
                    }

                });
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
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
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
        </script>
@endsection
