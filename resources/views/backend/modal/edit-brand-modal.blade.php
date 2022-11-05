<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit Brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form  id="updateForm">
            @csrf
            <input type="hidden" value="{{ $data->id }}" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">
                        <span @class('text-danger')>*</span>
                        Category Name</label>
                    <input autofocus spellcheck="true" @class(['form-control']) type="text" 
                        name="title" value="{{ $data->title }}">
                    <span @class('text-danger') id="error"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="UpdateBrand()"  class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>