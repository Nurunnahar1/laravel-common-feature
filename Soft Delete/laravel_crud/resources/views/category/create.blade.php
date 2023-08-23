@extends('app')
@section('content')
    <div class="row">
        <div class="col-md-8 m-auto">
            @if (session('status'))
            <div class="bg-success text-white">
                {{ session('status') }}
            </div>

            @endif
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name</label>
                    <input name="category_name" type="text"
                        class="form-control
                     @error('category_name')
                        is-invalid
                    @enderror"
                        id="category_name" placeholder="Please provide category name" value="{{ old('category_name') }}">

                    @error('category_name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="category_slug" class="form-label">Category Slug</label>
                    <input name="category_slug" type="text"
                        class="form-control @error('category_slug')
                    is-invalid
                @enderror"
                        id="category_slug">
                    @error('category_slug')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}
                <div class="form-check">
                    <input name="is_active" class="form-check-input" type="checkbox" value="" id="is_active">
                    <label class="form-check-label" for="is_active">
                        Active/Inactive
                    </label>
                </div>
                <button type="submit" class="btn btn-danger mt-3">Submit</button>
            </form>
        </div>
    </div>
@endsection
