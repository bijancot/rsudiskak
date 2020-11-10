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
                <div class="capsule-btn active capsule-single ml-auto mt-3 mt-lg-0">Pengkajian Ulang Pasien Rawat Jalan</div>
            </div>

            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h4">Data Pasien</p>
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
            @php
                // set subform data
                $subForm = ['PengkajianKeperawatan_1', 'PengkajianKeperawatan_2'];
                $dataPengkajian = [];
                foreach ($dataMasukPoli['DataPengkajian'] as $item) {
                    foreach ($subForm as $item2) {
                        if(!empty($item[$item2])){
                            $dataPengkajian[$item2] = $item[$item2];
                            break;
                        }
                    }
                }
                
            @endphp
            <form action="{{action('FormPengkajianController@storeFormPengkajian', [$idForm, $NoCM, $noPendaftaran, $subForm[0], '0'])}}" class="needs-validation" method="POST" novalidate>
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
                                        <label for="nopendaftaran">Tekanan Darah</label>
                                        <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan_1[TekananDarah]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_1']['TekananDarah']) ? $dataPengkajian['PengkajianKeperawatan_1']['TekananDarah'] : '')}}" required>
                                        <div class="invalid-feedback">
                                            Data Tekanan Darah Harus Diisi.
                                        </div>
                                    </div>
                                    <div class="pl-0 col-4 mt-3 mt-lg-0">
                                        <label for="norekammedis"></label>
                                        <input type="text" name="" value="mmHg" disabled>
                                    </div>
        
                                    <div class="col-8 mt-3">
                                        <label for="nopendaftaran">Frekuensi Nadi</label>
                                        <input class="form-control" type="number" onkeypress="return onlyNumberKey(event)" name="PengkajianKeperawatan_1[FrekuensiNadi]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_1']['FrekuensiNadi']) ? $dataPengkajian['PengkajianKeperawatan_1']['FrekuensiNadi'] : '')}}" required>
                                        <div class="invalid-feedback">
                                            Data Frekuensi Nadi Harus Diisi.
                                        </div>
                                    </div>
                                    <div class="pl-0 col-4 mt-3">
                                        <label for="norekammedis"></label>
                                        <input type="text" name="" value="x/menit" disabled>
                                    </div>
        
                                    <div class="col-8 mt-3">
                                        <label for="nopendaftaran">Suhu</label>
                                        <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan_1[Suhu]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_1']['Suhu']) ? $dataPengkajian['PengkajianKeperawatan_1']['Suhu'] : '')}}" required>
                                        <div class="invalid-feedback">
                                            Data Suhu Harus Diisi.
                                        </div>
                                    </div>
                                    <div class="pl-0 col-4 mt-3">
                                        <label for="norekammedis"></label>
                                        <input type="text" name="" value="C" disabled>
                                    </div>
        
                                    <div class="col-8 mt-3">
                                        <label for="nopendaftaran">Frekuensi Nafas</label>
                                        <input class="form-control" type="number" onkeypress="return onlyNumberKey(event)" name="PengkajianKeperawatan_1[FrekuensiNafas]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_1']['FrekuensiNafas']) ? $dataPengkajian['PengkajianKeperawatan_1']['FrekuensiNafas'] : '')}}" required>
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
                                        <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan_1[BeratBadan]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_1']['BeratBadan']) ? $dataPengkajian['PengkajianKeperawatan_1']['BeratBadan'] : '')}}" required>
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
                                        <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan_1[TinggiBadan]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_1']['TinggiBadan']) ? $dataPengkajian['PengkajianKeperawatan_1']['TinggiBadan'] : '')}}" required>
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
                                        <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control" name="PengkajianKeperawatan_1[SkorNyeri]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_1']['SkorNyeri']) ? $dataPengkajian['PengkajianKeperawatan_1']['SkorNyeri'] : '')}}" required>
                                        <div class="invalid-feedback">
                                            Data Skor Nyeri Harus Diisi.
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 mt-3 pr-5">
                                        <label for="nopendaftaran" class="pb-3">Skor Jatuh</label>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="rendah" name="PengkajianKeperawatan_1[SkorJatuh]" value="rendah" {{(!empty($dataPengkajian['PengkajianKeperawatan_1']['SkorJatuh']) && $dataPengkajian['PengkajianKeperawatan_1']['SkorJatuh'] == 'rendah' ? 'checked' : '')}} required>
                                                <label for="rendah">Rendah</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="sedang" name="PengkajianKeperawatan_1[SkorJatuh]" value="sedang" {{(!empty($dataPengkajian['PengkajianKeperawatan_1']['SkorJatuh']) && $dataPengkajian['PengkajianKeperawatan_1']['SkorJatuh'] == 'sedang' ? 'checked' : '')}} required>
                                                <label for="sedang">Sedang</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="tinggi" name="PengkajianKeperawatan_1[SkorJatuh]" value="tinggi" {{(!empty($dataPengkajian['PengkajianKeperawatan_1']['SkorJatuh']) && $dataPengkajian['PengkajianKeperawatan_1']['SkorJatuh'] == 'tinggi' ? 'checked' : '')}} required>
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
            </form>
            <form action="{{action('FormPengkajianController@storeFormPengkajian', [$idForm, $NoCM, $noPendaftaran, $subForm[1], '1'])}}" method="POST" class="needs-validation" novalidate>
                @csrf
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
                                            <textarea class="form-control" name="PengkajianKeperawatan_2[Anamnesis]" id="Anamnesis" required>{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['Anamnesis']) ? $dataPengkajian['PengkajianKeperawatan_2']['Anamnesis'] : '')}}</textarea>
                                            <div class="invalid-feedback">
                                                Data Anamnesis Harus Diisi.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="form-group h-100">
                                            <label for="pemeriksaanFisik">Pemeriksaan Fisik (O)</label>
                                            <textarea class="form-control" class="form-control" name="PengkajianKeperawatan_2[PemeriksaanFisik]" id="PemeriksaanFisik" required>{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['PemeriksaanFisik']) ? $dataPengkajian['PengkajianKeperawatan_2']['PemeriksaanFisik'] : '')}}</textarea>
                                            <div class="invalid-feedback">
                                                Data Pemeriksaan Fisik Harus Diisi.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="diagnosa">Diagnosa (A)</label>
                                        <input type="text" class="form-control" name="PengkajianKeperawatan_2[Diagnosa]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['Diagnosa']) ? $dataPengkajian['PengkajianKeperawatan_2']['Diagnosa'] : '')}}" required>
                                        <div class="invalid-feedback">
                                            Data Diagnosa Harus Diisi.
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="kodeICD">Kode ICD 10</label>
                                        <select class="custom-select" name="PengkajianKeperawatan_2[KodeICD10]" id="kodeICD">
                                            <option selected>-</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="komplikasi">Komplikasi</label>
                                        <input class="form-control" type="text" name="PengkajianKeperawatan_2[Komplikasi]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['Komplikasi']) ? $dataPengkajian['PengkajianKeperawatan_2']['Komplikasi'] : '')}}" required>
                                        <div class="invalid-feedback">
                                            Data Komplikasi Harus Diisi.
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="komorbid">Komorbid</label>
                                        <input type="text" class="form-control" name="PengkajianKeperawatan_2[Komorbid]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['Komorbid']) ? $dataPengkajian['PengkajianKeperawatan_2']['Komorbid'] : '')}}" required>
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
                                            <label for="rencanadanterapi">Rencana dan Terapi (P)</label>
                                            <textarea class="form-control" name="PengkajianKeperawatan_2[RencanaDanTerapi]" id="rencanadanterapi" required>{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['RencanaDanTerapi']) ? $dataPengkajian['PengkajianKeperawatan_2']['RencanaDanTerapi'] : '')}}</textarea>
                                            <div class="invalid-feedback">
                                                Data Rencana dan Terapi Harus Diisi.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="kodeICD">Kode ICD 9</label>
                                        <select class="custom-select" name="PengkajianKeperawatan_2[KodeICD9]" id="kodeICD">
                                            <option selected>-</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group h-100">
                                            <label for="edukasi">Edukasi</label>
                                            <textarea class="form-control" name="PengkajianKeperawatan_2[Edukasi]" id="edukasi" required>{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['Edukasi']) ? $dataPengkajian['PengkajianKeperawatan_2']['Edukasi'] : '')}}</textarea>
                                            <div class="invalid-feedback">
                                                Data Ediukasi Harus Diisi.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="penyakitmenular">Penyakit Menular</label>
                                        <input type="text" class="form-control" name="PengkajianKeperawatan_2[PenyakitMenular]" value="{{(!empty($dataPengkajian['PengkajianKeperawatan_2']['PenyakitMenular']) ? $dataPengkajian['PengkajianKeperawatan_2']['PenyakitMenular'] : '')}}" required>
                                        <div class="invalid-feedback">
                                            Data Penyakit Menular Harus Diisi.
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 pr-5">
                                        <label for="kesanstatusgizi" class="pb-3">Kesan Status Gizi</label>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="kurang" name="PengkajianKeperawatan_2[KesanStatusGizi]" value="kurang" {{(!empty($dataPengkajian['PengkajianKeperawatan_2']['KesanStatusGizi']) && $dataPengkajian['PengkajianKeperawatan_2']['KesanStatusGizi'] == 'kurang' ? 'checked' : '')}} required>
                                                <label for="kurang">Gizi Kurang/Buruk</label>
                                                <div class="invalid-feedback">
                                                    Data Kesan Status Gizi Harus Diisi.
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="cukup" name="PengkajianKeperawatan_2[KesanStatusGizi]" value="cukup" {{(!empty($dataPengkajian['PengkajianKeperawatan_2']['KesanStatusGizi']) && $dataPengkajian['PengkajianKeperawatan_2']['KesanStatusGizi'] == 'cukup' ? 'checked' : '')}} required>
                                                <label for="cukup">Gizi Cukup</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="lebih" name="PengkajianKeperawatan_2[KesanStatusGizi]" value="lebih" {{(!empty($dataPengkajian['PengkajianKeperawatan_2']['KesanStatusGizi']) && $dataPengkajian['PengkajianKeperawatan_2']['KesanStatusGizi'] == 'lebih' ? 'checked' : '')}} required>
                                                <label for="lebih">Gizi Lebih</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <a href="#" class="btn secondary">List dirujuk/konsul ke</a>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn green-long">Submit</button>
                                    </div>
                                </div>
                            </div>
    
                        </div>         
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script>
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
        </script>
@endsection
