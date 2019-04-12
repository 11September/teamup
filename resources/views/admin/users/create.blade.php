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
                        <li><span>Create new User</span></li>
                    </ul>
                </div>
            </div>

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">

        <form class="needs-validation" novalidate="" action="{{ action('Admin\UsersController@store') }}"
              method="post">
            {{ csrf_field() }}

            @if(Auth::user()->type == "coach")
                <input type="text" name="activation" value="full" hidden>
                <input id="activation_code_hidden" type="text" name="activation_code" value="@php(print(bin2hex(random_bytes(10))))" hidden>
                <input id="expiration_date_hidden" type="text" name="expiration_date" value="{{ \Carbon\Carbon::now() }}" hidden>
            @endif

            <div class="row">
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Create new user</h4>

                                    <div class="form-group">
                                        <label for="type" class="col-form-label">Role*</label>
                                        <select id="type" name="type"
                                                class="custom-select{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                                required>

                                            @if(Auth::user()->type == "admin")
                                                <option selected="selected" value="coach">Coach</option>
                                                <option value="admin">Admin</option>
                                            @endif

                                            <option value="athlete">Athlete</option>

                                        </select>

                                        @if ($errors->has('type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                        @endif

                                    </div>


                                    <div class="form-group">
                                        <label for="first_name" class="col-form-label">First Name*</label>
                                        <input
                                            class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                            type="text" name="first_name" value="{{ old('first_name') }}"
                                            id="first_name" required min="6">

                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name" class="col-form-label">Last Name*</label>
                                        <input
                                            class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                            type="text" name="last_name" value="{{ old('last_name') }}"
                                            id="last_name" required min="6" data-rule-minlength="6">

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email*</label>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               type="email" name="email" value="{{ old('email') }}" id="email"
                                               max="255" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="wrapper-phone-school-block">
                                        <div class="form-group">
                                            <label for="phone" class="col-form-label">Phone Number</label>
                                            <input class="form-control" name="phone" type="tel"
                                                   value="{{ old('phone') }}"
                                                   id="phone" min="10" max="18">

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif

                                        </div>

                                        <div class="form-group">
                                            <label for="school" class="col-form-label">School Name</label>
                                            <input class="form-control" name="school" type="text"
                                                   value="{{ old('school') }}" id="school" min="6">

                                            @if ($errors->has('school'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('school') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Create User</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Textual inputs end -->
                    </div>
                </div>
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Access</h4>

                                    @if(Auth::user()->type == "admin")
                                        <div class="wrapper-access-block">
                                            <div class="form-group">
                                                <label for="number_students" class="col-form-label">Number of Athletes
                                                    in
                                                    the
                                                    team*</label>
                                                <input class="form-control" name="number_students" type="number"
                                                       value="{{ old('number_students') }}" id="number_students"
                                                       required>

                                                @if ($errors->has('number_students'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('number_students') }}</strong>
                                                    </span>
                                                @endif

                                            </div>

                                            <div class="form-group">
                                                <label for="activation" class="col-form-label">Activation type*</label>
                                                <select id="activation" name="activation"
                                                        class="custom-select{{ $errors->has('activation') ? ' is-invalid' : '' }}"
                                                        required>
                                                    <option selected="selected" value="demo">Demo</option>
                                                    <option value="full">Full</option>
                                                </select>

                                                @if ($errors->has('activation'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('activation') }}</strong>
                                                </span>
                                                @endif

                                            </div>

                                            <div class="wrapper-code" style="display:none;">
                                                <div class="form-group">
                                                    <label for="activation_code" class="col-form-label">Code</label>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <a id="code_generator" href="#">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </a>
                                                        </span>
                                                        </div>
                                                        <input class="form-control" type="text" name="activation_code"
                                                               value="{{ old('activation_code') }}" id="activation_code"
                                                               required min="10">

                                                        @if ($errors->has('activation_code'))
                                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('activation_code') }}</strong>
                                                        </span>
                                                        @endif

                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="expiration_date" class="col-form-label">Date
                                                        Expired*</label>
                                                    <input class="form-control" type="date" name="expiration_date"
                                                           value="{{ old('expiration_date') }}"
                                                           id="expiration_date" required>

                                                    @if ($errors->has('expiration_date'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('expiration_date') }}</strong>
                                                </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="form-group">
                                        <div class="input-group">
                                            <label for="password" class="col-form-label">Password*</label>

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
                                            <label for="password-confirm" class="col-form-label">Confirm
                                                Password*</label>

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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>

        $(".hide_show_password").hover(
            function functionName() {
                //Change the attribute to text
                $("#password").attr("type", "text");
                $(".fa-password")
                    .removeClass("fa-eye")
                    .addClass("fa-eye-slash");
            },
            function () {
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
            function () {
                //Change the attribute back to password
                $("#password-confirm").attr("type", "password");
                $(".fa-password-confirm")
                    .removeClass("fa-eye-slash")
                    .addClass("fa-eye");
            }
        );

        function setTodayMinValue() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();
            if (dd < 10) {
                dd = '0' + dd
            }
            if (mm < 10) {
                mm = '0' + mm
            }

            today = yyyy + '-' + mm + '-' + dd;

            document.getElementById("expiration_date").setAttribute("min", today);
        }

        function setTodayValue() {
            var myDate = document.getElementById("expiration_date");
            var today = new Date();
            myDate.value = today.toISOString().substr(0, 10);
        }

        setTodayMinValue();
        setTodayValue();

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
            var code = generateId(10);
            $('#activation_code').val(code);

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
                var code = generateId(10);
                $('#activation_code').val(code);
            });

            $('#activation').on('change', function () {
                var activation = $(this).val();

                if (activation == "demo") {
                    $('.wrapper-code').fadeOut();
                    $('#activation_code').val();
                } else {
                    $('.wrapper-code').fadeIn();
                    $('#activation_code').val(generateId(10));
                }
            });

            $('#type').on('change', function () {
                var activation = $(this).val();

                if (activation == "admin") {
                    $('.wrapper-phone-school-block').fadeOut();
                    $('.wrapper-access-block').fadeOut();
                    $('#activation').val('full');
                    $('#activation_code').val(generateId(10));
                    $('#expiration_date').val(generateId(10));
                    setTodayMinValue();
                    setTodayValue();
                }

                if (activation == "athlete") {
                    $('.wrapper-phone-school-block').fadeIn();
                    $('.wrapper-access-block').fadeOut();
                    $('#activation').val('full');
                    $('#activation_code').val(generateId(10));
                    $('#expiration_date').val(generateId(10));
                    setTodayMinValue();
                    setTodayValue();

                }
                if (activation == "coach") {
                    $('.wrapper-phone-school-block').fadeIn();
                    $('.wrapper-access-block').fadeIn();
                    $('#activation_code').val(generateId(10));
                    $('#expiration_date').val(generateId(10));
                    setTodayMinValue();
                    setTodayValue();
                }
            });

        });
    </script>
@endsection
