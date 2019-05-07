@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
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
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    @yield('filter')
@endsection
