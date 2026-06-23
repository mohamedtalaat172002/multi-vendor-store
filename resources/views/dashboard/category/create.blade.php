@extends('adminlte::page');

@section('title', 'Add New Category')

@section('content')

    @include('dashboard.category._form', [
        'category' => $category,
        'parents' => $parents
    ])
@endsection