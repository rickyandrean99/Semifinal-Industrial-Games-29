@extends("layout.panitia")

@section("title")
    <title>IG29 - Pos Input Customer</title>
@endsection

@section("content")
    <!-- CONTENT START -->
    <div class="d-flex">
        <div class="bd-highlight pr-4" style="flex-grow: 1; display: flex; justify-content: flex-end;">
            <button class="pl-3 btn btn-primary h4 fw-bold text-capitalize" onclick="LoadRealTimeCustomer()"><i class="material-icons mr-2">refresh</i>Muat Ulang Daftar Customer</button>
        </div>
    </div>

    <div class="d-flex flex-wrap">
        <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <div class="card card-chart mt-2 mb-5">
                <div class="card-header card-header-info">
                    <div class="card-title h3 fw-bold m-0">Daftar Customer App</div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="width: 100%">
                            <thead class="text-dark" style="table-layout: fixed; width: calc( 100% - 1em ); display: table;">
                                <tr>
                                    <th class="text-center" style='width:65%'><span class="h3">Informasi Customer</span></th>
                                    <th class="text-center" style='width:15%'><span class="h3">Kuota</span></th>
                                    <th class="text-center" style='width:20%'><span class="h3">Klaim</span></th>
                                </tr>
                            </thead>
                        
                            <tbody style="display: block; overflow-y: auto; height: 40vh;" id="customer_app_data">
                                @for($i = 1; $i <= 10; $i++)
                                    <tr style='display: table; table-layout: fixed; width: 100%' id="tr_app_{{ $i }}">
                                        <td class='text-center border' style='width:65%'><span id='td_cus_app_detail_{{ $i }}'></span></td>
                                        <td class='text-center border' style='width:15%'><span id='td_cus_app_kuota_{{ $i }}'></span></td>
                                        <td class='text-center border' style='width:20%'><span id='td_cus_app_klaim_{{ $i }}'></span></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Input Score -->
            <div class="card card-chart mt-2">
                <div class="card-header card-header-warning">
                    <div class="h3 fw-bold m-0">Daftar Kelompok</div>
                </div>

                <div class="card-body">
                    <div class="card-title h3 mb-3 mt-2">Pilih Kelompok : </div>

                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="teams_id_inputcustomer">
                        <option value="" selected disabled>Pilih Kelompok</option>
                        @foreach($daftarTim as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <div class="card card-chart mt-2 mb-5">
                <div class="card-header card-header-info">
                    <div class="card-title h3 fw-bold m-0">Daftar Customer Store</div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" style="width: 100%">
                            <thead class="text-dark" style="table-layout: fixed; width: calc( 100% - 1em ); display: table;">
                                <tr>
                                    <th class="text-center" style='width:65%'><span class="h3">Informasi Customer</span></th>
                                    <th class="text-center" style='width:15%'><span class="h3">Kuota</span></th>
                                    <th class="text-center" style='width:20%'><span class="h3">Klaim</span></th>
                                </tr>
                            </thead>
                        
                            <tbody style="display: block; overflow-y: auto; height: 40vh;" id="customer_store_data">
                                @for($i = 1; $i <= 10; $i++)
                                    <tr style='display: table; table-layout: fixed; width: 100%' id="tr_store_{{ $i }}">
                                        <td class='text-center border' style='width:65%'><span id='td_cus_store_detail_{{ $i }}'></span></td>
                                        <td class='text-center border' style='width:15%'><span id='td_cus_store_kuota_{{ $i }}'></span></td>
                                        <td class='text-center border' style='width:20%'><span id='td_cus_store_klaim_{{ $i }}'></span></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="alert alert-success fw-bold mt-0 mb-5" id="success-note" style="display:none; letter-spacing: 0.5px;"></div>

            <!-- Table History -->
            @include('panitia.helper.riwayat')
        </div>
    </div>
    <!-- CONTENT END -->

    <div class="modal fade" id="modalYo" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3>
                </div>
                
                <div class="modal-body" id="confirmation-box" style="margin: auto"></div>

                <div class="modal-footer">
                    <button class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <button class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="claimCustomer()" id="modal_button" value="">Ya</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#inputcustomer').addClass("active");
            realTimeCustomer();
        });

        $(document).on('click', '.btn-app', function() {
            var noCustomerApp = (($(this).val()-10) - ((siklus - 1) * 20));
            $('#confirmation-box').html("Klaim <span class='text-danger fw-bold'>Customer App " + noCustomerApp + "</span> untuk <span class='text-danger fw-bold'>" + $('#teams_id_inputcustomer option:selected').text() + "</span>?");
        });

        $(document).on('click', '.btn-store', function() {
            var noCustomerStore = (($(this).val()) - ((siklus - 1) * 20));
            $('#confirmation-box').html("Klaim <span class='text-danger fw-bold'>Customer Store " + noCustomerStore + "</span> untuk <span class='text-danger fw-bold'>" + $('#teams_id_inputcustomer option:selected').text() + "</span>?");
        });

        function lihatRiwayat() {
            var id = $('#pilih_riwayat_tim').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.showhistory") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id,
                    'tipe': 'klaim_customer'
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

        $('body').on('click', '#button_claim', function(){
            $('#modal_button').val($(this).val());
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
                            // $("#td_cus_app_id_" + id).text(id);

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

                            $("#td_cus_app_detail_" + id).html("<span class='fw-bold'>" + value.nama_customer + " " + ((value.id-10) - ((value.siklus - 1) * 20)) + "</span><br>(Syarat: " + value.jumlah_produk + " " + value.nama_produk + ", App Level " + lvl_app + ")");
                            $("#td_cus_app_kuota_" + id).text(value.kuota);
                            $("#td_cus_app_klaim_" + id).html("<button type='button' href='#modalYo' data-toggle='modal' class='btn btn-info btn-app' value='" + value.id + "' id='button_claim'>Klaim</button>");
                            id = id + 1;
                        });

                        // kosongkan row tabel customer app tertentu jika data customer kurang dari 3
                        for(var i = id; i <= 10; i++) {
                            // $("#td_cus_app_id_" + i).text(i);
                            $("#td_cus_app_detail_" + i).html("");
                            $("#td_cus_app_kuota_" + i).text("");
                            $("#td_cus_app_klaim_" + i).html("");
                            $("#tr_app_" + i).css("display", "none");
                        }

                        id = 1;

                        // Tabel Customer Store
                        $.each(data.daftarCustomerStore, function(key, value) {
                            $("#tr_store_" + id).css("display", "table");
                            // $("#td_cus_store_id_" + id).text(id);
                            
                            if (value.competitor == true) {
                                $("#td_cus_store_detail_" + id).html("<span class='fw-bold'>" + value.nama_customer + " " + ((value.id) - ((value.siklus - 1) * 20)) + "</span><br>(Syarat: " + value.jumlah_produk + " " + value.nama_produk + ", <span>Wilayah Competitor " + value.nama_wilayah + "<span>, " + value.syarat_tertarik + " poin ketertarikan)");
                            } else {
                                $("#td_cus_store_detail_" + id).html("<span class='fw-bold'>" + value.nama_customer + " " + ((value.id) - ((value.siklus - 1) * 20)) + "</span><br>(Syarat: " + value.jumlah_produk + " " + value.nama_produk + ", Wilayah " + value.nama_wilayah + ", " + value.syarat_tertarik + " poin ketertarikan)");
                            }

                            $("#td_cus_store_kuota_" + id).text(value.kuota);
                            
                            $("#td_cus_store_klaim_" + id).html("<button type='button' href='#modalYo' data-toggle='modal' class='btn btn-info btn-store' value='" + value.id + "' id='button_claim'>Klaim</button>");
                        
                            id = id + 1;
                        });

                        // kosongkan row tabel customer store tertentu jika data customer kurang dari 3
                        for(var i = id; i <= 10; i++) {
                            // $("#td_cus_store_id_" + i).text(i);
                            $("#td_cus_store_detail_" + i).html("");
                            $("#td_cus_store_kuota_" + i).text("");
                            $("#td_cus_store_klaim_" + i).html("");
                            $("#tr_store_" + i).css("display", "none");
                        }
                    }
                }
            });
        }

        function claimCustomer() {
            var team_id = $('#teams_id_inputcustomer').val();
            var customer_id = $('#modal_button').val();
            
            $.ajax({
                type: 'POST',
                url: '{{ route("team.inputclaimcustomer") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'team_id': team_id,
                    'customer_id': customer_id
                },
                success: function(data) {
                    $('#success-note').hide();
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(7000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });

                    if (data.status == "oke") {
                        $('#success-note').removeClass("alert-danger");
                        $('#success-note').addClass("alert-success");

                        $("#teams_id_inputcustomer").val('');
                    } else if (data.status == "tidak") {
                        $('#success-note').removeClass("alert-success");
                        $('#success-note').addClass("alert-danger");
                    }
                }
            });
        }

        function LoadRealTimeCustomer() {
            realTimeCustomer();

            // Notifikasi Berhasil
            $('#success-note').hide();
            $('#success-note').show();
            $('#success-note').html("Daftar Customer Berhasil Diperbaharui");

            $("#success-note").fadeTo(2000, 500).hide(500, function(){
                $("#success-note").hide(500);
            });

            $('#success-note').removeClass("alert-danger");
            $('#success-note').addClass("alert-success");
        }
    </script>
@endsection