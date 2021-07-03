<!doctype html>
<html lang="en">
    <head>
        <title>IG29 - Customer List</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link rel="icon" href="{{ asset('assets/img/icon.png')}}">
        
        <!-- Material Kit CSS -->
        <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    </head>

    <body>
        <div class="wrapper">
            <div class="main-panel w-100">
                <div class="content m-0 p-2">
                    <div class="container-fluid p-0">
                        <div class="navbar-wrapper ml-3 text-center p-3">
                           <span class="h2 fw-bold siklus" style="display:none">Babak Semifinal Belum Dimulai</span>
                           <span class="h2 fw-bold timer"></span>
                        </div>

                        <div class="d-flex flex-wrap p-0">
                            <div class="bd-highlight mr-1" style="flex-grow: 1; flex-basis: 48%;">
                                <div class="card card-chart mt-0">
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table" style="width: 100%">
                                                <thead class="text-dark" style="display: block;">
                                                    <tr style='display: table; table-layout: fixed; width: 100%'>
                                                        <th class="text-center" style='width:35%'><span class="h4 fw-bold">Customer App</span></th>
                                                        <th class="text-center" style='width:25%'><span class="h4 fw-bold">Syarat Produk</span></th>
                                                        <th class="text-center" style='width:25%'><span class="h4 fw-bold">Syarat Level</span></th>
                                                        <th class="text-center" style='width:15%'><span class="h4 fw-bold">Kuota</span></th>
                                                    </tr>
                                                </thead>
                                            
                                                <!-- <tbody style="display: block; overflow-y: auto; height: 87vh;" id="customer_app_data"> -->
                                                <tbody style="display: block;" id="customer_app_data">
                                                    @for($i = 1; $i <= 10; $i++)
                                                        <tr style='display: table; table-layout: fixed; width: 100%' id="tr_app_{{ $i }}">
                                                            <td class='text-center p-3 border h5' style='width:35%'><span id='td_cus_app_detail_{{ $i }}'></span></td>
                                                            <td class='text-center p-3 border h5' style='width:25%'><span id='td_cus_app_produk_{{ $i }}'></span></td>
                                                            <td class='text-center p-3 border h5' style='width:25%'><span id='td_cus_app_level_{{ $i }}'></span></td>
                                                            <td class='text-center p-3 border h5 fw-bold' style='width:15%'><span id='td_cus_app_kuota_{{ $i }}'></span></td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bd-highlight ml-1" style="flex-grow: 1; flex-basis: 48%;">
                                <div class="card card-chart mt-0">
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <table class="table" style="width: 100%">
                                                <thead class="text-dark" style="display: block;">
                                                    <tr style='display: table; table-layout: fixed; width: 100%'>
                                                        <th class="text-center" style='width:25%'><span class="h4 fw-bold">Customer Store</span></th>
                                                        <th class="text-center" style='width:20%'><span class="h4 fw-bold">Syarat Produk</span></th>
                                                        <th class="text-center" style='width:25%'><span class="h4 fw-bold">Syarat Wilayah</span></th>
                                                        <th class="text-center" style='width:20%'><span class="h4 fw-bold">Syarat Poin</span></th>
                                                        <th class="text-center" style='width:10%'><span class="h4 fw-bold">Kuota</span></th>
                                                    </tr>
                                                </thead>
                                            
                                                <!-- <tbody style="display: block; overflow-y: auto; height: 87vh;" id="customer_store_data"> -->
                                                <tbody style="display: block;" id="customer_store_data">
                                                    @for($i = 1; $i <= 10; $i++)
                                                        <tr style='display: table; table-layout: fixed; width: 100%' id="tr_store_{{ $i }}">
                                                            <td class='text-center p-3 border h5' style='width:25%'><span id='td_cus_store_detail_{{ $i }}'></span></td>
                                                            <td class='text-center p-3 border h5' style='width:20%'><span id='td_cus_store_produk_{{ $i }}'></span></td>
                                                            <td class='text-center p-3 border h5' style='width:25%'><span id='td_cus_store_wilayah_{{ $i }}'></span></td>
                                                            <td class='text-center p-3 border h5' style='width:20%'><span id='td_cus_store_poin_{{ $i }}'></span></td>
                                                            <td class='text-center p-3 border h5 fw-bold' style='width:10%'><span id='td_cus_store_kuota_{{ $i }}'></span></td>
                                                        </tr>
                                                    @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('dashboardpanitia') }}"><button class="btn btn-primary w-25 h4 fw-bold">Back To Dashboard</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            var siklus = parseInt("{{ $siklus }}");
            var time = parseInt("{{ $remaining_time }}");
            var cooldown = false;

            if (time <= 0) {
                if (siklus < 8) { cooldown = true; }
                time = parseInt("{{ $remaining_cooldown }}");
                if (time <= 0) { time = 0; }
            }

            var runTimer = setInterval(function () {
                $('.siklus').css("display", "inline");
                
                if(siklus < 0) {
                    $('.siklus').html("Babak Semifinal Belum Dimulai");
                } else {
                    var minutes = (Math.floor(time / 60)).toString().padStart(2, '0');
                    var seconds = (time % 60).toString().padStart(2, '0'); 

                    if (cooldown) {
                        $('.answer').prop("disabled", true);
                        $('.siklus').html("Cooldown&nbsp;|&nbsp;");
                        if (time > 0) { time--; }
                    } else {
                        if (siklus == "0") {
                            $('.siklus').html("Siklus Modal Awal&nbsp;|&nbsp;");
                            $('.timer').css("display", "inline");
                            $('#modal-awal').css("display", "block");
                        } else if (siklus == "4") {
                            $('.siklus').html("Siklus " + siklus + " (Competitor)&nbsp;|&nbsp;");
                            $('.timer').css("display", "inline");
                            $('#modal-awal').css("display", "none");
                        } else if (siklus == "8") {
                            $('.siklus').html("Babak Semifinal Telah Selesai");
                            $('.timer').css("display", "none");
                            $('#modal-awal').css("display", "none");
                        } else {
                            $('.siklus').html("Siklus " + siklus + "&nbsp;|&nbsp;");
                            $('.timer').css("display", "inline");
                            $('#modal-awal').css("display", "none");
                        }

                        if (time > 0) {
                            time--;
                        } else {
                            if (siklus < 7) {
                                cooldown = true;
                                time = 120;
                            }
                        }
                    }
                    
                    $('.timer').html(minutes + ":" + seconds);
                }
            }, 1000);

            $(document).ready(function() {
                $('#customer_main').addClass("active");
                realTimeCustomer();
            });

            function realTimeCustomer() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("team.realtimecustomer") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>'
                    },
                    success: function(data) {
                        if (data.status == "oke") {
                            var id = 1;

                            // Tabel Customer App
                            $.each(data.daftarCustomerApp, function(key, value) {
                                $("#tr_app_" + id).css("display", "table");

                                var lvl_app = "";
                                
                                if (value.syarat_bintang == 1) {
                                    lvl_app = "Cockroach";
                                } else if (value.syarat_bintang == 2) {
                                    lvl_app = "Ponies";
                                } else if (value.syarat_bintang == 3) {
                                    lvl_app = "Centaurs";
                                } else if (value.syarat_bintang == 4) {
                                    lvl_app = "Unicorn";
                                } else if (value.syarat_bintang == 5) {
                                    lvl_app = "Decacorn";
                                } else if (value.syarat_bintang == 6) {
                                    lvl_app = "Hectocorn";
                                }

                                $("#td_cus_app_detail_" + id).html("<span style='font-weight: 500'>" + value.nama_customer + " " + ((value.id-10) - ((value.siklus - 1) * 20)) + "</span>");
                                $("#td_cus_app_produk_" + id).html("<span style='font-weight: 500'>" + value.jumlah_produk + " " + value.nama_produk + "</span>");
                                $("#td_cus_app_level_" + id).html("<span style='font-weight: 500'>" + lvl_app + "</span>");
                                $("#td_cus_app_kuota_" + id).text(value.kuota);
                                id = id + 1;
                            });

                            // kosongkan row tabel customer app tertentu jika data customer kurang dari 20
                            for(var i = id; i <= 10; i++) {
                                $("#td_cus_app_detail_" + i).html("");
                                $("#td_cus_app_produk_" + i).html("");
                                $("#td_cus_app_level_" + i).html("");
                                $("#td_cus_app_kuota_" + i).text("");
                                $("#tr_app_" + i).css("display", "none");
                            }

                            id = 1;

                            // Tabel Customer Store
                            $.each(data.daftarCustomerStore, function(key, value) {
                                $("#tr_store_" + id).css("display", "table");

                                $("#td_cus_store_detail_" + id).html("<span style='font-weight: 500'>" + value.nama_customer + " " + ((value.id) - ((value.siklus - 1) * 20)) + "</span>");
                                $("#td_cus_store_produk_" + id).html("<span style='font-weight: 500'>" + value.jumlah_produk + " " + value.nama_produk + "</span>");
                                
                                if (value.competitor == true) {
                                    $("#td_cus_store_wilayah_" + id).html("<span style='font-weight: 500'>Competitor " + value.nama_wilayah + "</span>");
                                } else {
                                    $("#td_cus_store_wilayah_" + id).html("<span style='font-weight: 500'>" + value.nama_wilayah + "</span>");
                                }

                                $("#td_cus_store_poin_" + id).html("<span style='font-weight: 500'>" + value.syarat_tertarik + "</span>");
                                $("#td_cus_store_kuota_" + id).text(value.kuota);
                                
                                id = id + 1;
                            });

                            // kosongkan row tabel customer store tertentu jika data customer kurang dari 20
                            for(var i = id; i <= 10; i++) {
                                $("#td_cus_store_detail_" + i).html("");
                                $("#td_cus_store_produk_" + i).html("");
                                $("#td_cus_store_wilayah_" + i).html("");
                                $("#td_cus_store_poin_" + i).html("");
                                $("#td_cus_store_kuota_" + i).text("");
                                $("#tr_store_" + i).css("display", "none");
                            }
                        }
                    }
                });
            }

            setInterval(() => {
                realTimeCustomer();
            }, 2000);

            document.addEventListener('contextmenu', event => event.preventDefault());
            document.onkeydown = function (e) {
                if(e.keyCode == 123) { return false; }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 73){ return false; }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 74) { return false; }
                if(e.ctrlKey && e.keyCode == 85) { return false; }
            }
        </script>
        <script src="../js/app.js"></script>
    </body>
</html>