<!doctype html>
<html lang="en">
    <head>
        <title>IG29 - Maps</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <link rel="icon" href="{{ asset('assets/img/icon.png')}}">
        
        <!-- Material Kit CSS -->
        <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    </head>

    <body>
        <div class="wrapper">
            <div class="main-panel w-100">
                <div class="content m-0">
                    <div class="container-fluid">
                        <div class="d-flex flex-wrap">
                            <div class="pl-4 pr-4 m-2 bd-highlight" style="flex-grow: 1; flex-basis: 48%;">
                                <!-- Tabel Cupertino -->
                                <table class="table table-striped table-bordered border-dark border-2">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center border-dark border-2" colspan="4"><span class="h4 fw-bold">CUPERTINO</span></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @for($i = 1; $i <= 12; $i++)
                                            @if($i % 4 == 1)
                                                @if(($i / 4) % 2 == 0) <tr style="background-color: #F7F7F7;"> @else <tr style="background-color: #FFFFFF;"> @endif
                                            @endif

                                            @if($i < 12)
                                                <td class='text-left border-dark border-2 p-0 w-25' style="vertical-align: top">
                                                    <div class='text-center fw-bold' style='position: absolute; width: 30px; height: 30px; border-right: 2px solid black; border-bottom: 2px solid black'>{{$i}}</div>
                                                    <div class='pt-4 pb-4 text-center fw-bold' id='cupertino_{{ $i }}'></div>
                                                </td>
                                            @else
                                                <td class='text-center border-dark border-2 bg-dark fw-bold pl-4 pr-4' style='color: white; line-height: 2.0;' id='cupertino_{{ $i }}'></td>
                                            @endif

                                            @if($i % 4 == 0) </tr> @endif
                                        @endfor
                                    </tbody>
                                </table>

                                <!-- Tabel San Jose -->
                                <table class="table table-striped table-bordered border-dark border-2">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center border-dark border-2" colspan="4"><span class="h4 fw-bold">SANJOSE</span></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @for($i = 1; $i <= 12; $i++)
                                            @if($i % 4 == 1)
                                                @if(($i / 4) % 2 == 0) <tr style="background-color: #F7F7F7"> @else <tr style="background-color: #FFFFFF; height: 7vh"> @endif
                                            @endif

                                            @if($i < 12)
                                                <td class='text-left border-dark border-2 p-0 w-25' style="vertical-align: top">
                                                    <div class='text-center fw-bold' style='position: absolute; width: 30px; height: 30px; border-right: 2px solid black; border-bottom: 2px solid black'>{{$i}}</div>
                                                    <div class='pt-4 pb-4 text-center fw-bold' id='sanjose_{{ $i }}'></div>
                                                </td>
                                            @else
                                                <td class='text-center border-dark border-2 bg-dark fw-bold pl-4 pr-4' style='color: white; line-height: 2.0;' id='sanjose_{{ $i }}'></td>
                                            @endif

                                            @if($i % 4 == 0) </tr> @endif
                                        @endfor
                                    </tbody>
                                </table>

                                <!-- Tabel Sun Vale -->
                                <table class="table table-striped table-bordered border-dark border-2">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center border-dark border-2" colspan="4"><span class="h4 fw-bold">SUNNY VALE</span></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @for($i = 1; $i <= 12; $i++)
                                            @if($i % 4 == 1)
                                                @if(($i / 4) % 2 == 0) <tr style="background-color: #F7F7F7;"> @else <tr style="background-color: #FFFFFF; height: 7vh"> @endif
                                            @endif

                                            @if($i < 12)
                                                <td class='text-left border-dark border-2 p-0 w-25' style="vertical-align: top">
                                                    <div class='text-center fw-bold' style='position: absolute; width: 30px; height: 30px; border-right: 2px solid black; border-bottom: 2px solid black'>{{$i}}</div>
                                                    <div class='pt-4 pb-4 text-center fw-bold' id='sunvale_{{ $i }}'></div>
                                                </td>
                                            @else
                                                <td class='text-center border-dark border-2 bg-dark fw-bold pl-4 pr-4' style='color: white; line-height: 2.0;' id='sunvale_{{ $i }}'></td>
                                            @endif

                                            @if($i % 4 == 0) </tr> @endif
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('dashboardpanitia') }}"><button class="btn btn-primary w-25 h4 fw-bold">Back To Dashboard</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
                $('#map_main').addClass("active");
                realTimeMap();
            });

            function realTimeMap() {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("team.realtimemap") }}',
                    data: {
                        '_token':'<?php echo csrf_token() ?>'
                    },
                    success: function(data) {
                        for(var i = 1; i <= 12; i++) {
                            $("#cupertino_" + i).html("-");
                        }

                        for(var i = 1; i <= 12; i++) {
                            $("#sanjose_" + i).html("-");
                        }

                        for(var i = 1; i <= 12; i++) {
                            $("#sunvale_" + i).html("-");
                        }

                        // Fill map
                        var cupertinoCompetitor = "";
                        var sanjoseCompetitor = "";
                        var sunnyvaleCompetitor = "";
                        $.each(data.daftarRegionDetails, function(key, value) {
                            if (value.teams_id != null) {
                                if (value.regions_id == 2) {
                                    if(value.id < 12) {
                                        $("#cupertino_" + (value.id)).html("<span class='fw-bold'>" + value.nama + "</span>");
                                        $("#cupertino_" + (value.id)).removeClass("fw-bold");
                                    }

                                    if (value.id >= 12) { cupertinoCompetitor += value.nama + ', '; }
                                }

                                if (value.regions_id == 3) {
                                    if(value.id < 12) {
                                        $("#sanjose_" + (value.id)).html("<span class='fw-bold'>" + value.nama + "</span>");
                                        $("#sanjose_" + (value.id)).removeClass("fw-bold");
                                    }

                                    if (value.id >= 12) { sanjoseCompetitor += value.nama + ', '; }
                                }

                                if (value.regions_id == 4) {
                                    if(value.id < 12) {
                                        $("#sunvale_" + (value.id)).html("<span class='fw-bold'>" + value.nama + "</span>");
                                        $("#sunvale_" + (value.id)).removeClass("fw-bold");
                                    }

                                    if (value.id >= 12) { sunnyvaleCompetitor += value.nama + ', '; }
                                }
                            }
                        });
                        cupertinoCompetitor.substring(0, cupertinoCompetitor.length - 1);
                        $("#cupertino_12").html(cupertinoCompetitor.substring(0, cupertinoCompetitor.length - 2));
                        $("#sanjose_12").html(sanjoseCompetitor.substring(0, sanjoseCompetitor.length - 2));
                        $("#sunvale_12").html(sunnyvaleCompetitor.substring(0, sunnyvaleCompetitor.length - 2));
                    }
                });
            }

            setInterval(() => {
                realTimeMap();
            }, 3000);

            document.addEventListener('contextmenu', event => event.preventDefault());
            document.onkeydown = function (e) {
                if(e.keyCode == 123) { return false; }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 73){ return false; }
                if(e.ctrlKey && e.shiftKey && e.keyCode == 74) { return false; }
                if(e.ctrlKey && e.keyCode == 85) { return false; }
            }
        </script>
    </body>
</html>