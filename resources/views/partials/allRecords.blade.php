@if($report->range == "week")
    <div id="accordion4" class="according accordion-s3 gradiant-bg">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#accordion41">All
                    week
                    records</a>
            </div>
            <div id="accordion41" class="collapse show"
                 data-parent="#accordion4">
                <div class="card-body">

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


                        <div class="card-body-record">
                            <p><span>{{ $maxResult }}</span>
                                - {{ $activity->measure->name }}
                            </p>
                            <p>{{ $date ? $date : '' }}</p>
                        </div>
                        @if($notice) <p class="card-body-record-notice">{{ $notice }}</p> @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@elseif($report->range == "month")
    <div id="accordion4" class="according accordion-s3 gradiant-bg">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#accordion41">All
                    month
                    records</a>
            </div>
            <div id="accordion41" class="collapse show"
                 data-parent="#accordion4">
                <div class="card-body">

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


                        <div class="card-body-record">
                            <p><span>{{ $maxResult }}</span>
                                - {{ $activity->measure->name }}
                            </p>
                            <p>{{ $date ? $date : '' }}</p>
                        </div>
                        @if($notice) <p class="card-body-record-notice">{{ $notice }}</p> @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div id="accordion4" class="according accordion-s3 gradiant-bg">
        @foreach($records as $key => $value)
            <div class="card">
                <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse"
                       href="#{{ $key }}">
                        {{ $key }}
                    </a>
                </div>
                <div id="{{ $key }}"
                     class="collapse {{ $loop->last ? "" : "" }}"
                     data-parent="#accordion4">
                    <div class="card-body">
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

                        <div class="card-body-record">
                            <p><span>{{ $maxResult }}</span>
                                - {{ $activity->measure->name }}
                            </p>
                            <p>{{ $date ? $date : '' }}</p>
                        </div>
                        @if($notice) <p class="card-body-record-notice">{{ $notice }}</p> @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
