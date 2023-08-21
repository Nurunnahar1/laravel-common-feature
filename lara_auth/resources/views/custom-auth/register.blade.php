@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row">
    <div class="col-8 m-auto">
        <div class="card rounded">
            <div class="card-title p-3">
                <h4>Registration Form</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" >
                        @error('name')
                         <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" name="phone" id="" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="" class="form-control @error('password_confirmation') is-invalid @enderror">
                        @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Register </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

   </div>
</div>


@endsection
