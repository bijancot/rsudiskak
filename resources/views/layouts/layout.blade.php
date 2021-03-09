<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>RSUD</title>

        <!-- logo title -->
        <link rel="icon" href="{{URL::asset('/img/logo-min.png')}}" type="image/x-icon"> 

        <!-- main css  -->
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" />

        <!-- Font Material  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Font Awesome  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.3/umd/popper.min.js" integrity="sha512-53CQcu9ciJDlqhK7UD8dZZ+TF2PFGZrOngEYM/8qucuQba+a+BXOIRsp9PoMNJI3ZeLMVNIxIfZLbG/CdHI5PA==" crossorigin="anonymous"></script>

        <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
        <!-- DataTable -->
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

        <!-- Jquery-ui -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css" integrity="sha512-okE4owXD0kfXzgVXBzCDIiSSlpXn3tJbNodngsTnIYPJWjuYhtJ+qMoc0+WUwLHeOwns0wm57Ka903FqQKM1sA==" crossorigin="anonymous" />
        
        <!-- DatePicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

        <!-- bootstrap multiselect  -->
        <script type="text/javascript" src="{{ URL::asset('js/bootstrap-multiselect.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-multiselect.css') }}" />
        
        <!-- bootstrap slider  -->
        <script type="text/javascript" src="{{ URL::asset('js/BootSideMenu.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('css/BootSideMenu.css') }}" />

        <!-- Tags Input -->
        <link rel="stylesheet" href="{{ URL::asset('css/jquery.tagsinput-revisited.css') }}"/>
        <script type="text/javascript" src="{{ URL::asset('js/jquery.tagsinput-revisited.js') }}"></script>

        <!-- Iconify -->
        <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

        {{-- toast --}}
        <link rel="stylesheet" href="{{ URL::asset('css/toast.min.css') }}" />
        <script type="text/javascript" src="{{ URL::asset('js/toast.min.js') }}"></script>
        <style>
            .dataTables_length, .dataTables_info, .dataTables_paginate, .dataTables_filter {
                padding: 20px !important;
                
            }
            .tgl {
                border-radius: 30px !important;
            }
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

            .loader-container{
                height: 100%;
                width: 100%;
                /* background: rgba(0, 0, 0, .8); */
                background: rgba(0, 0, 0, .1);
                position: fixed;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 3;
            }

            .loader {
                width: 80px;
                height: 80px;
                
                border: 5px solid;
                color: #3498db;
                border-radius: 100%;
                border-top-color: transparent;

                animation: spin 1.2s infinite linear;
            }

            @keyframes spin {
                25% {
                    color: #2ecc71;
                } 
                50% {
                    color: #f1c40f;
                } 
                75% {
                    color: #e74c3c;
                } to {
                    transform: rotate(360deg);
                }
            }

            /* #overlay{
                height: 100%;
                width: 100%;
                background: rgba(0, 0, 0, .8);
                position: fixed;
                left: 0;
                top: 0;
            } */
            .isValid{
                border-color: #009241 !important;
                padding-right: calc(1.6em + 0.75rem) !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%23009241' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") !important;
                background-repeat: no-repeat !important;
                background-position: right calc(0.4em + 0.1875rem) center !important;
                background-size: calc(0.8em + 0.375rem) calc(0.8em + 0.375rem) !important;
            }
            .isValid:focus{
                border-color: #009241 !important;
                box-shadow: 0 0 0 0.2rem rgba(0, 146, 65, 0.25) !important;
            }
            .isValid-feedback{
                display: none;
                width: 100%;
                margin-top: 0.25rem;
                font-size: 80%;
                color: #009241;
            }

            .isInValid {
                border-color: #EB5757 !important;
                padding-right: calc(1.6em + 0.75rem) !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23EB5757' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23EB5757' stroke='none'/%3e%3c/svg%3e") !important;
                background-repeat: no-repeat !important;
                background-position: right calc(0.4em + 0.1875rem) center !important;
                background-size: calc(0.8em + 0.375rem) calc(0.8em + 0.375rem) !important;
            }
            .isInValid:focus{
                border-color: #EB5757 !important;
                box-shadow: 0 0 0 0.2rem rgba(235, 87, 87, 0.25) !important;
            }
            .isInvalid-feedback{
                display: none;
                width: 100%;
                margin-top: 0.25rem;
                font-size: 80%;
                color: #EB5757;
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
                        <p> <span id="msg_modal"></span><br></p>
                        <button type="button" class="btn green-long" data-dismiss="modal">Oke</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal_gagal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title text-white font-weight-bold">Gagal Menambahkan data</h5>
                        <!-- <button type="button bg-white" class="close" data-dismiss="modal" aria-label="Close"> -->
                        {{-- <span aria-hidden="true">&times;</span> --}}
                        <!-- </button> -->
                    </div>
                    <div class="modal-body text-center">
                        <span class="my-4 ">
                            <i class="fas fa-times" style="color: #ff0000; font-size:100px;"></i>
                            
                        </span>
                        <p class="text-center"> <span id="msg_modal1"></span><br></p>
                        <!-- <p>Modal body text goes here.</p> -->
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn form-control btn-danger btn-lg" data-dismiss="modal">Oke</button>
                    </div>
                    <!-- <div class="d-flex flex-column justify-content-center text-center"> -->
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Oke</button> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>

        {{-- Modal Pratinjau --}}
        <div class="modal fade" id="modal_pratinjau" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Pratinjau Data '<span id="title-pratinjau"></span>' </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col">
                        <iframe id="pratinjauDokumen" src="" frameborder="0" width="100%" height="500px"></iframe>
                    </div>
                </div>
                <form id="form-unduh" action="{{action('DokumenController@download')}}" method="POST">
                    @csrf
                    <div class="modal-footer">
                        <input type="hidden" name="PathFile" id="pathFile_pratinjau">
                        <button class="btn btn-dark diagnosa">Unduh</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    {{-- End Modal Pratinjau --}}
        <!-- end of tempat modal -->
        
        <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

        
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
