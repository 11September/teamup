<div class="col-xl-8 col-lg-8 mt-5">
    <div class="wrapper-feedbacks">
        <div class="card">
            <div class="card-body bg1">
                <h4 class="header-title text-white">
                    <a class="allFeedbacks" href="{{ action('Admin\FeedbacksController@index') }}">Client Feadbacks</a>
                </h4>

                @if(isset($feedbacks))
                    @if(count($feedbacks) > 0)

                        <div class="testimonial-carousel owl-carousel">
                            @foreach($feedbacks as $feedback)

                                <div class="tst-item">
                                    <div class="tst-wrapper-item">
                                        <div class="tstu-img">
                                            @if($feedback->user->avatar)
                                                <img src="{{ asset($feedback->user->avatar) }}" alt="author image">
                                            @else
                                                <img src="{{ asset('images/team/team-author1.jpg') }}"
                                                     alt="author image">
                                            @endif
                                        </div>
                                        <div class="tstu-content">
                                            <h4 class="tstu-name"><a class="mailTo" href="{{ url('admin/users', $feedback->user->id) }}">{{ $feedback->user->getFullnameAttribute() }}</a></h4>
                                            <span class="profsn"><a class="mailTo" href="mailto:{{ $feedback->user->email }}">{{ $feedback->user->email }}</a></span>
                                            <span class="profsn">{{ $feedback->date->format('d-m-Y') }}</span>
                                            <p>{{ $feedback->feedback }}</p>
                                        </div>

                                        <div class="tst-absolute">
                                            <div class="tst-action-block">
                                                <a href="#" class="markReadFeedback" data-id="{{ $feedback->id }}">
                                                    <i class="fas fa-check-circle"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    @else
                        <div class="wrapper-no-feedbacks">
                            <p>No feedbacks yet!</p>
                        </div>
                    @endif
                @endif


            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent

    <script>
        function clearOwl() {
            if (!$('.tst-item').length){
                $('.testimonial-carousel').remove();
                var text = '<div class="wrapper-no-feedbacks">\n' +
                    '<p>No feedbacks yet!</p>\n' +
                    '</div>';
                $('.wrapper-feedbacks .card-body').append(text);
            }
        }

        $(document).ready(function () {
            $(".wrapper-feedbacks").on("click", '.markReadFeedback', function (e) {
                e.preventDefault();
                var clicked = $(e.target);
                var id = $(this).attr("data-id");
                clicked.prop('disabled', true);

                if (id) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'PUT',
                        url: '{{ url('admin/feedbacks')}}' + '/' + id,
                        dataType: 'json',
                        data: {id: id, status: "read"},
                        success: function (data) {
                            if (data.success) {
                                clicked.closest('.owl-item').remove();
                                clearOwl();

                                toastr.success(data.message, {timeOut: 3000});
                            } else {
                                toastr.error(data.message, {timeOut: 3000});
                            }
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }

                clicked.prop('disabled', false);
            });
        });

    </script>
@endsection
