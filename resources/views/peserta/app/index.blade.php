@extends("layout.peserta")

@section("title")
    <title>IG29 - Application View</title>
@endsection

@section('content')
    <div class="d-flex flex-wrap">
        <div class="p-4 pr-4 bd-highlight m-2" style="flex-grow: 1; flex-basis: 100%;">
            <div class="card card-chart mt-2 mb-5">
                <div class="card-header card-header-info">
                    <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
                        <div class="card-title h3 fw-bold m-0">Application View</div>
                    </div>
                </div>

                <div class="card-body text-center">
                    @foreach($tim as $t)
                        <!-- Level 1 -->
                        @if($t->level_app == 1 && $t->promotions_id == 1)
                            <img src="{{ asset('assets/img/Level1/1_MERAH.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 2)
                            <img src="{{ asset('assets/img/Level1/1_JINGGA.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 3)
                            <img src="{{ asset('assets/img/Level1/1_KUNING.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 4)
                            <img src="{{ asset('assets/img/Level1/1_HIJAU.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 5)
                            <img src="{{ asset('assets/img/Level1/1_BIRUMUDA.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 6)
                            <img src="{{ asset('assets/img/Level1/1_BIRUTUA.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 7)
                            <img src="{{ asset('assets/img/Level1/1_COKLAT.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 8)
                            <img src="{{ asset('assets/img/Level1/1_UNGU.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 9)
                            <img src="{{ asset('assets/img/Level1/1_PUTIH.png') }}" width='25%'>
                        @elseif($t->level_app == 1 && $t->promotions_id == 10)
                            <img src="{{ asset('assets/img/Level1/1_HITAM.png') }}" width='25%'>

                        <!-- Level 2 -->
                        @elseif($t->level_app == 2 && $t->promotions_id == 1)
                            <img src="{{ asset('assets/img/Level2/2_MERAH.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 2)
                            <img src="{{ asset('assets/img/Level2/2_JINGGA.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 3)
                            <img src="{{ asset('assets/img/Level2/2_KUNING.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 4)
                            <img src="{{ asset('assets/img/Level2/2_HIJAU.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 5)
                            <img src="{{ asset('assets/img/Level2/2_BIRUMUDA.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 6)
                            <img src="{{ asset('assets/img/Level2/2_BIRUTUA.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 7)
                            <img src="{{ asset('assets/img/Level2/2_COKLAT.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 8)
                            <img src="{{ asset('assets/img/Level2/2_UNGU.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 9)
                            <img src="{{ asset('assets/img/Level2/2_PUTIH.png') }}" width='25%'>
                        @elseif($t->level_app == 2 && $t->promotions_id == 10)
                            <img src="{{ asset('assets/img/Level2/2_HITAM.png') }}" width='25%'>

                        <!-- Level 3 -->
                        @elseif($t->level_app == 3 && $t->promotions_id == 1)
                            <img src="{{ asset('assets/img/Level3/3_MERAH.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 2)
                            <img src="{{ asset('assets/img/Level3/3_JINGGA.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 3)
                            <img src="{{ asset('assets/img/Level3/3_KUNING.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 4)
                            <img src="{{ asset('assets/img/Level3/3_HIJAU.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 5)
                            <img src="{{ asset('assets/img/Level3/3_BIRUMUDA.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 6)
                            <img src="{{ asset('assets/img/Level3/3_BIRUTUA.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 7)
                            <img src="{{ asset('assets/img/Level3/3_COKLAT.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 8)
                            <img src="{{ asset('assets/img/Level3/3_UNGU.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 9)
                            <img src="{{ asset('assets/img/Level3/3_PUTIH.png') }}" width='25%'>
                        @elseif($t->level_app == 3 && $t->promotions_id == 10)
                            <img src="{{ asset('assets/img/Level3/3_HITAM.png') }}" width='25%'>

                        <!-- Level 4 -->
                        @elseif($t->level_app == 4 && $t->promotions_id == 1)
                            <img src="{{ asset('assets/img/Level4/4_MERAH.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 2)
                            <img src="{{ asset('assets/img/Level4/4_JINGGA.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 3)
                            <img src="{{ asset('assets/img/Level4/4_KUNING.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 4)
                            <img src="{{ asset('assets/img/Level4/4_HIJAU.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 5)
                            <img src="{{ asset('assets/img/Level4/4_BIRUMUDA.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 6)
                            <img src="{{ asset('assets/img/Level4/4_BIRUTUA.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 7)
                            <img src="{{ asset('assets/img/Level4/4_COKLAT.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 8)
                            <img src="{{ asset('assets/img/Level4/4_UNGU.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 9)
                            <img src="{{ asset('assets/img/Level4/4_PUTIH.png') }}" width='25%'>
                        @elseif($t->level_app == 4 && $t->promotions_id == 10)
                            <img src="{{ asset('assets/img/Level4/4_HITAM.png') }}" width='25%'>

                        <!-- Level 5 -->
                        @elseif($t->level_app == 5 && $t->promotions_id == 1)
                            <img src="{{ asset('assets/img/Level5/5_MERAH.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 2)
                            <img src="{{ asset('assets/img/Level5/5_JINGGA.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 3)
                            <img src="{{ asset('assets/img/Level5/5_KUNING.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 4)
                            <img src="{{ asset('assets/img/Level5/5_HIJAU.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 5)
                            <img src="{{ asset('assets/img/Level5/5_BIRUMUDA.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 6)
                            <img src="{{ asset('assets/img/Level5/5_BIRUTUA.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 7)
                            <img src="{{ asset('assets/img/Level5/5_COKLAT.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 8)
                            <img src="{{ asset('assets/img/Level5/5_UNGU.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 9)
                            <img src="{{ asset('assets/img/Level5/5_PUTIH.png') }}" width='25%'>
                        @elseif($t->level_app == 5 && $t->promotions_id == 10)
                            <img src="{{ asset('assets/img/Level5/5_HITAM.png') }}" width='25%'>

                        <!-- Level 6 -->
                        @elseif($t->level_app == 6 && $t->promotions_id == 1)
                            <img src="{{ asset('assets/img/Level6/6_MERAH.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 2)
                            <img src="{{ asset('assets/img/Level6/6_JINGGA.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 3)
                            <img src="{{ asset('assets/img/Level6/6_KUNING.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 4)
                            <img src="{{ asset('assets/img/Level6/6_HIJAU.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 5)
                            <img src="{{ asset('assets/img/Level6/6_BIRUMUDA.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 6)
                            <img src="{{ asset('assets/img/Level6/6_BIRUTUA.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 7)
                            <img src="{{ asset('assets/img/Level6/6_COKLAT.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 8)
                            <img src="{{ asset('assets/img/Level6/6_UNGU.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 9)
                            <img src="{{ asset('assets/img/Level6/6_PUTIH.png') }}" width='25%'>
                        @elseif($t->level_app == 6 && $t->promotions_id == 10)
                            <img src="{{ asset('assets/img/Level6/6_HITAM.png') }}" width='25%'>
                        @endif
                    @endforeach      
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript') 
<script>
    $(document).ready(function() {
        $('#app').addClass("active");
    });
</script>
@endsection