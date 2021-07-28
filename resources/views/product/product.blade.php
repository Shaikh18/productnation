@extends('layouts.auth')

@section('content')

<div class="page-wrapper">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                    Overview
                    </div>
                    <h2 class="page-title">
                    Products
                    </h2>
                </div>
              <!-- Page title actions -->
              <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                  <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Create new product
                  </a>
                </div>
              </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div id="update_create_alert" class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <div class="py-4">

            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Invoices</h3>
                </div>
                <div class="card-body border-bottom py-3">
                  <div class="d-flex">
                    <div class="text-muted">
                      Show
                      <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" id="filter1" value="8" size="3" aria-label="Invoices count">
                      </div>
                      entries
                    </div>
                    <div class="ms-auto text-muted">
                      Search:
                      <div class="ms-2 d-inline-block">
                        <input id="myInput" class="form-control form-control-sm" type="text">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table id="product_table" class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                      <tr>
                        <th>Product Picture</th>
                        <th>Product Name</th>
                        <th>Product Company Name</th>
                        <th>product Price</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($products as $product)
                        <tr>
                            <td style="width: 20%">
                                {{-- <img  src="<?php echo asset("storage/$product->product_img")?>" style="width:50%;"> --}}
                                <img  src="<?php echo asset("storage/$product->product_img")?>" style="width:50%;">
                            </td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_c_name}}</td>
                            <td>{{$product->product_price}}$</td>
                            <td class="text-end">
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item btn_edit_product" href="javascript:void(0)" data-id="{{$product->id}}">
                                        Edit
                                    </a>
                                    <a  href="javascript:void(0)" class="dropdown-item del_hidden_id" data-id="{{$product->id}}">
                                        Delete
                                    </a>
                                    </div>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                  <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                  <ul class="pagination m-0 ms-auto">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                        <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
                        prev
                      </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">
                        next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg>
                      </a>
                    </li>
                  </ul>
                </div>
            </div>

        </div>

    </div>

    {{-- modal --}}
    <div class="modal modal-blur fade show" id="modal-report" tabindex="-1" style="padding-right: 6px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Create New product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('product_index') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Product Picture</label>
                            <input type="file" class="form-control" id="file" name="product_img" placeholder="Your Product Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Your Product Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Company Name</label>
                            <input type="text" class="form-control" id="product_c_name" name="product_c_name" placeholder="Your Product Company Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Price</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Your Product Price" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" id="but_upload" class="btn btn-primary ms-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Create new product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div class="modal modal-blur fade show" id="modal-edit" tabindex="-1" style="padding-right: 6px;" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('product_update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="hidden" id="product_id" name="hidden" value="{{$product->id}}">
                        <div class="mb-3">
                            <label class="form-label">Product Picture</label>
                            <img  class="preview_product_img" src="<?php echo asset("storage/$product->product_img")?>" style="width:30%;margin-bottom:1%;">
                            <input type="file" class="form-control" id="file" name="product_img" placeholder="Your Product Name" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control product_name" id="product_name" name="product_name" placeholder="Your Product Name" value="{{$product->product_name}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Company Name</label>
                            <input type="text" class="form-control product_c_name" id="product_c_name" name="product_c_name" placeholder="Your Product Company Name" value="{{$product->product_c_name}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Price</label>
                            <input type="text" class="form-control product_price" id="product_price" name="product_price" placeholder="Your Product Price" value="{{$product->product_price}}$">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button type="submit" id="but_upload" class="btn btn-primary ms-auto">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            Update product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){

            $('#product_table').pagination({
                dataSource: [1, 2, 3, 4, 5, 6, 7, ... , 195],
                callback: function(data, pagination) {
                    // template method of yourself
                    var html = template(data);
                    dataContainer.html(html);
                }
            });
            // search bar
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // create update delete alert
            setTimeout(function(){$('#update_create_alert').fadeOut('slow');}, 3000);


            $('.btn_edit_product').on('click', function(){
                var id = $(this).data('id');

                $.ajax({
                    url: `<?php echo(route('product_find')); ?>`,
                    async: false,
                    data: {id: id},
                    success: function(data){
                        var product = data;

                        $('.hidden').val(product.id);
                        $('.preview_product_img').attr('src', `{{asset("storage/`+product.product_img+`")}}`);
                        $('.product_name').val(product.product_name);
                        $('.product_c_name').val(product.product_c_name);
                        $('.product_price').val(product.product_price);

                        $('#modal-edit').modal('show');
                    }
                });

            });

            $('.del_hidden_id').on('click', function(){
                var id = $(this).data('id');

                $.ajax({
                    url: `<?php echo(route('product_del')); ?>`,
                    async: false,
                    data: {id: id},
                    success: function(data){
                        console.log('del id');
                    }
                });

            });
        });
    </script>
@endsection
