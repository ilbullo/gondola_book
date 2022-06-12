<div class="row" style="min-height:50px;">

    <div class="col-6 text-start h-100">

        @if (count($selectedElements) > 0)
            <a class="btn btn-danger btn-sm" @include('layouts.partials.confirmation')
                wire:click="bulk()">{{ __('Trash Selected') }}</a>

            <a class="btn btn-dark btn-sm" @include('layouts.partials.confirmation')
                wire:click="bulk(true)">{{ __('Delete Selected') }}</a>
        @endif

    </div>

    <div class="col-6 text-end h-100">
        @if ($items->filter(function ($element, $key) {
                return $element->deleted_at != null;
            })->count() > 0)
            <a class="btn btn-success btn-sm" @include('layouts.partials.confirmation')
                wire:click="restoreAll()">{{ __('Restore all trashed') }}</a>
        @endif
    </div>

</div>
