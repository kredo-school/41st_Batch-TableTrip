<div class="modal fade" id="editMenuModal-{{ $menu->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 pb-4 pt-2">
                <h3 class="text-center mb-4"
                    id="editMenuModalLabel"
                    style="text-decoration: underline; text-underline-offset: 6px; text-decoration-color:#D96B52;">
                    Edit Menu
                </h3>

                <form action="{{ route('owner.page-management.updateMenu', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="text-center mb-3 justify-content-center">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="edit-menu-image rounded">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" alt="No image" class="menu-image rounded">
                        @endif    
                    </div>

                    <div class="row align-items-end mb-3">
                        <div class="col-md-4">
                            <label for="edit_menu_price" class="form-label mb-1 @error('price') is-invalid @enderror">Price *</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" id="edit_menu_price" name="price" value="{{ old('price', $menu->price) }}">
                            </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="edit_menu_photo" class="form-label mb-1 @error('image') is-invalid @enderror">Change Photo</label>
                            <input type="file" class="form-control" id="edit_menu_photo" name="image">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <button type="button" class="btn btn-navy w-100">Upload</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="edit_menu_name" class="form-label mb-1">Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="edit_menu_name" name="name"
                            value="{{ old('name', $menu->name) }}" placeholder="name of menu">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" class="btn btn-outline-orange px-4" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-navy px-5">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>