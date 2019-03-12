@extends('layouts.admin')

@section('css')

@endsection

@section('content')

    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ url('/admin') }}">Home</a></li>
                        <li><a href="{{ url('/admin/users') }}">Users</a></li>
                        <li><span>{{ $user->getFullnameAttribute() }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-inner">
        <form class="needs-validation" novalidate="" action="{{ action('Admin\UsersController@update_password', $user->id) }}" method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Update user password</h4>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="password-old" class="col-form-label">Old Password*</label>

                                            <div class="input-group">
                                                <input id="password-old" type="password"
                                                       class="form-control{{ $errors->has('password-old') ? ' is-invalid' : '' }}"
                                                       name="password-old" value="" placeholder="Password Old" required>

                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <a class="hide_show_password_old" href="#">
                                                            <i class="fa-password-old fas fa-eye"></i>
                                                        </a>
                                                    </span>
                                                </div>

                                                @if ($errors->has('password-old'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password-old') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="password" class="col-form-label">New Password*</label>

                                            <div class="input-group">
                                                <input id="password" type="password"
                                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                       name="password" value="" placeholder="Password" required>

                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <a class="hide_show_password" href="#">
                                                            <i class="fa-password fas fa-eye"></i>
                                                        </a>
                                                    </span>
                                                </div>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="password-confirm" class="col-form-label">Confirm New Password*</label>

                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" class="form-control"
                                                       id="password-confirm" value=""
                                                       placeholder="Password" required>

                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <a class="hide_show_password_confirm" href="#">
                                                            <i class="fa-password-confirm fas fa-eye"></i>
                                                        </a>
                                                    </span>
                                                </div>

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update Password</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Textual inputs end -->
                    </div>
                </div>
                <div class="col-lg-6 col-ml-12"></div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(".hide_show_password_old").hover(
            function functionName() {
                //Change the attribute to text
                $("#password-old").attr("type", "text");
                $(".fa-password-old")
                    .removeClass("fa-eye")
                    .addClass("fa-eye-slash");
            },
            function() {
                //Change the attribute back to password
                $("#password-old").attr("type", "password");
                $(".fa-password-old")
                    .removeClass("fa-eye-slash")
                    .addClass("fa-eye");
            }
        );

        $(".hide_show_password").hover(
            function functionName() {
                //Change the attribute to text
                $("#password").attr("type", "text");
                $(".fa-password")
                    .removeClass("fa-eye")
                    .addClass("fa-eye-slash");
            },
            function() {
                //Change the attribute back to password
                $("#password").attr("type", "password");
                $(".fa-password")
                    .removeClass("fa-eye-slash")
                    .addClass("fa-eye");
            }
        );

        $(".hide_show_password_confirm").hover(
            function functionName() {
                //Change the attribute to text
                $("#password-confirm").attr("type", "text");
                $(".fa-password-confirm")
                    .removeClass("fa-eye")
                    .addClass("fa-eye-slash");
            },
            function() {
                //Change the attribute back to password
                $("#password-confirm").attr("type", "password");
                $(".fa-password-confirm")
                    .removeClass("fa-eye-slash")
                    .addClass("fa-eye");
            }
        );


        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);


        $(document).ready(function (e) {
            var code = generateId(20);
            $('#code').val(code);

            function dec2hex(dec) {
                return ('0' + dec.toString(16)).substr(-2)
            }

            function generateId(len) {
                var arr = new Uint8Array((len || 40) / 2);
                window.crypto.getRandomValues(arr);
                return Array.from(arr, dec2hex).join('');
            }

            $("#code_generator").click(function (e) {
                e.preventDefault();
                var code = generateId(20);
                // var code = Math.random().toString(36).replace('0.', '');
                $('#code').val(code);
            });
        });
    </script>
@endsection
