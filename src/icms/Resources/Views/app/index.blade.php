@extends('layouts.base.web')

@set('hide_breadcrumb', true)

@section('over.content')
@include('layouts.web.carousel')
@include('layouts.web.vision')
@include('layouts.web.testimonial')
@endsection