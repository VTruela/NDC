@extends('layouts.admin')

@section('title', __('ui.admin.new_product'))
@section('heading', __('ui.admin.new_product'))
@section('crumb', __('ui.admin.products'))

@section('content')
    @include('admin.products._form', ['product' => null])
@endsection
