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
                            && (!filter.Teams || activity.Teams === filter.Teams)
                            && (!filter.Units || activity.Units === filter.Units)
                            && (!filter.Graphtype || activity.Graphtype === filter.Graphtype)
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

            db.teams = [
                    @foreach($teams as $team)
                {
                    Name: "{{ $team->name }}", Id: {{ $team->id }}},
                @endforeach
            ];

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

            db.status = [

                    @if(Auth::user()->type == "admin")
                        {Name: "Blank", Id: "blank"},
                    @endif

                    @if(Auth::user()->type == "coach")
                        {Name: "Custom", Id: "custom"},
                    @endif

            ];

            db.activities = [
                    @foreach($activities as $activity)
                {
                    "Id" : {{ $loop->index }},
                    "Name": "{{ $activity->name }}",
                    "Teams": @if($activity->team_id){{ $activity->team_id }}@else 0 @endif,
                    "Units": {{ $activity->measure_id }},
                    "Graphtype": "{{ $activity->graph_type }}",
                    "Status": "{{ $activity->status }}"
                },
                @endforeach
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
                confirmDeleting: true,
                rowClass: function(item, itemIndex) {



                    console.log(item, itemIndex)
                },

                fields: [
                    {
                        name: "Id", textField: "Activity Name", type: "text", width: 150, sorting: true, visible: false,
                        validate: "required"
                    },

                    {
                        name: "Name", textField: "Activity Name", type: "text", width: 150,  sorting: true, headercss: "table-cell-heading", css: "table-cell", insertcss: "table-cell", editcss : "table-cell",
                        validate: [
                            "required",
                            {validator: "minLength", param: 6},
                            function (value, item) {
                                return item.IsRetired ? value > 6 : true;
                            }
                        ]
                    },

                    {
                        name: "Teams",
                        type: "select",
                        items: db.teams,
                        valueField: "Id",
                        textField: "Name",
                        sorting: true,
                        validate: "required"
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
                        name: "Status",
                        type: "select",
                        items: db.status,
                        valueField: "Id",
                        textField: "Name",
                        sorting: true,
                        // validate: "required"
                    },

                    // {
                    //     name: "Status", type: "checkbox", title: "Custom", sorting: true, readOnly: false
                    // },

                    {type: "control"}
                ]
            });

        });
    </script>
@endsection
