@extends("layout.peserta")

@section("title")
    <title>IG29 - Modal Awal</title>
@endsection

@section("content")
        <!-- Title Modal Awal -->
          <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
            <p class="h2" style="font-weight: bold;">MODAL AWAL
          </div>

          <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
            <p class="h3">Aturlah ulang kata-kata acak dibawah ini hingga membentuk kata yang bermakna!</p>
          </div>
          <!-- End Title Modal Awal -->

          <!-- Soal -->
          <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
            <table class="table table-striped table-bordered border-dark border-2">
              <tbody>
                <?php $row = 0; ?>
                @foreach($question as $q)
                  @if($q->id % 5 == 1)<tr>@endif
                  <td class='text-center border-dark border-2'>{{ $q->soal }}</td>
                  @if($q->id % 5 == 0)
                    </tr>
                    <tr>
                      @for($i = 0; $i < 5; $i++)

                        <td class='text-center border-dark border-2'><input type='text' name='answer[]' class="answer" id="answer{{( ($i + 1) + $row)}}" style='width: 100%; font-size: 18px;'></td>
                      @endfor
                      <?php $row += 5; ?>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- End Soal -->

        <div style="height: 100%; margin-bottom: 1%; width: 100%; float: right; display: flex; justify-content: center; align-items: center;">
            <button class="btn btn-info w-25 btn-lg" href="#modalYo" data-toggle="modal"><span class="h4 fw-bold">SUBMIT ANSWER</span></button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalYo" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" >
              <div class="modal-header">
                <h4 class="modal-title fw-bold">Konfirmasi</h4>
              </div>

              <div class="modal-body">
                Apakah Anda sudah yakin dengan jawaban Anda?
              </div>

              <div class="modal-footer">
                <a class="btn btn-default fw-bold text-light" data-dismiss="modal">Tidak</button>
                <a class="btn btn-primary fw-bold text-light" data-dismiss="modal" onclick="inputModalAwal()">Ya</a>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('javascript')
  <script>
    $(document).ready(function() {
        $('#modal-awal').addClass("active");

        // Ambil Jawaban di cookie
        var list_jawaban_json = getCookie('JAWABAN_MODAL_AWAL');
        var list_jawaban = JSON.parse(list_jawaban_json);
        
        for(var i = 0; i < 50; i++) {
            $("#answer" + (i+1)).val(list_jawaban[i]);
        }
    });

    function inputModalAwal() {
      var jawaban = $("input[class='answer']").map(function(){return $(this).val();}).get();

      $.ajax({
        type: 'POST',
        url: '{{ route("team.inputmodalawal") }}',
        data: {
            '_token':'<?php echo csrf_token() ?>',
            'jawaban': jawaban
        },

        success: function(data) {
            alert(data.msg);
            window.location.replace("http://semifinal.industrialgameubaya.com/dashboard");
            // window.location.replace("http://localhost:8000/dashboard");
        }
      });
    }

    $(document).on('change', '.answer', function() {
        // Simpan Jawaban
        var jawaban = $("input[class='answer']").map(function(){return $(this).val();}).get();
        var json_string = JSON.stringify(jawaban);
        document.cookie = "JAWABAN_MODAL_AWAL = " + json_string + "; path=/;";
    });

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
    }
  </script>
@endsection