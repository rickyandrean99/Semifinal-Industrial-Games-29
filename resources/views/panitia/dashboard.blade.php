@extends('layout.panitia')

@section("title")
    <title>IG29 - Dashboard</title>
@endsection

@section('content')
    <div class="ml-5 h3 fw-bold">Hi Penjaga Pos! Keep the spirit okay :D</div>

    <div class="d-flex flex-wrap">
        <div class="p-4 bd-highlight m-0 mb-0" style="flex-basis: 25%; text-align: center">
            <!-- Pos Rating -->
            <a href="{{ route('posrating') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Upgrade-rafiki.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Pos Upgrade App</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mb-0" style="flex-basis: 25%; text-align: center">
            <!-- Pos Produk -->
            <a href="{{ route('posproduk') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Product tour-rafiki.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Pos Produk</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mb-0" style="flex-basis: 25%; text-align: center">
            <!-- Pos Forecasting -->
            <a href="{{ route('posforecasting') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Search-rafiki.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Pos Forecasting</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mt-0" style="flex-basis: 25%; text-align: center">
            <!-- Pos Promosi -->
            <a href="{{ route('pospromosi') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Discount-rafiki.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Pos Promosi</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mt-0" style="flex-basis: 25%; text-align: center">
            <!-- Pos Wilayah -->
            <a href="{{ route('poswilayah') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Current location-rafiki.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Pos Wilayah</span></div>
                </div>
            </a>
        </div>
            
        <div class="p-4 bd-highlight m-0 mt-0" style="flex-basis: 25%; text-align: center">
            <!-- Pos Bank -->
            <a href="{{ route('minigames') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Vault-amico.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Bank</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mt-0" style="flex-basis: 25%; text-align: center">
            <!-- Input Customer -->
            <a href="{{ route('inputcustomer') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Add User-amico.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Input Customer</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mt-0" style="flex-basis: 25%; text-align: center">
            <!-- Franchise -->
            <a href="{{ route('franchise') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/Opened-cuate.png')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Franchise</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mt-0" style="flex-basis: 25%; text-align: center">
            <!-- Maps Main Room -->
            <a href="{{ route('mapWilayah') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/maps-main.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Maps Main Room</span></div>
                </div>
            </a>
        </div>

        <div class="p-4 bd-highlight m-0 mt-0" style="flex-basis: 25%; text-align: center">
            <!-- Customer Main Room -->
            <a href="{{ route('customerlist') }}">
                <div class="card card-chart pb-4 m-0 cardhover">
                    <img src="{{ asset('assets/img/customer-main.svg')}}" class="w-100" alt="">
                    <div class="w-100"><span class="h3 fw-bold">Customer Main Room</span></div>
                </div>
            </a>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#dashboard').addClass("active");
        });
    </script>
@endsection