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
                        <li><span>Name</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-inner">

        <form class="needs-validation" novalidate="" action="" method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <!-- Textual inputs start -->
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Create new user</h4>
                                    <div class="form-group">
                                        <label for="first_name" class="col-form-label">First Name*</label>
                                        <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                               type="text" name="first_name" value="{{ $user->first_name }}"
                                               id="first_name">

                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="col-form-label">Last Name*</label>
                                        <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                               type="text" name="last_name" value="{{ $user->last_name }}"
                                               id="last_name">

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-form-label">Email*</label>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               type="email" name="email" value="{{ $user->email }}"
                                               id="email">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password*</label>
                                        <input id="password" type="password"
                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                               name="password"
                                               value="inputPassword" placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="">Confirm Password*</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               id="password-confirm" value="inputPassword"
                                               placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Role*</label>
                                        <select class="custom-select">
                                            <option selected="selected">Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-tel-input" class="col-form-label">Phone Number</label>
                                        <input class="form-control" type="tel" value="+880-1233456789"
                                               id="example-tel-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="col-form-label">School Name</label>
                                        <input class="form-control" type="text" value="Carlos Rath"
                                               id="example-text-input">
                                    </div>
                                    <div class="form-group">
                                        <label for="example-number-input" class="col-form-label">Number of Athletes in
                                            the
                                            team*</label>
                                        <input class="form-control" type="number" value="42" id="example-number-input">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Submit form</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Textual inputs end -->
                    </div>
                </div>
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <!-- basic form start -->
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Access</h4>
                                    <div class="form-group">
                                        <label for="code" class="col-form-label">Code</label>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <a id="code_generator" href="#">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </a>
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" value="Carlos Rath" id="code">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-date-input" class="col-form-label">Date Expired*</label>
                                        <input class="form-control" type="date" value="2018-03-05"
                                               id="example-date-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- basic form end -->

                        <!-- Server side start -->
                        <div class="col-12">
                            <div class="card mt-5">
                                <div class="card-body">
                                    <h4 class="header-title">Server side</h4>
                                    {{--<form class="needs-validation2" novalidate="">--}}
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom01">First name</label>
                                            <input type="text" class="form-control" id="validationCustom01"
                                                   placeholder="First name" value="Mark" required="">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom02">Last name</label>
                                            <input type="text" class="form-control" id="validationCustom02"
                                                   placeholder="Last name" value="Otto" required="">
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please choose a username.
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustomUsername">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                </div>
                                                <input type="text" class="form-control"
                                                       id="validationCustomUsername"
                                                       placeholder="Username" aria-describedby="inputGroupPrepend"
                                                       required="">
                                                <div class="invalid-feedback">
                                                    Please choose a username.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationCustom03">City</label>
                                            <input type="text" class="form-control" id="validationCustom03"
                                                   placeholder="City" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid city.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom04">State</label>
                                            <input type="text" class="form-control" id="validationCustom04"
                                                   placeholder="State" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid state.
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom05">Zip</label>
                                            <input type="text" class="form-control" id="validationCustom05"
                                                   placeholder="Zip" required="">
                                            <div class="invalid-feedback">
                                                Please provide a valid zip.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="invalidCheck"
                                                   required="">
                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                            </label>
                                            <div class="invalid-feedback">
                                                You must agree before submitting.
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Submit form</button>
                                    {{--</form>--}}
                                </div>
                            </div>
                        </div>
                        <!-- Server side end -->
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
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
