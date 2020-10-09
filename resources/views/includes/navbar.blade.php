<nav class="navbar">
    <ul class="d-flex justify-content-center align-items-center flex-row">
        <li class="{{ Request::is('listPasien') ? 'active' : '' }}"><a href="{{ url('listPasien') }}">Periksa</a></li>
        <li class="{{ Request::is('listPasienKirimPoli') ? 'active' : '' }}"><a href="{{ url('listPasienKirimPoli') }}">Kirim Poli Lain</a></li>
        <li class="{{ Request::is('listPasienHasilLab') ? 'active' : '' }}"><a href="{{ url('listPasienHasilLab') }}">Hasil Lab</a></li>
        <li class="profile d-flex flex-row align-items-center">
            <img src="{{URL::asset('/img/1.png')}}" alt="Profile picture">
            <p>{{ Auth::user()->namadokter }}</p>
            <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>            
            <span><svg width="32" height="32" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.66675 6.66663L8.00008 9.99996L11.3334 6.66663H4.66675Z" fill="white"/></svg></span>
        </li>
    </ul>
</nav>
