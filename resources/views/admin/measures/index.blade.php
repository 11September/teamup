@extends('layouts.admin')

@section('css')

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
                                                    <div class="col-md-3">
                                                        <input class="form-control custom-form-control-measures"
                                                               value="{{ $measure->name }}" data-id="{{ $measure->id }}"
                                                               type="text" name="name">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="wrapper-measures-delete-block">
                                                            <a class="measures-button-block measures-button-block-save" href="#">
                                                                <i class="fas fa-save"></i>
                                                            </a>
                                                            <a class="measures-button-block measures-button-block-delete" href="#">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
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
    <script>
        $(document).ready(function () {

            // new measure
            $(".measures-container").on("click", '.add-new-measure-link', function (e) {
                e.preventDefault();

                var clicked = $(e.target);
                clicked.prop('disabled', true);
                clicked.closest('.measures-container').find('.wrapper-measures').addClass('lol').append(
                    '<div class="wrapper-measures-item">' +
                    '<div class="row">' +
                    '<div class="col-md-3">' +
                    '<input class="form-control custom-form-control-measures" value="" data-id="" type="text" name="name">' +
                    '</div>' +
                    '<div class="col-md-2">' +
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
                    '</div>'
                ).hide().fadeIn();
                clicked.prop('disabled', false);
            });

            // delete measure
            $(".wrapper-measures").on("click", '.measures-button-block-delete', function (e) {
                e.preventDefault();

                alert('delete click');

                var clicked = $(e.target);
                clicked.prop('disabled', true);
                var delete_lesson_id = $(this).attr("data-id");

                if (delete_lesson_id) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        type: 'POST',
                        url: '/admin/nutritions/adminDeleteFoodByDay',
                        dataType: 'json',
                        data: {id: delete_lesson_id},
                        success: function (data) {
                            if (data.success) {
                                clicked.closest('div.append-day-item').fadeOut(300, function () {
                                    $(this).remove();
                                });
                                toastr.success('Розклад успішно оновлено!', {timeOut: 3000});
                            }
                        }, error: function () {
                            console.log(data);
                        }
                    });
                } else {
                    clicked.closest('div.append-day-item').fadeOut(300, function () {
                        $(this).remove();
                    });
                }

                clicked.prop('disabled', false);
            });



            // save measure
            $(".wrapper-measures").on("click", '.measures-button-block-save', function (e) {
                e.preventDefault();

                alert('save click');

                var clicked = $(e.target);
                clicked.prop('disabled', true);
                var delete_lesson_id = $(this).attr("data-id");

                if (delete_lesson_id) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        type: 'POST',
                        url: '/admin/nutritions/adminDeleteFoodByDay',
                        dataType: 'json',
                        data: {id: delete_lesson_id},
                        success: function (data) {
                            if (data.success) {
                                clicked.closest('div.append-day-item').fadeOut(300, function () {
                                    $(this).remove();
                                });
                                toastr.success('Розклад успішно оновлено!', {timeOut: 3000});
                            }
                        }, error: function () {
                            console.log(data);
                        }
                    });
                } else {
                    clicked.closest('div.append-day-item').fadeOut(300, function () {
                        $(this).remove();
                    });
                }

                clicked.prop('disabled', false);
            });

        });
    </script>
@endsection
