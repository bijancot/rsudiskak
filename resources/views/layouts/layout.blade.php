<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RSUD</title>

        <!-- main css  -->
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />

        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>


        <!-- bootstrap multiselect  -->
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap-multiselect.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-multiselect.css') }}" />

    </head>
    <body>
        
        <div class="bg-white">
            @yield ('content')
        </div>

        <script>
            $(document).ready(function() {
                $('#multiselect').multiselect();
            });
            $(document).ready(function() {
                $('#example').multiselect({
                    templates: {
                        button: '<button type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"></button>',
                        ul: '<ul class="multiselect-container dropdown-menu"></ul>',
                        filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
                        filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span>',
                        li: '<li><a href="javascript:void(0);"><label></label></a></li>',
                        divider: '<li class="multiselect-item divider"></li>',
                        liGroup: '<li class="multiselect-item group"><label class="multiselect-group"></label></li>'
                    }
                });
            });
        </script>
        
    </body>
</html>
