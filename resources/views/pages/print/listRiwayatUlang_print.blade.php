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

$record2 = json_decode(json_encode($listRiwayat));
$inputTglLahir = $record2[0]->TglLahir; 
$inputJamMasukPoli = $record2[0]->TglWaktuMasukPoli;
$inputTanggalMasukPoli = $record2[0]->TglWaktuMasukPoli;
$JamMasuk = strtotime($inputJamMasukPoli);
$TglMasuk = strtotime($inputTanggalMasukPoli);
$TglLahir = strtotime($inputTglLahir); 

?>
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
            <p style="font-size:10px">Nama Pasien : <?php echo $record2[0]->NamaLengkap; ?></p>
                <p style="font-size:10px">Jenis Kelamin : <?php echo $record2[0]->JenisKelamin; ?></p>
                <p style="font-size:10px">Ruang/Kelas : <?php echo $record2[0]->Ruangan; ?></p>
            </td>
            <td colspan=3>
                <p style="font-size:10px">No. RM : <?php echo $record2[0]->NoCM; ?></p>
                <p style="font-size:10px">Tgl Lahir : <?php echo date('d F Y', $TglLahir); ?> / <?php echo $record2[0]->Umur; ?></p>
                <p style="font-size:10px">Tgl Masuk : <?php echo date('d F Y', $TglMasuk); ?> Jam: <?php echo date('H:i', $JamMasuk); ?></p>
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
                1. Tekanan darah : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->TekananDarah?> mmHg<br>
                2. Frekuensi nadi : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->FrekuensiNadi?> x/menit<br>
                3. Suhu : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Suhu?> C<br>
                4. Frekuensi nafas : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->FrekuensiNafas?> x/menit<br>
            </td>
            <td colspan=3>
                1. Berat badan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->BeratBadan?><br>
                2. Tinggi badan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->TinggiBadan?><br>
                3. Skor Nyeri : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->SkorNyeri?><br>
                4. Skala resiko jatuh : <br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkorJatuh=="rendah" ? 'checked' : '');?>> Rendah &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkorJatuh=="sedang" ? 'checked' : '');?>> Sedang &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkorJatuh=="tinggi   " ? 'checked' : '');?>> Tinggi &nbsp;
                <br>
            </td>
            <td style="text-align:center" colspan=2>
                Perawat / Terapis<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                {{ $record2[0]->NamaPerawat }}
            </td>
        </tr>
        <tr>
            <td colspan=8><b>II. Pengkajian Medis</b></td>
        </tr>
        <tr>
            <td rowspan="4" colspan="6">
                Amnesis (S) : <br>
                <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Anamnesis?>
                <br><br>
                Pemeriksaan Fisik (O) : <br>
                <?php echo $record2[0]->DataPengkajian->PengkajianMedis->PemeriksaanFisik?>
                <br>&nbsp;<br>
                <img src="https://cdn.pixabay.com/photo/2017/01/31/08/20/anatomical-2023188_960_720.png" width="50px">
                
            </td>
            <td>
                Rencana dan Terapi(P)<br>
                <?php echo $record2[0]->DataPengkajian->PengkajianMedis->RencanaDanTerapi?>
            </td>
            <td>
                Kode ICD 9 CM<br>
                -
        </tr>
        <tr>
            <td colspan=2>
                Edukasi :<br>
                <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Edukasi?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                Penyakit menular : <br>
                <?php echo $record2[0]->DataPengkajian->PengkajianMedis->PenyakitMenular?>
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
                Diagnosa : -<br>    
                Komplikasi : <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Komplikasi?><br>
                Komorbid : <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Komorbid?>
            </td>
            <td colspan=3>
                Kode ICD 10 CM : <br>-<br>
            </td>
            <td colspan=2>
                Kesan Status Gizi : <br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianMedis->KesanStatusGizi=="kurang" ? 'checked' : '');?>> Gizi Kurang / Buruk &nbsp;<br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianMedis->KesanStatusGizi=="cukup" ? 'checked' : '');?>> Gizi Cukup &nbsp;<br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianMedis->KesanStatusGizi=="lebih" ? 'checked' : '');?>> Gizi Lebih &nbsp;<br>
            </td>
        </tr>
        <tr>
            <td colspan=2 style="text-align:center">Telah Direvifikasi</td>
            <td colspan=2 style="text-align:center">Telah Dikode</td>
            <td colspan=2 style="text-align:center">Legalisasi Severity</td>
            <td colspan=2 rowspan=3 style="text-align:center">
                Tulungagung, <?php echo date('d F Y', $TglMasuk)?><br>
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
            <td style="text-align:center"><?php echo date('d F Y', $TglMasuk)?>&nbsp;<br>&nbsp;<br></td>
            <td><br></td>
            <td style="text-align:center"><?php echo date('d F Y', $TglMasuk)?><br></td>
            <td><br></td>
            <td colspan=2><br></td>
        </tr>
        <tr>
            <td colspan=6></td>
            <td style="text-align:center" colspan=2><?php echo $record2[0]->NamaDokter; ?></td>
        </tr>
    </table>
</body>
</html>
