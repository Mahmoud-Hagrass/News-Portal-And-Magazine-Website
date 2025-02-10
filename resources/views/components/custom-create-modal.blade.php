<style>
    .modal-dialog {
        max-width: 450px;
        /* Set your desired width */
    }
</style>
<!-- Modal -->
<div class="modal fade" id="createNewCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="form-group">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input name="category_name" type="text" class="form-control" id="category_name"
                            placeholder="Enter Category Name" style="width:100%" value="{{ old('category_name') }}" />
                        @error('category_name')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <select name="category_status" class="form-control" id="category_status" style="width:100%" value="{{ old('category_name') }}">
                            <option selected disabled>Select Status</option>
                            <option value="1" @selected(old('category_status') == 1)  >Active</option>
                            <option value="0" @selected(old('category_status') == 0)>Not Active</option>
                        </select>
                        @error('category_status')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>