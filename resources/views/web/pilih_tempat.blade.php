@extends('layouts.mainweb')
<style>
    .warna-biru {
        background-color: #142964;
    }

    .warna-abu {
        background-color: #d9d9d9;
    }

    .warna-biru-muda {
        background-color: #554e8c;
    }

    body {
        min-height: 100vh;
        min-height: -webkit-fill-available;
    }

    html {
        height: -webkit-fill-available;
    }

    main {
        display: flex;
        flex-wrap: nowrap;
        height: 100vh;
        height: -webkit-fill-available;
        max-height: 100vh;
        overflow-x: auto;
        overflow-y: hidden;
    }

    .b-example-divider {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
        background-color: #0b015b;
        border: solid #0b015b;
        border-width: 1px 0;
        box-shadow: inset 0 0.5em 1.5em rgba(0, 0, 0, 0.1), inset 0 0.125em 0.5em rgba(0, 0, 0, 0.15);
    }

    .bi {
        vertical-align: -0.125em;
        pointer-events: none;
        fill: currentColor;
    }

    .dropdown-toggle {
        outline: 0;
    }

    .nav-flush .nav-link {
        border-radius: 0;
    }

    .btn-toggle {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.5rem;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.65);
        background-color: transparent;
        border: 0;
    }

    .btn-toggle:hover,
    .btn-toggle:focus {
        color: rgba(0, 0, 0, 0.85);
        background-color: #d2f4ea;
    }

    .btn-toggle::before {
        width: 1.25em;
        line-height: 0;
        content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
        transition: transform 0.35s ease;
        transform-origin: 0.5em 50%;
    }

    .btn-toggle[aria-expanded="true"] {
        color: rgba(0, 0, 0, 0.85);
    }

    .btn-toggle[aria-expanded="true"]::before {
        transform: rotate(90deg);
    }

    .btn-toggle-nav a {
        display: inline-flex;
        padding: 0.1875rem 0.5rem;
        margin-top: 0.125rem;
        margin-left: 1.25rem;
        text-decoration: none;
    }

    .btn-toggle-nav a:hover,
    .btn-toggle-nav a:focus {
        background-color: #d2f4ea;
    }

    .scrollarea {
        overflow-y: auto;
    }

    .fw-semibold {
        font-weight: 600;
    }

    .lh-tight {
        line-height: 1.25;
    }

    .list-wrapper {
        position: relative;
    }

    .list-item-wrapper {
        margin-top: 10px;
        position: relative;
    }

    .list-bullet {
        float: left;
        margin-right: 20px;
        background: #0b015b;
        height: 30px;
        width: 30px;
        line-height: 30px;
        border-radius: 100px;
        font-weight: 700;
        color: white;
        text-align: center;
        outline-style: solid;
    }

    .list-bullet2 {
        float: left;
        margin-right: 20px;
        background: #fff;
        height: 30px;
        width: 30px;
        line-height: 30px;
        border-radius: 100px;
        font-weight: 700;
        color: #0b015b;
        text-align: center;
        outline-style: solid;
    }

    .list-item {
        display: table-row;
        vertical-align: middle;
    }

    .list-title {
        font-weight: 700;
    }

    .list-text {
        font-weight: 400;
    }

    .red-line {
        background: #0b015b;
        z-index: -1;
        width: 1px;
        height: 100%;
        position: absolute;
        left: 15px;
    }

    .white-line {
        background: #fff;
        z-index: -1;
        top: 0px;
        width: 1px;
        height: 100%;
        position: absolute;
        left: 15px;


    }

    .active-card {
        outline: solid rgb(22, 44, 142) 1.5px;
    }

    .active-card1 {
        outline: solid rgb(22, 44, 142) 1.5px;
    }

</style>
@section('content')
<style>
    .list-items-layout3 li:before {
        color: #ffffff;
        border-color: #3f6d6a;
        background-color: #547d7a;
    }
    img {
        display: block;
        max-width:300px;
        max-height:300px;
        width: auto;
        height: auto;
    }
</style>
<div class="about-layout4 pb-0 ">
    <div class="row">
        <div class="col-md-2">
            <div class="px-5 py-5">
                <ul class="package__list list-items list-items-layout2 list-unstyled">
                    <li>
                        <h6>Pilih Tempat</h6>
                    </li>
                </ul>
                <ul class=" list-items list-items-layout3 list-unstyled">
                    <li>
                        <h6>Pilih Dokter</h6>
                    </li>
                    <li>
                        <h6>Alur Jadwal</h6>
                    </li>
                    <li>
                        <h6>Konfirmasi Data</h6>
                    </li>
                    <li>
                        <h6>Bukti Pembayaran</h6>
                    </li>
                </ul>
                
            </div>
        </div>
        @foreach ($place as $item)
        <div class="col-md-5 px-5 py-5">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <img class="card-img-top" height="400px" width="400px" src="{{url('/assets/images/logo/LOGO-2.png')}}" style="margin-bottom: 15px">
                    <h5 class="card-title text-center">{{ $item->name }}</h5>
                    <p class="card-text">{{ $item->desc }}</p>
                    <form action="chooseDoctor" method="get">
                        <input type="hidden" name="place_id" value="{{ $item->id }}">
                        <center>
                            <button type="submit" class="btn btn-primary">Pilih</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
        var header = document.getElementById("collapse1");
        var btns = header.getElementsByClassName("card");
    for (var i = 0; i <btns.length; i++){
        btns[i].addEventListener("click", function (){
            var current =
            document.getElementsByClassName('active-card');
            current[0].className =
            current[0].className.replace("active-card","");
            this.className += "active-card";
        });
    };
    var cards = document.querySelectorAll(".date");

    cards.forEach(function(card) {
    card.addEventListener("click", function() {
        var currentActiveCard = document.querySelector(".active-card1");
        if (currentActiveCard) {
            currentActiveCard.classList.remove("active-card1");
        }
            this.classList.add("active-card1");
        });
    });

    </script>
@endsection
