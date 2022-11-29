@if (session('success'))
    <div class="alert alert-success font-12" role="alert">
        {{ session('success') }}
        <button type="button" class="ml-2 close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (isset($success_message))
    <div class="alert alert-success font-12" role="alert">
        {{ $success_message }}
        <button type="button" class="ml-2 close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('danger'))
    <div class="alert alert-danger font-12" role="alert">
        {{ session('danger') }}
        <button type="button" class="ml-2 close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (isset($danger_message))
    <div class="alert alert-danger font-12" role="alert">
        {{ $danger_message }}
        <button type="button" class="ml-2 close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
