@extends('layouts.layout_dataTb')

@section('content')

    @include('includes.admin.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <h3>Setting Agama</h3>
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
                                <th>Agama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($agama as $item)
                            <tr>
                                <td data-label="No">{{ $loop->iteration }}</td>
                                <td data-label="Agama">{{ $item->agama }}</td>
                                <td data-label="Action" class="p-lg-1">
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
            <form action="{{ action ('AgamaController@store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="agama" class="col-form-label">Agama :</label>
                        <input type="text" class="form-control" id="agama" name="agama">
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

    @foreach ($agama as $item)
    <div class="modal fade" id="modal_hapus-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white">Hapus Data </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="text-white" aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ action ( 'AgamaController@destroy', $item->id )}}" method="POST">
                @method('delete')
                @csrf
                <div class="modal-body">
                    <p>Apa anda yakin ingin menghapus data <code>{{ $item->agama }}</code> ?</p>
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
        });
    </script>
@endsection