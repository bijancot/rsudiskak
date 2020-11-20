@extends('layouts.layout_dataTb')

@section('content')

    @include('includes.admin.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <h3>Manajemen Form</h3>
            <div class="table-container soft-shadow mt-4">
                <div class="card">
                    <div class="card-title mt-3 ml-3">
                        <a data-toggle="modal" data-target="#modal_tambah" class="btn diagnosa">Tambah</a>
                    </div>
                    <div class="card-body">
                    <table id="tbl" class="table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Form</th>
                                <th>Nama Form</th>
                                <th>Nama File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($manajemenForm as $item)
                            <tr>
                                <td data-label="No">{{ $loop->iteration }}</td>
                                <td data-label="IdForm">{{ $item->idForm }}</td>
                                <td data-label="NamaForm">{{ $item->namaForm }}</td>
                                <td data-label="NamaFile">{{ $item->namaFile }}</td>
                                <td data-label="Action" class="p-lg-1">
                                    <a data-toggle="modal" data-target="#modal_edit-{{ $item->id }}" class="btn btn-secondary">Edit</a>
                                    <a data-toggle="modal" data-target="#modal_hapus-{{ $item->id }}" class="btn batal">Hapus</a>
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
            <form id="form-tambah" action="{{ action ('ManajemenFormController@store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idForm" class="col-form-label">Id Form :</label>
                        <input type="text" class="form-control frm-input" id="idFormTambah" name="idForm">
                        <div class="idFormTambah-isInvalid invalid-feedback">
                            Id Form Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaForm" class="col-form-label">Nama Form :</label>
                        <input type="text" class="form-control frm-input" id="namaFormTambah" name="namaForm">
                        <div class="namaFormTambah-isInvalid invalid-feedback">
                            Nama Form Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaFile" class="col-form-label">Upload File (.blade.php) :</label>
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
                    <input type="hidden" name="status" value="1">
                    <div id="btn_tambah_submit" class="btn btn-dark diagnosa">Simpan</div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    {{-- End Modal Tambah --}}

    @foreach ($manajemenForm as $item)
        {{-- Modal Edit --}}
        <div class="modal fade" id="modal_edit-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white">Edit Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ action ( 'ManajemenFormController@update', $item->id )}}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="idForm" class="col-form-label">Id Form :</label>
                            <input type="text" class="form-control" id="idForm" name="idForm" value="{{ $item->idForm }}">
                            <input type="hidden" class="form-control" name="idFormOld" value="{{ $item->idForm }}">
                        </div>
                        <div class="form-group">
                            <label for="namaForm" class="col-form-label">Nama Form :</label>
                            <input type="text" class="form-control" id="namaForm" name="namaForm" value="{{ $item->namaForm }}">
                            <div class="namaForm-isInvalid invalid-feedback">
                                Nama Form Harus Diisi.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namaFile" class="col-form-label">Nama File :</label>
                            @php
                                $namaFile = str_replace('pages.formPengkajian.', '', $item->namaFile);
                            @endphp
                            <input type="text" class="form-control" id="namaFile" name="namaFile" value="{{ $namaFile }}">
                            <input type="hidden" class="form-control" name="namaFileOld" value="{{ $namaFile }}">
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary">Ubah</button>
                        <button type="button" class="btn btn-dark diagnosa" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        {{-- End Modal Edit --}}

        {{-- Modal Hapus --}}
        <div class="modal fade" id="modal_hapus-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Hapus Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{ action ( 'ManajemenFormController@delete', $item->id )}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Apa anda yakin ingin menghapus data <code>{{ $item->namaForm }}</code> ?</p>
                    </div>
                    <div class="modal-footer">
                        @php
                            $namaFile = str_replace('pages.formPengkajian.', '', $item->namaFile);
                        @endphp
                        <input type="hidden" name="namaFile" value="{{$namaFile}}">
                        <button type="submit" class="btn btn-dark diagnosa">Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
        {{-- End Modal Hapus --}}
    @endforeach

    <script>
        $(document).ready(function() {
            var table = $('#tbl').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup', function () {
                table.search( this.value ).draw();
            });
            $('#tbl_filter').show();
        });
        $('#btn_tambah_submit').click(function(){
            let idFormTambah = $('#idFormTambah').val();
            let namaFormTambah = $('#namaFormTambah').val();
            let fileVal = $('#fileTambah').val();
            let file = $('#fileTambah');
            // set var file fileExtension
            let fileExtension = file[0].files[0].name;
            let fileArray = fileExtension.split('.');
            
            if(idFormTambah == ""){
                $('#idFormTambah').addClass('isInValid')
                $('.idFormTambah-isInvalid').css('display', 'block');
            }
            
            if(namaFormTambah == ""){
                $('#namaFormTambah').addClass('isInValid')
                $('.namaFormTambah-isInvalid').css('display', 'block');
            }

            if(fileVal == ""){
                $('.fileTambah-isInvalid').css('display', 'block');
            }
            
            if(fileArray[fileArray.length - 1] != "php" || fileArray[fileArray.length - 2] != "blade"){
                $('#fileExtension-isInvalid').css('display', 'block');
            }else{
                $('#fileExtension-isInvalid').css('display', 'none');
                if(idFormTambah != "" && namaFormTambah != "" && fileVal != ""){
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
        $('#fileTambah').change(function(){
            if($(this).val() != ""){
                $('.fileTambah-isInvalid').css('display', 'none')
            }
        })
    </script>
@endsection