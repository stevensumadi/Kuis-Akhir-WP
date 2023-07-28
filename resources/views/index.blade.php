@extends('template.main')

@section('content')
    <div style="height: 10vh"></div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible d-flex justify-content-center col-lg" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="col-lg my-5 d-flex flex-column justify-content-center align-items-center px-5">
        <h1 class="filter-title text-black fw-bold mb-4">Here is <span class="text-primary">Your Wedding</span> Partner</h1>
        <div class="card" style="width: 40rem;">
            <img src="storage/{{ $image }}" class="card-img img-fluid">
        </div>
    </div>

    <div class="col-lg my-5 d-flex flex-column justify-content-center align-items-center px-5">
        <h1 class="filter-title text-primary fw-bold">List <span class="text-black">of</span> Venues</h1>
        <div class="col-lg-12 my-3 d-flex flex-row justify-content-center align-items-center px-3">
            <div class="col-lg-12">
                <label for="location" class="fw-bold mb-2 ms-1" style="color: cornflowerblue">Select Your Destined Location</label>
                <select id="location" name="location" class="form-select" aria-label="Default select example">
                    <option selected disabled>Filter by</option>
                    <option value="0">Show All</option>
                    <option value="1">Tangerang</option>
                    <option value="2">Singapore</option>
                    <option value="3">Jakarta</option>
                </select>
            </div>
        </div>
    
        <div id="filter" class="px-3">
            @foreach ($venues as $venue)
                <div class="card col-lg-12 mb-3">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <img src="https://source.unsplash.com/450x250/?{{ $venue->regency->name }}" class="img-fluid rounded-start">
                        </div>
                        <div class="col-md-7 d-flex flex-column align-content-center">
                            <div class="card-body ps-0 pb-0">
                                <h5 class="card-title">{{ $venue->name }}</h5>
                                <p class="text-justify">{{ $venue->description }}</p>
                                <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-geo-alt-fill" style="color: cornflowerblue;"></i>
                                    <p class="m-0 pt-1" style="padding-left: 1.5px">Jl. {{ $venue->location }}, {{ $venue->regency->name }}</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="fw-bold m-0 pe-1" style="color: cornflowerblue; font-size: 18px; padding-left: 1.5px">$</p>
                                    <p class="m-0" style="padding-left: 1px">{{ $venue->price }}</p>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end border-0 bg-white">
                                <button class="fw-bold btn btn-primary" data-bs-target="#{{ $venue->id }}" data-bs-toggle="modal">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('partials.popup_booking')

    <script src="js/filter.js"></script>
@endsection