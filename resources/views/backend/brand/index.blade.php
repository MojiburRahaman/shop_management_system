@extends('backend.master')
@section('title','Brand')

@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Brand</h1>
<div class="text-right mb-2">

    <a href="" class="btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Add Brand</span>

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
                                    <th>Title</th>
                                    <th>Total Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($brands as $brand)
                                <tr id="row{{ $brand->id }}">
                                    <td class="sorting_1">{{ $loop->index+1 }}</td>
                                    <td>{{ $brand->title }}</td>
                                    <td> {{ $brand->product_count }}</td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="EditBrand({{$brand->id}})"
                                            class="btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        &nbsp;
                                        <a href="javascript:void(0)" onclick="DeleteBrand({{$brand->id}})"
                                            class="btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="10">
                                        No Brand
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="" id="categoryAdd">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">
                            <span @class('text-danger')>*</span>
                            Category Name</label>
                        <input autofocus spellcheck="true" @class(['form-control']) type="text" title="Brand Name"
                            placeholder="Brand Name" name="title">
                        <span @class('text-danger') id="error_title"></span>
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
    function UpdateBrand(){
        axios.put("{{ route('brand.update','id') }}", $('#updateForm').serialize())
            .then(function (response) {
                $('#Modal').modal('hide');
                $("#myTable").load(location.href +" #myTable");
                $('#error').html('');
                Command: toastr["success"](response.data.success);
                    })
                    .catch(function (error) {
                    $('#error').html(error.response.data.errors.title);

                    });
    }
                
function DeleteBrand(id){
           var id = id;
               axios.delete("brand/"+id+"")
        .then(function (response) {
            $('#row'+id).remove();
            Command: toastr["error"](response.data.success);
        })
        .catch(function (error) {
                    Command: toastr["error"]('Not Found');
                });
                    }
                
function EditBrand(id){
           var id = id;
               axios.get("brand/"+id+"/edit")
        .then(function (response) {

            $('#Modal').html(response.data.html);
            $('#Modal').modal('show');
            
                })
                .catch(function (error) {
                    $('#error_title').html(error.response.data.errors.title);
                });
                    }






    $('#categoryAdd').submit(function(e){
        e.preventDefault();
        var form = $(this);
        axios.post("{{ route('brand.store') }}", form.serialize())
        .then(function (response) {
            if (response.data.success) {
                $('#exampleModalCenter').modal('hide');
                $("#myTable").load(location.href +" #myTable");
                $('#error_title').html('');
                Command: toastr["success"](response.data.success);

                    }
                })
                .catch(function (error) {
                    $('#error_title').html(error.response.data.errors.title);
                });

});
</script>
@endsection