@extends('layout.peserta')

@section('content')
<div class="d-flex flex-wrap">
    <!-- Los Gatos -->
    <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
        <div class="card card-chart mt-2 mb-5">
            <div class="card-header card-header-info">
                <div class="card-title h3 fw-bold m-0">Los Gatos</div>
            </div>

            <div class="card-body">
                <img src="{{ asset('assets/img/losgatos.png')}}" class="w-100">
            </div>
        </div>
    </div>
    <!-- End Los Gatos -->

    <!-- Sanjose -->
    <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
        <div class="card card-chart mt-2 mb-5">
            <div class="card-header card-header-info">
                <div class="card-title h3 fw-bold m-0">Sanjose</div>
            </div>

            <div class="card-body">
                <img src="{{ asset('assets/img/sanjose.png')}}" class="w-100">
            </div>
        </div>
    </div>
    <!-- End Sanjose -->
</div>

<div class="d-flex flex-wrap">
    <!-- Cupertino -->
    <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
        <div class="card card-chart mt-2 mb-5">
            <div class="card-header card-header-info">
                <div class="card-title h3 fw-bold m-0">Cupertino</div>
            </div>

            <div class="card-body">
                <img src="{{ asset('assets/img/cupertino.png')}}" class="w-100">
            </div>
        </div>
    </div>
    <!-- End Cupertino -->

    <!-- Sunny Vale -->
    <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
        <div class="card card-chart mt-2 mb-5">
            <div class="card-header card-header-info">
                <div class="card-title h3 fw-bold m-0">Sunny Vale</div>
            </div>

            <div class="card-body">
                <img src="{{ asset('assets/img/sunnyvale.png')}}" class="w-100">
            </div>
        </div>
    </div>
    <!-- End Sunny Vale -->
</div>
@endsection

@section('javascript') 
<script>
    $(document).ready(function() {
        $('#maps').addClass("active");
    });
</script>
@endsection
