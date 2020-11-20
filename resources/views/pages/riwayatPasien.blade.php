@extends('layouts.layout')

@section('content')

    @include('includes.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <div class="search-box-box">
                <input id="cstm_search" type="search" placeholder="Cari Nama Pasien" class="soft-shadow">
                <span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9167 11.6667H12.2583L12.025 11.4417C12.8417 10.4917 13.3333 9.25833 13.3333 7.91667C13.3333 4.925 10.9083 2.5 7.91667 2.5C4.925 2.5 2.5 4.925 2.5 7.91667C2.5 10.9083 4.925 13.3333 7.91667 13.3333C9.25833 13.3333 10.4917 12.8417 11.4417 12.025L11.6667 12.2583V12.9167L15.8333 17.075L17.075 15.8333L12.9167 11.6667ZM7.91667 11.6667C5.84167 11.6667 4.16667 9.99167 4.16667 7.91667C4.16667 5.84167 5.84167 4.16667 7.91667 4.16667C9.99167 4.16667 11.6667 5.84167 11.6667 7.91667C11.6667 9.99167 9.99167 11.6667 7.91667 11.6667Z" fill="#C7D3CC"/></svg></span>
            </div>
            <div class="table-container soft-shadow">
                <table id="tbl_listPasienKirimPoli" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No Pendaftaran</th>
                            <th>No Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Masuk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listRiwayat as $item)
                            @if($item['StatusPengkajian']=="2")
                            <tr>
                                <td>{{ $item['NoPendaftaran'] }}</td>
                                <td>{{ $item['NoCM'] }}</td>
                                <td>{{ $item['NamaLengkap'] }}</td>
                                <td>{{ $item['TglMasukPoli'] }}</td>
                                <td data-label="Action" class="d-flex flex-row p-lg-1">
                                    <a href="riwayatPasien/{{ $item['NoPendaftaran'] }}" class="btn diagnosa ml-auto">Print</a>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#tbl_listPasienKirimPoli').DataTable();
            $(table).DataTable();
            $('#cstm_search').on( 'keyup', function () {
                table.search( this.value ).draw();
            });
            $('#tbl_listPasienKirimPoli_filter').hide();
        });
    </script>
@endsection