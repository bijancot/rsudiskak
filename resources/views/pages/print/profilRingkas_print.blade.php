<html>
<head>
	<title>Riwayat Pasien</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body{
            font-size:10px;
        }
    </style>
</head>
<body>
<?php

//$record2 = json_decode(json_encode($listRiwayat));

?>
@php
    $dataPengkajian = $dataMasukPoli['DataPengkajian'];
@endphp
    <table class="table table-bordered">
        <tr>
            <td style="text-align:center" colspan=2>
                <img src="https://news.rsudtulungagung.com/wp-content/uploads/2019/03/Logo-Iskak-Transparant.png" width="40px" height="40px"><br>
                RSUD Dr.Iskak<br>
                <div style="font-size:7px;">
                Jl. Dr. Wahidin Sudiro Husodo Tulungagung 66224<br>
                Telp 0355 - 322609 Fax 0355 - 322165<br>
                Email : rsud_iskak_ta@yahoo.com   
                </div>             
            </td>
            <td colspan=3>
                <p style="font-size:11px">Nama Pasien : {{ $dataMasukPoli['NamaLengkap']}}</p>
                <p style="font-size:11px">Jenis Kelamin : {{$dataMasukPoli['JenisKelamin']}}</p>
                <p style="font-size:11px">Ruang/Kelas : {{$dataMasukPoli['Kelas']}}</p>
            </td>
            <td colspan=3>
                @php
                    $date = date_create($dataMasukPoli['TglMasuk']);
                @endphp
                <p style="font-size:11px">No. RM : {{ $dataMasukPoli['NoCM'] }}</p>
                <p style="font-size:11px">Tgl Lahir : {{ $dataMasukPoli['UmurTahun'] }}</p>
                <p style="font-size:11px">Tgl Masuk : {{ date_format($date,"d/m/Y")}}</p>
            </td>
        </tr>
        <tr>
            <td colspan=8 style="text-align: center"><b>PROFIL RINGKAS MEDIS RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan=8>
                Alamat : {{ $dataMasukPoli['Alamat'] }}<br>
                @if($dataMasukPoli['IdFormPengkajian']=="1")
                    Agama : {{ $dataPengkajian['PengkajianKeperawatan']['Agama'] }}<br>
                    Pekerjaan : {{ $dataPengkajian['PengkajianKeperawatan']['Pekerjaan'] }}<br>
                    Status Perkawinan : {{ $dataPengkajian['PengkajianKeperawatan']['StatusPernikahan'] }}<br>
                    Riwayat Alergi : {{ $dataPengkajian['PengkajianKeperawatan']['Alergi'] }}<br>
                @elseif($dataMasukPoli['IdFormPengkajian']=="2")
                    Agama : - <br>
                    Pekerjaan : - <br>
                    Status Perkawinan : - <br>
                    Riwayat Alergi : -<br>
                @endif
                    
            </td>
        </tr>
    </table>
    <table class="table table-bordered">
        <tr>
            <th style="text-align:center">No</th>
            <th style="text-align:center">Tanggal Berkunjung</th>
            <th style="text-align:center">Poli</th>
            <th style="text-align:center">Diagnosis</th>
            <th style="text-align:center">Penatalaksanaan</th>
            <th style="text-align:center">Riwayat Rawat Inap/ Prosedur Operasi</th>
            <th style="text-align:center">Nama & TTD Petugas Kesehatan</th>
        </tr>
        
        <?php $i = 1; ?>
        @foreach ($dataRiwayat as $item)
        @php
            $no=0;
            $date = date_create($item['TglMasukPoli']);
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{date_format($date, 'd/m/Y - h:i')}}</td>
            <td>{{$item['Ruangan']}}</td>
            <td>CAD, HF</td>
            <td>-</td>
            <td>-</td>
            <td>
            @if ($item['StatusPengkajian'] == '2')
                OK
            @else
                -
            @endif
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
