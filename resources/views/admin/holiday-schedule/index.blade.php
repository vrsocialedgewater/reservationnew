<div>
    <div class="container-fluid">
        <div class="row">
            <!-- Row Selection And Deletion (Single Row) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <button class="btn btn-secondary mb-3" id="single-row-delete-btn" onclick="openModal()"><i class="fa fa-plus"></i> Add Holiday Schedule</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="datatable-section">
                                <thead>
                                <tr>
                                    <th>Sl#</th>
                                    <th>Name</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->start_date)->format('jS F, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->end_date)->format('jS F, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
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
        <livewire:admin.holiday-schedule.form />
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

        Livewire.on('holiday_schedule-created', () => {
            openToast('success', 'Holiday schedule has created!')
            $('#form_modal').modal('hide');
        });

        Livewire.on('holiday_schedule-updated', () => {
            openToast('success', 'Holiday schedule has updated!')
            $('#form_modal').modal('hide');
        });

        Livewire.on('holiday_schedule-update-error', () => {
            openToast('error', 'Holiday schedule update error. Please try again!')
            $('#form_modal').modal('hide');
        });

        Livewire.on('holiday_schedule-deleted', () => {
            openToast('success', 'Holiday schedule has deleted!')
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

    function openModal(){
        Livewire.dispatch('open-create-form')
        $('#form_modal').modal('show');
    }

</script>
