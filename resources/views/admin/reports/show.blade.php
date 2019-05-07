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
                                                        <h4>Info about all records by {{ $report->range }} :</h4>
                                                    </div>
                                                    <div class="prc-list">
                                                        <div class="wrapper-activity-info-content">
                                                            <ul>
                                                                <li>
                                                                    <p>Activity - <span
                                                                            class="attention">{{ $activity->name }}</span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p>
                                                                    <span class="primary">
                                                                        {{ $report->user->getFullNameAttribute() }}
                                                                    </span>
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
                                                                        <span>{{ $activity->measure->name }}</span>
                                                                    </p>
                                                                </li>
                                                            </ul>


                                                            @if($report->image_graph && $report->pdf_link)
                                                                <div class="report-item-pdf-icon">
                                                                    <a href="{{ action('Admin\ReportsController@download', $report->id ) }}">
                                                                        <i class="far fa-file-pdf"></i>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
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

    @yield('filter')

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
                        @php
                            $maxResult = 0;
                            foreach($value as $record){
                                if ($record->value > $maxResult){
                                $maxResult = $record->value;
                                }
                            }
                        @endphp

                        "year": "{{ $key }}",
                        "record": {{ number_format(floatval($maxResult), 2) }},
                        "color": "@if(isset($activity->goal) && !empty($activity->goal) && $maxResult >= $activity->goal->goal){{ "#19bd36" }}@else{{ "#bd4123" }}@endif ",
                        "goal": @if(($loop->first || $loop->last) && isset($activity->goal->goal) && !empty($activity->goal->goal)){{  number_format(floatval($activity->goal->goal), 2) }}@else null @endif,
                        @if($loop->last)"alpha": 0.2, "additional": "(projection)",@endif
                    },
                    @endforeach
                    @endif
                ],
                "valueAxes": [{
                    "inversed": true,
                    "axisAlpha": 0,
                    "position": "left",
                    {{--@if($activity->graph_type == "reverse") "inversed" : true, @endif--}}
                }],
                "startDuration": 1,
                "graphs": [{
                    "alphaField": "alpha",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                    "fillAlphas": 1,
                    "fillColorsField": "color",
                    "title": "Record",
                    "type": "column",
                    "valueField": "record",
                    "dashLengthField": "dashLengthColumn"
                }, {
                    "id": "graph2",
                    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
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
                    "valueField": "goal",
                    "dashLengthField": "dashLengthLine"
                }],
                "categoryField": "year",
                "categoryAxis": {
                    "gridPosition": "start",
                    "axisAlpha": 0,
                    "tickLength": 0
                },
                "export": {
                    "enabled": false,
                    // "class": "export-main",
                    // "menu": [ {
                    //     "label": "JPG",
                    //     "class": "export-main",
                    //     "click": function() {
                    //         this.capture( {}, function() {
                    //             this.toJPG( {}, function( data ) {
                    //                 jQuery.post( "save.php", {
                    //                         imageData: encodeURIComponent( data )
                    //                     },
                    //                     function( msg ) {
                    //                         alert( "image saved" );
                    //                     } );
                    //             } );
                    //         } );
                    //     }
                    // } ]
                }
            });
        }
    </script>
@endsection
