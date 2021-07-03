@extends("layout.peserta")

@section("title")
    <title>IG29 - Dashboard</title>
@endsection

@section("content")
    <!-- Player Details -->
    <div class="d-flex flex-wrap">
        <!-- Nama Tim -->
        <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
            <p class="h2" style="font-weight: bold;" id="nama_tim"></p>
        </div>
        <!-- End Nama Tim -->

        <div class="pr-4 m-2" style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: flex-end;">
            <button class="pl-3 btn btn-primary h4 fw-bold text-capitalize" onclick="realtimeData('player')"><i class="material-icons mr-2">refresh</i>Muat Ulang Detail Tim</button>
        </div>

        <div class="pl-2 pr-2 pt-0 bd-highlight m-2" style="flex-grow: 1; flex-basis: 100%;">
            <div class="card card-chart">
                <div class="card-header card-header-primary">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                        <span class="h3 fw-bold m-0">Produk</span>
                    </div>
                </div>

                <div class="card-body">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%;">
                        <!-- Produk List -->
                        <div class="d-flex flex-wrap">
                            @for($i = 1; $i <= 42; $i++)
                                <div class="pl-2 pr-2 bd-highlight" style="width: 25%" id="product_list_{{ $i }}">
                                    <div class="card card-chart w-100 mb-2">
                                        <div class="card-body p-3" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
                                            <div class="d-flex flex-wrap">
                                                <div class="bd-highlight m-1" style="flex-grow: 1; flex-basis: 45%;">
                                                    <div class="p-3" id="product_image_{{ $i }}"></div>
                                                </div>
                                                
                                                <div class="bd-highlight m-1" style="flex-grow: 1; flex-basis: 45%;">
                                                    <div class="h4 pt-3 pb-1 fw-bold" id="product_name_{{ $i }}"></div>
                                                    <div class="h4 pb-1" id="product_quantity_{{ $i }}"></div>
                                                    <div class="h4" id="product_price_{{ $i }}"></div>
                                                    <div class="h4" id="product_session_{{ $i }}" style="color: red; font-weight: bold;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Saldo -->
        <div class="pl-3 pr-3 pt-0 pb-0 bd-highlight" style="flex-grow: 1; flex-basis: 20%;">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                        <div class="h3 fw-bold m-0">Fooxie Coin</div>
                    </div>
                </div>

                <div class="card-body">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
                        <p class="h3 m-0" id='fc'></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Saldo -->

        <!-- Poin Ketertarikan -->
        <div class="pl-3 pr-3 pt-0 pb-0 bd-highlight" style="flex-grow: 1; flex-basis: 20%;">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                        <div class="h3 fw-bold m-0">Poin Ketertarikan</div>
                    </div>
                </div>

                <div class="card-body">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
                        <p class="h3 m-0" id='poin_ketertarikan'></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Poin Ketertarikan -->

        <!-- Application Level -->
        <div class="pl-3 pr-3 pt-0 pb-0 bd-highlight" style="flex-grow: 1; flex-basis: 20%;">
            <div class="card card-chart">
                <div class="card-header card-header-success">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                        <div class="h3 fw-bold m-0">Application Level</div>
                    </div>
                </div>

                <div class="card-body">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                        <p class="h3 m-0" id="level"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Application Level -->
    </div>

    <div class="d-flex flex-wrap">
        <!-- Wilayah -->
        <div class="pl-3 pr-3 pt-0 bd-highlight" style="flex-grow: 1; flex-basis: 75%;">
            <div class="card card-chart">
                <div class="card-header card-header-rose">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                        <div class="h3 fw-bold m-0">Wilayah</div>
                    </div>
                </div>

                <div class="card-body">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-dark" style="table-layout: fixed; width: calc( 100% - 1em ); display: table;">
                                    <tr>
                                        <th class="text-center" style='width:50%'><span class="h3 fw-bold">Wilayah</span></th>
                                        <th class="text-center" style='width:50%'><span class="h3 fw-bold">Area Kepemilikan</span></th>
                                    </tr>
                                </thead>
                
                                <tbody style="display: block;" id="customer_app_data">
                                    @for($i = 1; $i <= 4; $i++)
                                        <tr style='display: table; table-layout: fixed; width: 100%' id="tr_region_{{ $i }}">
                                            <td class='text-center fw-bold' style='width:50%' id='td_region_name_{{ $i }}'></td>
                                            <td class='text-center fw-bold h4' style='width:50%' id='td_region_koordinat_{{ $i }}'></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Wilayah -->

        <div class="pl-3 pr-3 pt-0 bd-highlight" style="flex-grow: 1; flex-basis: 25%;">
            <div class="d-flex flex-wrap">
                <!-- Jumlah Customer Store -->
                <div class="pl-3 pr-3 pt-0 bd-highlight" style="flex-grow: 1; flex-basis: 100%;">
                    <div class="card card-chart mb-5">
                        <div class="card-header card-header-success">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <div class="h3 fw-bold m-0">Jumlah Customer Store</div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <p class="h3 m-0" id="jmlh_customer_store"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Jumlah Customer Store-->

                <!-- Jumlah Customer App -->
                <div class="pl-3 pr-3 pt-0 bd-highlight" style="flex-grow: 1; flex-basis: 100%;">
                    <div class="card card-chart mb-5">
                        <div class="card-header card-header-success">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <div class="h3 fw-bold m-0">Jumlah Customer App</div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <p class="h3 m-0" id="jmlh_customer_app"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Jumlah Customer App -->

                <!-- Bank Credits -->
                <div class="pl-3 pr-3 pt-0 bd-highlight" style="flex-grow: 1; flex-basis: 100%;">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <div class="h3 fw-bold m-0">Bank Credits</div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <p class="h3 m-0" id="bank-credits" style="text-align: center;">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Franchise -->
                <div class="pl-3 pr-3 pt-0 bd-highlight" style="flex-grow: 1; flex-basis: 100%;">
                    <div class="card card-chart">
                        <div class="card-header card-header-success">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <div class="h3 fw-bold m-0">Franchise</div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">  
                                <p class="h3 m-0" id="franchise" style="text-align: center;">
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
  <!-- End Player Details -->
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        $('#dashboard').addClass("active");
        realTimePlayerDetail();
    });

    function realtimeData(command) {
        setTimeout(realTimePlayerDetail, 1000);
    }

    function realTimePlayerDetail() {
        $.ajax({
            type: 'POST',
            url: '{{ route("team.realtimeplayerdetail") }}',
            data: {
                '_token':'<?php echo csrf_token() ?>'
            },
            success: function(data) {
                if(data.status == "oke") {
                    var arr_losgatos = [];
                    var arr_cupertino = [];
                    var arr_sanjose = [];
                    var arr_sunnyvale = [];
                    var koordinatList = "";

                    // Cetak player detail
                    $.each(data.team, function(key, value) {
                        $('#nama_tim').text(value.nama);
                        $('#fc').text(value.saldo);
                        $('#poin_ketertarikan').text(value.poin_ketertarikan);

                        if (value.level_app == 1) {
                            $('#level').text("Cockroach");
                        } else if (value.level_app == 2) {
                            $('#level').text("Ponies");
                        } else if (value.level_app == 3) {
                            $('#level').text("Centaurs");
                        } else if (value.level_app == 4) {
                            $('#level').text("Unicorn");
                        } else if (value.level_app == 5) {
                            $('#level').text("Decacorn");
                        } else if (value.level_app == 6) {
                            $('#level').text("Hectocorn");
                        }

                        $('#jmlh_customer_app').text(value.jumlah_customer_app);
                        $('#jmlh_customer_store').text(value.jumlah_customer_store);
                        $("#franchise").html(value.franchise);
                        
                        if (value.regions_id == 1) {
                            arr_losgatos.push(value.koordinat);
                        } else if (value.regions_id == 2) {
                            arr_cupertino.push(value.koordinat);
                        } else if (value.regions_id == 3) {
                            arr_sanjose.push(value.koordinat);
                        } else if (value.regions_id == 4) {
                            arr_sunnyvale.push(value.koordinat);
                        }
                    })

                    // Detail Wilayah Losgatos
                    if (arr_losgatos.length != 0) {
                        $('#tr_region_1').show();
                        $('#td_region_name_1').html("<img src='{{ asset('assets/img/losgatos.png') }}' width='30%'>");
                        for (var i = 0; i < arr_losgatos.length; i++) {
                            koordinatList += arr_losgatos[i] + ", ";
                        }
                        $('#td_region_koordinat_1').text(koordinatList.slice(0, -2));
                    } else {
                        $('#tr_region_1').hide();
                    }

                    // Detail Wilayah Cupertino
                    koordinatList = "";
                    if (arr_cupertino.length != 0) {
                        $('#tr_region_2').show();
                        $('#td_region_name_2').html("<img src='{{ asset('assets/img/cupertino.png') }}' width='30%'>");
                        for (var i = 0; i < arr_cupertino.length; i++) {
                            if (arr_cupertino[i] >= 12) {
                                koordinatList += "Competitor, ";
                            } else {
                                koordinatList += arr_cupertino[i] + ", ";
                            }
                        }
                        $('#td_region_koordinat_2').text(koordinatList.slice(0, -2));
                    } else {
                        $('#tr_region_2').hide();
                    }

                    // Detail Wilayah Sanjose
                    koordinatList = "";
                    if (arr_sanjose.length != 0) {
                        $('#tr_region_3').show();
                        $('#td_region_name_3').html("<img src='{{ asset('assets/img/sanjose.png') }}' width='30%'>");
                        for (var i = 0; i < arr_sanjose.length; i++) {
                            if (arr_sanjose[i] >= 12) {
                                koordinatList += "Competitor, ";
                            } else {
                                koordinatList += arr_sanjose[i] + ", ";
                            }
                        }
                        $('#td_region_koordinat_3').text(koordinatList.slice(0, -2));
                    } else {
                        $('#tr_region_3').hide();
                    }

                    // Detail Wilayah Sunnyvale
                    koordinatList = "";
                    if (arr_sunnyvale.length != 0) {
                        $('#tr_region_4').show();
                        $('#td_region_name_4').html("<img src='{{ asset('assets/img/sunnyvale.png') }}' width='30%'>");
                        for (var i = 0; i < arr_sunnyvale.length; i++) {
                            if (arr_sunnyvale[i] >= 12) {
                                koordinatList += "Competitor, ";
                            } else {
                                koordinatList += arr_sunnyvale[i] + ", ";
                            }
                        }
                        $('#td_region_koordinat_4').text(koordinatList.slice(0, -2));
                    } else {
                        $('#tr_region_4').hide();
                    }

                    var id = 1;

                    //Tampilkan produk yang dimiliki di sesi 1
                    $.each(data.produk_team_1, function(key, value) {
                        if (value.quantity > 0) {
                            $("#product_list_" + id).show();

                            if (value.id == 1) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_kuning.png') }}' width='100%'>");
                            } else if (value.id == 2) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_goreng.png') }}' width='100%'>");
                            } else if (value.id == 3) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/soto_ayam.png') }}' width='100%'>");
                            } else if (value.id == 4) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/rawon.png') }}' width='100%'>");
                            } else if (value.id == 5) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/sate.png') }}' width='100%'>");
                            } else if (value.id == 6) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_padang.png') }}' width='100%'>");
                            }

                            $("#product_name_" + id).text(value.nama_produk);
                            $("#product_quantity_" + id).text(value.quantity + " Items");
                            $("#product_price_" + id).text(value.harga_jual + " Fooxie Coin");
                            $("#product_session_" + id).text("Exp : Siklus " + (value.sesi_beli+2)); 
                            id++;
                        } else {
                            $("#product_list_" + id).hide();
                        }
                    });

                    //Tampilkan produk yang dimiliki di sesi 2
                    $.each(data.produk_team_2, function(key, value) {
                        if (value.quantity > 0) {
                            $("#product_list_" + id).show();
                            
                            if (value.id == 1) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_kuning.png') }}' width='100%'>");
                            } else if (value.id == 2) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_goreng.png') }}' width='100%'>");
                            } else if (value.id == 3) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/soto_ayam.png') }}' width='100%'>");
                            } else if (value.id == 4) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/rawon.png') }}' width='100%'>");
                            } else if (value.id == 5) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/sate.png') }}' width='100%'>");
                            } else if (value.id == 6) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_padang.png') }}' width='100%'>");
                            }
                            
                            $("#product_name_" + id).text(value.nama_produk);
                            $("#product_quantity_" + id).text(value.quantity + " Items");
                            $("#product_price_" + id).text(value.harga_jual + " Fooxie Coin");
                            $("#product_session_" + id).text("Exp : Siklus " + (value.sesi_beli+2)); 
                            id++;
                        } else {
                            $("#product_list_" + id).hide();
                        }
                    });

                    //Tampilkan produk yang dimiliki di sesi 3
                    $.each(data.produk_team_3, function(key, value) {
                        if (value.quantity > 0) {
                            $("#product_list_" + id).show();

                            if (value.id == 1) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_kuning.png') }}' width='100%'>");
                            } else if (value.id == 2) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_goreng.png') }}' width='100%'>");
                            } else if (value.id == 3) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/soto_ayam.png') }}' width='100%'>");
                            } else if (value.id == 4) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/rawon.png') }}' width='100%'>");
                            } else if (value.id == 5) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/sate.png') }}' width='100%'>");
                            } else if (value.id == 6) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_padang.png') }}' width='100%'>");
                            }

                            $("#product_name_" + id).text(value.nama_produk);
                            $("#product_quantity_" + id).text(value.quantity + " Items");
                            $("#product_price_" + id).text(value.harga_jual + " Fooxie Coin");
                            $("#product_session_" + id).text("Exp : Siklus " + (value.sesi_beli+2)); 
                            id++;
                        } else {
                            $("#product_list_" + id).hide();
                        }
                    });

                    //Tampilkan produk yang dimiliki di sesi 4
                    $.each(data.produk_team_4, function(key, value) {
                        if (value.quantity > 0) {
                            $("#product_list_" + id).show();

                            if (value.id == 1) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_kuning.png') }}' width='100%'>");
                            } else if (value.id == 2) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_goreng.png') }}' width='100%'>");
                            } else if (value.id == 3) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/soto_ayam.png') }}' width='100%'>");
                            } else if (value.id == 4) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/rawon.png') }}' width='100%'>");
                            } else if (value.id == 5) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/sate.png') }}' width='100%'>");
                            } else if (value.id == 6) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_padang.png') }}' width='100%'>");
                            }

                            $("#product_name_" + id).text(value.nama_produk);
                            $("#product_quantity_" + id).text(value.quantity + " Items");
                            $("#product_price_" + id).text(value.harga_jual + " Fooxie Coin");
                            $("#product_session_" + id).text("Exp : Siklus " + (value.sesi_beli+2)); 
                            id++;
                        } else {
                            $("#product_list_" + id).hide();
                        }
                    });

                    //Tampilkan produk yang dimiliki di sesi 5
                    $.each(data.produk_team_5, function(key, value) {
                        if (value.quantity > 0) {
                            $("#product_list_" + id).show();

                            if (value.id == 1) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_kuning.png') }}' width='100%'>");
                            } else if (value.id == 2) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_goreng.png') }}' width='100%'>");
                            } else if (value.id == 3) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/soto_ayam.png') }}' width='100%'>");
                            } else if (value.id == 4) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/rawon.png') }}' width='100%'>");
                            } else if (value.id == 5) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/sate.png') }}' width='100%'>");
                            } else if (value.id == 6) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_padang.png') }}' width='100%'>");
                            }

                            $("#product_name_" + id).text(value.nama_produk);
                            $("#product_quantity_" + id).text(value.quantity + " Items");
                            $("#product_price_" + id).text(value.harga_jual + " Fooxie Coin");
                            $("#product_session_" + id).text("Exp : Siklus " + (value.sesi_beli+2)); 
                            id++;
                        } else {
                            $("#product_list_" + id).hide();
                        }
                    });

                    //Tampilkan produk yang dimiliki di sesi 6
                    $.each(data.produk_team_6, function(key, value) {
                        if (value.quantity > 0) {
                            $("#product_list_" + id).show();

                            if (value.id == 1) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_kuning.png') }}' width='100%'>");
                            } else if (value.id == 2) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_goreng.png') }}' width='100%'>");
                            } else if (value.id == 3) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/soto_ayam.png') }}' width='100%'>");
                            } else if (value.id == 4) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/rawon.png') }}' width='100%'>");
                            } else if (value.id == 5) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/sate.png') }}' width='100%'>");
                            } else if (value.id == 6) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_padang.png') }}' width='100%'>");
                            }

                            $("#product_name_" + id).text(value.nama_produk);
                            $("#product_quantity_" + id).text(value.quantity + " Items");
                            $("#product_price_" + id).text(value.harga_jual + " Fooxie Coin");
                            $("#product_session_" + id).text("Exp : Siklus " + (value.sesi_beli+2)); 
                            id++;
                        } else {
                            $("#product_list_" + id).hide();
                        }
                    });

                    //Tampilkan produk yang dimiliki di sesi 7
                    $.each(data.produk_team_7, function(key, value) {
                        if (value.quantity > 0) {
                            $("#product_list_" + id).show();

                            if (value.id == 1) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_kuning.png') }}' width='100%'>");
                            } else if (value.id == 2) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_goreng.png') }}' width='100%'>");
                            } else if (value.id == 3) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/soto_ayam.png') }}' width='100%'>");
                            } else if (value.id == 4) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/rawon.png') }}' width='100%'>");
                            } else if (value.id == 5) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/sate.png') }}' width='100%'>");
                            } else if (value.id == 6) {
                                $("#product_image_" + id).html("<img src='{{ asset('assets/img/nasi_padang.png') }}' width='100%'>");
                            }

                            $("#product_name_" + id).text(value.nama_produk);
                            $("#product_quantity_" + id).text(value.quantity + " Items");
                            $("#product_price_" + id).text(value.harga_jual + " Fooxie Coin");
                            $("#product_session_" + id).text("Exp : Siklus " + (value.sesi_beli+2)); 
                            id++;
                        } else {
                            $("#product_list_" + id).hide();
                        }
                    });

                    $("#bank-credits").html(data.debt);

                    // Sembunyikan box yang tidak ada produknya
                    for(var i = id; i <= 42; i++) {
                        $("#product_list_" + i).hide();
                    }
                }
            }
        });
    }
</script>
@endsection