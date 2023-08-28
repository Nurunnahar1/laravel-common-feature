@extends('app')
@section('title','Product-Create-page')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <div class="card">
            <div class="card-title">
                <h4>Product List</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="formm-label">Seclect Category Name</label>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected>Seclect a category</option>
                            @foreach ($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach


                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="formm-label">Seclect SubCategory Name</label>
                        <select class="form-select" aria-label="Default select example" name="subcategory_id">
                            <option selected>Seclect a subcategory</option>
                            @foreach ($subcategories as $subcategory)
                                 <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach

                          </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="text" name="name" id="" class="forn-control">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Price</label>
                        <input type="number" name="price" id="" class="forn-control" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Product Image</label>
                         <input type="file" name="image" id="formFile" class="form-control" >
                    </div>
                    <div class="mb-3">
                      <button type="submit" class="btn btn-primary ">Add New Product</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>


@endsection
