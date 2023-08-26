@extends('app')
@section('title', 'Subcategory-index-page')
@section('content')
    <div class="row">
        <div class="d-flex justify-content-end">
            <a href="{{ route('subcategory.create') }}" class="btn btn-success my-4">Create SubCategory</a>
        </div>

        <div class="col-8 m-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">SubCategory Name</th>
                        <th scope="col">Created Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <th scope="row">{{ $subcategory->id }}</th>
                            {{-- <td>{{ $subcategory->category_id }}</td> --}}
                            <td>{{ $subcategory->category->name }}</td>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('subcategory.edit', ['subcategory' => $subcategory->id]) }}"
                                        class="btn btn-info">Edit</a>
                                    <form action="{{ route('subcategory.destroy', ['subcategory' => $subcategory->id]) }}"
                                        method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>

        </div>
    </div>
    <div class="row mt-5">


        <div class="col-8 m-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">SubCategory Name</th>
                        <th scope="col">Created Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($delCategories as $subcategory)
                        <tr>
                            <th scope="row">{{ $subcategory->id }}</th>
                            {{-- <td>{{ $subcategory->category_id }}</td> --}}
                            <td>{{ $subcategory->category->name }}</td>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->created_at->diffForHumans() }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('subcategory.restore', ['subcategory_id' => $subcategory->id]) }}"
                                        class="btn btn-info">Restore</a>

                                    {{-- <a href="{{ route('category.restore', ['category_id' => $category->id]) }}"
                                class="btn btn-info">Restore</a> --}}


                                    <form
                                        action="{{ route('subcategory.forceDelete', ['subcategory_id' => $subcategory->id]) }}"
                                        method="POST">

                                        @csrf
                                        <button type="submit" class="btn btn-danger">Force Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach



                </tbody>
            </table>

        </div>
    </div>
@endsection
