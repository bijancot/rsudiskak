@extends('layouts.layout_dataTb')

@section('content')

    @include('includes.admin.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <h3>Dokumen Rekam Medis</h3>
            <div class="table-container soft-shadow mt-4">
                <div class="card">
                    <div class="card-title mt-3 ml-3">
                        <a data-toggle="modal" data-target="#modal_tambah" class="btn diagnosa">Tambah</a>
                    </div>
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
                            @foreach ($dataDokumen as $collections)
                                @foreach ($collections as $item)
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
                                            <a data-toggle="modal" data-target="#modal_hapus" data-nopendaftaran="{{$item['NoPendaftaran']}}" data-nocm="{{$item['NoCM']}}" class="btn batal hapus-data">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title text-white">Tambah Data </h5>
              <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="form-tambah" action="{{ action ('DokumenController@store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idForm" class="col-form-label">No Pendaftaran :</label>
                        <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control frm-input" id="noPendaftaran" name="NoPendaftaran">
                        <div class="noPendaftaran-isInvalid invalid-feedback">
                            No Pendaftaran Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaForm" class="col-form-label">No Rekam Medis :</label>
                        <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control frm-input" id="noRekamMedis" name="NoCM">
                        <div class="noRekamMedis-isInvalid invalid-feedback">
                            No Rekam Medis Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaForm" class="col-form-label">Nama Lengkap :</label>
                        <input type="text" class="form-control frm-input" id="namaLengkap" name="NamaLengkap">
                        <div class="namaLengkap-isInvalid invalid-feedback">
                            Nama Lengkap Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="KodeRuangan" class="col-form-label">Kode Ruangan :</label>
                        <select name="KodeRuangan" class="form-control">
                            @foreach ($kdRuangan as $item)
                                <option value="{{$item['KdRuangan']}}" selected>{{$item['KdRuangan']}} - {{$item['NamaRuangan']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namaForm" class="col-form-label">Tanggal Masuk :</label>
                        <input type="date" id="tglMasuk" name="TanggalMasuk" class="custom-select frm-tanggal">
                        <div class="tglMasuk-isInvalid invalid-feedback">
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
                        <div class="fileTambah-isInvalid invalid-feedback">
                            Upload File Harus Diisi.
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <div id="fileExtension-isInvalid" class="alert alert-danger mt-4" role="alert" style="display: none;">
                            Format file upload tidak sesuai
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="Status" id="" value="1">
                    <div id="btn_tambah_submit" class="btn btn-dark diagnosa">Simpan</div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}
    {{-- Modal Edit --}}
        {{-- <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Ubah Data '<span id="title-pendaftaran-edit"></span>'</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="form-ubah" action="{{ action ('DokumenController@update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="idForm" class="col-form-label">No Pendaftaran :</label>
                            <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control frm-input" id="noPendaftaran_edit" name="NoPendaftaran">
                            <div class="noPendaftaran_edit-isInvalid invalid-feedback">
                                No Pendaftaran Harus Diisi.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namaForm" class="col-form-label">No Rekam Medis :</label>
                            <input type="number" onkeypress="return onlyNumberKey(event)" class="form-control frm-input" id="noRekamMedis_edit" name="NoCM">
                            <div class="noRekamMedis_edit-isInvalid invalid-feedback">
                                No Rekam Medis Harus Diisi.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namaForm" class="col-form-label">Nama Lengkap :</label>
                            <input type="text" class="form-control frm-input" id="namaLengkap_edit" name="NamaLengkap">
                            <div class="namaLengkap_edit-isInvalid invalid-feedback">
                                Nama Lengkap Harus Diisi.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="KodeRuangan" class="col-form-label">Kode Ruangan :</label>
                            <select name="KodeRuangan" id="kodeRuangan_edit" class="form-control">
                                @foreach ($kdRuangan as $item)
                                    <option value="{{$item['KdRuangan']}}" selected>{{$item['KdRuangan']}} - {{$item['NamaRuangan']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="namaForm" class="col-form-label">Tanggal Masuk :</label>
                            <input type="date" id="tglMasuk_edit" name="TanggalMasuk" class="custom-select frm-tanggal">
                            <div class="tglMasuk_edit-isInvalid invalid-feedback">
                                Tanggal Masuk Harus Diisi.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namaFile" class="col-form-label">Nama File :</label>
                            <input type="text" name="NamaFile" class="form-control frm-input" id="namaFile_edit">
                        </div>
                        <div class="form-group">
                            <div class="namaFile_edit-isInvalid invalid-feedback">
                                Nama File Harus Diisi.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="noPendaftaranOld" name="NoPendaftaranOld">                        
                        <input type="hidden" id="noRekamMedisOld" name="NoCMOld">                        
                        <input type="hidden" id="namaFileOld" name="NamaFileOld">                        
                        <div id="btn_ubah_submit" class="btn btn-dark diagnosa">Simpan</div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
            </div>
        </div> --}}
    {{-- End Modal Edit --}}
    {{-- Modal Hapus --}}
        <div class="modal fade" id="modal_hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Hapus Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ action ( 'DokumenController@delete')}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Apa anda yakin ingin menghapus data <code id="title-pendaftaran-hapus"></code> ?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="NoPendaftaran" id="noPendaftaran_hapus">
                        <input type="hidden" name="NoCM" id="noRekamMedis_hapus">
                        <input type="hidden" name="NamaFile" id="namaFile_hapus">
                        <input type="hidden" name="TanggalMasuk" id="tanggalMasuk_hapus">
                        <button type="submit" class="btn btn-dark diagnosa">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
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
                $('.noPendaftaran-isInvalid').css('display', 'block');
            }
            
            if(noRekamMedis == ""){
                $('#noRekamMedis').addClass('isInValid')
                $('.noRekamMedis-isInvalid').css('display', 'block');
            }

            if(namaLengkap == ""){
                $('#namaLengkap').addClass('isInValid')
                $('.namaLengkap-isInvalid').css('display', 'block');
            }

            if(tglMasuk == ""){
                $('#tglMasuk').addClass('isInValid')
                $('.tglMasuk-isInvalid').css('display', 'block');
            }

            if(fileVal == ""){
                $('.fileTambah-isInvalid').css('display', 'block');
            }
            
            if(fileExtension != 'pdf'){
                $('#fileExtension-isInvalid').css('display', 'block');
            }else{
                $('#fileExtension-isInvalid').css('display', 'none');
                if(noPendaftaran != "" && noRekamMedis != "" && namaLengkap != "" && tglMasuk != "" && fileVal != ""){
                    $('#form-tambah').submit();
                }
            }

        })
        $('.frm-input').keyup(function(){
            let id = $(this).attr('id');
            if($(this).val() == ""){
                $(this).removeClass('isInValid')
                $(this).removeClass('isValid')
                $('.'+id+'-isInvalid').css('display', 'none')
            }else{
                $(this).removeClass('isInValid')
                $(this).addClass('isValid')
                $('.'+id+'-isInvalid').css('display', 'none')
            }
        })
        $('.frm-tanggal').change(function(){
            let id = $(this).attr('id')
            if($(this).val() == ""){
                $(this).removeClass('isInValid')
                $(this).removeClass('isValid')
                $('.'+id+'-isInvalid').css('display', 'none')
            }else{
                $(this).removeClass('isInValid')
                $(this).addClass('isValid')
                $('.'+id+'-isInvalid').css('display', 'none')
            }
        })
        $('#fileTambah').change(function(){
            if($(this).val() != ""){
                $('.fileTambah-isInvalid').css('display', 'none')
            }
        })
        function onlyNumberKey(evt) { 
          // Only ASCII charactar in that range allowed 
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
            return false; 
          return true; 
      }
      $('#tbl_dokumen tbody').on('click', '.ubah-data', function(){
        let noPendaftaran = $(this).data('nopendaftaran');
        let noCm = $(this).data('nocm');
        $('#title-pendaftaran-edit').html(noPendaftaran);
        // get data
        $.ajax({
                url: "{{url('/dokumen/getData')}}",
                method: 'post',
                data: {noPendaftaran: noPendaftaran, noCm : noCm, _token: '<?php echo csrf_token()?>'},
                success : function(res){
                    $('#noPendaftaran_edit').val(res.NoPendaftaran);
                    $('#noRekamMedis_edit').val(res.NoCM);
                    $('#namaLengkap_edit').val(res.NamaLengkap);
                    $('#kodeRuangan_edit').val(res.KodeRuangan);
                    $('#tglMasuk_edit').val(res.TanggalMasuk);
                    $('#namaFile_edit').val(res.NamaFile);
                    $('#noPendaftaranOld').val(res.NoPendaftaran);
                    $('#noRekamMedisOld').val(res.NoCM);
                    $('#namaFileOld').val(res.NamaFile);

                }
            })
      })
      $('#tbl_dokumen tbody').on('click', '.hapus-data', function(){
        let noPendaftaran = $(this).data('nopendaftaran');
        let noCm = $(this).data('nocm');
        $('#title-pendaftaran-hapus').html('No Pendaftaran '+noPendaftaran);

        $('#noPendaftaran_hapus').val(noPendaftaran);
        $('#noRekamMedis_hapus').val(noCm);
        // get data
        $.ajax({
                url: "{{url('/dokumen/getData')}}",
                method: 'post',
                data: {noPendaftaran: noPendaftaran, noCm : noCm, _token: '<?php echo csrf_token()?>'},
                success : function(res){
                    $('#namaFile_hapus').val(res.NamaFile);
                    $('#tanggalMasuk_hapus').val(res.TanggalMasuk);
                }
            })
      })
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
                    $('#pratinjauDokumen').attr('src', res.PathFile);
                    $('#pathFile_pratinjau').val(res.PathFile);
                }
            })
      })
      $("#btn_ubah_submit").click(function(){
        let noPendaftaran = $('#noPendaftaran_edit').val()
        let noRekamMedis = $('#noRekamMedis_edit').val()
        let namaLengkap = $('#namaLengkap_edit').val()
        let tglMasuk = $('#tglMasuk_edit').val()
        let namaFile = $('#namaFile_edit').val()

        if(noPendaftaran == ""){
            $('#noPendaftaran_edit').addClass('isInValid')
            $('.noPendaftaran_edit-isInvalid').css('display', 'block');
        }
        
        if(noRekamMedis == ""){
            $('#noRekamMedis_edit').addClass('isInValid')
            $('.noRekamMedis_edit-isInvalid').css('display', 'block');
        }

        if(namaLengkap == ""){
            $('#namaLengkap_edit').addClass('isInValid')
            $('.namaLengkap_edit-isInvalid').css('display', 'block');
        }

        if(tglMasuk == ""){
            $('#tglMasuk_edit').addClass('isInValid')
            $('.tglMasuk_edit-isInvalid').css('display', 'block');
        }

        if(namaFile == ""){
            $('#namaFile_edit').addClass('isInValid')
            $('.namaFile_edit-isInvalid').css('display', 'block');
        }

        if(noPendaftaran != "" && noRekamMedis != "" && namaLengkap != "" && tglMasuk != "" && namaFile != ""){
            $('#form-ubah').submit();
        }

        $('#modal_pratinjau').on('hide.bs.modal', function (e) {
            alert("masuk")
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