<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle ">
                <h4 class="p-1">Schedule Generate</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.common.alert')

                <form class="theme-form" wire:submit="store" id="location-form">
                    <div class="form-group">
                        <label class="col-form-label">Name</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="name" required placeholder="Enter name" wire:model="name">
                        </div>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Choose Service</label>
                        <div wire:ignore>
                            <select class="form-select"  name="service_id" id="services_id" required placeholder="Select Service" wire:model="service_id">
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('service_id') <div class="text-danger">{{ $message }}</div> @enderror
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
                        <label class="col-form-label">Duration</label>
                        <div wire:ignore>
                            <div class="input-group">
                                <input class="form-control" type="number" name="duration" placeholder="Enter total duration in minutes" wire:model="duration">
                                <label class="input-group-text mb-0">Minutes</label>
                            </div>

                        </div>
                        @error('duration') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="card-wrapper border rounded-3 mt-3 checkbox-checked">
                        <label class="form-check-label lead">Choose days </label>
                        @foreach($days as $it)
                            <div class="form-check checkbox checkbox-primary mb-0">
                                <input class="form-check-input" id="checkbox-primary-{{ $it->id }}" type="checkbox" name="day" wire:model="day" value="{{ $it->id }}">
                                <label class="form-check-label" for="checkbox-primary-{{ $it->id }}">{{ $it->name }}</label>
                            </div>
                        @endforeach
                        @error('day') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group mb-0">
                        <div class="text-end mt-3">
                            <p class="text-warning text-start">***Generating this schedule will replace any existing schedules in the selected service. Would you like to proceed?***</p>
                            <button class="btn btn-primary btn-block w-100" type="submit" wire:loading.attr="disabled">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


