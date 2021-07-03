<!doctype html>
<html lang="en">
    <head>
        @yield("title")
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

        <style>
            .cardhover {
                transition: 0.4s;
            }

            .cardhover:hover {
                transform: scale(1.1);
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="wrapper ">
            <div class="sidebar" data-color="orange" data-background-color="white">
                <div class="logo">
                    <img src="{{ asset('assets/img/logo.png') }}" width=100%>
                </div>

                <div class="sidebar-wrapper">
                    <ul class="nav">
                        <li class="nav-item" id="dashboard">
                            <a class="nav-link" href="{{ route('dashboardpanitia') }}">
                                <i class="material-icons">dvr</i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item" id="rating">
                            <a class="nav-link" href="{{ route('posrating') }}">
                            <i class="large material-icons">trending_up</i>
                                <p>Pos Upgrade App</p>
                            </a>
                        </li>

                        <li class="nav-item" id="produk">
                            <a class="nav-link" href="{{ route('posproduk') }}">
                                <i class="material-icons">local_grocery_store</i>
                                <p>Pos Produk</p>
                            </a>
                        </li>

                        <li class="nav-item" id="forecasting">
                            <a class="nav-link" href="{{ route('posforecasting') }}">
                                <i class="material-icons">timeline</i>
                                <p>Pos Forecasting</p>
                            </a>
                        </li>

                        <li class="nav-item" id="promosi">
                            <a class="nav-link" href="{{ route('pospromosi') }}">
                                <i class="material-icons">local_offer</i>
                                <p>Pos Promosi</p>
                            </a>
                        </li>

                        <li class="nav-item" id="wilayah">
                            <a class="nav-link" href="{{ route('poswilayah') }}">
                                <i class="material-icons">public</i>
                                <p>Pos Wilayah</p>
                            </a>
                        </li>

                        <li class="nav-item" id="minigames">
                            <a class="nav-link" href="{{ route('minigames') }}">
                                <i class="material-icons">attach_money</i>
                                <p>Pos Bank</p>
                            </a>
                        </li>

                        <li class="nav-item" id="inputcustomer">
                            <a class="nav-link" href="{{ route('inputcustomer') }}">
                                <i class="material-icons">people</i>
                                <p>Pos Input Customer</p>
                            </a>
                        </li>

                        <li class="nav-item" id="franchise">
                            <a class="nav-link" href="{{ route('franchise') }}">
                                <i class="material-icons">store</i>
                                <p>Pos Franchise</p>
                            </a>
                        </li>

                        <li class="nav-item" id="map_main">
                            <a class="nav-link" href="{{ route('mapWilayah') }}">
                                <i class="material-icons">location_city</i>
                                <p>Maps Main Room</p>
                            </a>
                        </li>

                        <li class="nav-item" id="customer_main">
                            <a class="nav-link" href="{{ route('customerlist') }}">
                                <i class="material-icons">list</i>
                                <p>Customer Main Room</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                    <div class="container-fluid">
                        <div class="navbar-wrapper ml-3">
                           <span class="h3 fw-bold siklus" style="display:none">Babak Semifinal Belum Dimulai</span>
                           <span class="h3 fw-bold timer"></span>
                        </div>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                            <span class="navbar-toggler-icon icon-bar"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-end">
                            <span class="h4 text-capitalize fw-bold mr-3">{{ Auth::user()->name }}</span>
                            <span class="h4 text-capitalize fw-bold mr-4 bg-primary p-2 pr-4 pl-4" style="border-radius: 20px"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-light"> {{ __('Logout') }}</a></span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </div>
                </nav>

                <div class="content">
                    <div class="container-fluid">
                        <!-- your content here -->
                        @yield("content")
                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="copyright float-right">
                            <div class="copyright float-right"> Developed by Industrial Games XXIX 2021 Committee </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="../js/app.js"></script>
        @yield('javascript')
        
        <script>
            var siklus = parseInt("{{ $siklus }}");
            var time = parseInt("{{ $remaining_time }}");
            var cooldown = false;

            if (time <= 0) {
                if (siklus < 8) { cooldown = true; }
                time = parseInt("{{ $remaining_cooldown }}");
                if (time <= 0) { time = 0; }
            }
            
            var runTimer = setInterval(function () {
                $('.siklus').css("display", "inline");
                
                if(siklus < 0) {
                    $('.siklus').html("Babak Semifinal Belum Dimulai");
                } else {
                    var minutes = (Math.floor(time / 60)).toString().padStart(2, '0');
                    var seconds = (time % 60).toString().padStart(2, '0'); 

                    if (cooldown) {
                        $('.siklus').html("Cooldown&nbsp;|&nbsp;");
                        if (time > 0) { time--; }
                    } else {
                        if (siklus == "0") {
                            $('.siklus').html("Siklus Modal Awal&nbsp;|&nbsp;");
                            $('.timer').css("display", "inline");
                        } else if (siklus == "4") {
                            $('.siklus').html("Siklus " + siklus + " (Competitor)&nbsp;|&nbsp;");
                            $('.timer').css("display", "inline");
                        } else if (siklus == "8") {
                            $('.siklus').html("Babak Semifinal Telah Selesai");
                            $('.timer').css("display", "none");
                        } else {
                            $('.siklus').html("Siklus " + siklus + "&nbsp;|&nbsp;");
                            $('.timer').css("display", "inline");
                        }

                        if (time > 0) {
                            time--;
                        } else {
                            if (siklus < 7) {
                                cooldown = true;
                                time = 120;
                            }
                        }
                    }
                    
                    $('.timer').html(minutes + ":" + seconds);
                }
            }, 1000);

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