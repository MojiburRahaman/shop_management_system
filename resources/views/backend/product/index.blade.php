@extends('backend.master')
@section('title','Product')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Product</h1>
<div class="text-right mb-2">

    <a href="" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add Product</span>

    </a>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4" id="">
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row ">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable cat_all" id="myTable" role="grid"
                            aria-describedby="dataTable_info" style="width: 100%;" width="100%" cellspacing="0">
                            <thead>
                                <tr role="row">
                                    <th>SL</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>SKU No</th>
                                    <th>Purchase Price</th>
                                    <th>Sale Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr id="row{{ $product->id }}">
                                    <td class="sorting_1">{{ $loop->index+1 }}</td>
                                    <td><img width="60" src="{{ asset('storage/thumbnail/'.$product->thumbnail) }}" alt=""> </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->sku_no }}</td>
                                    <td>{{ $product->purchase_rate }}</td>
                                    <td>{{ $product->sale_rate }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="EditPRoduct({{$product->id}})"
                                            class="btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        &nbsp;
                                        <a href="javascript:void(0)" onclick="DeleteCategory({{$product->id}})"
                                            class="btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="10">
                                        No Product
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="upload_form" @class(["user"]) method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">
                                    <span @class('text-danger')>*</span>
                                    Product Title</label>
                                <input autofocus spellcheck="true" @class(['form-control']) type="text"
                                    title="Product Title" title="Product Title" placeholder="Product Title"
                                    name="title">
                                <span @class(['text-danger','error_msg']) id="error_title"></span>
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
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @empty

                                    @endforelse
                                </select>
                                <span @class(['text-danger','error_msg']) id="error_cat"></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="brand_id">
                                    Brand</label>
                                <select @class(['form-control']) name="brand_id" id="brand_id">
                                    <option value>-- Select Brand --</option>
                                    @forelse ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                    @empty

                                    @endforelse
                                </select>
                                <span @class(['text-danger','error_msg']) id="error_brand"></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="title">
                                    Bar Code</label>
                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                            <path
                                                d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z">
                                            </path>
                                        </svg>
                                    </span>
                                    <input @class(['form-control',]) type="text" title="Product Bar Code"
                                        placeholder="Product Bar Code" name="barcode">
                                </div>

                                <span @class(['text-danger','error_msg']) id="error_barcode"></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="barcode">
                                    SKU No</label>
                                <input @class(['form-control',]) type="text" title="Product Bar Code" id="barcode"
                                    placeholder="Sku No" name="sku_no">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="purchase_rate">
                                    Purchase Rate</label>
                                <input @class(['form-control',]) type="text" title="Product Purchase Rate"
                                    id="purchase_rate" placeholder="Purchase Rate" name="purchase_rate">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="sale_rate">
                                    Sale Rate</label>
                                <input @class(['form-control',]) type="text" title="Product Sale Rate" id="sale_rate"
                                    placeholder="Purchase Rate" name="sale_rate">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="stock">
                                    Stock</label>
                                <input @class(['form-control',]) type="text" title="Stock" id="stock"
                                    placeholder="Stock" name="stock">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="file">
                                    Thumbnail Image</label>
                                <div class="input-group">

                                    <span class="input-group-text" id="basic-addon1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('css')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
@endsection
@section('script_js')


<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>

<script>
function DeleteCategory(id){
           var id = id;
               axios.delete("product/"+id+"")
        .then(function (response) {
            $('#row'+id).remove();
            Command: toastr["error"](response.data.success);
        })
        .catch(function (error) {
                    Command: toastr["error"]('Not Found');
                });
                    }
                
function EditPRoduct(id){
           var id = id;
               axios.get("product/"+id+"/edit")
        .then(function (response) {

            $('#Modal').html(response.data.html);
            $('#Modal').modal('show');
            
                })
                .catch(function (error) {
                    $('#error_title').html(error.response.data.errors.title);
                });
                    }

$(document).ready(function(){

$('#upload_form').on('submit', function(event){
 event.preventDefault();
 axios.post("{{ route('product.store') }}", new FormData(this))
            .then(function (response) {
                Command: toastr["success"](response.data.success);
                $("#myTable").load(location.href +" #myTable");
                $('#exampleModalCenter').modal('hide');
                $('.error_msg').html('');
            })
            .catch(function (error) {
                        $('.error_msg').html('');
                        $('#error_title').html(error.response.data.errors.title);
                        $('#error_cat').html(error.response.data.errors.category_id);
                        $('#error_brand').html(error.response.data.errors.brand_id);
                    });
});

});
</script>
@endsection