@extends('layouts.layout')

@section('content')

    @include('includes.admin.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <div class="search-box-box">
                <form class="form form-inline">
                    <input id="cstm_search" type="search" placeholder="Cari Nama Pasien" class="soft-shadow">
                    <span><svg style="margin-top:-20px;" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9167 11.6667H12.2583L12.025 11.4417C12.8417 10.4917 13.3333 9.25833 13.3333 7.91667C13.3333 4.925 10.9083 2.5 7.91667 2.5C4.925 2.5 2.5 4.925 2.5 7.91667C2.5 10.9083 4.925 13.3333 7.91667 13.3333C9.25833 13.3333 10.4917 12.8417 11.4417 12.025L11.6667 12.2583V12.9167L15.8333 17.075L17.075 15.8333L12.9167 11.6667ZM7.91667 11.6667C5.84167 11.6667 4.16667 9.99167 4.16667 7.91667C4.16667 5.84167 5.84167 4.16667 7.91667 4.16667C9.99167 4.16667 11.6667 5.84167 11.6667 7.91667C11.6667 9.99167 9.99167 11.6667 7.91667 11.6667Z" fill="#C7D3CC"/></svg></span>
                    
                    @csrf
                    &nbsp;
                <input type="date" id="date" value="{{ date('Y-m-d') }}" onchange="handler(event);" class="form-control">&nbsp;
                    <!-- <input type="button" id="submit"  class="form-control btn btn-primary" value="Filter"> -->
                </form>
                </div>
            <div class="table-container soft-shadow">
                <table id="tbl_Riwayat" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No Pendaftaran</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Masuk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table1">
                        @foreach ($listRiwayat as $item)
                            <tr>
                                <td>{{ $item['NoPendaftaran'] }}</td>
                                <td>{{ $item['NoCM'] }}</td>
                                <td>{{ $item['NamaLengkap'] }}</td>
                                <td>{{ $item['TglMasukPoli'] }}</td>
                                <td data-label="Action" class="d-flex flex-row p-lg-1">
                                    <a href="{{url('lihatFormPengkajian/'.$item['IdFormPengkajian'].'/'.$item['NoCM'].'/'.$item['NoPendaftaran'].'/'.$item['TglMasukPoli'])}}" class="btn btn-primary"><i class="fas fa-eye"></i> Lihat Form</a>
                                    <a href="{{url('printRiwayat/'.$item['IdFormPengkajian'].'/'.$item['NoCM'].'/'.$item['NoPendaftaran'].'/'.$item['TglMasukPoli'])}}" target='_blank' class="btn diagnosa"><i class="fas fa-print"></i> Print</a>
                                    <a href="#" data-toggle="modal" data-target="#modal_hapus" data-nopendaftaran="{{$item['NoPendaftaran']}}" data-nocm="{{$item['NoCM']}}" data-tanggal="{{$item['TglMasukPoli']}}" class="btn hapus-data batal">Batal Verifikasi</a>
                                    
                                    <!-- <a href="profilRingkas/{{ $item['NoPendaftaran'] }}" target="_blank" class="btn diagnosa ml-auto">Profil Ringkas</a> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Batal Verifikasi '<span class="title-id"></span>'</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ action('RiwayatController@batalVerifikasi')}}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <p style="text-align:center;margin:20px;">Apakah anda yakin untuk membatalkan verifikasi '<span class="title-id"></span>'</p>
                <div class="modal-footer">
                    <input type="hidden" name="NoPendaftaran" id="NoPendaftaran">
                    <input type="hidden" name="NoCM" id="NoCM">
                    <input type="hidden" name="TglMasukPoli" id="TglMasukPoli">

                    <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
            </div>
        </div> 
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#tbl_Riwayat').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup search input paste cut', function () {
                table.search(this.value).draw();
            });
            $('#tbl_Riwayat_filter').hide();
            $('#tbl_Riwayat tbody').on('click', '.hapus-data', function(){
                let NoCM = $(this).data('nocm');
                let NoPendaftaran = $(this).data('nopendaftaran');
                let TglMasukPoli = $(this).data('tanggal');
                $('.title-id').html(NoCM);
                $('#NoPendaftaran').val(NoPendaftaran);
                $('#NoCM').val(NoCM);
                $('#TglMasukPoli').val(TglMasukPoli);
            })
        });
        
    </script>
    <script>
    function handler(e){
        var date = e.target.value;
        var table = $('#tbl_Riwayat').DataTable();
        $("#tbl_Riwayat").dataTable().fnDestroy()
        $("tbody").empty();
        //var date = $('#date').val()
        $.ajax({
            url: "{{url('/riwayatPasien/getData')}}",
            method: 'post',
            data: {date: date, _token: '<?php echo csrf_token()?>'},
            success : function(data){
                $('#table1').html(data.html);
                $('#cstm_search').on("keyup search input paste cut", function () {
                    $('#tbl_Riwayat').DataTable().rows('.odd').search(this.value).draw();
                    //$('#tbl_listPasienKirimPoli').hasClass('odd').draw();
                });
                $("#tbl_Riwayat").dataTable();
                $('#tbl_Riwayat_filter').hide();
            },
            error: function (request, status, error) {
                //alert("error");
                //alert(request.responseText);
            }
        })
    }
        
    </script>
@endsection