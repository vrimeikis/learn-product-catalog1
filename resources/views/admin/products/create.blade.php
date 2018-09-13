@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        New Product
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" class="form-control" placeholder="Price">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Context:</strong>
                    <textarea class="form-control" style="height:150px" name="context" placeholder="context"></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <input type="file" class="form-control" name="cover"/>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <input type="checkbox" id="active" name="active"
                           value="active" />
                    <label for="active">Active?</label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
                <a class="btn btn-secondary pull-right" href="javascript:history.back();">Cancel</a>
            </div>
        </div>


    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection