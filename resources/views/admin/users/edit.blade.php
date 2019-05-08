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

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">
        <form class="needs-validation" method="post" novalidate=""
              action="{{ action('Admin\UsersController@update', $user->id) }}">
            @method('PUT')
            {{ csrf_field() }}

            @if(Auth::user()->type == "coach")
                <input type="text" name="activation" value="{{ $user->activation }}" hidden>
                <input id="activation_code_hidden" type="text" name="activation_code"
                       value="{{ $user->activation_code }}" hidden>
                <input id="expiration_date_hidden" type="text" name="expiration_date"
                       value="{{ $user->expiration_date }}" hidden>
            @else
                <input type="text" name="activation" value="{{ $user->activation }}" hidden>
            @endif

            <div class="row">
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Edit user - {{ $user->getFullnameAttribute() }}</h4>
                                    <div class="form-group">
                                        <label for="first_name" class="col-form-label">First Name*</label>
                                        <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                               type="text" name="first_name"
                                               value="@if(old('first_name')) {{ old('first_name') }} @else {{ $user->first_name }} @endif"
                                               id="first_name" required min="6">

                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name" class="col-form-label">Last Name*</label>
                                        <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                               type="text" name="last_name"
                                               value="@if(old('last_name')) {{ old('last_name') }} @else {{ $user->last_name }} @endif"
                                               id="last_name" required min="6" data-rule-minlength="6">

                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group" style="display:none;">
                                        <label for="email" class="col-form-label">Email*</label>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                               type="email" name="email"
                                               value="@if(old('email')) {{ old('email') }} @else {{ $user->email }} @endif"
                                               id="email"
                                               max="255" required disabled>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="wrapper-phone-school-block">
                                        <div class="form-group"
                                             @if(old('type') && old('type') == "admin") style="display:none;"
                                             @else style="display:block;" @endif>
                                            <label for="phone" class="col-form-label">Phone Number</label>
                                            <input class="form-control" name="phone" type="tel"
                                                   value="@if(old('phone')) {{ old('phone') }} @else {{ $user->phone }} @endif"
                                                   id="phone" min="10" max="18">

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif

                                        </div>

                                        <div class="form-group"
                                             @if(old('type') && old('type') == "admin") style="display:none;"
                                             @else style="display:block;" @endif>
                                            <label for="school" class="col-form-label">School Name</label>
                                            <input class="form-control" name="school" type="text"
                                                   value="@if(old('school')) {{ old('school') }} @else {{ $user->school }} @endif"
                                                   id="school" min="6">

                                            @if ($errors->has('school'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('school') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update User</button>
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

                            @if(Auth::user()->type == "admin")
                                @if($user->type == "coach")
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Access</h4>

                                            <div class="form-group"
                                                 @if($user->type == "athlete" || $user->type == "admin") style="display: none" @endif>
                                                <label for="number_students" class="col-form-label">Number of Athletes
                                                    in
                                                    the
                                                    team*</label>
                                                <input class="form-control" name="number_students" type="number"
                                                       value="{{ $user->number_students }}" id="number_students"
                                                       required>

                                                @if ($errors->has('number_students'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('number_students') }}</strong>
                                                </span>
                                                @endif

                                            </div>

                                            <div class="form-group" style="display: none">
                                                <label for="type" class="col-form-label">Role*</label>
                                                <select id="type" name="type"
                                                        class="custom-select{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                                        required>
                                                    <option @if($user->type == 'coach')   selected @endif value="coach">
                                                        Coach
                                                    </option>
                                                    <option @if($user->type == 'admin')   selected @endif value="admin">
                                                        Admin
                                                    </option>
                                                    <option @if($user->type == 'athlete') selected
                                                            @endif value="athlete">
                                                        Athlete
                                                </select>

                                                @if ($errors->has('type'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                                @endif

                                            </div>


                                            <div class="wrapper-access-block">
                                                @if($user->type != "athlete")
                                                    <div class="form-group"
                                                         @if($user->type == "athlete" || $user->type == "admin") style="display: none" @endif>
                                                        <label for="activation" class="col-form-label">Activation
                                                            type*</label>
                                                        <select id="activation" name="activation" required
                                                                class="custom-select{{ $errors->has('activation') ? ' is-invalid' : '' }}">
                                                            <option @if($user->activation == 'demo') selected
                                                                    @endif value="demo">Demo
                                                            </option>
                                                            <option @if($user->activation == 'full') selected
                                                                    @endif value="full">Full
                                                            </option>
                                                        </select>

                                                        @if ($errors->has('activation'))
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('activation') }}</strong>
                                                </span>
                                                        @endif

                                                    </div>


                                                    <div class="wrapper-code"
                                                         style="@if($user->activation == 'full') display:block @else display:none @endif;">
                                                        <div class="form-group">
                                                            <label for="activation_code" class="col-form-label">
                                                        <span class="spanTooltip">
                                                            Activation code*
                                                            <a href="#" class="tooltip-has has-tooltip-right" title=""
                                                               data-original-title="Code to activate the coach in the application."><i
                                                                    class="fas fa-info-circle"></i></a>
                                                        </span>
                                                            </label>

                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <a id="code_generator" href="#">
                                                                <i class="fas fa-sync-alt"></i>
                                                            </a>
                                                        </span>
                                                                </div>
                                                                <input class="form-control" type="text"
                                                                       name="activation_code"
                                                                       value="{{ $user->activation_code }}"
                                                                       id="activation_code"
                                                                       required min="10">

                                                                @if ($errors->has('activation_code'))
                                                                    <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('activation_code') }}</strong>
                                                                </span>
                                                                @endif

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="expiration_date" class="col-form-label">
                                                        <span class="spanTooltip">
                                                            Date Expired*
                                                            <a href="#" class="tooltip-has has-tooltip-right" title=""
                                                               data-original-title="The period expires at night on the set day."><i
                                                                    class="fas fa-info-circle"></i></a>
                                                        </span>
                                                            </label>

                                                            <input class="form-control" type="date"
                                                                   name="expiration_date"
                                                                   value="{{ $user->expiration_date }}"
                                                                   id="expiration_date" required>

                                                            @if ($errors->has('expiration_date'))
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('expiration_date') }}</strong>
                                                            </span>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                        </div>
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
            // $(".has-tooltip-right").tooltip({ placement: 'right'});
            // $(".has-tooltip-left").tooltip({ placement: 'left'});
            // $(".has-tooltip-bottom").tooltip({ placement: 'bottom'});
            // $(".has-tooltip").tooltip();

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
                    setTodayMinValue();
                    setTodayValue();
                }

                if (activation == "athlete") {
                    $('.wrapper-phone-school-block').fadeIn();
                    $('.wrapper-access-block').fadeOut();
                    $('#activation').val('full');
                    setTodayMinValue();
                    setTodayValue();

                }
                if (activation == "coach") {
                    $('.wrapper-phone-school-block').fadeIn();
                    $('.wrapper-access-block').fadeIn();
                    setTodayMinValue();
                    setTodayValue();
                }
            });

        });
    </script>
@endsection
