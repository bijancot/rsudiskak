@extends('layouts.layout')

@section('content')

    @include('includes.admin.navbar')

    <div class="bg-greenishwhite">
        <div class="wrapper">
            
            <div class="content soft-shadow">
                <div class="p-3">
                    <p class="h5">Submit Data</p>
                </div>
                <hr>
                <div class="row p-3 py-4">
                    <div class="col-12">
                        <form method="POST" action="">
                            
                            <div class="row">
                                <div class="col-12">
                                    <label for="submit_data">No Rekam Medis</label>
                                    <select name="dokter" class="custom-select" id="submit_data">
                                        <option selected>Pilih Dokter</option>
                                        
                                    </select>
                                    <input type="hidden" name="no_cm" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-5">
                            <button type="submit" class="btn green-long m-0" data-toggle="modal" data-target="#modal_success">Submit</button>
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