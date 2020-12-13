<html>
<head>
	<title>Riwayat Pasien</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body{
            font-size:10px;
        }
        input[type=checkbox]:before { 
            font-family: DejaVu Sans; 
            font-size: 12px;
        }
        input[type=checkbox] { 
            display: inline; 
        }
        table{
            width:100%;
        }
        table,
        th,
        td {
        border: 0.5px solid #d2d7d3;
        }

        table th,
        table td {
            vertical-align: top;
            padding: 5px;
        /* Apply cell padding */
        }
    </style>
</head>
<body>
<?php

//$record2 = json_decode(json_encode($listRiwayat));

?>
@php
    $dataPengkajian = $dataRiwayatDetail['DataPengkajian'];
    $inputTglLahir = $dataMasukPoli['UmurTahun']; 
    $inputTanggalMasukPoli = $dataMasukPoli['TglMasuk'];
    $TglMasuk = strtotime($inputTanggalMasukPoli);
    $TglLahir = strtotime($inputTglLahir); 
    $TglLahir2 = date('Y-m-d', $TglLahir);
    $TglMasuk2 = date('Y-m-d', $TglMasuk);

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
@endphp
<div class="float-right" style="font-size:12px;">RM 01 </div> <br>&nbsp;<br>

    <table>
        <tr>
            <td style="text-align:center" colspan=2>
                <img src="https://bgskr-project.my.id/img/logo.png" width="40px" height="40px"><br>
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
                <p style="font-size:11px">Tgl Lahir : <?php echo tgl_indo($TglLahir2); ?> / {{ $dataMasukPoli['Umur'] }}</p>
                <p style="font-size:11px">Tgl Masuk : {{ tgl_indo($TglMasuk2) }}</p>
            </td>
        </tr>
        <tr>
            <td colspan=8 style="text-align: center"><b>PROFIL RINGKAS MEDIS RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan=8>
                Alamat : {{ $dataMasukPoli['Alamat'] }}<br>
                @php 
                    $riwayatAlergi = array();
                @endphp
                @if(isset($dataPengkajian['PengkajianKeperawatan']['Agama']) || isset($dataPengkajian['PengkajianKeperawatan']['Pekerjaan'] ))
                    Agama : {{ $dataPengkajian['PengkajianKeperawatan']['Agama'] }}<br>
                    Pekerjaan : {{ $dataPengkajian['PengkajianKeperawatan']['Pekerjaan'] }}<br>
                    Status Perkawinan : {{ $dataPengkajian['PengkajianKeperawatan']['StatusPernikahan'] }}<br>
                    Riwayat Alergi : 
                    <?php
                        foreach($dataRiwayatAlergi as $item){
                            if($item['DataPengkajian']['PengkajianKeperawatan']['Alergi']!=null OR $item['DataPengkajian']['PengkajianKeperawatan']['Alergi']!='-'){
                                $riwayatAlergi[]=$item['DataPengkajian']['PengkajianKeperawatan']['Alergi'];
                            }
                        }
                        echo implode(', ', $riwayatAlergi);
                    ?>
                @else
                    Agama : - <br>
                    Pekerjaan : - <br>
                    Status Perkawinan : - <br>
                    Riwayat Alergi : -<br>
                @endif
                    
            </td>
        </tr>
    </table>
    <br>
    <table>
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
            @if($item['StatusPengkajian']=='2')
        @php
            
            $date = date_create($item['TglWaktuMasukPoli']);
        @endphp
        <tr>
            <td style="text-align:center">{{ $i++ }}</td>
            <td style="text-align:center">{{date_format($date, 'd/m/Y - h:i')}}</td>
            <td style="text-align:center">{{$item['Ruangan']}}</td>
            @php
                $namaDiagnosa = (!empty($item['DataPengkajian']['PengkajianMedis']['Diagnosa']['KodeDiagnosa'])? $item['DataPengkajian']['PengkajianMedis']['Diagnosa']['KodeDiagnosa'] : '-');
            @endphp
            <td style="text-align:center">{{$namaDiagnosa}}</td>
            <td style="text-align:center">-</td>
            <td style="text-align:center">-</td>
            <td style="text-align:center">
            @if ($item['StatusPengkajian'] == '2')
                <img src="https://bgskr-project.my.id/img/centang.png" width=30px;>
            @else
                -
            @endif
            </td>
        </tr>
            @endif
        @endforeach
    </table>
</body>
</html>
