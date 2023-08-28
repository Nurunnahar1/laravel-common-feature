@extends('app')
@section('title','Subcategory-edit-page')



@section('content')
    <div class="row">

        <div class="col-md-8 my-3 m-auto">
            @if (session('status'))
            <div class="bg-success text-white mb-3">
                {{ session('status') }}
            </div>

            @endif
            <div class="card p-4">

                <form action="{{ route('subcategory.update',['subcategory'=>$subcategory->id]) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <select class="form-select" name="category_id">
                            <option  >Open this select menu</option>
                            @foreach ($categories as $category)
                                 <option value="{{ $category->id }}"
                                    @if ($category->id==$subcategory->category_id)
                                    selected
                                    @endif
                                    >{{ $category->name }}</option>
                            @endforeach


                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="subcategory-name" class="form-label">SubCategory Name</label>
                        <input value="{{ $subcategory->name }}" type="text" name="subcategory_name" class="form-control @error('subcategory_name')
                        is-invalid
                    @enderror" id="">
                    @error('subcategory_name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input @if ($subcategory->is_active)
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
