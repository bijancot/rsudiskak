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
                <p style="font-size:11px">Nama Pasien : <?php echo $record2[0]->NamaLengkap; ?></p>
                <p style="font-size:11px">Jenis Kelamin : <?php echo $record2[0]->JenisKelamin; ?></p>
                <p style="font-size:11px">Ruang/Kelas : <?php echo $record2[0]->Ruangan; ?></p>
            </td>
            <td colspan=3>
                <p style="font-size:11px">No. RM : <?php echo $record2[0]->NoCM; ?></p>
                <p style="font-size:11px">Tgl Lahir : <?php echo $record2[0]->TglLahir; ?></p>
                <p style="font-size:11px">Tgl Masuk : <?php echo $record2[0]->TglMasukPoli; ?></p>
            </td>
        </tr>
        <tr>
            <td colspan=8 style="text-align: center"><b>PENGKAJIAN AWAL PASIEN RAWAT JALAN</b></td>
        </tr>
        <tr>
            <td colspan=6><b>I. Pengkajian Keperawatan</b></td>
            <td colspan=2>Jam: -------</td>
        </tr>
        <tr>
            <td colspan=2 style="text-align: center">Tanda Vital</td>
            <td colspan=2 style="text-align: center">Antroprometri</td>
            <td colspan=2 style="text-align: center">Fungsional</td>
            <td colspan=2 style="text-align: center">Perawat/Terapis</td>
        </tr>
        <tr>
            <td colspan=2>
                1. Tekanan darah : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->TekananDarah?> mmHg<br>
                2. Frekuensi nadi : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->FrekuensiNadi?> x/menit<br>
                3. Suhu : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Suhu?> C<br>
                4. Frekuensi nafas : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->FrekuensiNafas?> x/menit<br>
                5. Skor Nyeri : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->SkorNyeri?><br>
                6. Skala resiko jatuh : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->SkorJatuh?><br>
            </td>
            <td colspan=2>
                1. Berat badan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->BeratBadan?><br>
                2. Tinggi badan : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->TinggiBadan?><br>
                3. Lingkar kepala : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->LingkarKepala?><br>
                4. IMT : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->IMT?><br>
                5. Lingkar lengan atas : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->LingkaranLenganAtas?><br>
                *khusus pediatri<br>
            </td>
            <td colspan=2>
                1. Alat bantu : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->AlatBantu?><br>
                2. Protesa : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Prothesa?><br>
                3. ADL : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->ADL?><br>
            </td>
            <td style="text-align:center" colspan=2>
                <br><br><br><br><br>
                <?php echo $record2[0]->NamaDokter?>
            </td>
        </tr>
        <tr>
            <td colspan="8">
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
            <td colspan="8">
                Riwayat penyakit dahulu : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->RiwayatPenyakitDahulu?><br>
                Alergi : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Alergi?><br>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                Status Obsetri : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->StatusObstetri?><br>
                Keterangan Obstetri/Ginekologi/Laktasi/KB : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->Ket_Obstetri_Ginekologi_Laktasi_KB?><br>
            </td>
            <td colspan="2">
                HPHT : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->HPTT?><br>
                TP : <?php echo $record2[0]->DataPengkajian[0]->PengkajianKeperawatan_1->TP?><br>
            </td>
        </tr>
        <tr>
            <td colspan=8><b>II. Pengkajian Medis</b></td>
        </tr>
        <tr>
            <td rowspan="4" colspan="6">
                Amnesis (S) : <br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->Anamnesis?>
                <br><br>
                Pemeriksaan Fisik (O) : <br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->Anamnesis?>
                
            </td>
            <td>
                Rencana dan Terapi(P)<br>
                <?php echo $record2[0]->DataPengkajian[1]->PengkajianKeperawatan_2->RencanaDanTerapi?>
            </td>
            <td>
                Kode ICD 9 CM<br>
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
            <td colspan=3>
                Diagnosa : <br>    
                Komplikasi : <br>
                Komorbid : 
            </td>
            <td colspan=3>
                Kode ICD 10 CM : <br>
            </td>
            <td colspan=2>
                Kesan Status Gizi : <br>
            </td>
        </tr>
        <tr>
            <td colspan=2 style="text-align:center">Telah Direvifikasi</td>
            <td colspan=2 style="text-align:center">Telah Dikode</td>
            <td colspan=2 style="text-align:center">Legalisasi Severity</td>
            <td colspan=2 rowspan=3 style="text-align:center">
                Tulungagung, -- -- -- Jam : -- -- --<br>
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
            <td>&nbsp;<br>&nbsp;<br></td>
            <td><br></td>
            <td><br></td>
            <td><br></td>
            <td colspan=2><br></td>
        </tr>
        <tr>
            <td colspan=6></td>
            <td style="text-align:center" colspan=2>Nama Dokter</td>
        </tr>
    </table>
</body>
</html>
