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
                                    <a data-toggle="modal" data-target="#modal_edit" data-idform="{{ $item->idForm }}" class="btn btn-primary ubah-data">Ubah</a>
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
                        <input type="text" class="form-control inptId" id="idFormTambah" name="idForm">
                        <input type="hidden" id="idFormTambah_checkValid" value="0">
                        <div class="idFormTambah_isNull isInvalid-feedback">
                            Id Form Harus Diisi.
                        </div>
                        <div class="idFormTambah_duplicated isInvalid-feedback">
                            Data ID Sudah Terdaftar.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaForm" class="col-form-label">Nama Form :</label>
                        <input type="text" class="form-control frm-input" id="namaFormTambah" name="namaForm">
                        <div class="namaFormTambah_isNull invalid-feedback">
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
                        <div class="fileTambah_isNull invalid-feedback">
                            Upload File Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="fileExtension_isNull" class="alert alert-danger mt-4" role="alert" style="display: none;">
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
    {{-- Modal Edit --}}
    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
            <h5 class="modal-title text-white">Edit Data '<span class="title-id"></span>' </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="form_edit" action="{{action('ManajemenFormController@update')}}" method="POST" enctype="multipart/form-data">
            {{-- <form id="form_edit" action="" method="POST" enctype="multipart/form-data"> --}}
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idForm" class="col-form-label">Id Form :</label>
                        <input type="text" class="form-control inptIdEdit" id="idForm_edit" name="idForm">
                        <input type="hidden" class="form-control" id="idForm_edit_checkValid" value="1">
                        <input type="hidden" class="form-control" id="idFormOld_edit" name="idFormOld">
                        <div class="idForm_edit_isNull invalid-feedback">
                            Id Form Harus Diisi.
                        </div>
                        <div class="idForm_edit_duplicated invalid-feedback">
                            Data ID Sudah Terdaftar.
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="namaForm" class="col-form-label">Nama Form :</label>
                        <input type="text" class="form-control frm-input_edit" id="namaForm_edit" name="namaForm">
                        <div class="namaForm_edit_isNull invalid-feedback">
                            Nama Form Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="namaFile" class="col-form-label">Upload File (.blade.php) :</label>
                        <div>
                            <label for="file-upload1">
                                <input id="file_edit"  type="file" name="file">
                            </label>
                        </div>
                        <div class="fileEdit_isNull invalid-feedback">
                            Upload File Harus Diisi.
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="fileExtension_edit_isNull" class="alert alert-danger mt-4" role="alert" style="display: none;">
                            Format file upload tidak sesuai
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input  type="hidden" id="namaFileOld_edit" name="namaFileOld">
                    <input  type="hidden" id="idForm_edit_hidden">
                    <div data-idform="" class="btn btn-dark diagnosa btn_edit_submit">Ubah</div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    {{-- End Modal Edit --}}
    @foreach ($manajemenForm as $item)
        {{-- Modal Edit --}}
        {{-- <div class="modal fade" id="modal_edit-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white">Edit Data </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
                </div>
                <form id="form-{{$item->idForm}}_edit" action="{{ action ( 'ManajemenFormController@update', $item->id )}}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="idForm" class="col-form-label">Id Form :</label>
                            <input type="text" class="form-control inptIdEdit" id="idForm-{{$item->idForm}}_edit" name="idForm" value="{{ $item->idForm }}">
                            <input type="hidden" class="form-control" id="idForm-{{$item->idForm}}_checkValid" value="{{ $item->idForm }}" value="1">
                            <input type="hidden" class="form-control" name="idFormOld" value="{{ $item->idForm }}">
                            <div class="idForm-{{$item->idForm}}_edit_isNull invalid-feedback">
                                Id Form Harus Diisi.
                            </div>
                            <div class="idForm-{{$item->idForm}}_edit_duplicated invalid-feedback">
                                Data ID Sudah Terdaftar.
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="namaForm" class="col-form-label">Nama Form :</label>
                            <input type="text" class="form-control frm-input_edit" id="namaForm-{{$item->idForm}}_edit" name="namaForm" value="{{ $item->namaForm }}">
                            <div class="namaForm-{{$item->idForm}}_edit_isNull invalid-feedback">
                                Nama Form Harus Diisi.
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="namaFile" class="col-form-label">Upload File (.blade.php) :</label>
                            <div>
                                <label for="file-upload1">
                                    <input id="file-{{$item->idForm}}_edit"  type="file" name="file">
                                </label>
                            </div>
                            <div class="fileEdit_isNull invalid-feedback">
                                Upload File Harus Diisi.
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="fileExtension-{{$item->idForm}}_edit_isNull" class="alert alert-danger mt-4" role="alert" style="display: none;">
                                Format file upload tidak sesuai
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input  type="hidden" name="namaFileOld" value="{{$item->namaFile}}">
                        <input  type="hidden" id="idForm-{{$item->idForm}}_hidden" value="{{$item->idForm}}">
                        <div data-idform="{{$item->idForm}}" class="btn btn-dark diagnosa btn_edit_submit">Ubah</div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
            </div>
        </div> --}}
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
            
            if($('#idFormTambah').val() != ''){
                $('#idFormTambah_checkValid').val('1');
            }else{
                $('#idFormTambah_checkValid').val('0');
            }

            // notification crud
            @if(!empty(session('isCreate')))
                $('#msg_modal').html('Berhasil Menambahkan <br> Data Master Form');
                $('#modal_success').modal('toggle') 
            @endIf

            @if(!empty(session('isUpdate')))
                $('#msg_modal').html('Berhasil Mengubah <br> Data Master Form');
                $('#modal_success').modal('toggle') 
            @endIf

            @if(!empty(session('isDelete')))
                $('#msg_modal').html('Berhasil Menghapus <br> Data Master Form');
                $('#modal_success').modal('toggle') 
            @endIf
        });
        $('#tbl tbody').on('click', '.ubah-data', function(){
            let idForm = $(this).data('idform');
            $('.title-id').html(idForm);
            $('#idForm_edit').val(idForm)
            $('#idForm_edit_hidden').val(idForm)
            $('#idFormOld_edit').val(idForm)
            $.ajax({
                url: "{{url('/manajemen_form/getData')}}",
                method: 'post',
                data: {idForm: idForm, _token: '<?php echo csrf_token()?>'},
                success : function(res){
                    $('#namaForm_edit').val(res.namaForm)
                    $('#namaFileOld_edit').val(res.namaFile)
                }
            })
        })
        $(document).on('hidden.bs.modal','#modal_edit', function () {
            // $('#form-ubah').reset()
            $('#idForm_edit').removeClass('isInValid');
            $('#idForm_edit').removeClass('isValid');
            $('#namaForm_edit').removeClass('isInValid');
            $('#namaForm_edit').removeClass('isValid');
            $('.idForm_edit_duplicated').css('display', 'none');
            $('.idForm_edit_isNull').css('display', 'none');
            $('.namaForm_edit_isNull').css('display', 'none');
            $('#idForm_edit_checkValid').val('1');
        })
        $('#btn_tambah_submit').click(function(){
            let idFormTambah = $('#idFormTambah').val();
            let namaFormTambah = $('#namaFormTambah').val();
            let fileVal = $('#fileTambah').val();
            let file = $('#fileTambah');
            
        
            if(idFormTambah == ""){
                $('#idFormTambah').addClass('isInValid')
                $('.idFormTambah_isNull').css('display', 'block');
            }else{
                CheckIdDuplicate('idFormTambah', idFormTambah, 'tambah')
            }
            
            if(namaFormTambah == ""){
                $('#namaFormTambah').addClass('isInValid')
                $('.namaFormTambah_isNull').css('display', 'block');
            }

            if(fileVal == ""){
                $('.fileTambah_isNull').css('display', 'block');
            }

            let idFormCheckValid = $('#idFormTambah_checkValid').val();
            
            // set var file fileExtension
            if(fileVal != ""){
                let fileExtension = file[0].files[0].name;
                let fileArray = fileExtension.split('.');
                
                // check extension
                if(fileArray[fileArray.length - 1] != "php" || fileArray[fileArray.length - 2] != "blade"){
                    $('#fileExtension_isNull').css('display', 'block');
                }else{
                    $('#fileExtension_isNull').css('display', 'none');
                    if(idFormTambah != "" && namaFormTambah != "" && fileVal != "" && idFormCheckValid == '1'){
                        $('#form-tambah').submit();
                    }
                }
            }

        })

        $('.btn_edit_submit').click(function(){
            let id = $(this).data('idform')
            let idFormEdit = $('#idForm_edit').val();
            let namaFormEdit = $('#namaForm_edit').val();
            let fileVal = $('#file_edit').val();
            let file = $('#file_edit');
            let statusExtension = '1';
            
            if(idFormEdit == ""){
                $('#idForm_edit').addClass('isInValid')
                $('.idForm_edit_isNull').css('display', 'block');
            }
            
            if(namaFormEdit == ""){
                $('#namaForm_edit').addClass('isInValid')
                $('.namaForm_edit_isNull').css('display', 'block');
            }
            
            // set var file fileExtension
            if(fileVal != ""){

                let fileExtension = file[0].files[0].name;
                let fileArray = fileExtension.split('.');
                
                // check extension
                if(fileArray[fileArray.length - 1] != "php" || fileArray[fileArray.length - 2] != "blade"){
                    $('#fileExtension_edit_isNull').css('display', 'block');
                    statusExtension = '0'
                }else{
                    $('#fileExtension_edit_isNull').css('display', 'none');
                    statusExtension = '1'
                }
            }

            let idFormEditCheckValid = $('#idForm_edit_checkValid').val()
            if(idFormEdit != "" && namaFormEdit != "" && statusExtension == "1" && idFormEditCheckValid == '1'){
                $('#form_edit').submit();
            }

        })

        $('.frm-input').keyup(function(){
            let id = $(this).attr('id');
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

        $('.frm-input_edit').keyup(function(){
            let id = $(this).attr('id');
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

        $('.inptId').keyup(function(){
            let tagId = $(this).prop('id');
            let val = $(this).val();
            CheckIdDuplicate(tagId, val, 'tambah');
        })

        $('.inptIdEdit').keyup(function(){
            let tagId = $(this).prop('id');
            let val = $(this).val();
            CheckIdDuplicate(tagId, val, 'ubah');
        })
        
        const CheckIdDuplicate = (tagId, val, method) => {
            let isUbah
            if(method == 'ubah'){
                isUbah = true;
                console.log(tagId);
            }else{
                isUbah = false;
            }

            $.ajax({
                url: "{{url('manajemen_form/checkIdDuplicate')}}",
                method: 'post',
                data: {val: val, _token: '<?php echo csrf_token()?>'},
                success : function(res){
                    if(val == ''){
                        $('#'+tagId).removeClass('isInValid');
                        $('#'+tagId).removeClass('isValid');
                        $('.'+tagId+'_duplicated').css('display', 'none');
                        $('.'+tagId+'_isNull').css('display', 'none');
                        $('#'+tagId+'_checkValid').val('0');
                    }else if(isUbah == true && res.ID == $('#'+tagId+'_hidden').val()){
                        $('#'+tagId).removeClass('isInValid');
                        $('#'+tagId).removeClass('isValid');
                        $('.'+tagId+'_duplicated').css('display', 'none');
                        $('.'+tagId+'_isNull').css('display', 'none');
                        $('#'+tagId+'_checkValid').val('1');
                    }else if(res.status == true){
                        $('#'+tagId).removeClass('isValid');
                        $('#'+tagId).addClass('isInValid');
                        $('.'+tagId+'_duplicated').css('display', 'block');
                        $('.'+tagId+'_isNull').css('display', 'none');
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
    </script>
@endsection