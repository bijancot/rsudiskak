@extends('layouts.layout')

@section('content')

    @include('includes.admin.navbar')

    <div class="wrapper d-flex flex-column bg-greenishwhite">
        <a href="#" class="mr-auto">
            <span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 18L15.41 16.59L10.83 12L15.41 7.41L14 6L7.99997 12L14 18Z" fill="#00451F"/></svg>
                Kembali
            </span>
        </a>
        <a href="#" class="capsule-btn capsule-single active w-25 text-center ml-auto">capsule-single</a>
        <div class="mt-3 d-flex flex-row">
            <a href="#" class="capsule-btn capsule-left active text-center ml-auto">capsule-left</a>
            <a href="#" class="capsule-btn capsule-middle active text-center">capsule-middle</a>
            <a href="#" class="capsule-btn capsule-right active text-center">capsule-right</a>
        </div>

        <div class="content mt-3 soft-shadow collapsible">
                <div class="p-3 collapsible-head inactive">
                    <p class="h6">Click me <svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="currentColor" d="M7,10L12,15L17,10H7Z" /></svg></p>
                </div>
                <hr>
                <div class="collapsible-body">
                    <div class="p-5">
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group h-100">
                                    <label for="anamnesis">Textarea</label>
                                    <textarea class="form-control" id="anamnesis"></textarea>
                                </div>
                            </div>
                            <div class="col-6 mt-3">
                                <label for="diagnosa">Input type text</label>
                                <input type="text" name="diagnosa" value="">
                            </div>
                            <div class="pl-0 col-2 mt-3">
                                <label for="norekammedis"></label>
                                <input type="text" name="norekammedis" value="disabled" disabled>
                            </div>
                            <div class="col-8 mt-3">
                                <label for="kodeICD">Input select</label>
                                <select class="custom-select" id="kodeICD">
                                    <option selected>-</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-8 mt-3 pr-5">
                                <label for="nopendaftaran" class="pb-3">Radio Button</label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <input type="radio" id="rendah" name="skorJatuh" value="rendah" checked>
                                        <label for="rendah">Rendah</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="sedang" name="skorJatuh" value="sedang">
                                        <label for="sedang">Sedang</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="tinggi" name="skorJatuh" value="tinggi">
                                        <label for="tinggi">Tinggi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 mt-3">
                                <a href="#" class="btn green-long" data-toggle="modal" data-target="#modal_success"> Submit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

@endsection