<div>
    @if (Session::get('fail'))
        <div class="alert-danger p-2">
            {{ Session::get('fail') }}
            <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::get('success'))
        <div class="alert-success p-2">
            {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::get('info'))
    <div class="alert-info p-2">
        {{ Session::get('info') }}
        <button type="button" class="close" data-dismiss="alert" arial-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
</div>
