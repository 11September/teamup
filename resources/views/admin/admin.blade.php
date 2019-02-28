@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
@endsection

@section('content')

    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="index.html">Home</a></li>
                        <li><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">

            @include('partials.dashboard_tabs')

            @include('partials.dashboard_graph_activity')

            @include('partials.dashboadr_feedbacks')

            @include('partials.dashboard_client_statuses')

        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/ammap.js"></script>
    <script src="https://www.amcharts.com/lib/3/maps/js/worldLow.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

    <script>
        if ($('#socialads').length) {

            Highcharts.chart('socialads', {
                chart: {
                    type: 'column'
                },
                title: false,
                xAxis: {
                    categories: ['FB', 'TW', 'INS', 'G+', 'LINKD']
                },
                colors: ['#F5CA3F', '#E5726D', '#12C599', '#5F73F2'],
                yAxis: {
                    min: 0,
                    title: false
                },
                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                    shared: true
                },
                plotOptions: {
                    column: {
                        stacking: 'column'
                    }
                },
                series: [{
                    name: 'Closed',
                    data: [51, 48, 64, 48, 84]
                }, {
                    name: 'Hold',
                    data: [83, 84, 53, 81, 88]
                }, {
                    name: 'Pending',
                    data: [93, 84, 53, 53, 48]
                },
                    {
                        name: 'Active',
                        data: [430, 312, 348, 254, 258]
                    }
                ]
            });
        }



        if ($('#seolinechart8').length) {
            var ctx = document.getElementById("seolinechart8").getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'doughnut',
                // The data for our dataset
                data: {
                    labels: ["FB", "TW", "G+", "INS"],
                    datasets: [{
                        backgroundColor: [
                            "#8919FE",
                            "#12C498",
                            "#F8CB3F",
                            "#E36D68"
                        ],
                        borderColor: '#fff',
                        data: [810, 410, 260, 150],
                    }]
                },
                // Configuration options go here
                options: {
                    legend: {
                        display: true
                    },
                    animation: {
                        easing: "easeInOutBack"
                    }
                }
            });
        }



        /*================================
    Owl Carousel
    ==================================*/
        function slider_area() {
            var owl = $('.testimonial-carousel').owlCarousel({
                margin: 50,
                loop: true,
                autoplay: false,
                nav: false,
                dots: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    450: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1000: {
                        items: 2
                    },
                    1360: {
                        items: 3
                    },
                    1600: {
                        items: 3
                    }
                }
            });
        }
        slider_area();
    </script>
@endsection
