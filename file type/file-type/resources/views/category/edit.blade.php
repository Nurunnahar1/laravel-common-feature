@extends('app')
@section('title','Subcategory-edit-page')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        @if (session('status'))
        <div class="bg-success text-white mb-3">
            {{ session('status') }}
        </div>

        @endif

        <div class="card p-4">
            <form action="{{ route('category.update',['category'=>$categories->id]) }}" method="POST">
                @method('put')
                @csrf



                <div class="mb-3">
                    <label for="category-name" class="form-label">Category Name</label>
                    <input value="{{ $categories->name }}" type="text" name="category_name" class="form-control @error('category_name')
                    is-invalid
                @enderror" id="">
                @error('category_name')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                </div>

                <div class="form-check mb-3">
                    <input @if ($categories->is_active)
                    checked

                    @endif type="checkbox" class="form-check-input"  name="is_active" id="isActive">
                    <label class="form-check-label" for="isActive">Active / InActive</label>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>



            </form>
        </div>
    </div>
</div>
@endsection
