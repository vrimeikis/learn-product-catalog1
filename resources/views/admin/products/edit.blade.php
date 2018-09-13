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
                    <input type="text" name="title" value="{{ old('title', $product->title) }}" class="form-control" placeholder="title">
                </div>



                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="price">
                </div>



                <div class="form-group">
                    <strong>Context:</strong>
                    <textarea class="form-control" style="height:150px" name="context" placeholder="Context">{{ old('context', $product->context) }}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categories:</strong>
                    <br>
                    @foreach($categories as $category)
                        <label for="category_{{ $category->id }}">
                            <input id="category_{{ $category->id }}" type="checkbox" name="category[]"
                                   value="{{ $category->id }}"
                                    {{ (in_array($category->id, old('category', $product->categories->pluck('id')->toArray())) ? 'checked' : '') }}
                            > {{ $category->title }}
                        </label>
                        <br>
                    @endforeach
                </div>
            </div>



                <div class="form-group">
                    <input type="checkbox" id="active" name="active"
                           value="1" {{ old('active', $product->active)? 'checked="checked"' : '' }} />
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