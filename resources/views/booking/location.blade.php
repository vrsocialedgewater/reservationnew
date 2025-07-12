<div>
    <div class="card">
        <div class="card-header pb-0 border-b-info">
            <h3 class="sub-title">Venue</h3>
        </div>
        <div class="card-body">
            <h5 class="f-m-light mt-1">
                {{ @$location->address }} <br/>
                {{ @$location->city }} <br/>
                {{ @$location->state }} <br/>
                {{ @$location->zip_code }} <br/>
                {{ @$location->phone_number }} <br/>
            </h5>
        </div>
    </div>
</div>
