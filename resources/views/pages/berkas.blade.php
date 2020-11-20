@extends('layouts.layout_dataTb')

@section('content')

    @include('includes.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <h3>Dokumen RM {{$no_cm}}</h3>
            <div class="table-container soft-shadow mt-4">
                <div class="card">
                    {{-- <div class="card-title mt-3 ml-3">
                        <a data-toggle="modal" data-target="#modal_tambah" class="btn diagnosa">Tambah</a>
                    </div> --}}
                    <div class="card-body">
                    <table id="tbl_dokumen" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No Pendaftaran</th>
                                <th>No Rekam Medis</th>
                                <th>Nama Pasien</th>
                                <th>Ruangan</th>
                                <th>Tanggal Masuk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataDokumen as $item)
                                @php
                                    $date = date_create($item['TanggalMasuk']);
                                @endphp
                                <tr>
                                    <td data-label="No Pendaftaran">{{ $item['NoPendaftaran'] }}</td>
                                    <td data-label="No Rekam Medis">{{ $item['NoCM'] }}</td>
                                    <td data-label="Nama Pasien">{{ $item['NamaLengkap'] }}</td>
                                    <td data-label="Nama Ruangan">{{ $item['NamaRuangan'] }}</td>
                                    <td data-label="Nama Ruangan">{{ date_format($date, 'd/m/Y') }}</td>
                                    <td data-label="Action" class="p-lg-1">
                                        {{-- <a data-toggle="modal" data-target="#modal_edit" data-nopendaftaran="{{$item['NoPendaftaran']}}" data-nocm="{{$item['NoCM']}}" class="btn btn-primary ubah-data">Ubah</a> --}}
                                        <a data-toggle="modal" data-target="#modal_pratinjau" data-nopendaftaran="{{$item['NoPendaftaran']}}" data-nocm="{{$item['NoCM']}}" class="btn btn-secondary pratinjau-data">Pratinjau</a>
                                        <a data-nopendaftaran="{{$item['NoPendaftaran']}}" data-nocm="{{$item['NoCM']}}" class="btn btn-primary btn-unduh">Unduh</a>
                                        {{-- <a data-toggle="modal" data-target="#modal_hapus" data-nopendaftaran="{{$item['NoPendaftaran']}}" data-nocm="{{$item['NoCM']}}" class="btn batal hapus-data">Hapus</a> --}}
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
    {{-- End Modal Hapus --}}
    {{-- Modal Pratinjau --}}
        <div class="modal fade" id="modal_pratinjau" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Pratinjau Data '<span id="title-pratinjau"></span>' </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <iframe id="pratinjauDokumen" src="" frameborder="0" width="100%" height="500px"></iframe>
                    </div>
                </div>
                <form id="form-unduh" action="{{action('DokumenController@download')}}" method="POST">
                    @csrf
                    <div class="modal-footer">
                        <input type="hidden" name="PathFile" id="pathFile_pratinjau">
                        <button class="btn btn-dark diagnosa">Unduh</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    {{-- End Modal Pratinjau --}}
    <script>
        $(document).ready(function() {
            var table = $('#tbl_dokumen').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup', function () {
                table.search( this.value ).draw();
            });
            $('#tbl_filter').show();
        });
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
    </script>
@endsection