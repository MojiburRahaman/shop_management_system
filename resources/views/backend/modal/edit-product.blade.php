<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="update_form" method="POST" @class(["user"]) enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" value="{{ $product->id }}" name="id">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="title">
                                <span @class('text-danger')>*</span>
                                Product Title</label>
                            <input autofocus spellcheck="true" @class(['form-control']) type="text"
                                title="Product Title" title="Product Title" placeholder="Product Title"
                                value="{{ $product->title }}" name="title">
                            <span @class(['text-danger','error1_msg']) id="error1_title"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="Category">
                                <span @class('text-danger')>*</span>
                                Category </label>
                            <select @class(['form-control']) name="category_id" id="Category">
                                <option value>-- Select Category --</option>
                                @forelse ($categories as $category)
                                <option {{ ($product->category_id == $category->id)? 'selected' : '' }} value="{{
                                    $category->id }}">{{ $category->title }}</option>
                                @empty

                                @endforelse
                            </select>
                            <span @class(['text-danger','error1_msg']) id="error1_cat"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="brand_id">
                                Brand</label>
                            <select @class(['form-control']) name="brand_id" id="brand_id">
                                <option value>-- Select Brand --</option>
                                @forelse ($brands as $brand)
                                <option {{ ($product->brand_id == $brand->id)? 'selected' : '' }} value="{{ $brand->id
                                    }}">{{ $brand->title }}</option>
                                @empty

                                @endforelse
                            </select>
                            <span @class(['text-danger','error1_msg']) id="error1_brand"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="sku_no">
                                <span @class('text-danger')>*</span>
                                SKU No</label>
                            <input @class(['form-control',]) type="text" title="Sku NO " id="sku_no"
                                value="{{ $product->sku_no }}" placeholder="Sku No" name="sku_no">
                                <span @class(['text-danger','error1_msg'])  id="error1_sku"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="purchase_rate">
                                Purchase Rate</label>
                            <input @class(['form-control',]) type="text" title="Product Purchase Rate"
                                value="{{ $product->purchase_rate }}" id="purchase_rate" placeholder="Purchase Rate"
                                name="purchase_rate">
                                <span @class(['text-danger','error_msg'])  id="error1_purchase"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="sale_rate">
                                Sale Rate</label>
                            <input @class(['form-control',]) type="text" title="Product Sale Rate" id="sale_rate"
                                value="{{ $product->sale_rate }}" placeholder="Purchase Rate" name="sale_rate">
                                <span @class(['text-danger','error_msg'])  id="error1_sale"></span>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="stock">
                                Stock</label>
                            <input @class(['form-control',]) type="text" title="Stock" id="stock"
                                value="{{ $product->stock }}" placeholder="Stock" name="stock">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="file">
                                Thumbnail Image</label>
                            <div class="input-group">

                                <span class="input-group-text" id="basic-addon1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
                                        <path
                                            d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z">
                                        </path>
                                    </svg>
                                </span>
                                <input @class(['form-control',]) type="file" title="Thumbnail Image" id="file"
                                    name="thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<script>
    $('#update_form').on('submit', function(event){
 event.preventDefault();
        axios.post("{{ route('product.update','id') }}", new FormData(this))
            .then(function (response) {
                $('#Modal').modal('hide');
                $("#myTable").load(location.href +" #myTable");
                $('#error').html('');
                Command: toastr["success"](response.data.success);
                    })
                    .catch(function (error) {
                        $('.error1_msg').html('');
                        $('#error1_title').html(error.response.data.errors.title);
                        $('#error1_sku').html(error.response.data.errors.sku_no);
                        $('#error1_cat').html(error.response.data.errors.category_id);
                        $('#error1_brand').html(error.response.data.errors.brand_id);
                        $('#error1_purchase').html(error.response.data.errors.purchase_rate);
                        $('#error1_sale').html(error.response.data.errors.sale_rate);
                    });
    });
</script>