@extends('fiz-placeholder.layouts.template')

@section('content')
    @if( isset($content))
        {!! $content !!}
    @endif
@endsection

@section('header-scripts')
    @if( isset($header_scripts))
        {!! $header_scripts !!}
    @endif
@endsection

@section('footer-scripts')
    @if( isset($footer_scripts))
        {!! $footer_scripts !!}
    @endif
@endsection