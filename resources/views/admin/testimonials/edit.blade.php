@extends('layouts.admin')

@section('title', __('ui.admin.edit_testimonial'))
@section('heading', __('ui.admin.edit_testimonial'))
@section('crumb', __('ui.admin.menu_content'))

@section('content')
    @include('admin.testimonials._form', ['testimonial' => $testimonial])
@endsection
