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

?>
<div class="float-right" style="font-size:12px;">RM 02 a</div> <br>&nbsp;<br>
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
            <p style="font-size:10px">Nama Pasien : {{ $listRiwayat['NamaLengkap']}}</p>
                <p style="font-size:10px">Jenis Kelamin : {{ $listRiwayat['JenisKelamin'] == "L" ? "Laki - Laki" : "Perempuan" }}</p>
                <p style="font-size:10px">Ruang/Kelas : {{ $listRiwayat['Ruangan']}}</p>
            </td>
            <td colspan=3>
                <p style="font-size:10px">No. RM : {{ $listRiwayat['NoCM']}}</p>
                <p style="font-size:10px">Tgl Lahir : <?php echo date('d F Y', $TglLahir); ?> / {{ $listRiwayat['Umur']}}</p>
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
                1. Tekanan darah : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['TekananDarah']}} mmHg<br>
                2. Frekuensi nadi : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['FrekuensiNadi']}} x/menit<br>
                3. Suhu : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Suhu']}} C<br>
                4. Frekuensi nafas : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['FrekuensiNafas']}} x/menit<br>
                5. Skor Nyeri : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorNyeri']}}<br>
                6. Skala resiko jatuh : <br>
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorJatuh']=="rendah" ? 'checked' : '');?>> Rendah &nbsp;
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorJatuh']=="sedang" ? 'checked' : '');?>> Sedang &nbsp;
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['SkorJatuh']=="tinggi   " ? 'checked' : '');?>> Tinggi &nbsp;
                <br>
            </td>
            <td colspan=2>
                1. Berat badan : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['BeratBadan']}}<br>
                2. Tinggi badan : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['TinggiBadan']}}<br>
                3. Lingkar kepala : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['LingkarKepala']}}<br>
                4. IMT : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['IMT']}}<br>
                5. Lingkar lengan atas : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['LingkaranLenganAtas']}}<br>
                *khusus pediatri<br>
            </td>
            <td colspan=2>
                1. Alat bantu : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['AlatBantu']}}<br>
                2. Protesa : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Prothesa']}}<br>
                3. ADL : <br>
                <input type="checkbox"  <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['ADL']=="mandiri" ? 'checked' : '');?>> Mandiri &nbsp;
                <input type="checkbox" <?php echo ($listRiwayat['DataPengkajian']['PengkajianKeperawatan']['ADL']="dibantu" ? 'checked' : '');?>> Dibantu &nbsp;
                
            </td>
            <td style="text-align:center" colspan=2>
                <br><br><br><br><br>
                {{-- ------------- --}}
                {{$listRiwayat['NamaPerawat']}}
            </td>
        </tr>
        <tr>
            <td colspan="8">
                Pendidikan : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Pendidikan']}}<br>
                Pekerjaan : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Pekerjaan']}}<br>
                Agama kepercayaan : 
                @foreach ($agama as $item)
                    <input type="checkbox" {{ $listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Agama'] == $item['Agama'] ? 'checked' : ''}}> {{ $item['Agama'] }} &nbsp;
                @endforeach
                
                <br>
                Nilai-nilai yang dianut : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['NilaiAnut']}}<br>
                Status pernikahan :
                @foreach ($statusPernikahan as $item)
                    <input type="checkbox" {{ $listRiwayat['DataPengkajian']['PengkajianKeperawatan']['StatusPernikahan'] == $item['StatusPernikahan'] ? 'checked' : ''}}> {{ $item['StatusPernikahan'] }} &nbsp;
                @endforeach
                <br>
                Keluarga : 
                @foreach ($keluarga as $item)
                    <input type="checkbox" {{ $listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Keluarga'] == $item['Keluarga'] ? 'checked' : ''}}> {{ $item['Keluarga'] }} &nbsp;
                @endforeach
                <br>
                Tempat tinggal :
                @foreach ($tempatTinggal as $item)
                    <input type="checkbox" {{ $listRiwayat['DataPengkajian']['PengkajianKeperawatan']['TempatTinggal'] == $item['TempatTinggal'] ? 'checked' : ''}}> {{ $item['TempatTinggal'] }} &nbsp;
                @endforeach
                <br>
                Status piskologis : 
                @foreach ($statusPsikologi as $item)
                    <input type="checkbox" {{ $listRiwayat['DataPengkajian']['PengkajianKeperawatan']['StatusPsikologi'] == $item['StatusPsikologi'] ? 'checked' : ''}}> {{ $item['StatusPsikologi'] }} &nbsp;
                @endforeach
                <br>
                Hambatan edukasi : 
                @foreach ($hambatanEdukasi as $item)
                    <input type="checkbox" {{ $listRiwayat['DataPengkajian']['PengkajianKeperawatan']['HambatanEdukasi'] == $item['HambatanEdukasi'] ? 'checked' : ''}}> {{ $item['HambatanEdukasi'] }} &nbsp;
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan="8">
                Riwayat penyakit dahulu : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['RiwayatPenyakitDahulu']}}<br>
                Alergi : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['RiwayatPenyakitDahulu']}}<br>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                Status Obsetri : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['StatusObstetri']}}<br>
                Keterangan Obstetri/Ginekologi/Laktasi/KB : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['Ket_Obstetri_Ginekologi_Laktasi_KB']}}<br>
            </td>
            <td colspan="2">
                HPHT : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['HPTT']}}<br>
                TP : {{$listRiwayat['DataPengkajian']['PengkajianKeperawatan']['TP']}}<br>
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
                    if(isset($listRiwayat['DataPengkajian']['PengkajianMedis']['KodeICD10']['KodeDiagnosaT'])){
                        $ICD9 = $listRiwayat['DataPengkajian']['PengkajianMedis']['KodeICD10']['KodeDiagnosaT'];
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
            <td style="text-align:center" colspan=2>{{$listRiwayat['NamaDokter']}}</td>
        </tr>
    </table>
</body>
</html>
