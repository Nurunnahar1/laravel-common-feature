@extends('app')
@section('title','Subcategory-Create-page')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <h1>{{ $subcategory->name }}</h1>
        <h3>{{ $subcategory->category->name }}</h3>
        <p>{{ $subcategory->created_at->format('d-m-Y D H:i A') }}</p>

    </div>
</div>
@endsection
