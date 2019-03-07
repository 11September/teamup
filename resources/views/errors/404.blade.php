<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>СадОк Медікавер</title>
    <!-- Styles -->

    <link href="{{ asset('administrator/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .welcome-logo {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('status') }}
            </div>
        @endif

        <div class="title m-b-md">
            <object class="welcome-logo"
                    type="image/svg+xml"
                    data="{{ asset('images/logo.svg') }}">
                <img
                    src="{{ asset('images/logo.svg') }}">
            </object>
        </div>
    </div>
</div>

<script src="{{ asset('administrator/js/jquery.min.js') }}"></script>
<script src="{{ asset('administrator/js/bootstrap.bundle.min.js') }}"></script>
<script>
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 3000);
</script>

</body>
</html>
