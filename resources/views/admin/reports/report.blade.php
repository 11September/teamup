<!DOCTYPE html>
<html lang="en">

<head>
    <title>TeamUp Dashboard</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
<div class="main-content">
    <div class="main-content-inner">
        <div class="row">
            <!-- Dark table start -->
            <div class="col-12 mt-5">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="wrapper-activity-info">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="pricing-list">
                                                    <div class="prc-head">
                                                        <h4>Info about all records by week :</h4>
                                                    </div>
                                                    <div class="prc-list">
                                                        <ul>
                                                            <li><p>Activity - <span
                                                                        class="attention">Troy Shanahan</span></p>
                                                            </li>
                                                            <li>
                                                                <p>
                                                                    <span class="primary">
                                                                        Атлет Атлетович
                                                                    </span>
                                                                    <span class="warning">
                                                                    goal
                                                                    </span>
                                                                    - <span class="attention">
                                                                                                                                                    18.65
                                                                                                                                            </span>
                                                                    <span>Mr. Darryl Jacobs</span>
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

                                {{--<div id="ambarchart2"></div>--}}
                            </div>

                            <div class="col-md-12">
                                <div class="wrapper-accordion">
                                    <div id="accordion4" class="according accordion-s3 gradiant-bg">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="card-link" data-toggle="collapse" href="#accordion41">All
                                                    week
                                                    records</a>
                                            </div>
                                            <div id="accordion41" class="collapse show"
                                                 data-parent="#accordion4">
                                                <div class="card-body">


                                                    <div class="card-body-record">
                                                        <p><span>14.87</span>
                                                            - Mr. Darryl Jacobs
                                                        </p>
                                                        <p>17-04-2019</p>
                                                    </div>
                                                    <p class="card-body-record-notice">Deleniti odit sit voluptas
                                                        incidunt quis enim officia explicabo.</p>


                                                    <div class="card-body-record">
                                                        <p><span>3.7</span>
                                                            - Mr. Darryl Jacobs
                                                        </p>
                                                        <p>20-04-2019</p>
                                                    </div>
                                                    <p class="card-body-record-notice">Magni quos a iusto eius ut.</p>


                                                    <div class="card-body-record">
                                                        <p><span>18.3</span>
                                                            - Mr. Darryl Jacobs
                                                        </p>
                                                        <p>21-04-2019</p>
                                                    </div>
                                                    <p class="card-body-record-notice">Animi consequatur aperiam velit
                                                        ipsum et ea qui.</p>


                                                    <div class="card-body-record">
                                                        <p><span>13.44</span>
                                                            - Mr. Darryl Jacobs
                                                        </p>
                                                        <p>22-04-2019</p>
                                                    </div>
                                                    <p class="card-body-record-notice">Qui nesciunt non enim.</p>


                                                    <div class="card-body-record">
                                                        <p><span>6.41</span>
                                                            - Mr. Darryl Jacobs
                                                        </p>
                                                        <p>23-04-2019</p>
                                                    </div>
                                                    <p class="card-body-record-notice">Eaque laudantium nobis doloribus
                                                        nobis quia ab beatae in.</p>
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
            <!-- Dark table end -->
        </div>
    </div>
</div>

<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

{{--<script src="{{ asset('js/vendor/charts/Chart.min.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/charts/amcharts.js') }}"></script>--}}
{{--<script src="{{ asset('js/vendor/charts/serial.js') }}"></script>--}}

{{--<script>--}}
    {{--if ($('#ambarchart2').length) {--}}
        {{--var chart = AmCharts.makeChart("ambarchart2", {--}}
            {{--"type": "serial",--}}
            {{--"addClassNames": true,--}}
            {{--"theme": "light",--}}
            {{--"autoMargins": false,--}}
            {{--"marginLeft": 30,--}}
            {{--"marginRight": 8,--}}
            {{--"marginTop": 10,--}}
            {{--"marginBottom": 26,--}}
            {{--"balloon": {--}}
                {{--"adjustBorderColor": false,--}}
                {{--"horizontalPadding": 10,--}}
                {{--"verticalPadding": 8,--}}
                {{--"color": "#ffffff",--}}
            {{--},--}}

            {{--"dataProvider": [--}}
                {{--{--}}

                    {{--"year": "Wed",--}}
                    {{--"record": 14.87,--}}
                    {{--"color": "#805ff5",--}}
                    {{--"goal":                             18.65--}}
                    {{--,--}}
                {{--},--}}
                {{--{--}}

                    {{--"year": "Sat",--}}
                    {{--"record": 3.70,--}}
                    {{--"color": "#805ff5",--}}
                    {{--"goal":  null  ,--}}
                {{--},--}}
                {{--{--}}

                    {{--"year": "Sun",--}}
                    {{--"record": 18.30,--}}
                    {{--"color": "#805ff5",--}}
                    {{--"goal":  null  ,--}}
                {{--},--}}
                {{--{--}}

                    {{--"year": "Mon",--}}
                    {{--"record": 13.44,--}}
                    {{--"color": "#805ff5",--}}
                    {{--"goal":  null  ,--}}
                {{--},--}}
                {{--{--}}

                    {{--"year": "Tue",--}}
                    {{--"record": 6.41,--}}
                    {{--"color": "#805ff5",--}}
                    {{--"goal":                             18.65--}}
                    {{--,--}}
                    {{--"alpha": 0.2, "additional": "(projection)",                    },--}}
            {{--],--}}
            {{--"valueAxes": [{--}}
                {{--"inversed" : true,--}}
                {{--"axisAlpha": 0,--}}
                {{--"position": "left",--}}

            {{--}],--}}
            {{--"startDuration": 1,--}}
            {{--"graphs": [{--}}
                {{--"alphaField": "alpha",--}}
                {{--"balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",--}}
                {{--"fillAlphas": 1,--}}
                {{--"fillColorsField": "color",--}}
                {{--"title": "Record",--}}
                {{--"type": "column",--}}
                {{--"valueField": "record",--}}
                {{--"dashLengthField": "dashLengthColumn"--}}
            {{--}, {--}}
                {{--"id": "graph2",--}}
                {{--"balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",--}}
                {{--"bullet": "round",--}}
                {{--"lineThickness": 3,--}}
                {{--"bulletSize": 7,--}}
                {{--"bulletBorderAlpha": 1,--}}
                {{--"bulletColor": "#FFFFFF",--}}
                {{--"lineColor": "#AA59FE",--}}
                {{--"useLineColorForBulletBorder": true,--}}
                {{--"bulletBorderThickness": 3,--}}
                {{--"fillAlphas": 0,--}}
                {{--"lineAlpha": 1,--}}
                {{--"title": "Goal",--}}
                {{--"valueField": "goal",--}}
                {{--"dashLengthField": "dashLengthLine"--}}
            {{--}],--}}
            {{--"categoryField": "year",--}}
            {{--"categoryAxis": {--}}
                {{--"gridPosition": "start",--}}
                {{--"axisAlpha": 0,--}}
                {{--"tickLength": 0--}}
            {{--},--}}
            {{--"export": {--}}
                {{--"enabled": false,--}}
            {{--}--}}
        {{--});--}}
    {{--}--}}
{{--</script>--}}
</body>
</html>
