@extends('layouts.admin')

@section('title', __('ui.admin.new_category'))
@section('heading', __('ui.admin.new_category'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    @include('admin.categories._form', ['category' => null, 'themes' => $themes])
@endsection
