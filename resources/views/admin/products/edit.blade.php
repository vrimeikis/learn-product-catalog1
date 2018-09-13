@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit product
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

    <form action="{{ route('admin.products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')



                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" value="{{ $product->title }}" class="form-control" placeholder="title">
                </div>



                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="name" value="{{ $product->price }}" class="form-control" placeholder="price">
                </div>



                <div class="form-group">
                    <strong>Context:</strong>
                    <textarea class="form-control" style="height:150px" name="context" placeholder="Context">{{ $product->context }}</textarea>
                </div>



                <div class="form-group">
                    <input type="checkbox" id="active" name="active"
                           value={{ $product->active }} />
                    <label for="active">Active?</label>
                </div>



        <div class="form-group">
            <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
            <a class="btn btn-secondary pull-right" href="javascript:history.back();">Cancel</a>

        </div>

    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection