@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">

            {{-- @include('includes.subNavbar') --}}
            <div class="d-flex align-items-center mb-5">
                <a href="{{url('/listPasien')}}" class="mr-auto">
                    <span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                        Kembali
                    </span>
                </a>
                <a class="capsule-btn capsule-left secondary" href="{{ url('/dataPasien\/') }}{{ $data['NoCM'] }}">Data Pasien</a>
                <a class="capsule-btn capsule-middle active" href="{{ url('/diagnosa\/') }}{{ $data['NoCM'] }}">Diagnosa Awal</a>
                <a class="capsule-btn capsule-right" href="{{ url('/diagnosaAkhir\/') }}{{ $data['NoCM'] }}">Diagnosa Akhir</a>
            </div>
            
            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h5">Diagnosa Awal Pasien</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-lg-6 col-12">
                        <form method="POST" action="{{ action('DiagnosaController@storeDiagnosaAwal', $data['NoCM']) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 mt-3 mt-lg-0">
                                    <label for="anamnesis">Anamnesis</label>
                                    <input type="text" name="anamnesis" value="Sesak Napas, Muntah Darah 3x, BAB Hitam pekat">
                                </div>
                                <div class="col-lg-4 col-12 mt-3 mt-lg-0">
                                    <label for="tekanandarah">Tekanan Darah</label>
                                    <input type="text" name="tekanandarah" placeholder="Tekanan">
                                </div>
                                <div class="col-lg-3 pl-lg-0 col-12 mt-3 mt-lg-0">
                                    <label for="suhutubuh">Suhu Tubuh</label>
                                    <input type="text" name="suhutubuh" placeholder="Suhu">
                                </div>
                                <div class="col-lg-3 pl-0 col-10 mt-3 mt-lg-0">
                                    <label for="beratbadan">Berat Badan</label>
                                    <input type="text" name="beratbadan" placeholder="Berat">
                                </div>
                                <div class="col-lg-2 pl-lg-0 col-2 mt-3 mt-lg-0">
                                    <label class="separator">Y</label>
                                    <input type="text" name="beratbadan" value="Kg" disabled>
                                </div>
                                <div class="col-12 mt-3 mt-lg-0">
                                    <label for="pemeriksaanfisik">Pemeriksaan Fisik</label>
                                    <input type="text" name="pemeriksaanfisik" placeholder="Pemeriksaan Fisik">
                                </div>
                            </div>
                        </div>
    
                        <div class="col-lg-6 col-12">
                            <div class="row">
                                <div class="col-12 mt-3 mt-lg-0">
                                    <label for="alamat">Diagnosa</label>
                                    <select class="custom-select">
                                        <option selected>Diagnosa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3 mt-lg-0">
                                    <label for="alamat">Jenis Pelayanan</label>
                                    <select class="custom-select">
                                        <option selected>Dalam</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3 mt-lg-0">
                                    <label for="alamat">Dokter Pemeriksa</label>
                                    <select class="custom-select">
                                        <option selected>dr. Agam Putanto sp. PD</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-dark green-long m-0" data-toggle="modal" data-target="#modal_success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#msg_modal').html('Diagnosa Awal Berhasil');
        })
    </script>
@endsection
