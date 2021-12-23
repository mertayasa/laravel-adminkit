@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@section('image')
    <img src="{{ asset('default/403.svg') }}" style="width:70%" alt="">
@endsection