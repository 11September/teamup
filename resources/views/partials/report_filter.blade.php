<div class="wrapper-filter">
    <form action="">
        <div class="form-group">
            <label for="team_id" class="col-form-label">Select Team*</label>
            <select id="team_id" name="team_id" required
                    class="custom-select{{ $errors->has('team_id') ? ' is-invalid' : '' }}">

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
            <label for="user_id" class="col-form-label">Student Name*</label>
            <select id="user_id" name="user_id" required
                    class="custom-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}">

                @foreach($athlets as $athlet)
                    <option value="{{ $athlet->id }}">{{ $athlet->getFullNameAttribute() }}</option>
                @endforeach

            </select>

            @if ($errors->has('user_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">
            <label for="activity_id" class="col-form-label">Select Exercises*</label>
            <select id="activity_id" name="activity_id" required
                    class="custom-select{{ $errors->has('activity_id') ? ' is-invalid' : '' }}">

                @foreach($activities as $activity)
                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                @endforeach

            </select>

            @if ($errors->has('activity_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('activity_id') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">
            <label for="type" class="col-form-label">This Week*</label>
            <select id="type" name="user_id" required
                    class="custom-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}">
            </select>

            @if ($errors->has('user_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('user_id') }}</strong>
                </span>
            @endif

        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Update Team</button>
        </div>
    </form>
</div>
