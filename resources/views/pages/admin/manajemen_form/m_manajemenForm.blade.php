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
            <form action="{{ action ('ManajemenFormController@store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="idForm" class="col-form-label">Id Form :</label>
                        <input type="text" class="form-control" id="idForm" name="idForm">
                    </div>
                    <div class="form-group">
                        <label for="namaForm" class="col-form-label">Nama Form :</label>
                        <input type="text" class="form-control" id="namaForm" name="namaForm">
                    </div>
                    <div class="form-group">
                        <label for="namaFile" class="col-form-label">Nama File :</label>
                        <input type="text" class="form-control" id="namaFile" name="namaFile">
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
                        </div>
                        <div class="form-group">
                            <label for="namaForm" class="col-form-label">Nama Form :</label>
                            <input type="text" class="form-control" id="namaForm" name="namaForm" value="{{ $item->namaForm }}">
                        </div>
                        <div class="form-group">
                            <label for="namaFile" class="col-form-label">Nama File :</label>
                            <input type="text" class="form-control" id="namaFile" name="namaFile" value="{{ $item->namaFile }}">
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
    </script>
@endsection