<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @if (isset($report->user))
            {{ $report->user->first_name . " " . $report->user->last_name }}
        @else
            {{ $user->first_name . " " . $user->last_name }}
        @endif
    </title>
</head>
<body>

<style>
    table {
        margin-bottom: 50px;
    }

    table,
    td {
        border: 1px solid #333;
    }

    thead,
    tfoot {
        background-color: #333;
        color: white;
    }

    .tablerow {
        margin-bottom: 20px;
        padding: 20px;
    }
</style>


<table>
    <thead>
    <tr>
        <th colspan="2">Actictivity</th>
        <th colspan="2">Athlet</th>
        <th colspan="2">Goal</th>
    </tr>
    <tr>
        <th colspan="2">{{ $activity->name }}</th>
        <th colspan="2">
            @if (isset($report->user))
                {{ $report->user->first_name . " " . $report->user->last_name }}
            @else
                {{ $user->first_name . " " . $user->last_name }}
            @endif
        </th>
        @if($activity->goal)
            <th colspan="2">{{ $activity->goal->goal }}</th>
        @endif
    </tr>
    </thead>

    <tbody>
    <tr align="center">
        <td align="center">
            <img src="{{ public_path('images/24df642906350a4a377b4483cc5c3bf7.jpg') }}"
                 alt="image" width="90px" height="75px">
        </td>
    </tr>
    </tbody>
</table>

<table cellpadding="3" cellspacing="2">
    <thead>
    <tr>
        <th colspan="2">All {{ $range }} records</th>
    </tr>
    </thead>
    <tbody>
    @if($records && count($records) > 0)
        @foreach($records as $key => $value)
            @php
                $maxResult = 0;
                $date = null;
                $notice = null;
                foreach($value as $record){
                    if ($record->value > $maxResult){
                    $maxResult = $record->value;
                    $date = $record->date;
                    $notice = $record->notice;
                    }
                }
            @endphp

            <tr class="tablerow">
                <td align="left">{{ $maxResult }} - {{ $activity->measure->name }}</td>
                <td align="right">{{ $date ? $date : '' }}</td>
            </tr>

            @if($notice)
                <tr colspan="2" class="tablerow">
                    <td align="left" colspan="2">{{ $notice }}</td>
                </tr>
            @endif

        @endforeach
    @endif
    </tbody>
</table>
</body>
</html>
