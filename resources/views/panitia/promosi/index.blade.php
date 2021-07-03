@extends("layout.panitia")

@section("title")
    <title>IG29 - Pos Promosi</title>
@endsection

@section("content")
    <!-- CONTENT START -->
    <div class="d-flex flex-wrap">
        <div class="pl-4 pr-4 bd-highlight ml-2 mr-2 mb-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Table Produk -->
            <div class="h2 fw-bold w-100 text-center" id="team_name" style="display: none"></div>
            <div class="mt-3" style="overflow-y: scroll; height: auto">
                <table class="table table-bordered border-dark border-2">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center border-dark border-2"><span class="h3 fw-bold">No</span></th>
                            <th scope="col" class="text-center border-dark border-2"><span class="h3 fw-bold">Warna</span></th>
                            <th scope="col" class="text-center border-dark border-2"><span class="h3 fw-bold">Harga</span></th>
                            <th scope="col" class="text-center border-dark border-2"><span class="h3 fw-bold">Klaim</span></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($daftarPromotion as $dp)
                            <tr id="promotion_row_{{ $dp->id }}">
                                <td class='text-center border-dark border-2' style="width: 10%;">{{ $dp->id }}</td>
                                <td class='text-center border-dark border-2' style="width: 50%;"><div class="w-100" style="background: {{ $dp->warna }}; height: 40px"></div></td>
                                <td class='text-center border-dark border-2 harga fw-bold' style="width: 25%;">{{ $dp->harga }} FC</td>
                                <td class='text-center border-dark border-2' style="width: 15%;">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input cbx" type="checkbox" name="promotion[]" value="{{$dp->harga}}" id="check_promotion_{{$dp->id}}" onchange="updatePricing({{$dp->id}})">
                                            
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    
                        <tr>
                            <td class='text-center border-dark border-2 fw-bold' colspan="3">TOTAL</td>
                            <td class='text-center border-dark border-2 total-harga fw-bold'>0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
            
        <div class="pl-4 pr-4 bd-highlight ml-2 mr-2 mb-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Input Score -->
            <div class="card card-chart mt-2 mb-5">
                <div class="card-header card-header-warning">
                    <div class="h3 fw-bold m-0">Pos Promosi</div>
                </div>

                <div class="card-body">
                    <h4 class="card-title h3 mb-3 mt-2">Pilih Kelompok : </h4>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="kelompokPromosi">
                        <option value="" selected disabled>Pilih Kelompok</option>
                        @foreach($daftarTim as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary w-100" href="#modalYo" data-toggle="modal" id="btnBeli"><span class="h4 fw-bold">BELI</span></button>
                </div>
            </div>

            <div class="alert alert-success fw-bold mb-5" id="success-note" style="display:none; letter-spacing: 0.5px;"></div>

            <!-- Table History -->
            @include('panitia.helper.riwayat')
        </div>
    </div>
    <!-- CONTENT END -->

    <!-- Modal -->
    <div class="modal fade" id="modalYo" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3>
                </div>

                <div class="modal-body" id="confirmation-box" style="margin: auto"></div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="inputPromosi()">Ya</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#promosi').addClass("active");
        });

        $(document).on('click', '#btnBeli', function() {
            var promotion_id = $("input[name='promotion[]']:checked").attr('id').split("_");
            var color = "";

            if (promotion_id[2] == "1") {
                color = "Merah";
            } else if (promotion_id[2] == "2") {
                color = "Jingga";
            } else if (promotion_id[2] == "3") {
                color = "Kuning";
            } else if (promotion_id[2] == "4") {
                color = "Hijau";
            } else if (promotion_id[2] == "5") {
                color = "Biru Muda";
            } else if (promotion_id[2] == "6") {
                color = "Biru Gelap";
            } else if (promotion_id[2] == "7") {
                color = "Coklat";
            } else if (promotion_id[2] == "8") {
                color = "Ungu";
            } else if (promotion_id[2] == "9") {
                color = "Putih";
            } else if (promotion_id[2] == "10") {
                color = "Hitam";
            }

            $('#confirmation-box').html("Yakin membeli Promosi <span class='text-danger fw-bold'>" + color + "</span> untuk <span class='text-danger fw-bold'>" + $('#kelompokPromosi option:selected').text() + "</span>?");
        });

        $("#kelompokPromosi").change(function(){
            chooseTeams();
        });

        function inputPromosi() {
            var id = $('#kelompokPromosi').val();
            var promotion_id = $("input[name='promotion[]']:checked").attr('id').split("_");

            $.ajax({
                type: 'POST',
                url: '{{ route("team.inputpromosi") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id,
                    'promosi': promotion_id[2]
                },
                success: function(data) {
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(2000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });

                    if(data.status == "oke"){
                        $('.total-harga').text("0");
                        $("#kelompokPromosi").val('');
                        $("#team_name").text('');
                        $("#team_name").css("display", "none");

                        for(var i = 1; i <= 10; i++) {
                            $("#promotion_row_" + i).removeClass("bg-secondary");
                            $("#check_promotion_" + i).prop('checked', false);
                            $("#check_promotion_" + i).removeAttr("disabled");
                        }

                        $('#success-note').removeClass("alert-danger");
                        $('#success-note').addClass("alert-success");
                    } else if (data.status == "tidak") {
                        $('#success-note').removeClass("alert-success");
                        $('#success-note').addClass("alert-danger");
                    }
                }, error: function(err) {
                    alert('error');
                }
            });
        }

        function chooseTeams(){
            var id = $('#kelompokPromosi').val();
            var nama = $('#kelompokPromosi option:selected').text();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.showteampromotion") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id
                },
                success: function(data) {
                    if (data.status == "oke") {
                        for(var i = 1; i <= 10; i++) {
                            $("#check_promotion_" + i).prop('checked', false);
                        }

                        if(data.allow){
                            for(var i = 1; i <= 10; i++) {
                                $("#promotion_row_" + i).removeClass("bg-secondary");
                                $("#check_promotion_" + i).removeAttr("disabled");
                            }
                        } else {
                            for(var i = 1; i <= 10; i++){
                                $("#promotion_row_" + i).addClass("bg-secondary");
                                $("#check_promotion_" + i).attr("disabled", "true");
                            }
                        }
                        
                        $('.total-harga').text("0");
                        $("#team_name").text(nama);
                        $("#team_name").css("display", "block");
                    }
                }
            });
        }

        function updatePricing(index) {
            $(".cbx").prop('checked', false);
            $("#check_promotion_" + index).prop('checked', true);
            $('.total-harga').text($("#check_promotion_" + index).val());
        }

        function lihatRiwayat() {
            var id = $('#pilih_riwayat_tim').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.showhistory") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id,
                    'tipe': 'promosi'
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
    </script>
@endsection