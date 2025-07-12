<div>
    <div class="container-fluid">
        <div class="row">
            <!-- Row Selection And Deletion (Single Row) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <a class="btn btn-secondary mb-3" id="single-row-delete-btn" href="/admin/experience_types"><i class="fa fa-arrow-left"></i> Back</a>
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
                                        <td>{{ $item->id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Title</td>
                                        <td>{{ $item->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{ $item->description }}</td>
                                    </tr>
                                    @if($item->image)
                                        <tr>
                                            <td>Cover Image</td>
                                            <td>
                                                <img class="img-thumbnail" src="{{ asset('storage/'.$item->image) }}" />
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
