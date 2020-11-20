<nav class="navbar">
    <ul class="d-flex justify-content-center align-items-center flex-row">
        <li class="nav-item" style="left: 0;position:absolute;font-weight:bold;">{{Auth::user()->NamaRuangan}}</li>
        <li class="{{ Request::is('listPasien') ? 'active' : '' }} nav-item"><a href="{{ url('listPasien') }}">Periksa</a></li>
        <li class="{{ Request::is('riwayatPasien') ? 'active' : '' }} nav-item"><a href="{{ url('riwayatPasien') }}">Riwayat</a></li>
        <li class="profile d-flex flex-row align-items-center nav-item">
            <div class="profile d-flex flex-row align-items-center nav-item" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::user()->Role =='001')         
                    <img src="{{URL::asset('/img/d.png')}}" alt="Profile picture"/>
                @elseif (Auth::user()->Role =='002')
                    <img src="{{URL::asset('/img/p.png')}}" alt="Profile picture"/>
                @endif
                
                <p>{{ Auth::user()->Nama }}</p>
                <a class="nav-link dropdown-toggle" href="#" >
                
                </a>
            </div>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{url('m_user/ubahPassword')}}">
                    Ubah Password
                </a>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modal_logout">
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
            @if(Auth::user()->Role =='001')         
                <img src="{{URL::asset('/img/d.png')}}" alt="Profile picture"/>
            @elseif (Auth::user()->Role =='002')
                <img src="{{URL::asset('/img/p.png')}}" alt="Profile picture"/>
            @endif
            
            <p>{{ Auth::user()->Nama }}</p>
       
        </div>
        <hr>
        <a class="{{ Request::is('listPasien') ? 'active' : '' }} nav-item" href="{{ url('listPasien') }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M18,19H6V17.6C6,15.6 10,14.5 12,14.5C14,14.5 18,15.6 18,17.6M12,7A3,3 0 0,1 15,10A3,3 0 0,1 12,13A3,3 0 0,1 9,10A3,3 0 0,1 12,7M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M19,3H14.82C14.4,1.84 13.3,1 12,1C10.7,1 9.6,1.84 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3Z" /></svg>Periksa</a>
        {{-- <a class="{{ Request::is('listPasienKirimPoli') ? 'active' : '' }} nav-item" href="{{ url('listPasienKirimPoli') }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M2,21L23,12L2,3V10L17,12L2,14V21Z" /></svg>Kirim Poli Lain</a>
        <a class="{{ Request::is('listPasienHasilLab') ? 'active' : '' }} nav-item" href="{{ url('listPasienHasilLab') }}"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M19,3H14.82C14.4,1.84 13.3,1 12,1C10.7,1 9.6,1.84 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3Z" /></svg>Hasil Lab</a> --}}
        <hr class="mt-auto">
        <a class="dropdown-item nav-item text-center font-weight-bold" href="{{url('m_user/ubahPassword')}}">
            Ubah Password
        </a>
        <a href="#" data-toggle="modal" data-target="#modal_logout" class="dropdown-item nav-item text-center font-weight-bold">
            Logout
        </a>
         
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
                <form id="logout-form" action="{{ url('signOut') }}" method="POST" >
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
