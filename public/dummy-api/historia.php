    <?php
    $json = array(
        'meta' => array('code' => "200", 'description' => "success"),
        'response' => array(
            'data' => array(array('no_pendaftaran' => '1603100117', 'no_rm' => '11608050', 'nama' => 'MUJIATIN', 'jk' => 'Perempuan', 'umur' => '64', 'kelas_pelayanan' => 'III', 'penjamin' => "BPJS", 'tanggal_masuk' => '10/03/2016')), 'first_page_url' => "string", 'from' => "1", 'last_page' => "3", 'last_page_url' => "string", 'next_page_url' => "string", 'path' => "string", 'per_page' => "20", 'prev_page_url' => NULL, 'to' => "20", 'total' => "45",
        )
    );
    header('Content-Type: application/json');
    print_r(json_encode($json));
    ?>