<div>
    <div class="card">
        <div class="card-header pb-0 border-b-info">
            <h3 class="sub-title">Upgrades</h3>
        </div>
        <div class="card-body">
            @foreach($additional_services as $additional_service)
                <div class="card">
                    <div class="card-body">
                <div class="form-check checkbox checkbox-primary mb-0">
                    <input class="form-check-input" id="additional-service-{{ $additional_service->id }}" type="checkbox" name="additional_service[]"  value="{{ $additional_service->id }}" wire:model="id" wire:change="changeId({{ $additional_service->id }}, {{ $additional_service }})">
                    <label class="form-check-label" for="additional-service-{{ $additional_service->id }}" >
                        <span>{{ $additional_service->title }}</span>
                        <br/>
                        <span class="text-muted"><span>{{ $additional_service->description }}</span></span>
                        <br/>
                        <img class="img-thumbnail" id="service-image" src="{{ asset('storage/'.$additional_service->image) }}" alt="{{ $additional_service->title }}">
                    </label>
                </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
