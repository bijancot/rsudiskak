    <?php
    $json = array(
        'meta' => array('code' => "200", 'description' => "success"),
        'response' => array(
            'data' => array(array('NoCM' => '11608050', 'KdRuangan' => '215', 'TglBerkunjung' => '2016-03-10 00:00:00', 'Ruangan' => 'poli jantung', 'Diagnosis' => 'CAD,HF', 'Tindakan' => 'PCI', 'VerifikasiPetugas' => '2'), array('NoCM' => '11608050', 'KdRuangan' => '215', 'TglBerkunjung' => '2016-03-10 00:00:00', 'Ruangan' => 'poli jantung', 'Diagnosis' => 'CAD,HF', 'Tindakan' => '', 'VerifikasiPetugas' => '2')), 'first_page_url' => "string", 'from' => "1", 'last_page' => "3", 'last_page_url' => "string", 'next_page_url' => "string", 'path' => "string", 'per_page' => "20", 'prev_page_url' => NULL, 'to' => "20", 'total' => "45",
        )
    );
    header('Content-Type: application/json');
    print_r(json_encode($json));
    ?>