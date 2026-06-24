@extends('adminlte::page')
@section('content')

    @include(
        'dashboard.category._form',
        [
            'category' => $category,
            'parents' => $parents
        ]
    )
@endsection