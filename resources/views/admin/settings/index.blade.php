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
                        <li><a href="{{ url('/admin/users') }}">Users</a></li>
                        <li><span>Create new User</span></li>
                    </ul>
                </div>
            </div>

            @include('errors.message')

            @include('errors.errors')

        </div>
    </div>

    <div class="main-content-inner">

        <form class="needs-validation" novalidate="" action="{{ action('Admin\SettingsController@store') }}"
              method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="type_graph_straight" class="col-form-label">Type Graph
                                            Straight</label>
                                        <input type="hidden" name="id" value="@if(isset($setting->id)){{ $setting->id }}@endif">

                                        <textarea
                                            class="form-control{{ $errors->has('type_graph_straight') ? ' is-invalid' : '' }}"
                                            type="text" name="type_graph_straight" rows="5"
                                            id="type_graph_straight" required>
                                            @if(isset($setting->type_graph_straight))
                                                {{ $setting->type_graph_straight }}
                                            @else {{ old('type_graph_straight') }}
                                            @endif
                                        </textarea>

                                        @if ($errors->has('type_graph_straight'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type_graph_straight') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="type_graph_reverse" class="col-form-label">Type Graph Reverse</label>
                                        <textarea
                                            class="form-control{{ $errors->has('type_graph_reverse') ? ' is-invalid' : '' }}"
                                            type="text" name="type_graph_reverse" rows="5"
                                            id="type_graph_reverse" required>
                                            @if(isset($setting->type_graph_reverse))
                                                {{ $setting->type_graph_reverse }}
                                            @else {{ old('type_graph_reverse') }}
                                            @endif
                                        </textarea>

                                        @if ($errors->has('type_graph_reverse'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('type_graph_reverse') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Textual inputs end -->
                    </div>
                </div>
                <div class="col-lg-6 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="privacy_policy" class="col-form-label">Privacy Policy</label>
                                        <textarea
                                            class="form-control{{ $errors->has('privacy_policy') ? ' is-invalid' : '' }}"
                                            type="text" name="privacy_policy" rows="5"
                                            id="privacy_policy" required>
                                            @if(isset($setting->privacy_policy))
                                                {{ $setting->privacy_policy }}
                                            @else {{ old('privacy_policy') }}
                                            @endif
                                        </textarea>

                                        @if ($errors->has('privacy_policy'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('privacy_policy') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="default_units" class="col-form-label">Default Units</label>
                                        <textarea
                                            class="form-control{{ $errors->has('default_units') ? ' is-invalid' : '' }}"
                                            type="text" name="default_units" rows="5"
                                            id="default_units" required>
                                            @if(isset($setting->default_units))
                                                {{ $setting->default_units }}
                                            @else {{ old('default_units') }}
                                            @endif
                                        </textarea>

                                        @if ($errors->has('default_units'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('default_units') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-ml-12">
                    <div class="row">
                        <div class="col-12 mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary">Save Settings</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        window.addEventListener('load', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    </script>
@endsection
