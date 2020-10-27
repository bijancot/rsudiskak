<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>RSUD</title>

        <!-- main css  -->
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />


        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


        <!-- bootstrap multiselect  -->
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap-multiselect.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-multiselect.css') }}" />
        <style>
            .page-item.active .page-link{
                background: #009241;
                border-color: #009241;
            }
            .page-link{
                color: #009241;
            }
            .page-link:hover{
                color: #009241;
            }
        </style>
        <script>
            $(document).ready(function(){
                $("#modal_login").modal('show');
            });
        </script>

    </head>
    <body>
        
        <div class="bg-white">
            @yield ('content')
        </div>

        <!-- tempat modal -->
        <div class="modal fade" id="modal_success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content p-3">
                    <div class="d-flex flex-column justify-content-center text-center">
                        <span class="my-4">
                            <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M53.1884 4.76378C45.2787 11.6094 38.5868 18.126 32.4602 26.6282C29.7584 30.3782 26.7537 34.7919 24.7896 38.9591C23.6684 41.1688 21.6471 44.6216 20.9581 47.9413C17.1893 44.435 13.1412 40.4553 8.99931 37.3382C6.04712 35.1172 -2.456 39.6453 1.00525 42.2497C7.20868 46.9157 12.3677 52.7272 18.4015 57.6013C20.9252 59.6375 26.5184 55.2153 27.8327 53.36C32.1471 47.2475 32.7368 39.7757 35.8812 33.1082C40.6821 22.911 49.1965 14.5344 57.6031 7.26034C63.1727 2.06566 57.4202 1.10753 53.1968 4.76378" fill="#37B34A"/>
                            </svg>
                        </span>
                        <p> <span id="msg_modal"></span><br>di Submit</p>
                        <button type="button" class="btn green-long" data-dismiss="modal">Oke</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of tempat modal -->
        
        <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
        
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
