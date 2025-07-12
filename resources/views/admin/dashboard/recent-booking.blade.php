<div>
    <div class="card">
        <div class="card-header pb-0">
            <div class="header-top">
                <h4>Recent Bookings </h4>
                <div class="dropdown icon-dropdown setting-menu">
                    <button class="btn dropdown-toggle" id="userdropdown4" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg>
                            <use href="../assets/svg/icon-sprite.svg#setting"> </use>
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown4"><a class="dropdown-item" href="#">Weekly</a><a class="dropdown-item" href="#">Monthly </a><a class="dropdown-item" href="#">Yearly</a></div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive custom-scrollbar">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Service</th>
                        <th>Date & Time </th>
                        <th>Persons </th>
                        <th>Price </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ @$item->service->title }}</td>
                            <td>{{ @$item->date_time }}</span></td>
                            <td>{{ $item->quantity }}</td>
                            <td>$ {{ @$item->order->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
