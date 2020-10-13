<nav class="navbar">
    <ul class="d-flex justify-content-center align-items-center flex-row">
        <li class="{{ Request::is('listPasien') ? 'active' : '' }}"><a href="{{ url('listPasien') }}">Periksa</a></li>
        <li class="{{ Request::is('listPasienKirimPoli') ? 'active' : '' }}"><a href="{{ url('listPasienKirimPoli') }}">Kirim Poli Lain</a></li>
        <li class="{{ Request::is('listPasienHasilLab') ? 'active' : '' }}"><a href="{{ url('listPasienHasilLab') }}">Hasil Lab</a></li>
        <li class="profile d-flex flex-row align-items-center">
            @if(Auth::user()->KdJabatan =='1')         
                <img src="{{URL::asset('/img/d.png')}}" alt="Profile picture"/>
            @elseif (Auth::user()->KdJabatan =='2')
                <img src="{{URL::asset('/img/p.png')}}" alt="Profile picture"/>
            @endif
            <p>{{ Auth::user()->NamaLengkap }}</p>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form"  action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>       
            </div>        
        </li>
    </ul>
</nav>