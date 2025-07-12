<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle ">
                <h4 class="p-1">{{ @$item->id ? 'Edit' : 'Add' }} Experience</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.common.alert')

                <form class="theme-form" wire:submit="store" id="item-form">
                    <div class="form-group">
                        <label class="col-form-label">Experience Title</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="title" required placeholder="Enter title" wire:model="title">
                        </div>
                        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Description</label>
                        <div wire:ignore>
                            <textarea class="form-control" name="description" placeholder="Enter description" wire:model="description"></textarea>
                        </div>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
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
                            <img class="img-thumbnail" src="{{ asset('storage/'.$old_cover_image) }}" alt="{{ $title }}">
                            <button class="btn-close" type="button" wire:click="remove_cover_image"></button>
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="col-form-label">Price</label>
                        <div wire:ignore>
                            <div class="input-group">
                                <label class="input-group-text mb-0">$</label>
                                <input class="form-control" type="number" name="price" placeholder="Enter price" wire:model="price" step="0.01" min="0.01" max="9999.99">
                            </div>
                        </div>
                        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Slot(s)</label>
                        <div wire:ignore>
                            <input class="form-control" type="number" name="slot" placeholder="Enter total slots" wire:model="slot">
                        </div>
                        @error('slot') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Experience Type</label>
                        <div wire:ignore>
                            <select class="form-select input-air-primary digits"  name="service_type_id" required placeholder="Select Experience Type" wire:model="service_type_id">
                                <option value="">Select Experience Type</option>
                                @foreach($service_types as $service_type)
                                    <option value="{{ $service_type->id }}" >{{ $service_type->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('service_type_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Duration</label>
                        <div wire:ignore>
                            <div class="input-group">
                                <input class="form-control" type="number" name="duration" placeholder="Enter total duration in minutes" wire:model="duration">
                                <label class="input-group-text mb-0">Minutes</label>
                            </div>

                        </div>
                        @error('duration') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group" id="extended-price-area">
                        <label class="col-form-label">Deposit Price</label>
                        <div wire:ignore>
                            <div class="input-group">
                                <label class="input-group-text mb-0">$</label>
                                <input class="form-control" type="number" name="deposit_price" placeholder="Enter deposit price" wire:model="deposit_price" step="0.01" min="0.01" max="9999.99">
                            </div>
                        </div>
                        @error('deposit_price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-check checkbox checkbox-primary mb-0">
                        <div wire:ignore>
                            <input class="form-check-input" id="checkbox-fixed-price" type="checkbox" wire:model="fixed_price">
                            <label class="form-check-label" for="checkbox-fixed-price">Fixed Price</label>
                        </div>
                        @error('fixed_price') <div class="text-danger">{{ $message }}</div> @enderror

                    </div>

                    <div class="form-group" id="extended-price-area" style="display: none">
                        <label class="col-form-label">Extended Price</label>
                        <div wire:ignore>
                            <div class="input-group">
                                <label class="input-group-text mb-0">$</label>
                                <input class="form-control" type="number" name="extended_price" placeholder="Enter extended price" wire:model="extended_price" step="0.01" min="0.01" max="9999.99">
                            </div>
                        </div>
                        @error('extended_price') <div class="text-danger">{{ $message }}</div> @enderror
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


