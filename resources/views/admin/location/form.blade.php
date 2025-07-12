<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle ">
                <h4 class="p-1">{{ @$location->id ? 'Edit' : 'Add' }} Location</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.common.alert')

                <form class="theme-form" wire:submit="store" id="location-form">
                    <div class="form-group">
                        <label class="col-form-label">Location Name</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="name" required placeholder="Enter name" wire:model="name">
                        </div>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Address</label>
                        <div wire:ignore>
                            <textarea class="form-control" name="address" required placeholder="Enter address" wire:model="address"></textarea>
                        </div>
                        @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">City</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="city" required placeholder="Enter city" wire:model="city">
                        </div>
                        @error('city') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">State</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="state" placeholder="Enter state" wire:model="state">
                        </div>
                        @error('state') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Zip Code</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="zip_code" placeholder="Enter zip code" wire:model="zip_code">
                        </div>
                        @error('zip_code') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Phone Number</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="phone_number" placeholder="Enter phone number" wire:model="phone_number">
                        </div>
                        @error('phone_number') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Cover Image</label>
                        <div wire:ignore>
                            <input class="form-control" id="cover_image" type="file" wire:model="cover_image">
                        </div>
                        @error('cover_image') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    @if($old_cover_image)
                        <div class="alert txt-primary border-primary alert-dismissible fade show" role="alert">
                            <img class="img-thumbnail" src="{{ asset('storage/'.$old_cover_image) }}" alt="{{ $name }}">
                            <button class="btn-close" type="button" wire:click="remove_cover_image"></button>
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <div class="text-end mt-3">
                            <button class="btn btn-primary btn-block w-100" type="submit" wire:loading.attr="disabled">
                                {{ @$location->id ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


