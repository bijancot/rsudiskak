    <?php
    $json = array(
        'meta' => array('code' => "200", 'description' => "success"),
        'response' => array(
            'data' => array(array('NoCM' => '11608050', 'Nourut' => '010', 'NoPendaftaran' => '1603100117', 'TglMasuk' => '2016-03-10 00:00:00', 'TglWaktuMasukPoli' => '2021-03-04 21:09:32', 'TglMasukPoli' => '2021-03-04', 'WaktuMasukPoli' => '21:09:32', 'jenisPasien' => 'BPJS', 'Ruangan' => 'POLI JANTUNG', 'KdRuangan' => '215', 'KdSubInstalasi' => '032', 'StatusPasien' => 'Baru', 'KdKelas' => '01', 'Kelas' => 'Kelas III', 'StatusPeriksa' => 'belum', 'IdPenjamin' => '0000000002', 'IdDokter' => 'strange', 'NamaDokter' => 'Dr Strange', 'IdPerawat' => 'perawat_wati', 'NamaPerawat' => 'PERAWAT WATI', 'KdInstalasi' => '02', 'KodeReservasi' => null, 'Status' => null, 'NoIdentitas' => null, 'TglDaftarMembership' => '2015-12-17 00:00:00.000', 'Title' => 'Ny.', 'NamaLengkap' => 'MUJIATIN', 'TempatLahir' => 'TA', 'TglLahir' => '1957-01-01 00:00:00.000', 'JenisKelamin' => 'P', 'Alamat' => 'NGRUKEM, PULOTONDO', 'Telepon' => null, 'NamaIbu' => null, 'Umur' => '64 th 2  bl 3  hr', 'UmurTahun' => '64', 'UmurBulan' => '2', 'UmurHari' => '3', 'Kelurahan' => 'PULOTONDO', 'Kecamatan' => 'NGUNUT', 'Kota' => 'KABUPATEN TULUNGAGUNG', 'NoCmTemp' => null, 'NoCmOld' => '0716516', 'NamaAyah' => null, 'NoKK' => null, 'NamaSuamiIstri' => null, 'Propinsi' => 'JAWA TIMUR', 'RTRW' => '03/02', 'StatusPengkajian' => '1', 'IdFormPengkajian' => '1', 'DataPengkajian' => array('PengkajianKeperawatan' => array('Pendidikan' => 'SD', 'Pekerjaan' => 'Lain - lain', 'Agama' => 'Islam', 'NilaiAnut' => 'Budi Pekerti yang baik', 'StatusPernikahan' => 'Menikah', 'Keluarga' => 'Tinggal serumah', 'TempatTinggal' => 'Rumah', 'StatusPsikologi' => 'Depresi', 'HambatanEdukasi' => 'Gangguan Pendengaran', 'TekananDarah' => array('Sistolik' => '1', 'Diastolik' => '1'), 'FrekuensiNadi' => '1', 'Suhu' => '1', 'FrekuensiNafas' => '1', 'SkorNyeri' => '1', 'SkorJatuh' => 'rendah', 'BeratBadan' => '1', 'TinggiBadan' => '1', 'LingkarKepala' => '1', 'IMT' => '1', 'LingkaranLenganAtas' => '1', 'AlatBantu' => '1', 'Prothesa' => '1', 'ADL' => 'mandiri', 'RiwayatPenyakitDahulu' => '1', 'Alergi' => '1', 'StatusObstetri' => '1', 'HPTT' => '1', 'TP' => '1', 'Ket_Obstetri_Ginekologi_Laktasi_KB' => '1'), 'PengkajianMedis' => array('Anamnesis' => '1', 'PemeriksaanFisik' => '1', 'Diagnosa' => array('KodeDiagnosa' => 'A044 ;A020 ;E100', 'NamaDiagnosa' => 'Other intestinal Escherichia coli infections;Salmonella enteritis;Insulin-dependent diabetes mellitus with coma'), 'Diagnosa(A)' => '1', 'Komplikasi' => '1', 'Komorbid' => '1', 'RencanaDanTerapi' => '1', 'Edukasi' => '1', 'PenyakitMenular' => '1', 'KesanStatusGizi' => 'kurang')), 'updated_at' => null, 'deleted_at' => null, 'created_at' => array('$date' => '2021-03-04T14:09:34.000Z')), array()), 'first_page_url' => "string", 'from' => "1", 'last_page' => "3", 'last_page_url' => "string", 'next_page_url' => "string", 'path' => "string", 'per_page' => "20", 'prev_page_url' => NULL, 'to' => "20", 'total' => "45",
        )
    );
    header('Content-Type: application/json');
    print_r(json_encode($json));
    ?>