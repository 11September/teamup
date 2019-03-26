<div class="col-xl-8 col-lg-8 mt-5">
    <div class="card">
        <div class="card-body bg1">
            <h4 class="header-title text-white">Client Feadback</h4>

            @if(isset($feedbacks))
                @if(count($feedbacks) > 0)

                    <div class="testimonial-carousel owl-carousel">
                        @foreach($feedbacks as $feedback)

                            <div class="tst-item">
                                <div class="tstu-img">
                                    @if($feedback->user->avatar)
                                        <img src="{{ asset($feedback->user->avatar) }}" alt="author image">
                                    @else
                                        <img src="{{ asset('images/team/team-author1.jpg') }}" alt="author image">
                                    @endif
                                </div>
                                <div class="tstu-content">
                                    <h4 class="tstu-name">{{ $feedback->user->getFullnameAttribute() }}</h4>
                                    <span class="profsn">{{ $feedback->user->email }}</span>
                                    <span class="profsn">{{ $feedback->date }}</span>
                                    <p>{{ $feedback->feedback }}</p>
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
