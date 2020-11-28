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
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkorJatuh=="sedang" ? 'checked' : '');?>> Sedang &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkorJatuh=="tinggi" ? 'checked' : '');?>> Tinggi &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->SkorJatuh=="rendah" ? 'checked' : '');?>> Rendah &nbsp;
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
                <input type="checkbox"  <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->ADL=="mandiri" ? 'checked' : '');?>> Mandiri &nbsp;
                <input type="checkbox" <?php echo ($record2[0]->DataPengkajian->PengkajianKeperawatan->ADL=="dibantu" ? 'checked' : '');?>> Dibantu &nbsp;
                
            </td>
            <td style="text-align:center" colspan=2>
                <br><br><br><br><br>
                {{-- ------------- --}}
                {{ $record2[0]->NamaPerawat }}
            </td>
        </tr>
        <tr>
            <td colspan="8">
                Pendidikan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Pendidikan?><br>
                Pekerjaan : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->Pekerjaan?><br>
                Agama kepercayaan : 
                @foreach ($agama as $item)
                    <input type="checkbox" {{ $record2[0]->DataPengkajian->PengkajianKeperawatan->Agama == $item['Agama'] ? 'checked' : ''}};> {{ $item['Agama'] }} &nbsp;
                @endforeach
                
                <br>
                Nilai-nilai yang dianut : <?php echo $record2[0]->DataPengkajian->PengkajianKeperawatan->NilaiAnut?><br>
                Status pernikahan :
                @foreach ($statusPernikahan as $item)
                    <input type="checkbox" {{ $record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPernikahan == $item['StatusPernikahan'] ? 'checked' : ''}};> {{ $item['StatusPernikahan'] }} &nbsp;
                @endforeach
                <br>
                Keluarga : 
                @foreach ($keluarga as $item)
                    <input type="checkbox" {{ $record2[0]->DataPengkajian->PengkajianKeperawatan->Keluarga == $item['Keluarga'] ? 'checked' : ''}};> {{ $item['Keluarga'] }} &nbsp;
                @endforeach
                <br>
                Tempat tinggal :
                @foreach ($tempatTinggal as $item)
                    <input type="checkbox" {{ $record2[0]->DataPengkajian->PengkajianKeperawatan->TempatTinggal == $item['TempatTinggal'] ? 'checked' : ''}};> {{ $item['TempatTinggal'] }} &nbsp;
                @endforeach
                <br>
                Status piskologis : 
                @foreach ($statusPsikologi as $item)
                    <input type="checkbox" {{ $record2[0]->DataPengkajian->PengkajianKeperawatan->StatusPsikologi == $item['StatusPsikologi'] ? 'checked' : ''}};> {{ $item['StatusPsikologi'] }} &nbsp;
                @endforeach
                <br>
                Hambatan edukasi : 
                @foreach ($hambatanEdukasi as $item)
                    <input type="checkbox" {{ $record2[0]->DataPengkajian->PengkajianKeperawatan->HambatanEdukasi == $item['HambatanEdukasi'] ? 'checked' : ''}};> {{ $item['HambatanEdukasi'] }} &nbsp;
                @endforeach
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
                <?php
                    if(isset($record2[0]->DataPengkajian->PengkajianMedis->KodeICD9->KodeDiagnosaT)){
                        $ICD9 = $record2[0]->DataPengkajian->PengkajianMedis->KodeICD9->KodeDiagnosaT;
                        $arrICD9=explode(";",$ICD9);
                        foreach($arrICD9 as $dataICD9){echo $dataICD9.'<br>';}  
                    }else{
                        echo "-";
                    }
                    
                ?>
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
            <?php
                $diagnosa = $record2[0]->DataPengkajian->PengkajianMedis->Diagnosa->NamaDiagnosa;
                $arrDiagnosa=explode(";",$diagnosa);
                
            ?> 
                Diagnosa : <br><?php foreach($arrDiagnosa as $dataDiagnosa){echo $dataDiagnosa.'<br>';}?><br>
                Komplikasi : <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Komplikasi?><br>
                Komorbid : <?php echo $record2[0]->DataPengkajian->PengkajianMedis->Komorbid?>
            </td>
            <td colspan=3>
                <?php
                    $icd10 = $record2[0]->DataPengkajian->PengkajianMedis->Diagnosa->KodeDiagnosa;
                    $arrICD10=explode(";",$icd10);
                    
                ?>
                Kode ICD 10 CM : <br><?php foreach($arrICD10 as $dataICD10){echo $dataICD10.'<br>';}?>
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
            <td rowspan="2" style="text-align:center"><?php echo date('d F Y', $TglMasuk)?>&nbsp;<br>&nbsp;<br></td>
            <td rowspan="2"><br></td>
            <td rowspan="2" style="text-align:center"><?php echo date('d F Y', $TglMasuk)?><br></td>
            <td rowspan="2"><br></td>
            <td rowspan="2" colspan=2><br></td>
        </tr>
        <tr>
            <td style="text-align:center" colspan=2><?php echo $record2[0]->NamaDokter; ?></td>
        </tr>
    </table>
</body>
</html>
