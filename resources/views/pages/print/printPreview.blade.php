<html>
    <head>
        <title>Riwayat Pasien</title>
    </head>
    <style type=text/css>
        body{
            margin: 0px;
            padding: 0px;
        }
    </style>
    <body>
        <embed src="{{ URL::asset('dokumenRM/') }}/{{$NoCM}}/{{$NoPendaftaran.'_'.$TglMasukPoli.'.pdf'}}" width="100%" height="100%" />
    </body>
</html>