<div>
    <ul class="nav-pills">
        @if($checkout)
            <li class="nav-item"><a class="nav-link text-white" href="#" wire:click="checkoutOff"><i class="fa fa-angle-left"></i> Back</a></li>
        @else
            <li class="nav-item"></li>
        @endif
    </ul>
</div>
