<nav class="navbar">
    <ul class="d-flex justify-content-center align-items-center flex-row">
        
        <li class="{{ Request::is('logActivities') ? 'active' : '' }} nav-item"><a href="{{ url('logActivities') }}">Log Activities</a></li>
        <li class="{{ Request::is('managementForm') ? 'active' : '' }} nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Management Form</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('m_pendidikan') }}">Pendidikan</a>
                <a class="dropdown-item" href="{{ url('m_pekerjaan') }}">Pekerjaan</a>
                <a class="dropdown-item" href="{{ url('m_agama') }}">Agama</a>
                <a class="dropdown-item" href="{{ url('m_nilaiAnut') }}">Nilai - nilai yang dianut</a>
                <a class="dropdown-item" href="{{ url('m_statusPernikahan') }}">Status Pernikahan</a>
                <a class="dropdown-item" href="{{ url('m_keluarga') }}">Keluarga</a>
                <a class="dropdown-item" href="{{ url('m_tempatTinggal') }}">Tempat Tinggal</a>
                <a class="dropdown-item" href="{{ url('m_statusPsikologi') }}">Status Psikologi</a>
                <a class="dropdown-item" href="{{ url('m_hambatanEdukasi') }}">Hambatan Edukasi</a>
                <a class="dropdown-item" href="{{ url('manajemen_form') }}">Manajemen Form</a>
            </div>
        </li>
        <li class="{{ Request::is('managementUser') ? 'active' : '' }} nav-item"><a href="{{ url('managementUser') }}">Management User</a></li>
        {{-- <li class="{{ Request::is('historicalList') ? 'active' : '' }} nav-item"><a href="{{ url('historicalList') }}">Historical List</a></li> --}}
        <li class="{{ Request::is('uploadFile') ? 'active' : '' }} nav-item"><a href="{{ url('uploadFile') }}">Upload File</a></li>
        
        <li class="profile d-flex flex-row align-items-center nav-item">
                     
                <img src="{{URL::asset('/img/d.png')}}" alt="Profile picture"/>
            
            
            <p>{{ Auth::user()->NamaLengkap }}</p>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#modal_logout">
                    Logout
                </a>
                      
            </div>       
        </li>

        <!-- mobile view -->

        <li class="mr-auto nav-item-sm"><button class="menu-btn" id="menu-btn"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z" /></svg></button></li>
        <li class="nav-item-sm">(Nama Page)</li>
        <li class="ml-auto search nav-item-sm"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg></li>      
    </ul>
</nav>
<div class="side-navbar"> <!--NAVBAR KIRI MOBILE-->
    <div class="nav">
        <img class="logo" src="{{URL::asset('/img/logo-3.png')}}" alt="logo" width="266px" class="mx-auto logo">
        <hr>
        <div class="profile d-flex flex-row align-items-center nav-item">     
               
                <img src="{{URL::asset('/img/d.png')}}" alt="Profile picture"/>
            
            
            <p>ASD</p>
       
        </div>
        <hr>

        <a class="{{ Request::is('logActivities') ? 'active' : '' }} nav-item" href="{{ url('logActivities') }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M18,19H6V17.6C6,15.6 10,14.5 12,14.5C14,14.5 18,15.6 18,17.6M12,7A3,3 0 0,1 15,10A3,3 0 0,1 12,13A3,3 0 0,1 9,10A3,3 0 0,1 12,7M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M19,3H14.82C14.4,1.84 13.3,1 12,1C10.7,1 9.6,1.84 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3Z" /></svg>Log Activities</a>
        <a class="{{ Request::is('managementUser') ? 'active' : '' }} nav-item" href="{{ url('managementUser') }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z" /></svg>Management User</a>
        <a class="{{ Request::is('historicalList') ? 'active' : '' }} nav-item"  href="{{ url('historicalList') }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M19,3H14.82C14.4,1.84 13.3,1 12,1C10.7,1 9.6,1.84 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3Z" /></svg>Historical List</a>
        <a class="{{ Request::is('uploadFile') ? 'active' : '' }} nav-item"  href="{{ url('uploadFile') }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M19,3H14.82C14.4,1.84 13.3,1 12,1C10.7,1 9.6,1.84 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3Z" /></svg>Upload File</a>
        <hr class="mt-auto">
        <a class="dropdown-item nav-item text-center font-weight-bold" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>  
    </div>
    <div id="blocker"></div>
</div>
<!-- modal batal periksa -->
<div class="modal fade" id="modal_logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white text-center">Logout</h5>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Apakah ingin keluar aplikasi?</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-dark diagnosa">Ya</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>



