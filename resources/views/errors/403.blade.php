@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', 'putang ina mo')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
