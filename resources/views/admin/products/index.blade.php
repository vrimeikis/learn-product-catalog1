@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Products
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('admin.products.create') }}">{{ __('New') }}</a>
                    </div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
        <tr>
            <th>ID</th>
            <th>Cover</th>
            <th>Title</th>
            <th>Active</th>
            <th>Price</th>
            <th>Context</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td> {{$product->id }}</td>
                <td>@if ($product->cover)
                        <img width="100" src="{{ Storage::url($product->cover) }}">
                    @endif</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->active }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->context }}</td>
                <td>
                    <a class="btn btn-sm btn-success" href="{{ route('admin.products.edit', [$product->id]) }}">{{ __('Edit') }}</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $products->links() }}




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection