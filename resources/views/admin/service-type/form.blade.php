<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary-subtle ">
                <h4 class="p-1">{{ @$item->id ? 'Edit' : 'Add' }} Experience Type</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.common.alert')

                <form class="theme-form" wire:submit="store" id="item-form">
                    <div class="form-group">
                        <label class="col-form-label">Experience Type Title</label>
                        <div wire:ignore>
                            <input class="form-control" type="text" name="title" required placeholder="Enter title" wire:model="title">
                        </div>
                        @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Description</label>
                        <div wire:ignore>
                            <textarea class="form-control" name="description" placeholder="Enter description" wire:model="description"></textarea>
                        </div>
                        @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Cover Image</label>
                        <div wire:ignore>
                            <input class="form-control" id="cover_image" type="file" wire:model="cover_image">
                        </div>
                        @error('cover_image') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    @if($old_cover_image)
                        <div class="alert txt-primary border-primary alert-dismissible fade show" role="alert">
                            <img class="img-thumbnail" src="{{ asset('storage/'.$old_cover_image) }}" alt="{{ $title }}">
                            <button class="btn-close" type="button" wire:click="remove_cover_image"></button>
                        </div>
                    @endif
                    <div class="form-group mb-0">
                        <div class="text-end mt-3">
                            <button class="btn btn-primary btn-block w-100" type="submit" wire:loading.attr="disabled">
                                {{ @$item->id ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


