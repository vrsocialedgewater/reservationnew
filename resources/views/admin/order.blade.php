<div>
    <div class="container-fluid">
        <div class="row">
            <!-- Row Selection And Deletion (Single Row) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="datatable-section">
                                <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Service name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ @$loop->iteration }}</td>
                                        <td>{{ @$item->booking->service->title }}</td>
                                        <td>${{ $item->price }}</td>
                                        <td class="{{ $item->status == "succeeded" ? "text-success" : "text-danger" }}">{{ $item->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row Selection And Deletion (Single Row) Ends-->
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="form_modal" aria-hidden="true">
        <livewire:admin.additional-service.form />
    </div>
</div>
<script>

    document.addEventListener('livewire:init', function () {
        Livewire.hook('element.init', () => {
            initialize();
        });
        Livewire.hook('morph.updated', ({ component, cleanup }) => {
            initialize();
        })
    });

    function initialize() {
        $(document).ready(function() {
            $("#datatable-section").DataTable({
                "bDestroy": true
            });
        } );
    }

</script>
