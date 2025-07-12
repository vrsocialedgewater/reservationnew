<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle ">
                <h4 class="p-1">{{ @$item->id ? 'Edit' : 'Add' }} Booking Schedule</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.common.alert')

                <form class="theme-form" wire:submit="store" id="item-form">
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="name" required placeholder="Enter name" wire:model="name">
                        </div>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Stripe Key</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="key" required placeholder="Enter key" wire:model="key">
                        </div>
                        @error('key') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Stripe Secret</label>
                        <div wire:ignore>
                            <input class="form-control" type="password" name="secret" required placeholder="Enter start time" wire:model="secret">
                        </div>
                        @error('secret') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-check checkbox checkbox-primary mb-0">
                        <input class="form-check-input" id="active" type="checkbox" wire:model="active">
                        <label class="form-check-label" for="active">Active</label>
                        @error('active') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <div class="text-end mt-3">
                            <button class="btn btn-primary btn-block w-100" type="submit" wire:loading.attr="disabled">
                                {{ @$item->id ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function () {
        $(document).ready(function() {
        });

        Livewire.on('change_services_data', (r) => {

        });
    });
</script>
