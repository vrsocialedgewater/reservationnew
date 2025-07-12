<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle ">
                <h4 class="p-1">{{ @$item->id ? 'Edit' : 'Add' }} Upgrade</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.common.alert')

                <form class="theme-form" wire:submit="store" id="item-form">
                    <div class="form-group">
                        <label class="col-form-label">Upgrade Title </label>
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
                                <input class="form-control" type="number" name="price" placeholder="Enter title" wire:model="price">
                            </div>
                        </div>
                        @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Choose Experiences</label>
                        <div wire:ignore>
                            <select class="form-select input-air-primary digits"  name="service_ids" id="services_ids" placeholder="Select experiences" wire:model="service_ids" multiple="multiple">
                                <option value="">Select Experiences</option>
                            </select>
                        </div>
                        @error('service_ids') <div class="text-danger">{{ $message }}</div> @enderror
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
            $('#services_ids').select2({
                placeholder: "Select Experiences",
                allowClear: true,
                data: @json($options)
            });

            $('#services_ids').on('change', function (e) {
                var data = $(this).val();
                @this.set('service_ids', data);
            });
        });

        Livewire.on('change_services_data', (r) => {
            $("#services_ids").html('');
            // $("#services_ids").select2('destroy');
            $('#services_ids').select2({
                placeholder: "Select Experiences",
                allowClear: true,
                data: r.data
            });
            $('#services_ids').on('change', function (e) {
                var data = $(this).val();
                @this.set('service_ids', data);
            });
        });
    });



</script>
