@extends('layouts.layout')

@section('content')

@include('includes.navbar')


    <div class="loader-container">
        <div class="loader"></div>
    </div>

    @if (session('status'))

    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
                <!-- Position it -->
                <div style="position: absolute; top: 0; right: 0;">
        @if (session('status') != 'success')
            
            
                <!-- Then put toasts within -->
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong class="mr-auto">Data Gagal ditambahkan</strong>
                        <small>{{ date('H:i a') }}</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ session('status') }}
                    </div>
                    </div>
                </div>
        @endif
    @endif

    <div class="bg-greenishwhite">
        <div class="wrapper">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="search-box-box">
                        <input id="cstm_search" style="width: 100%;" type="text" placeholder="Cari Nama Pasien" class="soft-shadow">
                        <span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9167 11.6667H12.2583L12.025 11.4417C12.8417 10.4917 13.3333 9.25833 13.3333 7.91667C13.3333 4.925 10.9083 2.5 7.91667 2.5C4.925 2.5 2.5 4.925 2.5 7.91667C2.5 10.9083 4.925 13.3333 7.91667 13.3333C9.25833 13.3333 10.4917 12.8417 11.4417 12.025L11.6667 12.2583V12.9167L15.8333 17.075L17.075 15.8333L12.9167 11.6667ZM7.91667 11.6667C5.84167 11.6667 4.16667 9.99167 4.16667 7.91667C4.16667 5.84167 5.84167 4.16667 7.91667 4.16667C9.99167 4.16667 11.6667 5.84167 11.6667 7.91667C11.6667 9.99167 9.99167 11.6667 7.91667 11.6667Z" fill="#C7D3CC"/></svg></span>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mt-4 mt-lg-0">
                    @if ($role == "2")
                        @include('includes.tabPeriksa')
                    @endif
                </div>
            </div>
            
            <div class="table-container soft-shadow">
                <div id="antrianPoli">
                    <table id="tbl_antrianPoli" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Urutan</th>
                                <th>No Pendaftaran</th>
                                <th>No Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Masuk</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas['data'] as $data)
                            @php
                                // set style status periksa
                                if($data['Status Periksa'] == "Menunggu"){
                                    $status = "yellow";
                                }else if($data['Status Periksa'] == "Diperiksa"){
                                    $status = "blue"; 
                                }else if($data['Status Periksa'] == "Selesai"){
                                    $status = "lime";
                                }else if($data['Status Periksa'] == "Belum"){
                                    $status = "orange";
                                }
                                // set detail JK
                                $jenkel = ($data['JK'] == "L" ? "Laki - Laki" : "Perempuan");
                            @endphp
                            <tr>
                                <td data-label="Urutan">{{$data['No. Urut']}}</td>
                                <td data-label="No Pendaftaran">{{$data['NoPendaftaran']}}</td>
                                <td data-label="No Rekam Medis">{{$data['NoCM']}}</td>
                                <td data-label="Nama Pasien">{{$data['Nama Pasien']}}</td>
                                <td data-label="Umur">{{$data['UmurTahun']}} Th</td>
                                <td data-label="Jenis Kelamin">{{$jenkel}}</td>
                                @php
                                    $date = date_create($data['TglMasuk']);
                                @endphp
                                <td data-label="Tanggal Masuk">{{ date_format($date,"d/m/Y")}}</td>
                                <td data-label="Action" class="d-flex flex-row p-lg-1">
                                    {{-- <a href="{{ action ('DiagnosaController@pilihDokter', $data['NoCM']) }}" class="btn diagnosa ml-auto">Pilih Dokter</a> --}}
                                    <a data-toggle="modal" data-target="#modal_pilih_dokter-{{ $data['NoCM'] }}" class="btn diagnosa ml-auto">Pilih Dokter</a>
                                    <a data-toggle="modal" data-target="#modal_batal_periksa-{{ $data['NoPendaftaran'] }}" class="btn batal">Batal Periksa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="masukPoli">
                    <table id="tbl_masukPoli" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>No Rekam Medis</th>
                                <th>Dok. Pemeriksa</th>
                                <th>Nama Pasien</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Masuk</th>
                                <th>Keterangan</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masukPoli as $poli)
                            @php
                                $StatusPengkajian = "";
                                // set style status periksa
                                if($poli['StatusPengkajian'] == "0"){
                                    $StatusPengkajian = "Belum";
                                    $status = "orange";
                                }else if($poli['StatusPengkajian'] == "1"){
                                    $StatusPengkajian = "Periksa";
                                    $status = "yellow";
                                }else if($poli['StatusPengkajian'] == "2"){
                                    $StatusPengkajian = "Selesai";
                                    $status = "blue";
                                }
                                // set detail JK
                                $jenkel = ($poli['JenisKelamin'] == "L" ? "Laki - Laki" : "Perempuan");
                            @endphp
                                @if ($role == "1" && $poli['StatusPengkajian'] != "")
                                <tr>
                                    <td data-label="No Pendaftaran">{{ $poli['NoPendaftaran'] }}</td>
                                    <td data-label="No Rekam Medis">{{ $poli['NoCM'] }}</td>
                                    <td data-label="Dok. Pemeriksa">{{ $poli['NamaDokter'] }}</td>
                                    <td data-label="Nama Pasien">{{ $poli['NamaLengkap'] }}</td>
                                    <td data-label="Umur">{{ $poli['UmurTahun'] }} Th</td>
                                    <td data-label="Jenis Kelamin">{{ $jenkel }}</td>
                                    @php
                                        $date = date_create($poli['TglMasuk']);
                                    @endphp
                                    <td data-label="Tanggal Masuk">{{ date_format($date,"d/m/Y")}}</td>
                                    <td data-label="Keterangan">
                                        <span class="ml-auto label-keterangan {{ $status }}">{{ $StatusPengkajian }}</span>
                                    </td>
                                    <td data-label="Action" class="d-flex flex-row p-lg-1">
                                        @if ($poli['StatusPengkajian'] == 0)
                                            {{-- <a href="{{url('pilihForm/'.$poli['NoCM'].'/'.$poli['NoPendaftaran'])}}" class="btn diagnosa">Pilih Form Pengkajian</a> --}}
                                            <a data-toggle="modal" data-target="#modal_pilih_form-{{ $poli['NoCM'] }}-{{ $poli['NoPendaftaran'] }}" class="btn diagnosa">Pilih Form Pengkajian</a>
                                        @else
                                            <a href="{{url('formPengkajian/'.$poli['IdFormPengkajian'].'/'.$poli['NoCM'].'/'.$poli['NoPendaftaran'].'/'.$poli['TglMasukPoli'])}}" class="btn diagnosa">Isi Form</a>
                                            <a href="{{url('pilihForm/'.$poli['NoCM'])}}" data-toggle="modal" data-pendaftaran="{{$poli['NoPendaftaran']}}" data-nocm="{{$poli['NoCM']}}" data-target="#modal_batal_form" class="btn batal batalForm">Batal Form</a>
                                        @endif
                                        <a data-toggle="modal" data-target="#modal_batal_masukPoli-{{ $poli['NoCM'] }}-{{ $poli['NoPendaftaran'] }}" class="btn btn-secondary">Batal Masuk Poli</a>
                                    </td>
                                </tr>
                                @elseif($role == "2" && $poli['StatusPengkajian'] != "")
                                    <tr>
                                        <td data-label="No Pendaftaran">{{ $poli['NoPendaftaran'] }}</td>
                                        <td data-label="No Rekam Medis">{{ $poli['NoCM'] }}</td>
                                        <td data-label="Dok. Pemeriksa">{{ $poli['NamaDokter'] }}</td>
                                        <td data-label="Nama Pasien">{{ $poli['NamaLengkap'] }}</td>
                                        <td data-label="Umur">{{ $poli['UmurTahun'] }} Th</td>
                                        <td data-label="Jenis Kelamin">{{ $jenkel }}</td>
                                        @php
                                            $date = date_create($poli['TglMasuk']);
                                        @endphp
                                        <td data-label="Tanggal Masuk">{{ date_format($date,"d/m/Y")}}</td>
                                        <td data-label="Keterangan">
                                            <span class="ml-auto label-keterangan {{ $status }}">{{ $StatusPengkajian }}</span>
                                        </td>
                                        <td data-label="Action" class="d-flex flex-row p-lg-1">
                                            @if ($poli['StatusPengkajian'] == 0)
                                                {{-- <a href="{{url('pilihForm/'.$poli['NoCM'].'/'.$poli['NoPendaftaran'])}}" class="btn diagnosa">Pilih Form Pengkajian</a> --}}
                                                <a data-toggle="modal" data-target="#modal_pilih_form-{{ $poli['NoCM'] }}-{{ $poli['NoPendaftaran'] }}" class="btn diagnosa">Pilih Form Pengkajian</a>
                                            @else
                                                <a href="{{url('formPengkajian/'.$poli['IdFormPengkajian'].'/'.$poli['NoCM'].'/'.$poli['NoPendaftaran'].'/'.$poli['TglMasukPoli'])}}" class="btn diagnosa">Isi Form</a>
                                                <a href="{{url('pilihForm/'.$poli['NoCM'])}}" data-toggle="modal" data-pendaftaran="{{$poli['NoPendaftaran']}}" data-nocm="{{$poli['NoCM']}}" data-target="#modal_batal_form" class="btn batal batalForm">Batal Form</a>
                                            @endif
                                            <a data-toggle="modal" data-target="#modal_batal_masukPoli-{{ $poli['NoCM'] }}-{{ $poli['NoPendaftaran'] }}" class="btn btn-secondary">Batal Masuk Poli</a>
                                        </td>
                                    </tr>
                                
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($datas['data'] as $data)
    <!-- modal pilih dokter -->
    <div class="modal fade modal_pilih_dokter-{{ $data['NoCM'] }}" id="modal_pilih_dokter-{{ $data['NoCM'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white text-center">Pilih Dokter <span class="badge badge-info">{{ $data['NoCM'] }}</span></h5>
                </div>
                <form method="POST" class="myform-{{ $data['NoCM'] }}" action="{{ action('DiagnosaController@storePilihDokter', [$data['NoCM'], $data['NoPendaftaran']]) }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="dokter" class="form-control{{ $errors->has('Error') ? ' is-invalid' : '' }} pilihDokter " id="dokter" title="Pilih salah satu..." data-live-search="true" required>
                                {{-- @foreach ($listDokter['data'] as $item)
                                    <option value="{{ $item['IdDokter'] }}"> {{ $item['NamaLengkap'] }} </option>
                                @endforeach --}}
                                @foreach ($listDokter as $item)
                                    <option value="{{ $item['ID'] }}"> {{ $item['Nama'] }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Dokter harus diisi
                            </div>
                            <input type="hidden" name="no_cm" value="{{ $data['NoCM'] }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class=" btn btn-dark diagnosa">Ya</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of modal pilih dokter -->
    <!--<script>
        $('.modal_pilih_dokter-{{ $data['NoCM'] }}').on("click", ".add_dokter", function() {
            $.ajax({
                    url 	        : "{{ action('DiagnosaController@storePilihDokter', [$data['NoCM'], $data['NoPendaftaran']]) }}",
                    type            : "POST",
                    dataType        : 'json',
                    encode          : true,
                    data            : $('.myform-{{ $data['NoCM'] }}').serialize(),
                    success: function(data) {
                            $('.modal_pilih_dokter-{{ $data['NoCM'] }}').modal('toggle');
                            $("#nav_masukPoli").addClass('active');$("#nav_antrianPoli").removeClass('active');
                            $('#antrianPoli').hide();
                            $('#masukPoli').show();
                    }
                });
        });
    </script>-->
    <!-- modal batal periksa -->
    <div class="modal fade" id="modal_batal_periksa-{{ $data['NoPendaftaran'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white text-center">Batal Periksa NoCM: <span class="badge badge-info">{{ $data['NoCM'] }}</span> </h5>
                </div>
                <form action="{{ action ('PasienController@storeBatalPeriksa', [$data['NoCM'], $data['NoPendaftaran']])}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Keterangan :</label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
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
    <!-- end of modal batal periksa -->
    @endforeach

    @foreach ($masukPoli as $poli)
     <!-- modal pilih form -->
     <div class="modal fade" id="modal_pilih_form-{{ $poli['NoCM'] }}-{{ $poli['NoPendaftaran'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white text-center">Pilih Form NoCM: {{ $poli['NoCM'] }}</h5>
                </div>
                <form method="POST" action="{{action('FormPengkajianController@storePilihForm', [$poli['NoCM'], $poli['NoPendaftaran']])}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <select name="formPengkajian" class="form-control{{ $errors->has('Error') ? ' is-invalid' : '' }} pilihForm" id="formPengkajian" title="Pilih salah satu..." data-live-search="true" required>
                                @foreach ($listForm as $item)
                                    <option value="{{ $item['idForm'] }}"> {{ $item['namaForm'] }} </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Form harus diisi
                            </div>
                            <input type="hidden" name="TglMasukPoli" value="{{ $poli['TglMasukPoli'] }}">
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
    <!-- end of modal pilih Form -->

    <!-- modal batal masuk poli -->
    <div class="modal fade" id="modal_batal_masukPoli-{{ $poli['NoCM'] }}-{{ $poli['NoPendaftaran'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white text-center">Batal Masuk Poli</h5>
                </div>
                <form method="POST" action="{{action('DiagnosaController@storeBatalMasukPoli', [$poli['NoCM'], $poli['NoPendaftaran']])}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Apa anda yakin ingin membatalkan masuk poli NoCM : <code>{{ $poli['NoCM'] }}</code> ?</label>
                            <input type="hidden" name="TglMasukPoli" id="TglMasukPoli" value="{{ $poli['TglMasukPoli'] }}">
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
    <!-- end of modal batal masuk poli -->
    
    {{-- modal batal form --}}
    <div class="modal fade" id="modal_batal_form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white text-center">Batal Form '<span id="mdl_title_pendaftaran"></span>' </h5>
                </div>
                <form action="{{ action ('FormPengkajianController@storeBatalForm', $poli['NoPendaftaran'])}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <p style="text-align: center;">Apakah anda yakin batal pilih form ? </p>
                            <input type="hidden" name="NoCM" id="mdl_NoCM">
                            <input type="hidden" name="NoPendaftaran" id="mdl_Pendaftaran">
                            <input type="hidden" name="TglMasukPoli" id="TglMasukPoli" value="{{ $poli['TglMasukPoli'] }}">
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
    @endforeach

    <script>

        // var overlay = document.getElementById("overlay");
        // window.addEventListener('load', function () {
        //     overlay.style.display = 'none';
        // })

        $(window).on("load", function () {
            $(".loader-container").fadeOut(3000);
        })

        $(document).ready(function() {

            $('#loading').detach();
            $('#tbl_antrianPoli').DataTable();
            $('#tbl_masukPoli').DataTable();
            $('#tbl_antrianPoli_filter').hide();
            $('#tbl_masukPoli_filter').hide();
            //Js Check isDokter / isPerawat
            @if ($role == "1")
                $('#antrianPoli').hide();
                var table = $('#tbl_masukPoli').DataTable();
            @else
                $('#masukPoli').hide();
                var table = $('#tbl_antrianPoli').DataTable();
            @endif
            FilterSearch(table);

            $('.pilihDokter').selectpicker();
            $('.pilihForm').selectpicker();

            @if (session('status'))

            @if (session('status') == 'success')
                $("#nav_masukPoli").addClass('active');$("#nav_antrianPoli").removeClass('active');
                            $('#antrianPoli').hide();
                            $('#masukPoli').show();
                            
                    $.toast({
                        title: 'Sukses!',
                        subtitle: '3 detik yang lalu',
                        content: 'Berhasil Menambahkan Pasien Masuk Poli.',
                        type: 'info',
                        delay: 3000,
                    });
                @endif
            @endif
            
            @if(session('statusBatalMasukPoli'))
                @if(session('statusBatalMasukPoli') == 'success')
                    $.toast({
                        title: 'Sukses!',
                        subtitle: '3 detik yang lalu',
                        content: 'Berhasil Membatalkan Pasien Masuk Poli.',
                        type: 'info',
                        delay: 3000,
                    });
                @endif
            @endif

        });
            $("#nav_antrianPoli").click(function(){
                $(this).addClass('active');
                $('#nav_masukPoli').removeClass('active');
                $('#antrianPoli').show();
                $('#masukPoli').hide();
                var table = $('#tbl_antrianPoli').DataTable();
                FilterSearch(table);
            })
            $("#nav_masukPoli").click(function(){
                $(this).addClass('active');
                $('#nav_antrianPoli').removeClass('active');
                $('#antrianPoli').hide();
                $('#masukPoli').show();
                var table = $('#tbl_masukPoli').DataTable();
                FilterSearch(table);
            })
            function FilterSearch(table){
                $('#cstm_search').on( 'keyup', function () {
                    table.search( this.value ).draw();
                });
            }
            $('#tbl_masukPoli tbody').on('click', '.batalForm', function(){
                let noCm = $(this).data('nocm');
                let noPendaftaran = $(this).data('pendaftaran');
                
                $('#mdl_Pendaftaran').val(noPendaftaran);
                $('#mdl_NoCM').val(noCm);
                $('#mdl_title_pendaftaran').html(noCm);

            })

            
            
    </script>
@endsection
