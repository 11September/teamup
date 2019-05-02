@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endsection

@section('content')
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ url('/admin') }}">Dashboard</a></li>
                        <li><span>Measures</span></li>
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
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <h4 class="header-title text-center">Measures list</h4>
                                <h5>Units*</h5>

                                <div class="measures-container">
                                    <div class="wrapper-measures">

                                        @foreach($measures as $measure)

                                            <div class="wrapper-measures-item">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="wrapper-input-buttons">
                                                            <div class="wrapper-measure-input">
                                                                <input class="form-control custom-form-control-measures"
                                                                       value="{{ $measure->name }}"
                                                                       data-id="{{ $measure->id }}"
                                                                       type="text" name="name">
                                                            </div>

                                                            <div class="wrapper-measures-delete-block">
                                                                <a class="measures-button-block measures-button-block-save"
                                                                   href="#">
                                                                    <i class="fas fa-save"></i>
                                                                </a>
                                                                <a class="measures-button-block measures-button-block-delete"
                                                                   href="#">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>


                                    <div class="add-new-measure">
                                        <div class="circle">
                                            <a class="add-new-measure-link" href="#">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <script>
        $(document).ready(function () {

            // new measure
            $(".measures-container").on("click", '.add-new-measure-link', function (e) {
                e.preventDefault();

                var clicked = $(e.target);
                clicked.prop('disabled', true);

                var previousBox = clicked.closest('.measures-container').find('.wrapper-measures-item:last');
                var previousBoxCount = parseInt($('.wrapper-measures-item').length);
                var previousInput = previousBox.find('input');
                var previousInputValue = previousInput.val();

                if (!previousInputValue && previousBoxCount > 0) {
                    previousInput.css('border-bottom', '2px solid red');

                    setTimeout(function () {
                        previousInput.css('border-bottom', '1px solid grey');
                    }, 3000);
                }
                else if (!previousInputValue && previousBoxCount == 0) {
                    clicked.closest('.measures-container').find('.wrapper-measures').append(
                        '<div class="wrapper-measures-item">' +
                        '<div class="row">' +
                        '<div class="col-md-4">' +
                        '<div class="wrapper-input-buttons">' +
                        '<div class="wrapper-measure-input">' +
                        '<input class="form-control custom-form-control-measures" value="" data-id="" type="text" name="name">' +
                        '</div>' +
                        '<div class="wrapper-measures-delete-block">' +
                        '<a class="measures-button-block measures-button-block-save" href="#">' +
                        '<i class="fas fa-save"></i>' +
                        '</a>' +
                        '<a class="measures-button-block measures-button-block-delete" href="#">' +
                        '<i class="fas fa-trash-alt"></i>' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    ).hide().fadeIn();
                }
                else{
                    clicked.closest('.measures-container').find('.wrapper-measures').append(
                        '<div class="wrapper-measures-item">' +
                        '<div class="row">' +
                        '<div class="col-md-4">' +
                        '<div class="wrapper-input-buttons">' +
                        '<div class="wrapper-measure-input">' +
                        '<input class="form-control custom-form-control-measures" value="" data-id="" type="text" name="name">' +
                        '</div>' +
                        '<div class="wrapper-measures-delete-block">' +
                        '<a class="measures-button-block measures-button-block-save" href="#">' +
                        '<i class="fas fa-save"></i>' +
                        '</a>' +
                        '<a class="measures-button-block measures-button-block-delete" href="#">' +
                        '<i class="fas fa-trash-alt"></i>' +
                        '</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    ).hide().fadeIn();
                }

                clicked.prop('disabled', false);
            });

            // delete measure
            $(".wrapper-measures").on("click", '.measures-button-block-delete', function (e) {
                e.preventDefault();

                var clicked = $(e.target);
                clicked.prop('disabled', true);
                var input = $(this).closest('.wrapper-input-buttons').find('input');
                var id = input.attr("data-id");
                var name = input.val();

                if (id && name) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        type: 'delete',
                        url: '{{ url('admin/measures')}}'  + '/' + id,
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                clicked.closest('.wrapper-measures-item').fadeOut(300, function () {
                                    $(this).remove();
                                });

                                toastr.success(data.message, {timeOut: 3000});
                            }else{
                                toastr.error(data.message, {timeOut: 3000});
                            }
                        }, error: function (data) {
                            console.log(data);
                        }
                    });
                } else {
                    clicked.closest('.wrapper-measures-item').fadeOut(300, function () {
                        $(this).remove();
                    });
                }

                clicked.prop('disabled', false);
            });


            // save measure
            $(".wrapper-measures").on("click", '.measures-button-block-save', function (e) {
                e.preventDefault();

                var clicked = $(e.target);
                clicked.prop('disabled', true);
                var input = $(this).closest('.wrapper-input-buttons').find('input');
                var name = input.val();
                var id = input.attr("data-id");

                if (name) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        type: 'POST',
                        url: '{{ url('admin/measures')}}',
                        dataType: 'json',
                        data: {id: id, name: name},
                        success: function (data) {
                            if (data.success) {
                                if (!id && data.id){
                                    input.attr( "data-id", data.id );
                                }

                                toastr.success(data.message, {timeOut: 3000});
                            }else{
                                toastr.error(data.message, {timeOut: 3000});
                            }
                        }, error: function (data) {
                            console.log(data);

                            var errors = $.parseJSON(data.responseText);

                            console.log(errors);

                            $.each(errors.errors, function (key, value) {
                                toastr.error(value, {timeOut: 2000});
                            });
                        }
                    });
                } else {
                    input.css('border-bottom', '2px solid red');

                    setTimeout(function () {
                        input.css('border-bottom', '1px solid grey');
                    }, 3000);
                }

                clicked.prop('disabled', false);
            });

        });
    </script>
@endsection
