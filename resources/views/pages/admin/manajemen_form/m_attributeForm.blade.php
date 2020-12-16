@extends('layouts.layout_dataTb')

@section('content')

    @include('includes.admin.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <h3>Setting Attribute</h3>
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
                                <th>Nama Attribute</th>
                                <th>Nama Collection</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($attributeForm as $item)
                            <tr>
                                <td data-label="No">{{ $loop->iteration }}</td>
                                <td data-label="NamaAttribute">{{ $item->namaAttribute }}</td>
                                <td data-label="NamaCollection">{{ $item->namaCollection }}</td>
                                <td data-label="Action" class="p-lg-1">
                                    <a href="{{ url ('m_attribute/'. $item->id) }}" class="btn diagnosa ml-auto">Edit</a>
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

    <div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title text-white">Tambah Data </h5>
              <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ action ('ManajemenAttributeFormController@storeAttribute')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="namaAttribute" class="col-form-label">Nama Attribute :</label>
                        <input type="text" onkeypress="return noSpacing(event)" class="form-control" id="namaAttribute" name="namaAttribute" required>
                        <small>Penamaan Collection tidak boleh menggunakan spasi.</small>
                    </div>
                    <div class="form-group">
                        <label for="namaCollection" class="col-form-label">Nama Collection :</label>
                        <input type="text" onkeypress="return noSpacing(event)" class="form-control" id="namaCollection" name="namaCollection" data-toggle="popover" title="Tips" data-content="Sebaiknya menggunakan huruf kecil di awal penamaan collection" required>
                        <small>Penamaan Collection tidak boleh menggunakan spasi.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark diagnosa">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
          </div>
        </div>
    </div>

    @foreach ($attributeForm as $item)
    <div class="modal fade" id="modal_hapus-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white">Hapus Data </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ action ( 'ManajemenAttributeFormController@destroyAttribute', $item->id )}}" method="POST">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <p>Apa anda yakin ingin menghapus data <code>{{ $item->namaAttribute }}</code> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark diagnosa">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    @endforeach

    <script>
        $(document).ready(function() {
            var table = $('#tbl').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup', function () {
                table.search( this.value ).draw();
            });
            $('#tbl_filter').show();

            // $('#namaCollection').popover('enable')    
            $('[data-toggle="popover"]').popover()
            
            // notification crud
            @if(!empty(session('isCreateAttribute')))
                $('#msg_modal').html('Berhasil Menambahkan <br> Data Attribute');
                $('#modal_success').modal('toggle')
            @endIf

            @if(!empty(session('isDeleteAttribute')))
                $('#msg_modal').html('Berhasil Menghapus <br> Data Attribute');
                $('#modal_success').modal('toggle')
            @endIf
        });
        
        function noSpacing(evt) { 
          
          // Only ASCII charactar in that range allowed 
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
          if (ASCIICode == 32) 
              return false; 
          return true; 

          
        } 
    </script>
@endsection