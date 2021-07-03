@extends("layout.peserta")

@section("title")
    <title>IG29 - Forecast</title>
@endsection

@section("content")
    <!-- Title Customer Details -->
    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
        <p class="h3" style="font-weight: bold;">FORECAST LINK
    </div>

    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
        <div class="table-responsive">
            <table class="table" style="width: 100%">
                <thead class="text-dark" style="table-layout: fixed; width: calc( 100% - 1em ); display: table;">
                    <tr>
                        <th class="text-center" style='width:30%'><span class="h3 fw-bold">Wilayah</span></th>
                        <th class="text-center" style='width:10%'><span class="h3 fw-bold">Siklus</span></th>
                        <th class="text-center" style='width:60%'><span class="h3 fw-bold">Link</span></th>
                    </tr>
                </thead>
            
                <tbody style="display: block;" id="customer_app_data">
                    @foreach($tim as $t)
                        <tr style='display: table; table-layout: fixed; width: 100%'>
                            <td class='text-center border' style='width:30%'><span>{{ $t->nama_forecast }}</span></td>
                            <td class='text-center border' style='width:10%'><span>{{ $t->siklus_forecast }}</span></td>
                            <td class='text-center border fw-bold' style='width:60%'><span><a href="{{$t->link_forecast}}" target="_blank">{{ $t->link_forecast }}</a></span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- End Title Customer Details -->
@endsection

@section("javascript")
    <script>
        $(document).ready(function() {
            $('#forecast').addClass("active");
        });
    </script>
@endsection