@extends('layouts.app')
@section('title')
    {{ $category->meta_title }}
@endsection
@section('meta_keyword')
    {{ $category->meta_keyword }}
@endsection

@section('meta_description')
    {{ $category->meta_description }}
@endsection


@section('content')
<livewire:frontend.product.view :category="$category" :product="$product"  />

@endsection
