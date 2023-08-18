@extends('app')
@section('title','category-index-page')
@section('content')
    <div class="row">
        <div class="d-flex justify-content-end">
            <a href="{{ route('category.create') }}" class="btn btn-success my-4">Create category</a>
        </div>

        <div class="col-8 m-auto">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Category Name</th>

                    <th scope="col">Created Time</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category )
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        {{-- <td>{{ $subcategory->category_id }}</td> --}}
                        <td>{{ $category->name }}</td>

                        <td>{{ $category->created_at  }}</td>
                        <td>
                            <a href="{{ route('category.edit',['category'=>$category->id]) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('category.destroy',['category'=>$category->id]) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button   type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        </td>
                      </tr>
                    @endforeach



                </tbody>
              </table>

        </div>
    </div>
@endsection
