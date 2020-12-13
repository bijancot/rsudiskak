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
$inputTglLahir = $listRiwayat['TglLahir']; 
$inputJamMasukPoli = $listRiwayat['TglWaktuMasukPoli'];
$inputTanggalMasukPoli = $listRiwayat['TglWaktuMasukPoli'];
$JamMasuk = strtotime($inputJamMasukPoli);
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

?>
<div class="float-right" style="font-size:12px;">RM 02 c </div> <br>&nbsp;<br>

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
            <p style="font-size:10px">Nama Pasien : {{ $listRiwayat['NamaLengkap'] }}</p>
                <p style="font-size:10px">Jenis Kelamin : {{ $listRiwayat['JenisKelamin'] == "L" ? "Laki - Laki" : "Perempuan" }}</p>
                <p style="font-size:10px">Ruang/Kelas : {{ $listRiwayat['Ruangan'] }}</p>
            </td>
            <td colspan=3>
                <p style="font-size:10px">No. RM : {{ $listRiwayat['NoCM'] }}</p>
                <p style="font-size:10px">Tgl Lahir : <?php echo tgl_indo($TglLahir2); ?> / {{ $listRiwayat['Umur'] }}</p>
                <p style="font-size:10px">Tgl Masuk : <?php echo tgl_indo($TglMasuk2); ?> Jam: <?php echo date('H:i', $JamMasuk); ?></p>
            </td>
        </tr>
        <tr>
            <td colspan=8 style="text-align: center"><b>PENGKAJIAN ULANG PASIEN RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan=6><b>I. Pengkajian Keperawatan</b></td>
            <td colspan=2>Jam: <?php echo date('H:i', $JamMasuk); ?></td>
        </tr>
        <tr>
            <td colspan=3>
                1. Tekanan darah : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['TekananDarah']}} mmHg<br>
                2. Frekuensi nadi : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['FrekuensiNadi']}} x/menit<br>
                3. Suhu : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Suhu']}} C<br>
                4. Frekuensi nafas : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['FrekuensiNafas']}} x/menit<br>
            </td>
            <td colspan=3>
                1. Berat badan : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['BeratBadan']}}<br>
                2. Tinggi badan : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['TinggiBadan']}}<br>
                3. Skor Nyeri : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorNyeri']}}<br>
                4. Skala resiko jatuh : <br>
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorJatuh']=="rendah" ? 'checked' : '');?>> Rendah &nbsp;
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorJatuh']=="sedang" ? 'checked' : '');?>> Sedang &nbsp;
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorJatuh']=="tinggi   " ? 'checked' : '');?>> Tinggi &nbsp;
                <br>
            </td>
            <td style="text-align:center" colspan=2>
                Perawat / Terapis<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                {{$listRiwayat['NamaPerawat']}}
            </td>
        </tr>
        <tr>
            <td colspan=8><b>II. Pengkajian Medis</b></td>
        </tr>
        <tr>
            <td rowspan="4" colspan="6">
                Amnesis (S) : <br>
                {{$listRiwayat['DataPengkajian']['PengkajianMedis']['Anamnesis']}}
                <br><br>
                Pemeriksaan Fisik (O) : <br>
                {{$listRiwayat['DataPengkajian']['PengkajianMedis']['PemeriksaanFisik']}}
                <br>&nbsp;<br>
                <img src="https://cdn.pixabay.com/photo/2017/01/31/08/20/anatomical-2023188_960_720.png" width="50px">
                
            </td>
            <td>
                Rencana dan Terapi(P)<br>
                {{$listRiwayat['DataPengkajian']['PengkajianMedis']['RencanaDanTerapi']}}
            </td>
            <td>
                Kode ICD 9 CM<br>
                <?php
                    if(isset($listRiwayat['DataPengkajian']['PengkajianMedis']['KodeICD9']['KodeDiagnosaT'])){
                        $ICD9 = $listRiwayat['DataPengkajian']['PengkajianMedis']['KodeICD9']['KodeDiagnosaT'];
                        $arrICD9=explode(";",$ICD9);
                        foreach($arrICD9 as $dataICD9){echo $dataICD9.'<br>';}  
                    }else{
                        echo "-";
                    }
                    
                ?>
        </tr>
        <tr>
            <td colspan=2>
                Edukasi :<br>
                {{$listRiwayat['DataPengkajian']['PengkajianMedis']['Edukasi']}}
            </td>
        </tr>
        <tr>
            <td colspan=2>
                Penyakit menular : <br>
                {{$listRiwayat['DataPengkajian']['PengkajianMedis']['PenyakitMenular']}}
            </td>
        </tr>
        <tr>
            <td colspan=2>
                Dirujuk / konsul ke : <br>
                --------------------
            </td>
        </tr>
        <tr>
            <td colspan=3>
                <?php
                    $diagnosa = $listRiwayat['DataPengkajian']['PengkajianMedis']['Diagnosa']['NamaDiagnosa'];
                    $arrDiagnosa=explode(";",$diagnosa);
                    
                ?> 
                Diagnosa : <br><?php foreach($arrDiagnosa as $dataDiagnosa){echo $dataDiagnosa.'<br>';}?><br>   
                Komplikasi : {{$listRiwayat['DataPengkajian']['PengkajianMedis']['Komplikasi']}}<br>
                Komorbid : {{$listRiwayat['DataPengkajian']['PengkajianMedis']['Komorbid']}}
            </td>
            <td colspan=3>
                <?php
                    $icd10 = $listRiwayat['DataPengkajian']['PengkajianMedis']['Diagnosa']['KodeDiagnosa'];
                    $arrICD10=explode(";",$icd10);
                    
                ?>
                Kode ICD 10 CM : <br><?php foreach($arrICD10 as $dataICD10){echo $dataICD10.'<br>';}?>
            </td>
            <td colspan=2>
                Kesan Status Gizi : <br>
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianMedis']['KesanStatusGizi']=="kurang" ? 'checked' : '');?>> Gizi Kurang / Buruk &nbsp;<br>
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianMedis']['KesanStatusGizi']=="cukup" ? 'checked' : '');?>> Gizi Cukup &nbsp;<br>
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianMedis']['KesanStatusGizi']=="lebih" ? 'checked' : '');?>> Gizi Lebih &nbsp;<br>
            </td>
        </tr>
        <tr>
            <td colspan=2 style="text-align:center">Telah Direvifikasi</td>
            <td colspan=2 style="text-align:center">Telah Dikode</td>
            <td colspan=2 style="text-align:center">Legalisasi Severity</td>
            <td colspan=2 rowspan=3 style="text-align:center">
                Tulungagung, <?php echo tgl_indo($TglMasuk2); ?><br>
                Dokter<br>
            </td>
        </tr>
        <tr>
            <td style="text-align:center">Tanggal</td>
            <td style="text-align:center">Paraf Verifikator</td>
            <td style="text-align:center">Tanggal</td>
            <td style="text-align:center">Paraf Koder</td>
            <td style="text-align:center" colspan=2>Komite Medis</td>
        </tr>
        <tr>
            <td style="text-align:center"><?php echo tgl_indo($TglMasuk2); ?>&nbsp;<br>&nbsp;<br></td>
            <td><br></td>
            <td style="text-align:center"><?php echo tgl_indo($TglMasuk2); ?><br></td>
            <td><br></td>
            <td colspan=2><br></td>
        </tr>
        <tr>
            <td colspan=6></td>
            <td style="text-align:center" colspan=2>{{$listRiwayat['NamaDokter']}}</td>
        </tr>
    </table>
</body>
</html>
