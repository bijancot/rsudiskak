
<div class="d-flex align-items-center mb-5">
    <a href="{{ url()->previous() }}" class="mr-auto">
        <span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
            Kembali
        </span>
    </a>
    <a class="capsule-btn secondary" href="{{ url('dataPasien') }}">Data Pasien</a>
    <a class="capsule-btn active" href="{{ url('diagnosaAkhir') }}">Diagnosa Akhir</a>
    <a class="capsule-btn" href="{{ url('riwayat') }}">Riwayat</a>
</div>
