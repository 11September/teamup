@extends('layouts.admin')

@section('css')

@endsection

@section('content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li><span>Reports</span></li>
                    </ul>
                </div>
            </div>

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
            <!-- Dark table start -->
            <div class="col-12 mt-5">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="header-title">My previous reports</h4>

                                <div class="wrapper-all-user-reports">
                                    @if($reports && count($reports) > 0)
                                        @foreach($reports as $report)
                                            <div class="wrapper-one-report-item">
                                                <div class="report-item-holder">
                                                    <a href="{{ action('Admin\ReportsController@show', $report->id) }}">
                                                        <p class="report-item-team-activity">{{ $report->team->name }}
                                                            - {{ $report->activity->name }}</p>
                                                        <p class="report-item-team-user">{{ $report->user->getFullNameAttribute() }}
                                                            - {{ $report->range }}</p>
                                                    </a>

                                                    @if($report->image_graph && $report->pdf_link)
                                                        <div class="report-item-pdf-icon">
                                                            <a href="{{ action('Admin\ReportsController@download', $report->id ) }}">
                                                                <i class="far fa-file-pdf"></i>
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <h4 class="header-title">Generate new report</h4>

                                @include('partials.report_filter')
                            </div>

                            <div class="col-md-6">

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- Dark table end -->
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var global_team_id;
            var global_user_id;
            var global_activity_id;

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

                                var content = $('#user_id').empty();

                                content.append(
                                    '<option value="">Select Athlete</option>'
                                );

                                $.each(data.data, function (index, item) {
                                    content.append(
                                        '<option value="' + item.id + '">' + item.first_name + " " + item.last_name + '</option>'
                                    );
                                });

                                $('#activity_id').empty().attr('disabled', false);
                                $('#range').attr('disabled', false);

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
                                    '<option value="">Select Activity</option>'
                                );

                                $.each(data.data, function (index, item) {
                                    content.append(
                                        '<option value="' + item.id + '">' + item.name + '</option>'
                                    );
                                });

                                $('#range').attr('disabled', false);

                            }
                        }, error: function () {
                            console.log(data);
                        }
                    });
                } else {
                    toastr.error('Something went wrong!', {timeOut: 3000});
                }
            });

            $('.wrapper-filter #activity_id').on('change', function () {
                global_activity_id = $(this).val();

                if (global_activity_id) {
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

                                var content = $('#activity_id');

                                content.empty();
                                $('#type').attr('disabled', false);

                                $.each(data.data, function (index, item) {
                                    content.append(
                                        '<option value="' + item.id + '">' + item.name + '</option>'
                                    );
                                });

                            }
                        }, error: function () {
                            console.log(data);
                        }
                    });
                } else {
                    toastr.error('Something went wrong!', {timeOut: 3000});
                }
            });
        });
    </script>
@endsection
