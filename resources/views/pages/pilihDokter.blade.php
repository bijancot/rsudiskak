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
                <a class="capsule-btn active" style="border-radius: 24px 24px 24px 24px;" href="#">Pilih Dokter</a>

            </div>
            
            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h5">Pilih Dokter No CM '{{ $no_cm }}'</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-12">
                        <form method="POST" action="{{ url('/pilihDokter\/') }}{{ $no_cm }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="pil_dokter">Pilih Dokter</label>
                                    <select name="dokter" class="custom-select" id="pil_dokter">
                                        <option selected>Pilih Dokter</option>
                                        @foreach ($listDokter['data'] as $item)
                                            <option value="{{ $item['KodeDokter'] }}"> {{ $item['NamaDokter'] }} </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="no_cm" value="{{ $no_cm }}">
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
            $('#msg_modal').html('Pilih Dokter Berhasil');
        })
    </script>
@endsection