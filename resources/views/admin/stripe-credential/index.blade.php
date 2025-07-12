<div>
    <div class="container-fluid">
        <div class="row">
            <!-- Row Selection And Deletion (Single Row) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <button class="btn btn-secondary mb-3" id="single-row-delete-btn" onclick="openModal()"><i class="fa fa-plus"></i> Add Service</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="datatable-section">
                                <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Name</th>
                                    <th>Key</th>
                                    <th>Secret</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->key }}</td>
                                        <td>{{ $item->secret }}</td>
                                        <td class="{{ $item->active ? "text-success" : "" }}">{{ $item->active ? "Active" : "" }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button class="btn btn-outline-info" onclick="view({{ $item->id }})"><i class="icon-eye"></i></button>
                                                <button class="btn btn-outline-warning" onclick="edit({{ $item->toJson() }})"><i class="icon-pencil-alt"></i></button>
                                                <button class="btn btn-outline-danger" onclick="confirmDelete({{ $item->id }})"><i class="icon-trash"></i></button>
                                            </div>
                                        </td>
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
        <livewire:admin.stripe-credential.form />
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

        Livewire.on('stripe_credential-created', () => {
            openToast('success', 'Stripe credential has created!')
            $('#form_modal').modal('hide');
        });

        Livewire.on('stripe_credential-updated', () => {
            openToast('success', 'Stripe credential has updated!')
            $('#form_modal').modal('hide');
        });

        Livewire.on('stripe_credential-update-error', () => {
            openToast('error', 'Stripe credential update error. Please try again!')
            $('#form_modal').modal('hide');
        });

        Livewire.on('stripe_credential-deleted', () => {
            openToast('success', 'Stripe credential has deleted!')
        });
    });

    function initialize() {
        $(document).ready(function() {
            $("#datatable-section").DataTable({
                "bDestroy": true
            });
        } );
    }

    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this item?')) {
        @this.call('delete', id)
        }
    }

    function edit(item) {
        Livewire.dispatch('edit-form', { item: item})
        $('#form_modal').modal('show');
    }
    0
    function view(id) {
        Livewire.navigate('/admin/stripe_credentials/'+id)
    }

    function openModal(){
        Livewire.dispatch('open-create-form')
        $('#form_modal').modal('show');
    }

</script>
