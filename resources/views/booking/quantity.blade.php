<div>
    <div class="card">
        <div class="card-header pb-0 border-b-info">
            <h3 class="sub-title">Quantity {{ $schedules }}</h3>
        </div>
        <div class="card-body">
            <div class="input-group input-group-lg">
                <button class="btn btn-outline-secondary" id="decrement_quantity" type="button" wire:click="decrementIt" ><i class="fa fa-minus"></i></button>
                <input class="form-control" type="number" placeholder="Enter total quantity" wire:model="items" wire:change="changeIt($event.target.value)" min="1" max="{{ $limit }}">
                <button class="btn btn-outline-secondary" id="increment_quantity" type="button" wire:click="incrementIt" ><i class="fa fa-plus"></i></button>
            </div>
            <br/><p class="text-muted">You've selected the following time(s) - 11:00 AM, 11:30 AM, and 12:00 PM</p>
        </div>
    </div>
</div>
