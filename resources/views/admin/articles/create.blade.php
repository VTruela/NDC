@extends('layouts.admin')

@section('title', __('ui.admin.new_article'))
@section('heading', __('ui.admin.new_article'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    @include('admin.articles._form', ['article' => null])
@endsection
