@extends("layout.panitia")

@section("title")
    <title>IG29 - Pos Produk</title>
@endsection

@section("content")
    <div class="d-flex flex-wrap">
        <div class="p-4 pr-4 bd-highlight mt-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Table Produk -->
            <table class="table table-bordered border-dark border-2">
                <thead>
                    <tr>
                        <th scope="col" class="text-center border-dark border-2"><span class="h3 fw-bold">Nama Produk</span></th>
                        <th scope="col" class="text-center border-dark border-2"><span class="h3 fw-bold">Harga Beli</span></th>
                        <th scope="col" class="text-center border-dark border-2"><span class="h3 fw-bold">Jumlah Dibeli</span></th>
                    </tr>
                </thead>

                <tbody id="tbody_product_list">
                    @foreach($daftarProduk as $dp)
                        <tr id="product_list_{{ $dp->id }}">
                            @if($dp->id != 6)
                                <td id="nama_produk_{{ $dp->id }}" class='text-center border-dark border-2 nama fw-bold'>{{ $dp->nama }}</td>
                            @else
                                <td id="nama_produk_6" class='text-center border-dark border-2 nama fw-bold'>{{ $dp->nama }} (Spesial)</td>
                            @endif
                            
                            <td id="harga_produk_{{ $dp->id }}" class='text-center border-dark border-2 harga fw-bold'>{{ $dp->harga_beli }}</td>
                            <td class='text-center border-dark border-2'><input class="form-control text-center jumlah" type="number" min="0" value="0" name="product[]" id="product" onchange="updatePricing()"></td>
                        </tr>
                    @endforeach

                    <tr>
                        <td class='text-center border-dark border-2 fw-bold' colspan="2">TOTAL</td>
                        <td class='text-center border-dark border-2 fw-bold total-harga fw-bold'>0</td>
                    </tr>
                </tbody>
            </table>

            <div class="alert alert-success fw-bold mt-2" id="success-note" style="display:none; letter-spacing: 0.5px;"></div>
        </div>
            
        <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 48%;">
            <!-- Input Score -->
            <div class="card card-chart mt-2 mb-5">
                <div class="card-header card-header-warning">
                    <div class="h3 fw-bold m-0">Pos Produk</div>
                </div>

                <div class="card-body">
                    <h4 class="card-title h3 mb-3 mt-2">Pilih Kelompok : </h4>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="kelompokProduk">
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

            <!-- Table History -->
            @include('panitia.helper.riwayat')
        </div>
    </div>
    <!-- CONTENT END -->

    <!-- Modal -->
    <div class="modal fade" id="modalYo" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >
                <div class="modal-header"><h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3></div>

                <div class="modal-body" id="confirmation-box" style="margin: auto"></div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="inputProduk()">Ya</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            $('#produk').addClass("active");
        });

        $(document).on('click', '#btnBeli', function() {
            var listProduct = "";

            var jumlah = $("input[id='product']").map(function(){return $(this).val();}).get();
            $('td.nama').each(function(i) {
                if (jumlah[i] > 0) {
                    listProduct += jumlah[i] + " " + $(this).text() + ", ";
                }
            });

            $('#confirmation-box').html("Yakin Membeli <span class='text-danger fw-bold'>" + listProduct.slice(0, -2) + "</span> Untuk <span class='text-danger fw-bold'>" + $('#kelompokProduk option:selected').text() + "</span> Seharga <span class='text-danger fw-bold'>" + $('.total-harga').text() + "</span> FC?");
        });

        function updatePricing() {
            var jumlah = $("input[id='product']").map(function(){return $(this).val();}).get();
            var totalPrice = 0;
        
            $('td.harga').each(function(i) {
                totalPrice += parseInt($(this).text()) * jumlah[i];
            });

            $('.total-harga').text(totalPrice);

            $('.jumlah').each(function(i) {
                if($(this).val() == 0){
                $(this).val(0);
                }
            });
        }

        function inputProduk() {
            var id = $('#kelompokProduk').val();
            var products = $("input[id='product']").map(function(){return $(this).val();}).get();

            $.ajax({
                type: 'POST',
                url: '{{ route("team.inputproduk") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>',
                    'id': id,
                    'produk': products
                },
                success: function(data) {
                    $('#success-note').show();
                    $('#success-note').html(data.msg);

                    $("#success-note").fadeTo(2000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });

                    if(data.status == "oke"){
                        $('.jumlah').each(function(i) {
                            $(this).val(0);
                        });

                        $('.total-harga').text("0");
                        $("#kelompokProduk").val('');

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
                    'tipe': 'produk'
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

        function realTimeProduk() {
            $.ajax({
                type: 'POST',
                url: '{{ route("team.realtimeproduk") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>'
                },
                success: function(data) {
                    if (data.status == "oke") {
                        $.each(data.produk, function(key, value) {
                            if(value.id != 6) {
                                $("#nama_produk_" + value.id).text(value.nama);
                            } else {
                                $("#nama_produk_" + value.id).text(value.nama + " (Spesial)");
                            }

                            $("#harga_produk_" + value.id).text(value.harga_beli);
                            updatePricing();
                        });
                    }
                }
            });
        }

        setInterval(() => {
            realTimeProduk();
        }, 3000);
    </script>
@endsection