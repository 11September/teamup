<div class="col-sm-12 p-2">
    @if (Session::has('message'))
        <div class="alert alert-@if(Session::get('status')){{ Session::get('status') }}@else alert-primary  @endif alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('message')}}
        </div>
    @endif
</div>


