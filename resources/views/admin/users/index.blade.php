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
                        <li><span>Users</span></li>
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

                    <div class="card-header">
                        <div class="col-sm-12 flex-pull-right">
                            <a class="create-link" href="{{ url('/admin/users/create') }}">Create new User</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <h4 class="header-title">Users list</h4>
                        <div class="data-tables datatable-dark">
                            <table id="dataTable3" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>№</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>E-mail</th>
                                    <th>Count Athlets</th>
                                    <th>Type</th>
                                    <th>Expired Date</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <td>Actions</td>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->getFullnameAttribute() }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if($user->number_students || $user->number_students != 0) {{ $user->number_students }} @else @endif</td>
                                        <td>{{ $user->activation }}</td>
                                        <td>
                                            @if($user->type == "athlete")

                                            @else
                                                {{ $user->expiration_date }}
                                            @endif
                                        </td>
                                        <td><span class="font-weight-bolder">{{ $user->type }}</span></td>
                                        <td>
                                            @if($user->IsActive)
                                                <span class="success">Active</span>
                                            @else
                                                <span class="danger">Disable</span>
                                            @endif
                                        </td>
                                        <td class="datatable-actions">
                                            <a class="datatable-actions-link"
                                               href="{{ url('admin/users/' . $user->id . '/edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a class="datatable-actions-link"
                                               href="{{ url('admin/users/reset_password/' . $user->id) }}">
                                                <i class="fas fa-key"></i>
                                            </a>

                                            <a class="datatable-actions-link" href="">
                                                <form method="POST" class="delete-form"
                                                      action="{{ action('Admin\UsersController@destroy', $user->id) }}">
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
