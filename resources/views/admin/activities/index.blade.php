@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jsgrid.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}"/>

    <style>
        .jsgrid-grid-body {
            height: 500px !important;
        }
    </style>
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
                    <div class="card-body">

                        <div id="jsGrid"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/vendor/datatable/jsgrid.core.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/jsgrid.load-indicator.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/jsgrid.load-strategies.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/jsgrid.sort-strategies.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/jsgrid.validation.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/jsgrid.field.js') }}"></script>

    <script src="{{ asset('js/vendor/datatable/fields/jsgrid.field.text.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/fields/jsgrid.field.number.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/fields/jsgrid.field.select.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/fields/jsgrid.field.checkbox.js') }}"></script>
    <script src="{{ asset('js/vendor/datatable/fields/jsgrid.field.control.js') }}"></script>

    <script>
        (function () {

            var db = {

                loadData: function (filter) {
                    return $.grep(this.clients, function (client) {
                        return (!filter.Name || client.Name.indexOf(filter.Name) > -1)
                            && (!filter.Units || client.Units === filter.Units)
                            && (!filter.Graphtype || client.Graphtype === filter.Graphtype)
                            && (!filter.Colors || client.Colors === filter.Colors)
                            && (filter.Status === undefined || client.Status === filter.Status)
                            && (filter.Married === undefined || client.Married === filter.Married);
                    });
                },

                insertItem: function (insertingClient) {
                    console.log('insert');
                    console.log(insertingClient);
                    this.clients.push(insertingClient);
                },

                updateItem: function (updatingClient) {
                    console.log('update');
                    console.log(updatingClient);
                },

                deleteItem: function (deletingClient) {
                    console.log('delete');
                    console.log(deletingClient);

                    var clientIndex = $.inArray(deletingClient, this.clients);
                    this.clients.splice(clientIndex, 1);
                }

            };

            window.db = db;

            db.countries = [
                {Name: "", Id: 0},
                {Name: "United States", Id: 1},
                {Name: "Canada", Id: 2},
                {Name: "United Kingdom", Id: 3},
                {Name: "France", Id: 4},
                {Name: "Brazil", Id: 5},
                {Name: "China", Id: 6},
                {Name: "Russia", Id: 7}
            ];

            db.units = [
                // {Name: "", Id: 0},
                {Name: "Sec", Id: 1},
                {Name: "Miles", Id: 2}
            ];

            db.graphtype = [
                // {Name: "", Id: 0},
                {Name: "Straight", Id: 1},
                {Name: "Reverse", Id: 2}
            ];

            db.colors = [
                // {Name: "", Id: 0},
                {Name: "Red", Id: 1},
                {Name: "Blue", Id: 2}
            ];

            db.clients = [
                {
                    "Id": 1,
                    "Name": "Stuart Wallace",
                    "Units": 1,
                    "Graphtype": 1,
                    "Colors": 1,
                    "Status": "default"
                    // "Married": true
                },
                {
                    "Id": 1,
                    "Name": "Stuart Wallace",
                    "Units": 2,
                    "Graphtype": 2,
                    "Colors": 2,
                    "Status": "custom"
                    // "Married": false
                }
            ];
        }());

    </script>

    <script>
        $(function () {

            $("#jsGrid").jsGrid({
                height: "70%",
                width: "100%",
                filtering: false,
                editing: true,
                inserting: true,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 15,
                pageButtonCount: 5,
                deleteConfirm: "Do you really want to delete the client?",
                controller: db,

                fields: [
                    {
                        name: "Name", textField: "Activity Name", type: "text", width: 150, sorting: true,
                        validate: "required"
                    },

                    {
                        name: "Units", type: "select", items: db.units, valueField: "Id", textField: "Name", sorting: true,
                        validate: {
                            message: "Units should be specified", validator: function (value) {
                                return value > 0;
                            }
                        }
                    },

                    {
                        name: "Graphtype", type: "select", items: db.graphtype, valueField: "Id", textField: "Name", sorting: true,
                        validate: {
                            message: "Graphtype should be specified", validator: function (value) {
                                return value > 0;
                            }
                        }
                    },

                    {
                        name: "Colors", type: "select", items: db.colors, valueField: "Id", textField: "Name", sorting: true,
                        validate: {
                            message: "Graphtype should be specified", validator: function (value) {
                                return value > 0;
                            }
                        }
                    },

                    {
                        name: "Status", type: "checkbox", title: "Is Custom", sorting: true
                    },
                    // {name: "Married", type: "checkbox", title: "Is Married", sorting: false},
                    {type: "control"}
                ]
            });

        });
    </script>

    {{--<script>--}}
    {{--$(document).ready(function (e) {--}}

    {{--$("#new-one").on("click", function () {--}}

    {{--var content = $('#activities');--}}

    {{--itemStart = '<tr>';--}}
    {{--itemActivityName = '<td><input type="text"></td>';--}}

    {{--itemActivityUnits =--}}
    {{--'<td>' +--}}
    {{--'<select name="" id="">' +--}}
    {{--'<option value="reps">reps</option> ' +--}}
    {{--'</select>' +--}}
    {{--'</td>';--}}

    {{--itemActivityGraphicType =--}}
    {{--'<td>' +--}}
    {{--'<select name="" id="">' +--}}
    {{--'<option value="reps">reps</option> ' +--}}
    {{--'</select>' +--}}
    {{--'</td>';--}}

    {{--itemActivityColor =--}}
    {{--'<td>' +--}}
    {{--'<input type="color" id="head" name="head" value="#e66465">' +--}}
    {{--'</td>';--}}

    {{--itemActivityActions =--}}
    {{--'<td>' +--}}
    {{--'<a class="datatable-actions-link" href="#"><i class="fas fa-save"></i></a>' +--}}
    {{--'<a class="datatable-actions-link" href="#"><i class="fas fa-trash-alt"></i></a>' +--}}
    {{--'</td>';--}}

    {{--itemEnd = '</tr>';--}}

    {{--content.append(itemStart, itemActivityName, itemActivityUnits, itemActivityGraphicType, itemActivityColor, itemActivityActions, itemEnd);--}}

    {{--console.log($(this).text());--}}
    {{--});--}}

    {{--});--}}
    {{--</script>--}}

@endsection
