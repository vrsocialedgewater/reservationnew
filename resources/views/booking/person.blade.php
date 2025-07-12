<div>
    <div class="card">
        <div class="card-header pb-0 border-b-info">
            <h3 class="sub-title">Choose Players</h3>
        </div>
        <div class="card-body">
            <div class="input-group input-group-lg">
                <button class="btn btn-outline-secondary" id="decrement" type="button" wire:click="decrement" ><i class="fa fa-minus"></i></button>
                <input class="form-control" type="number" placeholder="Enter total players" wire:model="persons" wire:change="changePersons($event.target.value)" min="1" max="{{ $slots }}">
                <button class="btn btn-outline-secondary" id="increment" type="button" wire:click="increment" ><i class="fa fa-plus"></i></button>
            </div>
            <br/><p class="text-muted">The maximum number of players allowed is {{ $slots }}.</p>
        </div>
    </div>
</div>
