<div class="d-inline" x-data="{ confirmDelete: false }">
    <a href="#" x-show="!confirmDelete" x-on:click="confirmDelete=true" class="link-{{ $destroy ? 'dark' : 'danger' }} mx-2" data-bs-toggle="tooltip"
        data-bs-placement="top" rel="tooltip" title="{{ __('Delete') }}">{{ $destroy ? __('Delete') : __('Put in trash') }}</a>
    <a href="#" class="mx-2" x-show="confirmDelete" x-on:click="confirmDelete=false"
        wire:click="@if($destroy == null) delete({{ $id }}) @else destroy({{ $id }}) @endif" class="link-success">{{ __('Yes') }}</a>
    <a href="#" x-show="confirmDelete" x-on:click="confirmDelete=false" class="link-danger">{{ __('No') }}</a>
</div>
