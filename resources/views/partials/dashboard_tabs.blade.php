@if(Auth::user()->type == "admin")
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6 mt-2 mb-3">
                <div class="card">
                    <div class="seo-fact sbg1">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">
                                <a class="text-white" href="{{ url('admin/users') }}">
                                    <i class="fas fa-users"></i>
                                    Athlets
                                </a>
                            </div>
                            <h2>
                                {{ $tabs['users'] }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-md-2 mb-3">
                <div class="card">
                    <div class="seo-fact sbg2">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">
                                <a class="text-white" href="{{ url('admin/measures') }}">
                                    <i class="fas fa-weight"></i> Measures
                                </a>
                            </div>
                            <h2>{{ $tabs['measures'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="seo-fact sbg3">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">
                                <a class="text-white" href="{{ url('admin/teams') }}">
                                    <i class="fas fa-users-cog"></i> Teams
                                </a>
                            </div>
                            <div class="seofct-icon">{{ $tabs['teams'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card">
                        <div class="seo-fact sbg4">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon">
                                    <a class="text-white" href="{{ url('admin/reports') }}">
                                        <i class="fas fa-file-pdf"></i> Reports
                                    </a>
                                </div>
                                <div class="seofct-icon">{{ $tabs['reports'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card">
                        <div class="seo-fact sbg2">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon">
                                    <a class="text-white" href="{{ url('admin/activities') }}">
                                        <i class="fas fa-volleyball-ball"></i> Actives
                                    </a>
                                </div>
                                <div class="seofct-icon">{{ $tabs['actives'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card">
                        <div class="seo-fact sbg1">
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div class="seofct-icon">
                                    <a class="text-white" href="{{ url('admin/feedbacks') }}">
                                        <i class="fas fa-comment-dots"></i> Feedbacks
                                    </a>
                                </div>
                                <div class="seofct-icon">{{ $tabs['feedbacks'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@if(Auth::user()->type == "coach")
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6 mt-2 mb-3">
                <div class="card">
                    <div class="seo-fact sbg1">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">
                                <a class="text-white" href="{{ url('admin/users') }}">
                                    <i class="fas fa-users-cog"></i> Teams
                                </a>
                            </div>
                            <h2>{{ $tabs['teams'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-md-2 mb-3">
                <div class="card">
                    <div class="seo-fact sbg2">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">
                                <a class="text-white" href="{{ url('admin/users') }}">
                                    <i class="fas fa-user-friends"></i> Students
                                </a>
                            </div>
                            <h2>{{ $tabs['students'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="seo-fact sbg3">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">
                                <a class="text-white" href="{{ url('admin/notes') }}">
                                    <i class="far fa-sticky-note"></i> Notes
                                </a>
                            </div>
                            <div class="seofct-icon">{{ $tabs['notes'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="seo-fact sbg4">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon">
                                <a class="text-white" href="{{ url('admin/activities') }}">
                                    <i class="fas fa-stopwatch"></i> Exercises
                                </a>
                            </div>
                            <div class="seofct-icon">{{ $tabs['actives'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
