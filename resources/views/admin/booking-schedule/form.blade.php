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
                        <label class="col-form-label">Schedule Name</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="name" required placeholder="Enter name" wire:model="name">
                        </div>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Start Time</label>
                        <div wire:ignore>
                            <input class="form-control" type="time" name="start_time" required placeholder="Enter start time" wire:model="start_time">
                        </div>
                        @error('start_time') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">End Time</label>
                        <div wire:ignore>
                            <input class="form-control" id="end_time" type="time" required placeholder="Enter start time" wire:model="end_time">
                        </div>
                        @error('end_time') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Day</label>
                        <div wire:ignore>
                            <select class="form-select input-air-primary digits"  name="service_ids" id="services_ids" required wire:model="day_id" disabled>
                                <option value="">Select Day</option>
                                @foreach($days as $day)
                                    <option value="{{ $day->id }}">{{ $day->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('day_id') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Experience Name</label>
                        <div>
                            <input class="form-control" type="text" disabled="disabled" value="{{ $activeService }}">
                        </div>
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
