@php
    $container = 'container-xxl';
    $containerNav = 'container-xxl';
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', 'Orders - Product')

@section('content')
    @livewire('orders.products.product-table', ['products' => $products])
@endsection
