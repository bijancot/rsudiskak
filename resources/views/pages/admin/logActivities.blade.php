@extends('layouts.layout_dataTb')

@section('content')

    @include('includes.admin.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <div class="search-box-box">
                <div class="row">
                    <div class="col-lg-6 float-left">
                        <input id="cstm_search" type="text" placeholder="Cari" class="soft-shadow" style="width: 100%">
                    </div>
                    <span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9167 11.6667H12.2583L12.025 11.4417C12.8417 10.4917 13.3333 9.25833 13.3333 7.91667C13.3333 4.925 10.9083 2.5 7.91667 2.5C4.925 2.5 2.5 4.925 2.5 7.91667C2.5 10.9083 4.925 13.3333 7.91667 13.3333C9.25833 13.3333 10.4917 12.8417 11.4417 12.025L11.6667 12.2583V12.9167L15.8333 17.075L17.075 15.8333L12.9167 11.6667ZM7.91667 11.6667C5.84167 11.6667 4.16667 9.99167 4.16667 7.91667C4.16667 5.84167 5.84167 4.16667 7.91667 4.16667C9.99167 4.16667 11.6667 5.84167 11.6667 7.91667C11.6667 9.99167 9.99167 11.6667 7.91667 11.6667Z" fill="#C7D3CC"/></svg></span>
                    <div class="col-lg-6 float-right">
                        <form class="form form-inline" method="POST" action="{{ action('LoggingController@getDataByDate') }}">
                            @csrf
                            <div class="input-group date">
                                <input type="text" class="form-control datepicker" data-date-end-date="0d" name="tgl" value="{{ url()->current()==url('/logActivities/cari') ? $tgl : date('d F Y') }}">
                                <div class="input-group-append">
                                    {{-- <span class="fa fa-calendar"></span> --}}
                                </div>
                            </div>
                            &nbsp;
                            <button type="submit" class="capsule-btn capsule-right active" style="padding-top: 12px; padding-bottom: 12px;" >Submit</button>
                        </form>
                    </div>                        
                </div>
            </div>
            <div class="table-container soft-shadow">
                <div class="card">
                    <div class="card-body">
                    <table id="tbl_loggings" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal-Waktu</th>
                                <th>Id User</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Halaman</th>
                                <th>Metode</th>
                                <th>NoCM</th>
                                <th>Kode Ruangan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listLog as $item)
                            @php
                                $role = "";
                                    // set style status periksa
                                if($item['role'] == "1"){
                                    $role = "Dokter";
                                }else if($item['role'] == "2"){
                                    $role = "Perawat";
                                }else if($item['role'] == "3"){
                                    $role = "Admin Poli";
                                }

                                $keterangan = "";
                                if($item['fitur'] == "Login" && $item['metode'] == "LoginDokter" || $item['metode'] == "LoginPerawat"){
                                    $keterangan = $item['keterangan'];
                                }
                                else if($item['fitur'] == "Logout" && $item['metode'] == "Logout"){
                                    $keterangan = $item['keterangan'];
                                }
                                else if($item['fitur'] == "PilihDokter"){
                                    $keterangan = $item['keterangan']['IdDokter'] ." - ". $item['keterangan']['NamaDokter'] ;
                                }
                                else if($item['fitur'] == "BatalMasukPoli" && $item['metode'] == "batal"){
                                    $keterangan = $item['keterangan'];
                                }
                                else if($item['fitur'] == "BatalPeriksa"){
                                    $keterangan = "No Pendaftaran : " . $item['keterangan']['no_pendaftaran'] ." - ". $item['keterangan']['keterangan'] ;
                                }
                                else if($item['fitur'] == "PilihForm" && $item['metode'] == "create"){
                                    $keterangan = $item['keterangan'];
                                }
                                else if($item['fitur'] == "PilihForm" && $item['metode'] == "batal"){
                                    $keterangan = $item['keterangan']." Batal pilih form";
                                }
                                else if($item['fitur'] == "DataPengkajian" && $item['metode'] == "create"){
                                    $keterangan = $item['keterangan'];
                                }
                                
                                $date = date_create($item['created_at']);
                            @endphp
                                <tr>
                                    <td data-label="Tanggal-Waktu">{{ date_format($date,"d/m/Y - H:i:s")}}</td>
                                    <td data-label="IdUser">{{ $item['id_user'] }}</td>
                                    <td data-label="User">{{ $item['nama_user'] }}</td>
                                    <td data-label="Role">{{ $role }}</td>
                                    <td data-label="Halaman">{{ $item['fitur'] }}</td>
                                    <td data-label="Metode">{{ $item['metode'] }}</td>
                                    <td data-label="NoCM">{{ $item['NoCM'] }}</td>
                                    <td data-label="KodeRuangan" width="5%">{{ $item['KdRuangan'] }}</td>
                                    <td data-label="Keterangan" width="20%">
                                        {{-- Deprecated --}}
                                        {{-- @if ($item['fitur'] == "DataPengkajian" && $item['metode'] == "update")
                                            @php    
                                                $ketOld = array();
                                                foreach ($item['keterangan']['old'] as $keyOld => $valueOld) {    
                                                    array_push($ketOld, $keyOld . " : ". $valueOld);
                                                }
                                                // dump($ketOld);
                                                foreach (array_combine($ketOld, $item['keterangan']['current']) as $old => $new) {
                                                    echo $old . 
                                                    " <i class='fas fa-arrow-right'></i> "
                                                    .$new . "<br>";
                                                }
                                            @endphp    
                                        @else
                                            {{ $keterangan }}
                                        @endif --}}

                                        @if (($item['fitur'] == "FormPengkajian" && $item['metode'] == "update" || $item['metode'] == "final"))
                                            @php 
                                                $keterangan = $item['keterangan'];
                                            @endphp
                                            {{-- @dump($keterangan) --}}
                                            
                                            @if (array_key_exists('old',$keterangan) || array_key_exists('current',$keterangan))
                                                
                                                
                                                @if ((array_key_exists('PengkajianKeperawatan',$keterangan['old'])) || (array_key_exists('PengkajianMedis',$keterangan['old'])) )
                                                    @php
                                                        $ketOldKeperawatan = array();
                                                        foreach ($item['keterangan']['old']['PengkajianKeperawatan'] as $keyOldK => $valueOldK) {    
                                                            array_push($ketOldKeperawatan, $keyOldK . " : ". $valueOldK);
                                                        }
                                                        $ketOldMedis = array();
                                                        foreach ($item['keterangan']['old']['PengkajianMedis'] as $keyOldM => $valueOldM) {    
                                                            array_push($ketOldMedis, $keyOldM . " : ". $valueOldM);
                                                        }
                                                        foreach (array_combine($ketOldKeperawatan, $item['keterangan']['current']['PengkajianKeperawatan']) as $oldK => $newK) {
                                                            echo $oldK . 
                                                            " <i class='fas fa-arrow-right'></i> "
                                                            .$newK . "<br>";
                                                        }
                                                        foreach (array_combine($ketOldMedis, $item['keterangan']['current']['PengkajianMedis']) as $oldM => $newM) {
                                                            echo $oldM . 
                                                            " <i class='fas fa-arrow-right'></i> "
                                                            .$newM . "<br>";
                                                        }
                                                    @endphp

                                                @else
                                                    @php    
                                                    // dump($item['keterangan']['old']);
                                                        $ketOld = array();
                                                        if(array_key_exists('no_change',$item['keterangan']['old']) && array_key_exists('no_change',$item['keterangan']['current'])) {
                                                            echo "Tidak ada Perubahan";
                                                        } else {

                                                            foreach ($item['keterangan']['old'] as $keyOld => $valueOld) {    
                                                                array_push($ketOld, $keyOld . " : ". $valueOld);
                                                            }
                                                            // dump($ketOld);
                                                            foreach (array_combine($ketOld, $item['keterangan']['current']) as $old => $new) {
                                                                
                                                                echo $old . " <i class='fas fa-arrow-right'></i> " .$new . "<br>";

                                                            }
                                                        }
                                                    @endphp
                                                @endif

                                            @endif

                                            
                                        @else
                                        {{-- @dump($keterangan) --}}
                                            {{ $keterangan }}
                                        @endif 
                                    
                                    </td>
                                </tr>

                            @endforeach
                            
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#tbl_loggings').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup', function () {
                table.search( this.value ).draw();
            });
            $('#tbl_loggings_filter').hide();
           
        });

        $('.datepicker').datepicker({
            today: "Today",
            format: "d MM yyyy",
            todayHighlight: true,
            clearBtn: true,
            language: 'id'
        });

        // function handler(e){
        //     var date = e.target.value;
        //     var table = $('#tbl_loggings').DataTable();
        //     $("#tbl_loggings").dataTable().fnDestroy()
        //     $("tbody").empty();
        //     //var date = $('#date').val()
        //     $.ajax({
        //         url: "{{ url('/logActivities/getDataByDate') }}",
        //         method: 'post',
        //         data: {date: date, _token: '<?php echo csrf_token()?>'},
        //         success : function(data){
        //             console.log("success");
        //             console.log(data);
        //             $('#table1').html(data.html);
        //             $('#cstm_search').on("keyup search input paste cut", function () {
        //                 $('#tbl_loggings').DataTable().rows('.odd').search(this.value).draw();
        //                 //$('#tbl_loggings').hasClass('odd').draw();
        //             });
        //             $("#tbl_loggings").dataTable();
        //             $('#tbl_loggings_filter').hide();
        //         },
        //         error: function (request, status, error) {
        //             console.log("error");
        //             console.log(request.responseText);
        //             //alert("error");
        //             //alert(request.responseText);
        //         }
        //     })
        // }
    </script>
@endsection