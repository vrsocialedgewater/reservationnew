<div>
    <div class="container-fluid">
        <div class="row">
            <!-- Row Selection And Deletion (Single Row) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <a class="btn btn-secondary mb-3" id="single-row-delete-btn" href="/admin/locations"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">

                            <div class="table-responsive custom-scrollbar">
                                <table class="table table-bordered checkbox-td-width">
                                    <thead>
                                    <tr>
                                        <th>Property</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{ $location->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $location->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $location->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>City</td>
                                        <td>{{ $location->city }}</td>
                                    </tr>
                                    <tr>
                                        <td>State</td>
                                        <td>{{ $location->state }}</td>
                                    </tr>
                                    <tr>
                                        <td>Zip Code</td>
                                        <td>{{ $location->zip_code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td>{{ $location->zip_code }}</td>
                                    </tr>
                                    @if($location->image)
                                        <tr>
                                            <td>Cover Image</td>
                                            <td>
                                                <img class="img-thumbnail" src="{{ asset('storage/'.$location->image) }}" />
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <!-- Row Selection And Deletion (Single Row) Ends-->
        </div>
    </div>
</div>
<script>

</script>
