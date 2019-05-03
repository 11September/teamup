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
                        <li><span>Create new Team</span></li>
                    </ul>
                </div>
            </div>

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">

        <form class="needs-validation" novalidate="" action="{{ action('Admin\TeamsController@store') }}"
              method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-lg-3 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Create new Team</h4>

                                    <div class="form-group">
                                        <label for="first_name" class="col-form-label">Team Name*</label>
                                        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                               type="text" name="name" value="{{ old('name') }}"
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
                                                    required>

                                                @foreach($coaches as $coach)
                                                    <option value="{{ $coach->id }}"
                                                            @if(old('user_id') == $coach->id) selected="selected" @endif>
                                                        {{ $coach->getFullnameAttribute() }}
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

                                    @if(Auth::user()->type == "coach")
                                        <input name="user_id" type="hidden" value="{{ \Illuminate\Support\Facades\Auth::id() }}">
                                    @endif

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
                                            <input class="form-control" type="text" name="code"
                                                   value="{{ old('code') }}" id="code"
                                                   required min="5">

                                            @if ($errors->has('code'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('code') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Create Team</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Textual inputs end -->
                    </div>
                </div>

                <div class="col-lg-9 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="header-title">Team Members</h4>

                                            <div class="wrapper-multiselect">
                                                <div class="form-group">
                                                    <label for="ids" class="col-form-label">Choose athlets in your
                                                        team</label>

                                                    <select name="ids[]" class="thisMultiselect" id="ids" multiple>

                                                        @foreach($athlets as $athlet)
                                                            <option value="{{ $athlet->id }}"
                                                                    @if(Session::has('SelectedAthletsIds'))
                                                                    @foreach(Session::get('SelectedAthletsIds') as $key => $value)
                                                                    @if($athlet->id == $value) selected="selected" @endif
                                                                @endforeach
                                                                @endif>
                                                                {{ $athlet->getFullnameAttribute() }}
                                                            </option>
                                                        @endforeach

                                                    </select>

                                                    @if(Session::has('SelectedAthletsIdsError'))
                                                        <span class="invalid-feedback" role="alert" style="display: block">
                                                            <strong>{{ Session::get('SelectedAthletsIdsError') }}</strong>
                                                        </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wrapper-multiselect">
                                                <h4 class="header-title">Default Activities</h4>

                                                <div class="form-group">
                                                    <label for="activityIds" class="col-form-label">Choose default
                                                        Exercises</label>

                                                    <select name="activityIds[]" class="thisMultiselect"
                                                            id="activityIds" multiple>

                                                        @foreach($activities as $activity)
                                                            <option value='{{ $activity->id }}'
                                                                    @if(Session::has('SelectedActivitiesIds'))
                                                                    @foreach(Session::get('SelectedActivitiesIds') as $key => $value)
                                                                    @if($activity->id == $value) selected="selected" @endif
                                                                @endforeach
                                                                @endif>
                                                                {{ $activity->name }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
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
    <script src="{{ asset('js/jquery.quicksearch.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>

    <script type="text/javascript">
        // $('#ids').multiSelect();
        // $('#activityIds').multiSelect();

        $('#ids, #activityIds').multiSelect({
            selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='search ...'>",
            selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='search ...'>",
            afterInit: function(ms){
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        });
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
            var code = generateId(6);
            $('#code').val(code);
        });

        $('#code').val(generateId(6));

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
