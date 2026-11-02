@extends('layouts.admin')

@section('title', __('ui.admin.edit_category'))
@section('heading', __('ui.admin.edit_category'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    @include('admin.categories._form', ['category' => $category, 'themes' => $themes])
@endsection
