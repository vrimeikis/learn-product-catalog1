@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="products" style="text-align:center;">
                Products
            </div>
            <div class="success" style="text-align:center; padding:10px;">
                <a class="btn btn-success" href="{{ route('admin.products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Price</th>
            <th>Context</th>
            <th>Cover</th>
            <th>Active</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td> {{$product->id }}</td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->context }}</td>
                <td>@if ($product->cover)
                        <img width="100" src="{{ Storage::url($product->cover) }}">
                    @endif</td>
                <td>{{ $product->active }}</td>


                <td>



                        <a class="btn btn-primary" href="{{ route('admin.products.edit',$product->id) }}">Edit</a>


                        @csrf





                </td>
            </tr>
        @endforeach
    </table>





@endsection