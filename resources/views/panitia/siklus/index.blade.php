@extends('layout.panitia')

@section("title")
    <title>IG29 - Update Siklus</title>
@endsection

@section('content')
    <div class="d-flex flex-wrap">
        <div class="pl-2 pr-2 bd-highlight text-center" style="flex-grow: 1; flex-basis: 100%; margin-top: 25vh">
            <div>
                <span class="h1 fw-bold siklus"></span>
                <span class="h1 fw-bold timer"></span>
            </div>
        </div>

        <div class="pl-2 pr-2 bd-highlight text-center" style="flex-grow: 1; flex-basis: 100%; margin-top: 7vh">
            <button class="btn btn-primary h3 fw-bold" href="#modalUpdate" data-toggle="modal" style="text-transform: capitalize">Update Siklus</button>
            <button class="btn btn-danger h3 fw-bold ml-5" href="#modalUpdateHarga" data-toggle="modal" style="text-transform: capitalize">Update Harga</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="basic" aria-hidden="true" style="margin-left: 7%">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >
                <div class="modal-header"><h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3></div>

                <div class="modal-body fw-bold" style="margin: auto">Yakin Update Siklus?</div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" id="update_siklus">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalUpdateHarga" tabindex="-1" role="basic" aria-hidden="true" style="margin-left: 7%">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >
                <div class="modal-header"><h3 class="modal-title fw-bold" style="margin: auto">Konfirmasi</h3></div>

                <div class="modal-body fw-bold" style="margin: auto">Yakin Update Harga Produk?</div>

                <div class="modal-footer">
                    <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                    <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" id="update_harga_produk">Ya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-success fw-bold mt-5 mb-1 w-25 text-center" id="success-note" style="display:none; letter-spacing: 0.5px; margin:auto"></div>
@endsection

@section('javascript')
    <script>
        $(document).on('click', '#update_harga_produk', function() {
            $.ajax({
                type: 'POST',
                url: '{{ route("panitia.updatehargaproduk") }}',
                data: {
                    '_token':'<?php echo csrf_token() ?>'
                },
                success: function(data) {
                    $('#success-note').show();
                    $('#success-note').html("Harga Produk Berhasil Diperbaharui");

                    $("#success-note").fadeTo(3000, 500).hide(500, function(){
                        $("#success-note").hide(500);
                    });
                }
            });
        });
    </script>
@endsection