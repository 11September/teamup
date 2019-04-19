<div class="wrapper-filter">
    <form action="{{ action('Admin\ReportsController@store') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="team_id" class="col-form-label">Select Team*</label>
            <select id="team_id" name="team_id" required
                    class="custom-select{{ $errors->has('team_id') ? ' is-invalid' : '' }}">

                <option value="" selected>Select Team</option>

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
            <label for="user_id" class="col-form-label">Athlete Name*</label>
            <select id="user_id" name="user_id" required
                    class="custom-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}">

                <option value="" selected>Select Athlet</option>

                @if(!empty($teams->first()->users) && isset($teams->first()->users) && count($teams->first()->users))
                    @foreach($teams as $team)
                        @foreach($team->users as $user)
                            <option value="{{ $user->id }}">{{ $user->id }}</option>
                        @endforeach
                    @endforeach
                @endif

            </select>

            @if ($errors->has('user_id'))
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('user_id') }}</strong>
                                                </span>
            @endif

        </div>

        <div class="form-group">
            <label for="activity_id" class="col-form-label">Select Exercises*</label>
            <select id="activity_id" name="activity_id" required disabled
                    class="custom-select{{ $errors->has('activity_id') ? ' is-invalid' : '' }}">

                <option value="Exercises">Exercises</option>

            </select>

            @if ($errors->has('activity_id'))
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('activity_id') }}</strong>
                                                </span>
            @endif

        </div>

        <div class="form-group">
            <label for="range" class="col-form-label">Select Period*</label>
            <select id="range" name="range" required disabled
                    class="custom-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}">
                <option value="week">Week</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>

            @if ($errors->has('range'))
                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('range') }}</strong>
                                                </span>
            @endif

        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Generate Report</button>
        </div>
    </form>
</div>
