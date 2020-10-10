@extends('layouts.layout')

@section('content')

    @include('includes.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">

            @include('includes.subNavbar')
            
            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h5">Pilih Dokter No CM '{{$no_cm}}'</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-12">
                        <form method="POST" action="{{action('DiagnosaController@InsertPilihDokter')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <label for="pil_dokter">Pilih Dokter</label>
                                    <select name="pil_dokter" class="custom-select">
                                        <option selected>Pilih Dokter</option>
                                    </select>
                                    <input type="hidden" value="{{$no_cm}}">
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