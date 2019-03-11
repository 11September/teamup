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
                        <li><a href="{{ url('/admin') }}">Home</a></li>
                        <li><span>Users</span></li>
                    </ul>

                    <div class="pull-right">
                        <a class="create-link" href="{{ url('/admin/users/create') }}">Create new User</a>
                    </div>
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
                        <h4 class="header-title">Activities</h4>

                        <div class="wrapper-activities">
                            <table id="activities" class="text-center">
                                <thead class="text-capitalize">
                                <tr>
                                    <th>Activity Name*</th>
                                    <th>Units*</th>
                                    <th>Graphic Type*</th>
                                    <th>Activity Color*</th>
                                    <td>Actions</td>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, unde!</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, unde!</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, unde!</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, unde!</td>
                                    {{--<td class="datatable-actions">--}}
                                    {{--<a class="datatable-actions-link"--}}
                                    {{--href="{{ url('admin/users', $user->id) }}">--}}
                                    {{--<i class="fas fa-eye"></i>--}}
                                    {{--</a>--}}

                                    {{--<a class="datatable-actions-link"--}}
                                    {{--href="{{ url('admin/users/' . $user->id . '/edit') }}">--}}
                                    {{--<i class="fas fa-edit"></i>--}}
                                    {{--</a>--}}

                                    {{--<a class="datatable-actions-link"--}}
                                    {{--href="{{ url('admin/users/reset_password/' . $user->id) }}">--}}
                                    {{--<i class="fas fa-key"></i>--}}
                                    {{--</a>--}}

                                    {{--<a class="datatable-actions-link" href="">--}}
                                    {{--<form method="POST" class="delete-form"--}}
                                    {{--action="{{ action('Admin\UsersController@destroy', $user->id) }}">--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--{{ method_field('DELETE') }}--}}

                                    {{--<button type="submit" class="delete-button"><i--}}
                                    {{--class="fas fa-trash-alt"></i></button>--}}
                                    {{--</form>--}}
                                    {{--</a>--}}
                                    {{--</td>--}}
                                </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="wrapper-add-new-one">
                            <div class="row">
                                <div class="col-md-12">
                                    <button id="new-one" class="btn new-one">+</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Dark table end -->
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function (e) {

            $( "#new-one" ).on( "click", function() {

                var content = $('#activities');

                itemStart = '<tr>';
                itemActivityName = '<td><input type="text"></td>';
                itemActivityUnits =
                    '<td>' +
                    '<select name="" id="">' +
                    '<option value="reps">reps</option> ' +
                    '</select>' +
                    '</td>';
                itemActivityGraphicType =
                    '<td>' +
                    '<select name="" id="">' +
                    '<option value="reps">reps</option> ' +
                    '</select>' +
                    '</td>';
                itemActivityColor =
                    '<td>' +
                    '<input type="color" id="head" name="head" value="#e66465">' +
                    '</td>';
                itemEnd = '</tr>';

                content.append(itemStart, itemActivityName, itemActivityUnits, itemActivityGraphicType, itemActivityColor, itemEnd);

                console.log( $( this ).text() );
            });

        });
    </script>
@endsection
