@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 m-auto">
            <div class="card m-3">
                <div class="card-title m-3">Login Form</div>
                <div class="card-body">
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
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
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input name="rememberme" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Remember me
                            </label>
                          </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Login </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
