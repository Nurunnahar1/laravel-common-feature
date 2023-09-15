@extends('backend.layouts.master')
@section('title')
    Coupon Create
@endsection

@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('admin_content')
    <div class="row">
        <h1>Coupon Create Form</h1>

        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('cupon.index') }}" class="btn btn-primary"><i class="fas fa-backword"></i>Back to products</a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('cupon.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 mb-3">
                            <label for="coupon_name" class="form-label">Coupon Name</label>
                            <input type="text" name="coupon_name" class="form-control" id="coupon_name">
                            @error('coupon_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>

                            @enderror
                        </div>
                        <div class="col-12 mb-3">
                            <label for="discount_amount" class="form-label">Discount Percentage</label>
                            <input type="number" min="0" name="discount_amount" class="form-control" id="discount_amount">
                            @error('discount_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>

                            @enderror
                        </div>

                        <div class="col-6 mb-3">
                            <label for="minimum_purchase_amount" class="form-label">Minimum Purchase Amount</label>
                            <input type="number" name="minimum_purchase_amount" min="0" class="form-control @error('minimum_purchase_amount') is-invalid   @enderror" id="minimum_purchase_amount">
                            @error('minimum_purchase_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>

                        @enderror
                        </div>

                        <div class="col-6 mb-3">
                            <label for="validity_till" class="form-label">Espiry Date</label>
                            <input type="date" name="validity_till" class="form-control @error('validity_till') is-invalid   @enderror" id="validity_till" placeholder="enter a unique product code">
                            @error('validity_till')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>

                        @enderror
                        </div>


                        <div class="col-6 mb-3 form-check  form-switch ">
                            <input type="checkbox" class="form-check-input" name="is_active" role="switch" id="is_active" checked>
                            <label for="is_active" class="form-check-label">Active or Inactive</label>
                            @error('is_active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>

                            @enderror
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-success ">Store</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.dropify').dropify();
</script>
@endpush
