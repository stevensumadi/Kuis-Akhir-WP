@foreach ($venues as $venue)
<div class="modal fade" id="{{ $venue->id }}" aria-hidden="true" aria-labelledby="label1" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header border-0 pb-0">
            <h3 class="modal-title fw-bold" id="label1">Booking Detail</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pb-0 border-0">
            <div class="card col-lg-12 mb-3 border-0">
                <div class="row g-0">
                    <div class="col-md-5">
                        <img src="https://source.unsplash.com/450x250/?{{ $venue->regency->name }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-7 d-flex flex-column align-content-center">
                        <div class="card-body p-2">
                            <h5 class="card-title mb-0">{{ $venue->name }}</h5>
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-geo-alt-fill" style="color: cornflowerblue;"></i>
                                <p class="m-0 pt-1" style="padding-left: 1.5px">Jl. {{ $venue->location }}, {{ $venue->regency->name }}</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="fw-bold m-0 pe-1" style="color: cornflowerblue; font-size: 18px; padding-left: 1.5px">$</p>
                                <p class="m-0" style="padding-left: 1px">{{ $venue->price }}</p>
                            </div>
                            <div class="m-0">
                                <label for="date" class="form-label mt-1 mb-1 fw-medium">Date</label>
                                <input value="{{  old('date') }}" name="birthDate" type="date" class="form-control" id="date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer border-0">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Book Now</button>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body border-0 d-flex flex-column align-items-center align-content-center justify-content-center">
            <p>Payment with BCA Virtual Account</p>
            <h1>2502040404</h1>
        </div>
        <div class="modal-footer border-0">
            <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
        </div>
    </div>
    </div>
</div>
@endforeach