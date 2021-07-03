@extends("layout.panitia")

@section("title")
    <title>IG29 - Pos Bank</title>
@endsection

@section("content")
    <!-- CONTENT START -->
    <div class="d-flex flex-wrap">
        <div class="pl-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Input Score -->
            <div class="card card-chart mt-2">
                <div class="card-header card-header-warning">
                    <div class="h3 fw-bold m-0">Bank</div>
                </div>

                <div class="card-body">
                    <h4 class="card-title h3 mb-3 mt-2">Pilih Kelompok : </h4>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="kelompokFC" onchange="showDebt()">
                        <option value="" selected disabled>Pilih Kelompok</option>
                        @foreach($daftarTim as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>

                    <h4 class="card-title h3 mb-3 mt-2">Jumlah FC : </h4>
                    <input class="text-center h4 border border-5 p-3 w-100 rounded-1" type="number" value="0" min="0" id="fc">
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary w-50 mr-2" href="#modalPinjam" data-toggle="modal" id="btnPinjam"><span class="h4 fw-bold">PINJAM</span></button>
                    <button class="btn btn-primary w-50 ml-2" href="#modalBayar" data-toggle="modal" id="btnBayar"><span class="h4 fw-bold">BAYAR</span></button>
                </div>
            </div>

            <div class="card card-chart mt-2" id="showdebt" style="display: none;">
                <div class="card-body">
                    <h4 class="card-title h3 mb-3 mt-2 fw-bold" id='nama-kelompok'>Tim Simul X</h4>
                    <h4 class="card-title h3 mb-3 mt-2">Sisa Hutang : <span id='hutang' class="fw-bold"><b>0</b></span></h4>
                </div>
            </div>

            <div class="alert alert-success fw-bold" id="success-note" style="display:none; letter-spacing: 0.5px;"></div>
        </div>
        
        <div class="pl-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Table History -->
            @include('panitia.helper.riwayat')
        </div>
    </div>
    <!-- CONTENT END -->

    <!-- Modal -->
    <div class="modal fade" id="modalPinjam" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3>
                </div>

                <div class="modal-body" id="confirmation-box-pinjam" style="margin: auto"></div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="pinjam()">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBayar" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3>
                </div>

                <div class="modal-body" id="confirmation-box-bayar" style="margin: auto"></div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="bayar()">Ya</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#minigames').addClass("active");
        });

        $(document).on('click', '#btnPinjam', function() {
            $('#confirmation-box-pinjam').html("Yakin Memberikan Pinjaman Sebesar <span class='text-danger fw-bold'>" + $('#fc').val() + " FC</span> kepada <span class='text-danger fw-bold'> " + $('#kelompokFC option:selected').text() + "</span>?");
        });

        $(document).on('click', '#btnBayar', function() {
            $('#confirmation-box-bayar').html("Yakin Melunasi Hutang <span class='text-danger fw-bold'>" + $('#kelompokFC option:selected').text() + "</span> sebesar <span class='text-danger fw-bold'> " + $('#fc').val() + " FC</span>?");
        });

        function showDebt() {
            var id = $('#kelompokFC').val();
            var nama = $('#kelompokFC option:selected').text();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.showdebt") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id
                },
                success: function(data) {
                    $("#showdebt").css("display", "block");
                    $("#nama-kelompok").text(nama);
                    $("span#hutang").text(data.debt + " FC");
                }
            });
        }

        function pinjam() {
            var id = $('#kelompokFC').val();
            var jumlahFC = $('#fc').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.pinjambank") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id,
                    'jumlahFC': jumlahFC
                },
                success: function(data) {
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(2000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });

                    if(data.status == "oke") {
                        $('#kelompokFC').val('');
                        $('#fc').val(0);
                        $("#showdebt").css("display", "none");
                        
                        $('#success-note').removeClass("alert-danger");
                        $('#success-note').addClass("alert-success");
                    } else if (data.status == "tidak") {
                        $('#success-note').removeClass("alert-success");
                        $('#success-note').addClass("alert-danger");
                    }
                }
            });
        }

        function bayar() {
            var id = $('#kelompokFC').val();
            var jumlahFC = $('#fc').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.bayarbank") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id,
                    'jumlahFC': jumlahFC
                },
                success: function(data) {
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(2000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });

                    if (data.status == "oke") {
                        $('#kelompokFC').val('');
                        $('#fc').val(0);
                        $("#showdebt").css("display", "none");
                        
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
                    'tipe': 'bank'
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
                }, error: function(err){
                    alert('Error');
                }
            });
        }
    </script>
@endsection