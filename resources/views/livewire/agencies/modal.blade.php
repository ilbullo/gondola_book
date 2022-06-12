<!-- Modal -->
<div wire:ignore.self class="modal fade" id="AgencyModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Create new agency') }}</h5>
                <a class="close text-dark" wire:click.prevent="cancel()" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
            </a>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" wire:model="agency_id">
                        <label for="exampleFormControlInput1">{{ __('Name') }}</label>
                        <input type="text" class="form-control @error('form.name') border border-danger @enderror" wire:model="form.name" id="exampleFormControlInput1"
                            placeholder="{{ __('Enter Name') }}">
                        @error('form.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" wire:click.prevent="store()"
                    class="btn btn-primary">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        window.addEventListener('closeModal', event => {
            $('#AgencyModal').modal('hide')
        })
    </script>
@endsection
