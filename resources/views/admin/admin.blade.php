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

@endsection
