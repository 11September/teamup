@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all"/>

    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <style>
        .accordion-s3 .card-header a.collapsed:before {
            content: "\e61a";
        }
    </style>
@endsection

@section('content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li><a href="{{ url('/admin/reports') }}">Reports</a></li>
                        <li><span>{{ $report->user->getFullNameAttribute() }}</span></li>
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
                                <h4 class="header-title">Generate new report</h4>

                                @include('partials.report_filter')
                            </div>

                            <div class="col-md-3">
                                <h4 class="header-title">All records - {{ $report->user->getFullNameAttribute() }}</h4>

                                @if($records && count($records) > 0)
                                    <div class="wrapper-accordion">

                                        @include('partials.allRecords')

                                    </div>
                                @endif

                            </div>

                            <div class="col-md-6">
                                <div class="wrapper-activity-info">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="pricing-list">
                                                    <div class="prc-head">
                                                        <h4>Info:</h4>
                                                    </div>
                                                    <div class="prc-list">
                                                        <ul>
                                                            <li><p>Activity - <span>{{ $activity->name }}</span></p>
                                                            </li>
                                                            <li>
                                                                <p>{{ $report->user->getFullNameAttribute() }}
                                                                    <span class="warning">
                                                                    goal
                                                                    </span>
                                                                    - <span class="attention">
                                                                        @if(isset($activity->goal->goal) && !empty($activity->goal->goal))
                                                                            {{ $activity->goal->goal }}
                                                                        @else
                                                                            not set
                                                                        @endif
                                                                    </span>
                                                                    <span>{{ $measure->name }}</span>
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <h4 class="header-title">Graph</h4>

                                <div id="ambarchart2"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script>

        if ($('#ambarchart2').length) {
            var chart = AmCharts.makeChart("ambarchart2", {
                "type": "serial",
                "addClassNames": true,
                "theme": "light",
                "autoMargins": false,
                "marginLeft": 30,
                "marginRight": 8,
                "marginTop": 10,
                "marginBottom": 26,
                "balloon": {
                    "adjustBorderColor": false,
                    "horizontalPadding": 10,
                    "verticalPadding": 8,
                    "color": "#ffffff",
                },

                "dataProvider": [

                        @if(isset($records) && count($records) > 0)
                        @foreach($records as $key => $value)
                    {
                        "year": "{{ $key }}",

                        @php
                            $maxResult = 0;
                            foreach($value as $record){
                                if ($record->value > $maxResult){
                                $maxResult = $record->value;
                                }
                            }
                        @endphp

                        "income": {{ $maxResult }},
                        "expenses": @if($loop->first || $loop->last && isset($activity->goal->goal) && !empty($activity->goal->goal))
                            {{ $activity->goal->goal }}
                            @else
                            null
                        @endif,
                        "color": "#805ff5"
                    },
                    @endforeach
                    @endif

                    // {
                    //     "year": 2013,
                    //     "income": 23.5,
                    //     // "expenses": 15,
                    //     "color": "#7474f0"
                    // }, {
                    //     "year": 2014,
                    //     "income": 26.2,
                    //     // "expenses": 30.5,
                    //     "color": "#7474f0"
                    // }, {
                    //     "year": 2015,
                    //     "income": 30.1,
                    //     // "expenses": 34.9,
                    //     "color": "#7474f0"
                    // }, {
                    //     "year": 2016,
                    //     "income": 29.5,
                    //     // "expenses": 31.1,
                    //     "color": "#7474f0"
                    // }, {
                    //     "year": 2017,
                    //     "income": 30.6,
                    //     // "expenses": 28.2,
                    //     "dashLengthLine": 5,
                    //     "color": "#7474f0"
                    // }, {
                    //     "year": 2018,
                    //     "income": 34.1,
                    //     // "expenses": 32.9,
                    //     "dashLengthColumn": 5,
                    //     "alpha": 0.2,
                    //     "additional": "(projection)"
                    // }
                ],
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left"
                }],
                "startDuration": 1,
                "graphs": [{
                    "alphaField": "alpha",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[year]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                    "fillAlphas": 1,
                    "fillColorsField": "color",
                    "title": "Record",
                    "type": "column",
                    "valueField": "income",
                    "dashLengthField": "dashLengthColumn"
                }, {
                    "id": "graph2",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[year]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                    "bullet": "round",
                    "lineThickness": 3,
                    "bulletSize": 7,
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "lineColor": "#AA59FE",
                    "useLineColorForBulletBorder": true,
                    "bulletBorderThickness": 3,
                    "fillAlphas": 0,
                    "lineAlpha": 1,
                    "title": "Goal",
                    "valueField": "expenses",
                    "dashLengthField": "dashLengthLine"
                }],
                "categoryField": "year",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                },
                "export": {
                    "enabled": false
                }
            });
        }


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
