    <?php
    $json = array(
        'meta' => array('code' => "200", 'description' => "success"),
        'response' => array(
            'data' => array(array('nama_obat' => 'Furosemide', 'dosis' => '40', 'qty' => '30', 'keterangan' => ''), array('nama_obat' => 'Captopril', 'dosis' => '12.5', 'qty' => '90', 'keterangan' => 'Yuhuu')), 'first_page_url' => "string", 'from' => "1", 'last_page' => "3", 'last_page_url' => "string", 'next_page_url' => "string", 'path' => "string", 'per_page' => "20", 'prev_page_url' => NULL, 'to' => "20", 'total' => "45",
        )
    );
    header('Content-Type: application/json');
    print_r(json_encode($json));
    ?>