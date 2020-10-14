@extends('layouts.layout')

@section('content')

@include('includes.navbar')
    
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
                    @include('includes.tabPeriksa')
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
                                <th>Keterangan</th>
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
                                <td data-label="Tanggal Masuk">{{$data['TglMasuk']}}</td>
                                <td data-label="Keterangan"><span class="label-keterangan ml-auto {{$status}}">{{$data['Status Periksa']}}</span></td>
                                <td data-label="Action" class="p-lg-1"><div class="d-flex flex-row"><a href="{{ action ('DiagnosaController@pilihDokter', $data['NoCM'])}}" class="btn diagnosa ml-auto">Dokter</a><a href="#" class="btn batal">Batal</a></div></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="masukPoli">
                    <table id="tbl_masukPoli" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Urutan</th>
                                <th>No Pendaftaran</th>
                                <th>No Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th>Umur</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Masuk</th>
                                <th>Keterangan</th>
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
                                <td data-label="Tanggal Masuk">{{$data['TglMasuk']}}</td>
                                <td data-label="Keterangan"><span class="label-keterangan {{$status}}">{{$data['Status Periksa']}}</span></td>
                                <td data-label="Action" class="d-flex flex-row p-lg-1"><a href="{{action('PasienController@DataPasien', $data['NoCM'])}}" class="btn diagnosa ml-auto">Diagnosa</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#tbl_antrianPoli').DataTable();
            $('#tbl_masukPoli').DataTable();
            $('#tbl_antrianPoli_filter').hide();
            $('#tbl_masukPoli_filter').hide();
            $('#masukPoli').hide();
            var table = $('#tbl_antrianPoli').DataTable();
            FilterSearch(table);
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
    </script>
@endsection
