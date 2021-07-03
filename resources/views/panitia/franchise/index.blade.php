@extends("layout.panitia")

@section("title")
    <title>IG29 - Pos Franchise</title>
@endsection

@section("content")
    <div class="d-flex flex-wrap">
        <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <div class="card card-chart mt-2">
                <div class="card-header card-header-warning">
                    <div class="h3 fw-bold m-0">Pos Franchise</div>
                </div>
                
                <div class="card-body">
                    <div class="card-title h3 mb-3 mt-2">Pilih Kelompok : </div>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="kelompokFranchise">
                        <option value="" selected disabled>Pilih Kelompok</option>
                        @foreach($daftarTim as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary w-100" href="#modalYo" data-toggle="modal" id="btnBuka"><span class="h4 fw-bold">Buka Franchise</span></button>
                </div>
            </div>

            <div class="alert alert-success fw-bold" id="success-note" style="display:none; letter-spacing: 0.5px;"></div>
        </div>
              
        <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Table History -->
            @include('panitia.helper.riwayat')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalYo" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fw-bold" style="margin: auto">KONFIRMASI</h3>
                </div>

                <div class="modal-body" id="confirmation-box" style="margin: auto"></div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="openFranchise()">Ya</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#franchise').addClass("active");
        });

        $(document).on('click', '#btnBuka', function() {
            $('#confirmation-box').html("Yakin Membuka Franchise untuk <span class='text-danger fw-bold'>" + $('#kelompokFranchise option:selected').text() + "</span>?");
        });

        function openFranchise() {
            var id = $('#kelompokFranchise').val();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.openfranchise") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id
                },
                success: function(data) {
                    $("#kelompokFranchise").val('');
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(2000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });
                    
                    if (data.status == "oke") {
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
                    'tipe': 'franchise'
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