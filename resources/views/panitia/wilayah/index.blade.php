@extends('layout.panitia')

@section("title")
    <title>IG29 - Pos Wilayah</title>
@endsection

@section('content')
    <div class="d-flex flex-wrap">
        <div class="pl-4 pr-4 m-2 bd-highlight" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Tabel Cupertino -->
            <table class="table table-striped table-bordered border-dark border-2">
                <thead>
                    <tr>
                        <th scope="col" class="text-center border-dark border-2" colspan="4"><span class="h4 fw-bold">CUPERTINO</span></th>
                    </tr>
                </thead>

                <tbody>
                    @for($i = 1; $i <= 12; $i++)
                        @if($i % 4 == 1)
                            @if(($i / 4) % 2 == 0) <tr style="background-color: #F7F7F7"> @else <tr style="background-color: #FFFFFF"> @endif
                        @endif

                        @if($i < 12)
                            <td class='text-left border-dark border-2 p-0 w-25' style="vertical-align: top">
                                <div class='text-center fw-bold float-left p-1 pr-3 pl-3' style='border-right: 2px solid black; border-bottom: 2px solid black'>{{$i}}</div>
                                <div class='text-center fw-bold float-left p-1 pr-2 pl-2' style='border-right: 2px solid black; border-bottom: 2px solid black' id="harga_cupertino_{{ $i }}">{{$i}}</div>
                                <div class='pl-4 pr-4 pb-4 pt-3 text-center' style="clear: both" id='cupertino_{{ $i }}'></div>
                            </td>
                        @else
                            <td class='text-center border-dark border-2 bg-dark' style='color: white' id='cupertino_{{ $i }}'></td>
                        @endif

                        @if($i % 4 == 0) </tr> @endif
                    @endfor
                </tbody>
            </table>

            <!-- Tabel San Jose -->
            <table class="table table-striped table-bordered border-dark border-2">
                <thead>
                    <tr>
                        <th scope="col" class="text-center border-dark border-2" colspan="4"><span class="h4 fw-bold">SANJOSE</span></th>
                    </tr>
                </thead>

                <tbody>
                    @for($i = 1; $i <= 12; $i++)
                        @if($i % 4 == 1)
                            @if(($i / 4) % 2 == 0) <tr style="background-color: #F7F7F7"> @else <tr style="background-color: #FFFFFF"> @endif
                        @endif

                        @if($i < 12)
                            <td class='text-left border-dark border-2 p-0 w-25' style="vertical-align: top">
                                <div class='text-center fw-bold float-left p-1 pr-3 pl-3' style='border-right: 2px solid black; border-bottom: 2px solid black'>{{$i}}</div>
                                <div class='text-center fw-bold float-left p-1 pr-2 pl-2' style='border-right: 2px solid black; border-bottom: 2px solid black' id="harga_sanjose_{{ $i }}">{{$i}}</div>
                                <div class='pl-4 pr-4 pb-4 pt-3 text-center' style="clear: both" id='sanjose_{{ $i }}'></div>
                            </td>
                        @else
                            <td class='text-center border-dark border-2 bg-dark' style='color: white' id='sanjose_{{ $i }}'></td>
                        @endif

                        @if($i % 4 == 0) </tr> @endif
                    @endfor
                </tbody>
            </table>

            <!-- Tabel Sun Vale -->
            <table class="table table-striped table-bordered border-dark border-2">
                <thead>
                    <tr>
                        <th scope="col" class="text-center border-dark border-2" colspan="4"><span class="h4 fw-bold">SUNNY VALE</span></th>
                    </tr>
                </thead>

                <tbody>
                    @for($i = 1; $i <= 12; $i++)
                        @if($i % 4 == 1)
                            @if(($i / 4) % 2 == 0) <tr style="background-color: #F7F7F7"> @else <tr style="background-color: #FFFFFF"> @endif
                        @endif

                        @if($i < 12)
                            <td class='text-left border-dark border-2 p-0 w-25' style="vertical-align: top">
                                <div class='text-center fw-bold float-left p-1 pr-3 pl-3' style='border-right: 2px solid black; border-bottom: 2px solid black'>{{$i}}</div>
                                <div class='text-center fw-bold float-left p-1 pr-2 pl-2' style='border-right: 2px solid black; border-bottom: 2px solid black' id="harga_sunvale_{{ $i }}">{{$i}}</div>
                                <div class='pl-4 pr-4 pb-4 pt-3 text-center' style="clear: both" id='sunvale_{{ $i }}'></div>
                            </td>
                        @else
                            <td class='text-center border-dark border-2 bg-dark' style='color: white' id='sunvale_{{ $i }}'></td>
                        @endif

                        @if($i % 4 == 0) </tr> @endif
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="pl-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Klaim wilayah -->
            <div class="card card-chart mt-2">
                <div class="card-header card-header-warning">
                    <div class="h3 fw-bold m-0">Klaim Wilayah</div>
                </div>

                <div class="card-body">
                    <select class="form-select form-select-lg mt-2 mb-3" aria-label=".form-select-lg example" id="klaim_tim">
                        <option value="" selected disabled>Pilih Kelompok</option>
                        @foreach($daftarTim as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>

                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="klaim_wilayah">
                        <option value="" selected disabled>Pilih Lokasi</option>
                        @foreach($daftarRegion as $dr)
                            <option value="{{ $dr->id }}">{{ $dr->nama }}</option>
                        @endforeach
                    </select>

                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="klaim_koordinat">
                        <option value="" selected disabled>Pilih Koordinat</option>
                    </select>

                    <button class="btn btn-primary w-100" href="#modalYo" data-toggle="modal" id="btnKlaim"><span class="h4 fw-bold">KLAIM</span></button>
                </div>
            </div>

            <!-- Rebut wilayah -->
            <div class="card card-chart mt-5">
                <div class="card-header card-header-warning">
                    <div class="h3 fw-bold m-0">Rebut Wilayah</div>
                </div>

                <div class="card-body">
                    <select class="form-select form-select-lg mt-2 mb-3" aria-label=".form-select-lg example" id="rebut_tim">
                        <option value="" selected disabled>Pilih Kelompok</option>
                        @foreach($daftarTim as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                    
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="rebut_wilayah">
                        <option value="" selected disabled>Pilih Lokasi</option>
                        @foreach($daftarRegion as $dr)
                            <option value="{{ $dr->id }}">{{ $dr->nama }}</option>
                        @endforeach
                    </select>
                    
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="rebut_koordinat">
                        <option value="" selected disabled>Pilih Koordinat</option>
                    </select>
                    
                    <!-- <button class="btn btn-primary float-left" style="width: 49%" href="#modalYo2" data-toggle="modal"><span class="h4 fw-bold">BAYAR</span></button> -->
                    <button class="btn btn-rose float-right w-100" href="#modalYo3" data-toggle="modal" id="btnRebut"><span class="h4 fw-bold">REBUT</span></button>
                </div>
            </div>

            <div class="alert alert-success fw-bold mt-3" id="success-note" style="display:none; letter-spacing: 0.5px;"></div>
        </div>
    </div>

    <div class="d-flex flex-wrap mt-0">
        <div class="pl-4 pr-4 bd-highlight m-2 mt-0" style="flex-grow: 1;">
            <!-- Table History -->
            @include('panitia.helper.riwayat')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalYo" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3>
                </div>

                <!-- <div class="modal-body">
                    Yakin membeli wilayah?
                </div> -->
                <div class="modal-body" id="confirmation-box-klaim" style="margin: auto"></div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</a>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="klaimWilayah()">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalYo3" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3>
                </div>

                <!-- <div class="modal-body">
                    Yakin merebut wilayah?
                </div> -->
                <div class="modal-body" id="confirmation-box-rebut" style="margin: auto"></div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</a>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="rebutWilayah()">Ya</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#wilayah').addClass("active");
            realTimeMap();
        });

        $(document).on('click', '#btnKlaim', function() {
            $('#confirmation-box-klaim').html("Yakin Klaim Wilayah <span class='text-danger fw-bold'>" + $('#klaim_wilayah option:selected').text() + " " + $('#klaim_koordinat option:selected').text() + "</span> untuk <span class='text-danger fw-bold'>" + $('#klaim_tim option:selected').text() + "</span>?");
        });

        $(document).on('click', '#btnRebut', function() {
            $('#confirmation-box-rebut').html("Yakin Rebut Wilayah <span class='text-danger fw-bold'>" + $('#rebut_wilayah option:selected').text() + " " + $('#rebut_koordinat option:selected').text() + "</span> untuk <span class='text-danger fw-bold'>" + $('#rebut_tim option:selected').text() + "</span>?");
        });

        $("#klaim_wilayah").change(function(){
            $('#klaim_koordinat').empty();
            $('#klaim_koordinat').append('<option value="" selected disabled>Pilih Koordinat</option>');
            
            if ($("#klaim_wilayah").val() == 1) {
                for(var i = 1; i <= 25; i++) {
                    $('#klaim_koordinat').append('<option value="' + i + '">' + i + '</option>');
                }
            } else {
                for(var i = 1; i <= 12; i++) {
                    $('#klaim_koordinat').append('<option value="' + i + '">' + i + '</option>');
                }
            }
        });

        $("#rebut_wilayah").change(function(){
            $('#rebut_koordinat').empty();
            $('#rebut_koordinat').append('<option value="" selected disabled>Pilih Koordinat</option>');
            
            for(var i = 1; i <= 12; i++) {
                $('#rebut_koordinat').append('<option value="' + i + '">' + i + '</option>');
            }
        });

        function klaimWilayah() {
            var idTim = $('#klaim_tim').val();
            var idWilayah = $('#klaim_wilayah').val();
            var koordinat = $('#klaim_koordinat').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.klaimwilayah") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'idTim': idTim,
                    'idWilayah': idWilayah,
                    'koordinat': koordinat
                },
                success: function(data) {
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(2000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });

                    if (data.status == "oke") {
                        $("#klaim_tim").val('');
                        $("#klaim_wilayah").val('');
                        $('#klaim_koordinat').empty();
                        $('#klaim_koordinat').append('<option value="" selected disabled>Pilih Koordinat</option>');
                        $("#klaim_koordinat").val('');

                        $('#success-note').removeClass("alert-danger");
                        $('#success-note').addClass("alert-success");
                    } else if (data.status == "tidak") {
                        $('#success-note').removeClass("alert-success");
                        $('#success-note').addClass("alert-danger");
                    }
                }
            });
        }

        function rebutWilayah() {
            var idTim = $('#rebut_tim').val();
            var idWilayah = $('#rebut_wilayah').val();
            var koordinat = $('#rebut_koordinat').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.rebutwilayah") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'idTim': idTim,
                    'idWilayah': idWilayah,
                    'koordinat': koordinat
                },
                success: function(data) {
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(2000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });

                    if (data.status == "oke") {
                        $("#rebut_tim").val('');
                        $("#rebut_wilayah").val('');
                        $('#rebut_koordinat').empty();
                        $('#rebut_koordinat').append('<option value="" selected disabled>Pilih Koordinat</option>');
                        $("#rebut_koordinat").val('');

                        $('#success-note').removeClass("alert-danger");
                        $('#success-note').addClass("alert-success");
                    } else if (data.status == "tidak") {
                        $('#success-note').removeClass("alert-success");
                        $('#success-note').addClass("alert-danger");
                    }
                }
            });
        }

        function lihatRiwayat() {
            var id = $('#pilih_riwayat_tim').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.showhistory") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id,
                    'tipe': 'wilayah'
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $('#daftar_riwayat_tim').empty();
                        $('#title_riwayat_tim').html(data.nama_tim[0].nama);

                        $.each(data.riwayat, function(key, value) {
                            $('#daftar_riwayat_tim').append("<tr style='display: table; table-layout: fixed; width: 100%' id='tr_" + key + "'>");
                            $("#daftar_riwayat_tim #tr_" + key).append("<td class='text-center'> " + data.riwayat[key].siklus + " </td>");
                            $("#daftar_riwayat_tim #tr_" + key).append("<td class='text-center'> " + data.riwayat[key].waktu.toString().substring(11,19) + " </td>");
                            $("#daftar_riwayat_tim #tr_" + key).append("<td class='text-center'> " + data.riwayat[key].riwayat  + " </td>");
                            $('#daftar_riwayat_tim').append("</tr>");
                        });
                    }
                }
            });
        }

        function realTimeMap() {
            $.ajax({
                type: 'POST',
                url: '{{ route("team.realtimemap") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>'
                },
                success: function(data) {
                    for(var i = 1; i <= 12; i++) {
                        $("#cupertino_" + i).html("-");
                        $("#harga_cupertino_" + i).html("50 FC");
                    }

                    for(var i = 1; i <= 12; i++) {
                        $("#sanjose_" + i).html("-");
                        $("#harga_sanjose_" + i).html("50 FC");
                    }

                    for(var i = 1; i <= 12; i++) {
                        $("#sunvale_" + i).html("-");
                        $("#harga_sunvale_" + i).html("50 FC");
                    }

                    // Fill map
                    var cupertinoCompetitor = "";
                    var sanjoseCompetitor = "";
                    var sunnyvaleCompetitor = "";
                    $.each(data.daftarRegionDetails, function(key, value) {
                        if (value.teams_id != null) {
                            if (value.regions_id == 2) {
                                if(value.id < 12) {
                                    $("#harga_cupertino_" + (value.id)).html(((value.jumlah_klaim + 1) * 50) + " FC");
                                    $("#cupertino_" + (value.id)).html(value.nama);
                                }

                                if (value.id >= 12) { cupertinoCompetitor += value.nama + '<br>'; }
                            }

                            if (value.regions_id == 3) {
                                if(value.id < 12) {
                                    $("#harga_sanjose_" + (value.id)).html(((value.jumlah_klaim + 1) * 50) + " FC");
                                    $("#sanjose_" + (value.id)).html(value.nama);
                                }

                                if (value.id >= 12) { sanjoseCompetitor += value.nama + '<br>'; }
                            }

                            if (value.regions_id == 4) {
                                if(value.id < 12) {
                                    $("#harga_sunvale_" + (value.id)).html(((value.jumlah_klaim + 1) * 50) + " FC");
                                    $("#sunvale_" + (value.id)).html(value.nama);
                                }

                                if (value.id >= 12) { sunnyvaleCompetitor += value.nama + '<br>'; }
                            }
                        }
                    });
                    
                    $("#cupertino_12").html(cupertinoCompetitor);
                    $("#sanjose_12").html(sanjoseCompetitor);
                    $("#sunvale_12").html(sunnyvaleCompetitor);
                }
            });
        }

        setInterval(() => {
            realTimeMap();
        }, 3000);
    </script>
@endsection