@extends('components.layouts.user')

@section('content')

<x-ui.cart-modal :carts="$carts" />

@endsection()

