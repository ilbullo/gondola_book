<div class="container">

    @include('layouts.partials.alerts')
    @include('layouts.partials.page_title', ['page_title' => $page_title,'modalName' => $modalWindow])
    @include('layouts.partials.bulk_buttons', ['selectedElements' => $selectedElements,'items' => $agencies])

    <table class="table table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" wire:model="selectAll"></th>
                <th>{{ __('Agency') }} <a href="#" wire:click="$toggle('sort')"><i
                            class="fa {{ $sort ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i></a></th>
                <th class="text-end"><input type="text" wire:model="search"
                        placeholder="{{ __('Search') }}..." /></th>
            </tr>
        </thead>
        <tbody>

            @forelse($agencies as $agency)
                <tr>
                    <td>
                        <input wire:model="selectedElements" name="bulk_{{ $agency->id }}" value="{{ $agency->id }}"
                            type="checkbox">
                    </td>
                    <td class="text-uppercase"> {{ $agency->name }} </td>
                    <td class="text-end">
                        @include('layouts.partials.table_action_buttons',['item' => $agency, 'modalWindow' => 'agencyModal'])
                    </td>
                </tr>
            @empty
                <tr>
                    <td> {{ __(\config('app.empty_table_message')) }}</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    {{ $agencies->links() }}

    @include('livewire.agencies.modal')

</div>
