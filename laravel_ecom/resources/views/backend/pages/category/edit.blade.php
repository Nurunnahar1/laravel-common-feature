@extends('backend.layouts.master')
@section('title')
    Category Edit
@endsection

@push('admin_style')

@endpush

@section('admin_content')
    <div class="row">
        <h1>Category Create Form</h1>

        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="fas fa-backword"></i>Back to
                    Categories</a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('category.update',$category->slug) }}" method="post">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="category-title" class="form-label">Category Title</label>
                            <input type="text" value="{{ $category->title }}" name="title" id=""
                                class="form-control @error('title') is-invalid

                    @enderror"
                                placeholder="enter category title">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check form-switch ">
                            <input type="checkbox" class="form-check-input" name="is_active" role="switch" id="activeStatus" @if ($category->is_active) checked  @endif>
                            <label for="activeStatus" class="form-check-label">Active or Inactive</label>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>

                            @enderror
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-warning ">Store</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')

@endpush
