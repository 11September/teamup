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
                        <li><a href="{{ url('/admin/activities') }}">Exercises</a></li>
                        <li><span>Edit {{ $activity->name }}</span></li>
                    </ul>
                </div>
            </div>

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">

        <form class="needs-validation" novalidate="" action="{{ action('Admin\ActivitiesController@update', $activity ) }}"
              method="post">
            @method('PUT')
            {{ csrf_field() }}

            <input type="hidden" name="id" value="{{ $activity->id }}">

            <div class="row">
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">Edit {{ $activity->name }}</h4>

                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Name*</label>
                                        <input
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            type="text" name="name"
                                            value="@if(old('name')) {{ old('name') }} @else {{ $activity->name }} @endif"
                                            id="name" required min="3">

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="measure_id" class="col-form-label">Measure*</label>
                                        <select id="measure_id" name="measure_id"
                                                class="custom-select{{ $errors->has('measure_id') ? ' is-invalid' : '' }}"
                                                required>

                                            @foreach($measures as $measure)
                                                <option value="{{ $measure->id }}"
                                                    @if(old('measure_id') && old('measure_id') ==  $measure->id)
                                                        selected="selected"
                                                    @endif

                                                    @if($measure->id == $activity->measure_id)
                                                        selected="selected"
                                                    @endif>
                                                    {{ $measure->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        @if ($errors->has('measure_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('measure_id') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label for="graph_type" class="col-form-label">Graph Type*</label>
                                        <select id="graph_type" name="graph_type" required
                                                class="custom-select{{ $errors->has('graph_type') ? ' is-invalid' : '' }}">
                                            <option @if(old('graph_type') == "straight" || $activity->graph_type == "straight") selected="selected" @endif value="straight">straight
                                            </option>
                                            <option @if(old('graph_type') == "reverse" || $activity->graph_type == "reverse")selected="selected"
                                                    @endif value="reverse">reverse
                                            </option>
                                        </select>

                                        @if ($errors->has('graph_type'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('graph_type') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group" style="display: none">
                                        <label for="status" class="col-form-label">Exercise Status*</label>
                                        <select id="status" name="status" required
                                                class="custom-select{{ $errors->has('status') ? ' is-invalid' : '' }}">

                                            @if(Auth::user()->type == "admin")
                                                <option value="blank" selected="selected">Blank</option>
                                            @endif

                                            @if(Auth::user()->type == "coach")
                                                <option value="custom" selected="selected">Custom</option>
                                            @endif

                                        </select>

                                        @if ($errors->has('status'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @endif

                                    </div>


                                    <div class="form-group">
                                        <label for="team_id" class="col-form-label">Team*</label>
                                        <select id="team_id" name="team_id" required
                                                class="custom-select{{ $errors->has('status') ? ' is-invalid' : '' }}">

                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach

                                        </select>

                                        @if ($errors->has('team_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('team_id') }}</strong>
                                            </span>
                                        @endif

                                    </div>


                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Create Exercise</button>
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

@endsection
