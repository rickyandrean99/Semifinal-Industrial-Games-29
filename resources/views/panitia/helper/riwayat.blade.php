<div class="card card-chart mt-2">
    <div class="card-header card-header-info">
        <div class="card-title h3 fw-bold m-0">Tabel Riwayat</div>
    </div>

    <div class="card-body">
        <form class="form-inline">
            <div class="form-group w-75 p-1">
                <select class="form-select form-select-lg mb-0 d-inline" aria-label=".form-select-lg example" id="pilih_riwayat_tim">
                    <option value="" selected disabled>Pilih Kelompok</option>
                    @foreach($daftarTim as $dt)
                        <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group w-25 p-1">
                <button type="button" class="btn btn-primary w-100" onclick="lihatRiwayat()"><span class="h4 fw-bold">Lihat</span></button>
            </div>
        </form>

        <div class="h3 mb-3 mt-3 text-center fw-bold" id="title_riwayat_tim"></div>

        <div class="table-responsive">
            <table class="table">
                <thead class="text-dark" style="table-layout: fixed; width: calc( 100% - 1em ); display: table;">
                    <tr>
                        <th class="text-center"><span class="h3">Siklus</span></th>
                        <th class="text-center"><span class="h3">Waktu</span></th>
                        <th class="text-center"><span class="h3">Riwayat</span></th>
                    </tr>
                </thead>
                
                <tbody style="display: block; overflow-y: scroll; height: 50vh;" id="daftar_riwayat_tim"></tbody>
            </table>
        </div>
    </div>
</div>