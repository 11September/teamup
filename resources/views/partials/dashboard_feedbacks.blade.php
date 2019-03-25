<div class="col-xl-8 col-lg-8 mt-5">
    <div class="card">
        <div class="card-body bg1">
            <h4 class="header-title text-white">Client Feadback</h4>

            @if(count($feedbacks) > 0)

                @foreach($feedbacks as $feedback)
                    <div class="testimonial-carousel owl-carousel">
                        <div class="tst-item">
                            <div class="tstu-img">
                                <img src="{{ asset('images/team/team-author1.jpg') }}" alt="author image">
                            </div>
                            <div class="tstu-content">
                                <h4 class="tstu-name">{{ $feedback->user->getFullnameAttribute() }}</h4>
                                <span class="profsn">{{ $feedback->user->email }}</span>
                                <span class="profsn">{{ $feedback->date }}</span>
                                <p>{{ $feedback->feedback }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <div class="wrapper-no-feedbacks">
                    <p>No feedbacks yet!</p>
                </div>
            @endif


        </div>
    </div>
</div>
