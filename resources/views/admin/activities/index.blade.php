@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jsgrid.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}"/>
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
        function InsertData(insertData) {
            var data = insertData;
            var success = "false";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('admin/activities') }}",
                method: 'post',
                data: data,
                async: false,
                success: function (data) {
                    if (data.success) {
                        success = "true";
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });

            return success;
        }

        function UpdateData(updateData) {
            var data = updateData;
            var success = "false";

            if (updateData['Id']) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('admin/activities/') }}" + "/" + updateData['Id'],
                    method: 'PATCH',
                    data: data,
                    async: false,
                    success: function (data) {
                        if (data.success) {
                            success = "true";
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            return success;
        }


        function DeleteData(updateData) {
            var success = "false";

            if (updateData['Id']) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('admin/activities/') }}" + "/" + updateData['Id'],
                    method: 'DELETE',
                    async: false,
                    success: function (data) {
                        if (data.success) {
                            success = "true";
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            }

            return success;
        }

        (function () {

            var db = {
                loadData: function (filter) {
                    return $.grep(this.activities, function (client) {
                        return (!filter.Name || activity.Name.indexOf(filter.Name) > -1)
                            && (!filter.Units || activity.Units === filter.Units)
                            && (!filter.Graphtype || activity.Graphtype === filter.Graphtype)
                            && (!filter.Colors || activity.Colors === filter.Colors)
                            // && (filter.Status === undefined || activity.Status === filter.Status)
                            && (filter.Married === undefined || activity.Married === filter.Married);
                    });
                },

                insertItem: function (insertingActivity) {
                    console.log('insert');
                    console.log(insertingActivity);

                    var status = InsertData(insertingActivity);
                    if (status) {
                        this.activities.push(insertingActivity);
                    }
                },

                updateItem: function (updatingActivity) {
                    console.log('update');
                    console.log(updatingActivity);

                    var status = UpdateData(updatingActivity);
                },

                deleteItem: function (deletingActivity) {
                    console.log('delete');
                    console.log(deletingActivity);

                    var status = DeleteData(deletingActivity);

                    if (status) {
                        var clientIndex = $.inArray(deletingActivity, this.activities);
                        this.activities.splice(clientIndex, 1);
                    }
                }
            };

            window.db = db;

            db.units = [
                    @foreach($measures as $measure)
                {
                    Name: "{{ $measure->name }}", Id: {{ $measure->id }}
                },
                @endforeach
            ];

            db.graphtype = [
                {Name: "Straight", Id: "straight"},
                {Name: "Reverse", Id: "reverse"}
            ];

            db.colors = [
                {Name: "red", Id: "red"},
                {Name: "yellow", Id: "yellow"},
                {Name: "blue", Id: "blue"},
                {Name: "violet", Id: "violet"},
                {Name: "orange", Id: "orange"},
                {Name: "green", Id: "green"},
                {Name: "indigo", Id: "indigo"}
            ];

            db.activities = [
                    @foreach($activities as $activity)
                {
                    "Id": {{ $activity->id }},
                    "Name": "{{ $activity->name }}",
                    "Units": {{ $activity->measure_id }},
                    "Graphtype": "{{ $activity->graph_type }}",
                    "Colors": "{{ $activity->graph_color }}",
                    "Status": "{{ $activity->status }}"
                },
                @endforeach

                // {
                //     "Id": 1,
                //     "Name": "Stuart Wallace",
                //     "Units": 2,
                //     "Graphtype": "reverse",
                //     "Colors": "yellow",
                //     "Status": "custom"
                // },
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
                deleteConfirm: "Do you really want to delete the activity?",
                controller: db,

                fields: [
                    {
                        name: "Id", textField: "Activity Name", type: "text", width: 150, sorting: true, visible: false,
                        validate: "required"
                    },

                    {
                        name: "Name", textField: "Activity Name", type: "text", width: 150, sorting: true,
                        validate: [
                            "required",
                            {validator: "minLength", param: 6},
                            function (value, item) {
                                return item.IsRetired ? value > 6 : true;
                            }
                        ]
                    },

                    {
                        name: "Units",
                        type: "select",
                        items: db.units,
                        valueField: "Id",
                        textField: "Name",
                        sorting: true,
                        validate: "required"
                    },

                    {
                        name: "Graphtype",
                        type: "select",
                        items: db.graphtype,
                        valueField: "Id",
                        textField: "Name",
                        sorting: true,
                        validate: "required"
                    },

                    {
                        name: "Colors",
                        type: "select",
                        items: db.colors,
                        valueField: "Id",
                        textField: "Name",
                        sorting: true,
                        validate: "required"
                    },

                    // {
                    //     name: "Status", type: "checkbox", title: "Is Custom", sorting: true, readOnly: true
                    // },
                    {type: "control"}
                ]
            });

        });
    </script>
@endsection
