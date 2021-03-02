<div class="content soft-shadow">
    <div class="p-3">
        <p class="h4 d-flex">Data Pasien <a href="/profilRingkas/{{$idForm}}/{{ $dataMasukPoli['NoCM'] }}/{{$dataMasukPoli['NoPendaftaran'] }}/{{$dataMasukPoli['TglMasukPoli']}}" target="_blank" class="btn btn-primary print_button ml-auto" id="print_button" hidden>Print</a></p>
    </div>
    <hr>
    <div class="row p-3 py-4">
        <div class="col-lg-2 col-12 mt-3 mt-lg-0">
            <label for="nopendaftaran">No Pendaftaran</label>
            <input type="text" name="nopendaftaran" value="{{ $dataMasukPoli['NoPendaftaran'] }}" disabled>
        </div>
        <div class="col-lg-2 pl-lg-0 col-12 mt-3 mt-lg-0">
            <label for="norekammedis">No Rekam Medis</label>
            <input type="text" name="norekammedis" value="{{ $dataMasukPoli['NoCM'] }}" disabled>
        </div>
    
        <div class="col-lg-8 pl-lg-0 col-12 mt-3 mt-lg-0">
            <label for="nama">Nama</label>
            <input type="text" name="nama" value="{{ $dataMasukPoli['NamaLengkap'] }}" disabled>
        </div>
        <div class="col-lg-2 col-6 mt-3 mt-lg-0">
            <label for="jk">Jenis Kelamin</label>
            <input type="text" name="jk" value="{{ $dataMasukPoli['JenisKelamin']=='L'?'Laki-laki':'Perempuan' }}" disabled>
        </div>              
        <div class="col-lg-2 pl-0 pl-lg-0 col-6 mt-3 mt-lg-0">
            <label for="umur">Umur Pasien</label>
            <input type="text" name="umur" value="{{ $dataMasukPoli['UmurTahun'] }}" disabled>
        </div>
        <div class="col-lg-2 pl-lg-0 col-6 mt-3 mt-lg-0">
            <label for="kelas">Kelas Pelayanan</label>
            <input type="text" name="kelas" value="{{ $dataMasukPoli['Kelas'] }}" disabled>
        </div>
        <div class="col-lg-2 pl-0 col-6 mt-3 mt-lg-0">
            <label for="penjamin">Penjamin</label>
            <input type="text" name="penjamin" value="{{ $dataMasukPoli['jenisPasien'] }}" disabled>
        </div>
            @php
                $date = date_create($dataMasukPoli['TglMasuk']);
            @endphp
        <div class="col-lg-4 pl-lg-0 col-12 mt-3 mt-lg-0">
            <label for="tanggalmasuk">Tanggal Masuk</label>
            <input type="text" name="tanggalmasuk" value="{{ date_format($date,"d/m/Y")}}" disabled>
        </div>
    </div>   
</div>