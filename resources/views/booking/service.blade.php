<div>
    <div class="card">
        <div class="card-header pb-0 border-b-info">
            <h3 class="sub-title">Choose {{ $service_type_text }}</h3>
        </div>
        <div class="card-body">
            <div class="form-check radio radio-primary ps-0">
                <ul class="radio-wrapper  justify-content-center experience-section">
                    @foreach($services as $item)
                        <li>
                            @if($item->packages && $item->packages->isNotEmpty())
                                <input class="form-check-input" type="radio" name="service" value="{{ $item->id }}" wire:model="id" wire:change="changeService({{ $item->id }})">
                            @else
                                <input class="form-check-input" type="radio" name="service" value="{{ $item->id }}" wire:model="id" wire:change="changeId({{ $item->id }}, '{{ $item->title }}', {{ $item->price }}, {{ $item->slot }}, {{ $item->deposit_price ? $item->deposit_price : 0.00 }}, {{ $item->fixed_price ? 1 : 0 }})">
                            @endif
                            <label class="form-check-label"><i class="fa fa-gamepad"></i><br/><span>{{ $item->title }}</span></label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if($packages && $packages->isNotEmpty())
            <div class="card-header pb-0 border-b-info">
                <h3 class="sub-title">Choose Package</h3>
            </div>
            <div class="card-body">
                <div class="form-check radio radio-primary ps-0">
                    <ul class="radio-wrapper  justify-content-center experience-section">
                        @foreach($packages as $package)
                            <li>
                                <input class="form-check-input" type="radio" name="service_package" value="{{ $package->id }}" wire:model="id" wire:change="changeId({{ $service->id }}, '{{ $service->title }}', {{ $package->price }}, {{ $service->slot }}, {{ $package->deposit_price ? $package->deposit_price : 0.00 }}, {{ $package->fixed_price ? 1 : 0 }}, {{ $package->id }}, '{{ $package->name }}')">
                                <label class="form-check-label"><i class="fa fa-gamepad"></i><br/><span>{{ $package->name }}</span><br/><span>${{ $package->price }}</span></label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</div>
