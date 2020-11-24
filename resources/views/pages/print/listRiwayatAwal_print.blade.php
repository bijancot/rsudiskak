<html>
<head>
	<title>Riwayat Pasien</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body{
            font-size:9px;
        }
    </style>
</head>
<body>
<?php

$record2 = json_decode(json_encode($listRiwayat));
$inputTglLahir = $record2[0]->TglLahir; 
$inputJamMasukPoli = $record2[0]->TglMasuk;
$inputTanggalMasukPoli = $record2[0]->TglMasukPoli;
$JamMasuk = strtotime($inputJamMasukPoli);
$TglMasuk = strtotime($inputTanggalMasukPoli);
$TglLahir = strtotime($inputTglLahir); 

?>
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
                <p style="font-size:10px">Nama Pasien : <?php echo $record2[0]->NamaLengkap; ?></p>
                <p style="font-size:10px">Jenis Kelamin : <?php echo $record2[0]->JenisKelamin; ?></p>
                <p style="font-size:10px">Ruang/Kelas : <?php echo $record2[0]->Ruangan; ?></p>
            </td>
            <td colspan=3>
                <p style="font-size:10px">No. RM : <?php echo $record2[0]->NoCM; ?></p>
                <p style="font-size:10px">Tgl Lahir : <?php echo date('Y-m-d', $TglLahir); ?> / <?php echo $record2[0]->Umur; ?></p>
                <p style="font-size:10px">Tgl Masuk : <?php echo $record2[0]->TglMasukPoli; ?> Jam: <?php echo date('H:i', $JamMasuk); ?></p>
            </td>
        </tr>
        <tr>
            <td colspan=8 style="text-align: center"><b>PENGKAJIAN AWAL PASIEN RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan=6><b>I. Pengkajian Keperawatan</b></td>
            <td colspan=2>Jam: <?php echo date('H:i', $JamMasuk); ?></td>
        </tr>
        <tr>
            <td colspan=2 style="text-align: center">Tanda Vital</td>
            <td colspan=2 style="text-align: center">Antroprometri</td>
            <td colspan=2 style="text-align: center">Fungsional</td>
            <td colspan=2 style="text-align: center">Perawat/Terapis</td>
        </tr>
        <tr>
            <td colspan=2>
                1. Tekanan darah : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->TekananDarah?> mmHg<br>
                2. Frekuensi nadi : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->FrekuensiNadi?> x/menit<br>
                3. Suhu : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Suhu?> C<br>
                4. Frekuensi nafas : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->FrekuensiNafas?> x/menit<br>
                5. Skor Nyeri : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->SkorNyeri?><br>
                6. Skala resiko jatuh : <br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkalaJatuh=="Sedang" ? 'checked' : '');?>>Sedang &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkalaJatuh=="Tinggi" ? 'checked' : '');?>>Tinggi &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkalaJatuh=="Rendah" ? 'checked' : '');?>>Rendah &nbsp;
                <br>
            </td>
            <td colspan=2>
                1. Berat badan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->BeratBadan?><br>
                2. Tinggi badan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->TinggiBadan?><br>
                3. Lingkar kepala : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->LingkarKepala?><br>
                4. IMT : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->IMT?><br>
                5. Lingkar lengan atas : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->LingkaranLenganAtas?><br>
                *khusus pediatri<br>
            </td>
            <td colspan=2>
                1. Alat bantu : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->AlatBantu?><br>
                2. Protesa : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Prothesa?><br>
                3. ADL : <br>
                <input type="checkbox"  <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->ADL=="mandiri" ? 'checked' : '');?>>Mandiri &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->ADL=="dibantu" ? 'checked' : '');?>>Dibantu &nbsp;
                
            </td>
            <td style="text-align:center" colspan=2>
                <br><br><br><br><br>
                -------------
            </td>
        </tr>
        <tr>
            <td colspan="8">
                Pendidikan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Pendidikan?><br>
                Pekerjaan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Pekerjaan?><br>
                Agama kepercayaan : 
                <input type="checkbox"  <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->Agama=="Islam" ? 'checked' : '');?>>Islam &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->Agama=="Katholik" ? 'checked' : '');?>>Katholik &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->Agama=="Kristen" ? 'checked' : '');?>>Kristen &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->Agama=="Hindu" ? 'checked' : '');?>>Hindu &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->Agama=="Budha" ? 'checked' : '');?>>Budha &nbsp;
                
                <br>
                Nilai-nilai yang dianut : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->NilaiAnut?><br>
                Status pernikahan :
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPernikahan=="Menikah" ? 'checked' : '');?>>Menikah &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPernikahan=="Belum menikah" ? 'checked' : '');?>>Belum Menikah &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPernikahan=="Janda/duda" ? 'checked' : '');?>>Janda/duda &nbsp;<br>
                
                Keluarga : 
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->Keluarga=="Tinggal sendiri" ? 'checked' : '');?>>Tinggal Sendiri &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->Keluarga=="Tinggal serumah" ? 'checked' : '');?>>Tinggal Serumah &nbsp;<br>
                
                Tempat tinggal :
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->TempatTinggal=="Rumah" ? 'checked' : '');?>>Rumah &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->TempatTinggal=="Panti Asuhan" ? 'checked' : '');?>>Panti Asuhan &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->TempatTinggal=="Lainnya" ? 'checked' : '');?>>Lainnya &nbsp;<br>
                 
                Status piskologis : 
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPsikologi=="Depresi" ? 'checked' : '');?>>Depresi &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPsikologi=="Takut" ? 'checked' : '');?>>Takut &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPsikologi=="Agresif" ? 'checked' : '');?>>Agresif &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPsikologi=="Melukai diri sendiri" ? 'checked' : '');?>>Melukai diri sendiri &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPsikologi=="Tidak ada gejala" ? 'checked' : '');?>>Tidak ada gejala &nbsp;<br>
                 
                Hambatan edukasi : 
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->HambatanEdukasi=="Bahasa" ? 'checked' : '');?>>Bahasa &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->HambatanEdukasi=="Cacat/Fisik/Kognitif (Gangguan Penglihatan/Pendengaran Lain)" || $record2[0]->DataPengkajian->PengkajianKeperawatan->HambatanEdukasi=="Gangguan Pendengaran" ? 'checked' : '');?>>Cacat/Fisik/Kognitif (Gangguan Penglihatan/Pendengaran Lain) &nbsp;<br>
                
            </td>
        </tr>
        <tr>
            <td colspan="8">
                Riwayat penyakit dahulu : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->RiwayatPenyakitDahulu?><br>
                Alergi : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Alergi?><br>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                Status Obsetri : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->StatusObstetri?><br>
                Keterangan Obstetri/Ginekologi/Laktasi/KB : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Ket_Obstetri_Ginekologi_Laktasi_KB?><br>
            </td>
            <td colspan="2">
                HPHT : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->HPTT?><br>
                TP : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->TP?><br>
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
                <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Anamnesis?>
                
            </td>
            <td>
                Rencana dan Terapi(P)<br>
                <?php echo $record2[0]->DataPengkajian->PengkajianMedis->RencanaDanTerapi?>
            </td>
            <td>
                Kode ICD 9 CM<br>
                <?php //echo $record2[0]->DataPengkajian->PengkajianMedis->KodeICD10?>
            </td>
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
                Diagnosa : <?php //echo $record2[0]->DataPengkajian->PengkajianMedis->Diagnosa?><br>    
                Komplikasi : <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Komplikasi?><br>
                Komorbid : <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Komorbid?>
            </td>
            <td colspan=3>
                Kode ICD 10 CM : <br><?php //echo $record2[0]->DataPengkajian->PengkajianMedis->KodeICD10?><br>
            </td>
            <td colspan=2>
                Kesan Status Gizi : <br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianMedis->KesanStatusGizi=="kurang" ? 'checked' : '');?>>Gizi Kurang / Buruk &nbsp;<br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianMedis->KesanStatusGizi=="cukup" ? 'checked' : '');?>>Gizi Cukup &nbsp;<br>
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianMedis->KesanStatusGizi=="lebih" ? 'checked' : '');?>>Gizi Lebih &nbsp;<br>
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
            <td style="text-align:center"><?php echo date('Y/m/d', $TglMasuk)?>&nbsp;<br>&nbsp;<br></td>
            <td><br></td>
            <td style="text-align:center"><?php echo date('Y/m/d', $TglMasuk)?><br></td>
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
