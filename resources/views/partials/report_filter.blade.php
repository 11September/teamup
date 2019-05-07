<div class="wrapper-filter">
    <form action="{{ action('Admin\ReportsController@store') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="team_id" class="col-form-label">Select Team*</label>
            <select id="team_id" name="team_id" required
                    class="custom-select{{ $errors->has('team_id') ? ' is-invalid' : '' }}">

                <option value="none" selected>Select Team</option>

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
            <select id="user_id" name="user_id" required disabled
                    class="custom-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}">

                <option value="none" selected>Select Athlet</option>

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

                <option value="none">Select Exercises</option>

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
            <button class="btn btn-primary" id="generateBtn" type="submit">Generate Report</button>
        </div>
    </form>
</div>


@section('filter')
    <script>
        $(document).ready(function () {
            var global_team_id;
            var global_user_id;
            var global_activity_id;

            $("#generateBtn").attr("disabled", true);
            $('.wrapper-filter #team_id').on('change', function () {
                global_team_id = $(this).val();

                if (global_team_id) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        url: '{{ url('admin/teams') }}',
                        dataType: 'json',
                        data: {team_id: global_team_id},
                        success: function (data) {
                            if (data.success) {

                                var content = $('#user_id').empty().attr('disabled', false);
                                content.append(
                                    '<option value="none">Select Athlete</option>'
                                );

                                $.each(data.data, function (index, item) {
                                    content.append(
                                        '<option value="' + item.id + '">' + item.first_name + " " + item.last_name + '</option>'
                                    );
                                });

                                $('#activity_id').attr('disabled', true);
                                $('#range').attr('disabled', true);
                            }
                        }, error: function () {
                            console.log(data);
                        }
                    });
                } else {
                    toastr.error('Something went wrong!', {timeOut: 3000});
                }
            });

            $('.wrapper-filter #team_id').on('change', function () {
                var val = $(this).children("option:selected").val();
                if (val == "none") {

                    var content = $('#user_id').empty().attr('disabled', false);
                    content.append(
                        '<option value="none">Select Athlete</option>'
                    );

                    $('#activity_id').empty().append(
                        '<option value="none">Select Activity</option>'
                    ).attr('disabled', true);
                    $('#range').attr('disabled', true);
                    $("#generateBtn").attr("disabled", true);
                }
            });

            $('.wrapper-filter #user_id').on('change', function () {
                global_user_id = $(this).val();

                if (global_user_id) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        url: '{{ url('admin/records') }}',
                        dataType: 'json',
                        data: {user_id: global_user_id},
                        success: function (data) {
                            if (data.success) {

                                var content = $('#activity_id').empty();
                                content.append(
                                    '<option value="none">Select Activity</option>'
                                );

                                $.each(data.data, function (index, item) {
                                    content.append(
                                        '<option value="' + item.id + '">' + item.name + '</option>'
                                    );
                                });

                                $('#activity_id').attr('disabled', false);
                            }
                        }, error: function () {
                            console.log(data);
                        }
                    });
                } else {
                    toastr.error('Something went wrong!', {timeOut: 3000});
                }
            });

            $('.wrapper-filter #user_id').on('change', function () {
                var val = $(this).children("option:selected").val();
                if (val == "none") {

                    $('#activity_id').empty().append(
                        '<option value="none">Select Activity</option>'
                    ).attr('disabled', true);
                    $('#range').attr('disabled', true);
                    $("#generateBtn").attr("disabled", true);
                }
            });

            $('.wrapper-filter #activity_id').on('change', function () {
                $("#generateBtn").attr("disabled", false);
                $('#range').attr('disabled', false);
            });

            $('.wrapper-filter #activity_id').on('change', function () {
                var val = $(this).children("option:selected").val();
                if (val == "none") {
                    $('#range').attr('disabled', true);
                    $("#generateBtn").attr("disabled", true);
                }
            });
        });
    </script>
@endsection

