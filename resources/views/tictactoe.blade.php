@extends('template.main')

@section('content')
    <div style="height: 10vh"></div>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible d-flex justify-content-center col-lg my-5" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container">
        <div class="d-flex flex-column align-items-center">
            <h6 class="fw-bold mt-5 mb-3">Waiting ...</h6>
            <h1 class="fw-bold text-primary">Tic <span class="text-black">Tac</span> Toe</h1>
            <h6 class="fw-bold mt-2 mb-2 text-primary" id="message">Message</h6>
            <div class="row row-cols-3 col-8 bg-dark" id="board">
                <div class="col bg-primary border border-5 border-white p-5">
                    <h2 class="text-center text-white">X</h2>
                </div>
            </div>
            
            <input class="d-none" type="text" value="{{ $roomID }}" id="room">
            <button id="join-btn" class="btn btn-primary rounded d-none">Join</button>
        </div>
    </div>

    <div style="height: 20vh"></div>

    <script src="{{ asset('js/tictactoe.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#join-btn').click();

            $(window).bind('unload', function(){
                $.ajax({
                    url: '/reconnect',
                    method: 'GET'
                });
            });
        });
    </script>
@endsection