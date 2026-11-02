@extends('layouts.admin')

@section('title', __('ui.admin.edit_product'))
@section('heading', __('ui.admin.edit_product'))
@section('crumb', __('ui.admin.products'))

@section('content')
    @include('admin.products._form', ['product' => $product])
@endsection
