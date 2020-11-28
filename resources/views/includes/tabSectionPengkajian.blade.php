<div id="section-riwayat" style="display: none;">
    <div class="table-container soft-shadow pt-5">
        <table id="tbl_antrianPoli" class="table table-striped">
            <thead>
                <th>Tgl Berkunjung</th>
                <th>Poliklinik</th>
                <th>Diagnosis</th>
                <th>Penatalaksanaan</th>
                <th>Riwayat Rawat Inap</th>
                <th>Verifikasi Petugas Kesehatan</th>
            </thead>
            <tbody>
                @foreach ($dataRiwayat as $item)
                    @php
                        $date = date_create($item['TglMasukPoli']);
                    @endphp
                    <tr>
                        <td data-label="Tgl Berkunjung">{{date_format($date, 'd/m/Y - h:i')}}</td>
                        <td data-label="Poliklinik">{{$item['Ruangan']}}</td>
                        @php
                            $namaDiagnosa = (!empty($item['DataPengkajian']['PengkajianMedis']['Diagnosa']['KodeDiagnosa'])? $item['DataPengkajian']['PengkajianMedis']['Diagnosa']['KodeDiagnosa'] : '-');
                        @endphp
                        <td data-label="Diagnosis">{{$namaDiagnosa}}</td>
                        <td data-label="Penatalaksanaan">-</td>
                        <td data-label="Riwayat Rawat Inap">-</td>
                        <td data-label="Verifikasi Petugas Kesehatan" class="p-lg-1">
                            @if ($item['StatusPengkajian'] == '2')
                                <div class="btn diagnosa ml-auto px-5" style="cursor:default;">
                                    <svg width="20" height="20" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M53.1884 4.76378C45.2787 11.6094 38.5868 18.126 32.4602 26.6282C29.7584 30.3782 26.7537 34.7919 24.7896 38.9591C23.6684 41.1688 21.6471 44.6216 20.9581 47.9413C17.1893 44.435 13.1412 40.4553 8.99931 37.3382C6.04712 35.1172 -2.456 39.6453 1.00525 42.2497C7.20868 46.9157 12.3677 52.7272 18.4015 57.6013C20.9252 59.6375 26.5184 55.2153 27.8327 53.36C32.1471 47.2475 32.7368 39.7757 35.8812 33.1082C40.6821 22.911 49.1965 14.5344 57.6031 7.26034C63.1727 2.06566 57.4202 1.10753 53.1968 4.76378" fill="#FFFFFF"/>
                                    </svg>
                                </div>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div id="section-berkas" style="display: none;">
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