<!doctype html>
<html lang="en">

<head>
    <title>IG XXIX | Login</title>
  
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Material Kit CSS -->
    <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />

    <style>
        ::-webkit-input-placeholder {
            font-size: 20px !important;
        }

        :-moz-placeholder { 
            font-size: 20px !important;
        }
        ::-moz-placeholder { 
            font-size: 20px !important;
        }
    </style>
</head>

<body>
    <div class="wrapper ">
        <div class="main-panel w-100 bg-light">
            <div class="content">
                <div class="container-fluid">
                <!-- CONTENT START -->
                <div class="d-flex flex-wrap mt-0">
                    <div class="pl-4 pt-0 bd-highlight m-2 text-center" style="flex-grow: 1; flex-basis: 48%;">
                        <img src="{{ asset('assets/img/Mascot.png') }}" class="ml-5" alt="" style="width:60%">
                    </div>

                    <div class="p-4 pr-4 bd-highlight m-2 pl-5 pt-5" style="flex-grow: 1; flex-basis: 48%;">
                        <div class="card card-chart mt-5 w-75 ml-5">
                            <div class="card-header card-header-warning text-center">
                                <div class="h3 fw-bold m-0">LOGIN PESERTA</div>
                            </div>

                            <div class="card-body">
                                <input type="text" name="username" class="form-control h3 p-2 pb-4 mb-4 mt-4" placeholder="Username">
                                <input type="password" name="username" class="form-control h3 p-2 pb-4 mt-5 mb-3" placeholder="Password">
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary w-100" type="submit"><span class="h4 fw-bold">LOGIN</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- CONTENT END -->
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="footer w-100 bg-light">
            <div class="container-fluid">
                <div class="copyright">
                    Developed by Industrial Games XXIX 2021 Committee
                </div>
            </div>
        </footer>
    </div>

    <script>
        $(document).ready(function() {
        $('#rating').addClass("active");
        });
    </script>
</body>

</html>