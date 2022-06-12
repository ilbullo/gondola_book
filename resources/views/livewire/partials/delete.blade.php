{{-- @if (\Auth::user()->isAdmin()) --}}
    <x-delete-confirm id="{{ $id }}" destroy="{{isset($destroy) ? : null}}" />
{{-- @endif --}}
