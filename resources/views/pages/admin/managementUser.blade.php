@extends('layouts.layout')

@section('content')

@include('includes.admin.navbar')
    
    <div class="bg-greenishwhite">
        <div class="wrapper">
            <div class="search-box-box">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="search-box-box">
                            <input id="cstm_search" type="text" placeholder="Cari Nama Pasien" class="soft-shadow">
                            <span><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9167 11.6667H12.2583L12.025 11.4417C12.8417 10.4917 13.3333 9.25833 13.3333 7.91667C13.3333 4.925 10.9083 2.5 7.91667 2.5C4.925 2.5 2.5 4.925 2.5 7.91667C2.5 10.9083 4.925 13.3333 7.91667 13.3333C9.25833 13.3333 10.4917 12.8417 11.4417 12.025L11.6667 12.2583V12.9167L15.8333 17.075L17.075 15.8333L12.9167 11.6667ZM7.91667 11.6667C5.84167 11.6667 4.16667 9.99167 4.16667 7.91667C4.16667 5.84167 5.84167 4.16667 7.91667 4.16667C9.99167 4.16667 11.6667 5.84167 11.6667 7.91667C11.6667 9.99167 9.99167 11.6667 7.91667 11.6667Z" fill="#C7D3CC"/></svg></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12 mt-4 mt-lg-0">
                        <div class="d-flex align-items-center">
                            <a id="nav_antrianPoli" class="capsule-btn capsule-left active ml-auto">Antrian Pasien</a>
                            <a id="nav_masukPoli" class="capsule-btn capsule-right">Masuk Poli</a>
                        </div>
                    </div>
                </div>    
            </div>
            <div class="table-container soft-shadow">
                <table id="tbl_listPasienKirimPoli" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nama Dokter</th>
                            <th>Role</th>
                            <th>Access</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="No">001</td>
                            <td data-label="Username">Suep</td>
                            <td data-label="Password">11930222</td>
                            <td data-label="Nama Dokter">dr. Suep Suryanto sp, PD</td>
                            <td data-label="Role">Pelayanan Dalam</td>
                            <td data-label="Access">Dasboard Dokter</td>
                            <td data-label="Action" class="p-lg-1"><div class="d-flex flex-row"><a href="#" class="btn diagnosa ml-auto">Ganti Password</a><a href="#" class="btn batal">Hapus</a></div></td>
                        </tr>
                        
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