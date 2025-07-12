<div>
    <div class="card">
        <div class="card-header pb-0 border-b-info">
            <h3 class="sub-title">Reservation Type</h3>
        </div>
        <div class="card-body">
            <div class="form-check radio radio-primary ps-0">
                <ul class="radio-wrapper justify-content-center">
                    @foreach($serviceTypes as $serviceType)
                        <li>
                            <input class="form-check-input" id="type" type="radio" name="type" value="{{ $serviceType->id }}" wire:model="id" wire:change="changeId({{ $serviceType->id }}, '{{ $serviceType->title }}')">
                            <label class="form-check-label" for="radio-icon"><i class="fa fa-gear"></i><br/><span>{{ $serviceType->title }}</span></label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
