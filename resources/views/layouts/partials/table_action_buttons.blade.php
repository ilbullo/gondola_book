@if ($item->trashed())
                            <a wire:click="restore({{ $item->id }})" class="link-primary"
                                title="{{ __('Restore') }}">{{ __('Restore') }}</a>
                        @else
                            <div id="{{ $item->id }}">

                                <a href="#" data-bs-toggle="modal" data-bs-target="#{{$modalWindow}}"
                                    wire:click="edit({{ $item->id }})"
                                    class="link-primary mx-2">{{ __('Edit') }}
                                </a>

                                @include('livewire.partials.delete', ['id' => $item->id])
                                @include('livewire.partials.delete', [
                                    'id' => $item->id,
                                    'destroy' => true,
                                ])
                            </div>
                        @endif
