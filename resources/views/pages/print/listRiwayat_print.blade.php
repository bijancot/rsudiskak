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

$record2 = json_decode(json_encode($listRiwayat));

?>
    <table class="table table-bordered">
        <tr>
            <td>
                RSUD Dr.Iskak
                
            </td>
            <td >
                Nama Pasien : <?php echo $record2[0]->NamaLengkap; ?><br>
                Jenis Kelamin : <?php echo $record2[0]->JenisKelamin; ?><br>
                Ruang/Kelas : <?php echo $record2[0]->Ruangan; ?><br>
            </td>
            <td colspan=2>
                No. RM : <?php echo $record2[0]->NoCM; ?><br>
                Tgl Lahir : <?php echo $record2[0]->TglLahir; ?><br>
                Tgl Masuk : <?php echo $record2[0]->TglMasukPoli; ?><br>
            </td>
        </tr>
        <tr>
            <td colspan=4 style="text-align: center"><b>PENGKAJIAN AWAL PASIEN RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan=3><b>I. Pengkajian Keperawatan</b></td>
            <td>Jam: -------</td>
        </tr>
        <tr>
            <td class="col-md-4" style="text-align: center">Tanda Vital</td>
            <td class="col-md-4" style="text-align: center">Antroprometri</td>
            <td class="col-md-4" style="text-align: center">Fungsional</td>
            <td class="col-md-4" style="text-align: center">Perawat/Terapis</td>
        </tr>
        <tr>
            <td>
                1. Tekanan darah : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->TekananDarah?> mmHg<br>
                2. Frekuensi nadi : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->FrekuensiNadi?> x/menit<br>
                3. Suhu : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Suhu?> C<br>
                4. Frekuensi nafas : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->FrekuensiNafas?> x/menit<br>
                5. Skor Nyeri : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->SkorNyeri?><br>
                6. Skala resiko jatuh : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->SkorJatuh?><br>
            </td>
            <td>
                1. Berat badan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->BeratBadan?><br>
                2. Tinggi badan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->TinggiBadan?><br>
                3. Lingkar kepala : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->LingkarKepala?><br>
                4. IMT : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->IMT?><br>
                5. Lingkar lengan atas : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->LingkaranLenganAtas?><br>
                *khusus pediatri<br>
            </td>
            <td>
                1. Alat bantu : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->AlatBantu?><br>
                2. Protesa : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Prothesa?><br>
                3. ADL : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->ADL?><br>
            </td>
            <td>
                <br><br><br><br><br>
                <?php echo $record2[0]->NamaDokter?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Pendidikan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Pendidikan?><br>
                Pekerjaan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Pekerjaan?><br>
                Agama kepercayaan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Agama?><br>
                Nilai-nilai yang dianut : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->NilaiAnut?><br>
                Status pernikahan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->StatusPernikahan?><br>
                Keluarga : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Keluarga?><br>
                Tempat tinggal : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->TempatTinggal?><br>
                Status piskologis : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->StatusPsikologi?><br>
                Hambatan edukasi : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->HambatanEdukasi?><br>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                Riwayat penyakit dahulu : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->RiwayatPenyakitDahulu?><br>
                Alergi : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Alergi?><br>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Status Obsetri : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->StatusObstetri?><br>
                Keterangan Obstetri/Ginekologi/Laktasi/KB : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Ket_Obstetri_Ginekologi_Laktasi_KB?><br>
            </td><td colspan="2">
                HPHT : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->HPTT?><br>
                TP : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->TP?><br>
            </td>
        </tr>
        <tr>
            <td colspan=4><b>II. Pengkajian Medis</b></td>
        </tr>
        <tr>
            <td rowspan="4" colspan="2">
                Amnesis (S) : <br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->Anamnesis?>
                <br>
                Pemeriksaan Fisik (O) : <br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->Anamnesis?>
                
            </td>
            <td>
                Rencana dan Terapi (P) : <br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->RencanaDanTerapi?>
            </td>
            <td>
                Kode ICD 9 CM : <br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->KodeICD10?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                Edukasi :<br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->Edukasi?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                Penyakit menular : <br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->PenyakitMenular?>
            </td>
        </tr>
        <tr>
            <td colspan=2>
                Dirujuk / konsul ke : <br>
                --------------------
            </td>
        </tr>
        <tr>
            <td>
                Diagnosa : <br>    
                Komplikasi : <br>
                Komorbid : 
            </td>
        </tr>
        <tr>
            <td>
                ttdd
            </td>
        </tr>
        <tr>
            <td>
                ttdd
            </td>
        </tr>
    </table>
</body>
</html>
