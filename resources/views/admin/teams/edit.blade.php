@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/multi-select.css') }}">
@endsection

@section('content')

    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ url('/admin') }}">Home</a></li>
                        <li><a href="{{ url('/admin/teams') }}">Teams</a></li>
                        <li><span>{{ $team->name }}</span></li>
                    </ul>
                </div>
            </div>

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">

        <form class="needs-validation" method="post" novalidate=""
              action="{{ action('Admin\TeamsController@update', $team->id) }}">
            @method('PUT')
            {{ csrf_field() }}

            <div class="row">
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Edit Team - {{ $team->name }}</h4>

                                    <div class="form-group">
                                        <label for="first_name" class="col-form-label">Team Name*</label>
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               type="text" name="name"
                                               value="{{ old('name') ? old('name') : $team->name }}"
                                               id="name" required min="6">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    @if(Auth::user()->type == "admin")
                                        <div class="form-group">
                                            <label for="type" class="col-form-label">Coach Name*</label>
                                            <select id="type" name="user_id"
                                                    class="custom-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}"
                                                    disabled="disabled" required>

                                                @foreach($coaches as $coach)
                                                    <option
                                                        @if($team->user_id == $coach->id) selected="selected" @endif
                                                    name="user_id"
                                                        value="{{ $coach->id }}">{{ $coach->getFullnameAttribute() }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('user_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('user_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    @endif


                                    {{--<div class="form-group">--}}
                                        {{--<label for="code" class="col-form-label">Code</label>--}}

                                        {{--<div class="input-group mb-3">--}}
                                            {{--<div class="input-group-prepend">--}}
                                                {{--<span class="input-group-text" id="basic-addon1">--}}
                                                    {{--<a id="code_generator" href="#">--}}
                                                        {{--<i class="fas fa-sync-alt"></i>--}}
                                                    {{--</a>--}}
                                                {{--</span>--}}
                                            {{--</div>--}}
                                            {{--<input disabled="disabled" class="form-control" type="text" name="code"--}}
                                                   {{--value="{{ old('code') ? old('code') : $team->code }}" id="code"--}}
                                                   {{--required min="10">--}}

                                            {{--@if ($errors->has('code'))--}}
                                                {{--<span class="invalid-feedback" role="alert">--}}
                                                    {{--<strong>{{ $errors->first('code') }}</strong>--}}
                                                {{--</span>--}}
                                            {{--@endif--}}

                                        {{--</div>--}}
                                    {{--</div>--}}
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

                                    <div class="form-group">
                                        <label for="ids" class="col-form-label">Athlets in team</label>

                                        <select name="ids[]" id="ids" multiple>

                                            @foreach($athlets as $athlet)

                                                @php($selected = "")

                                                @foreach($team->users as $user)

                                                    @if($user->id == $athlet->id)
                                                        @php($selected = "selected='selected'")
                                                    @endif

                                                @endforeach

                                                <option {{ $selected }} value='{{ $athlet->id }}'>{{ $athlet->getFullnameAttribute() }}</option>

                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Update Team</button>
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
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>

    <script type="text/javascript">
        $('#ids').multiSelect();
    </script>

    <script>
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
            $('#code').val(code);
        });

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
    </script>
@endsection
