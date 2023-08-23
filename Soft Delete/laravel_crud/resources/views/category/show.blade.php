@extends('app')
@section('title','Subcategory-Create-page')
@section('content')
<div class="row">
    <div class="col-8 m-auto">
        <h1>{{ $categories->name }}</h1>
        <h1>{{ $categories->created_at->format('d-m-Y H:i A') }}</h1>
    </div>
</div>
@endsection
