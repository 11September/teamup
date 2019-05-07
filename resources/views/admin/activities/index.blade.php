@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
@endsection

@section('content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li><span>Exercises</span></li>
                    </ul>
                </div>
            </div>

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">

                    <div class="card-header">
                        <div class="col-sm-12 flex-pull-right">
                            <a class="create-link" href="{{ url('/admin/activities/create') }}">Create new Exercise</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="header-title">Users list</h4>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>№</th>
                                    <th>Name</th>
                                    <th>Team</th>
                                    <th>Units</th>
                                    <th>Graph Type</th>
                                    <th>Status</th>
                                    <td>Actions</td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($activities as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $activity->name }}</td>
                                        <td>@if($activity->team) {{ $activity->team->name }} @endif</td>
                                        <td>{{ $activity->measure->name }}</td>
                                        <td>{{ $activity->graph_type }}</td>
                                        <td>{{ $activity->status }}</td>
                                        <td class="datatable-actions">

                                            @if(Auth::user()->type == "coach" && $activity->user_id == Auth::id() && $activity->status == "custom" || $activity->status == "default")
                                                <a class="datatable-actions-link"
                                                   href="{{ url('admin/activities/' . $activity->id . '/edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif

                                            @if(Auth::user()->type == "admin" && $activity->user_id == Auth::id() && $activity->status == "blank")
                                                <a class="datatable-actions-link"
                                                   href="{{ url('admin/activities/' . $activity->id . '/edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif

                                            <a class="datatable-actions-link" href="">
                                                <form method="POST" class="delete-form"
                                                      action="{{ action('Admin\ActivitiesController@destroy', $activity->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <button type="submit" class="delete-button"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dark table end -->
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->

    <script>
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
        if ($('#dataTable2').length) {
            $('#dataTable2').DataTable({
                responsive: true
            });
        }
        if ($('#dataTable3').length) {
            $('#dataTable3').DataTable({
                responsive: true
            });
        }
    </script>

@endsection
