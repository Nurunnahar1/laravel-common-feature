@extends('backend.layouts.master')

@section('title')
    Category index
@endsection
@push('admin_style')
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css') }}">
    <style>
        .dataTables_length {
            padding: 20px 0;
        }
    </style>
@endpush
@section('admin_content')
    <div class="row">
        <h1>Category List Table</h1>
        <div class="col-12">
            <div class="d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    Add New Category
                </a>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive my-2">
                <table class="table table-bordered table-striped dataTables_length" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock/Alert</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
                                {{-- <td><img src="{{ $product->product_image }}" alt=""
                                        class="img-fluid rounded h-50 w-50 "></td> --}}
                                        <th><img src="{{ asset('uploads/product') }}/{{ $product->product_image }}"
                                            alt="" class="img-fluid rounded  h-100  w-50 "></th>
                                <td></td>
                                {{-- <td>{{ $product->updated_at->format('d M Y') }}</td> --}}
                                <td>{{ $product->category->title }}</td>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->product_price }}</td>
                                <td><span class="badge bg-success ">{{ $product->product_stock }}</span>/ <span class="badge bg-danger ">{{ $product->alert_quantity  }}</span></td>
                                <td>{{ $product->product_rating }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Setting
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a href="{{ route('products.edit', $product->slug) }}"
                                                    class="dropdown-item">
                                                    <i class="fas fa-edit"></i>Edit
                                                </a></li>
                                            <li>
                                                <form action="{{ route('products.destroy', $product->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item show_confirm" type="submit"> <i
                                                            class="fas fa-trash"></i>Delete</button>
                                                </form>

                                                {{-- <a href="{{ route('category.destroy',$category->slug) }}" class="dropdown-item">
                                <i class="fas fa-trash"></i>Delete
                                 </a> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection


@push('admin_script')
    <script src="{{ asset('https://code.jquery.com/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                pagingType: 'first_last_numbers',
            });

            $('.show_confirm').click(function(event) { //this line
                let form = $(this).closest('form'); //this line
                event.preventDefault(); //this line


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); //this line
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            });
        });
    </script>
@endpush
