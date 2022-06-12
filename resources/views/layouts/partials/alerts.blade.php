@if (session()->has('message'))
    <div class="alert alert-{{ session('type') ? session('type') : 'primary' }} alert-dismissible fade show p-1" role="alert">
        @if(session('element')!=null)<strong>{{ session('element') }}</strong>: @endif{{ session('message') }}.
        <button type="button" class="btn-close btn-sm p-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
