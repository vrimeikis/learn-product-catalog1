@extends('layouts.admin')

@section('page-title', 'Add New Product | ')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2 class="text-center">Add New Product</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <strong>Title:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <strong>Price:</strong>
                        <input type="text" name="price" class="form-control" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <strong>Context:</strong>
                        <textarea class="form-control" style="height:150px" name="context" placeholder="context"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" name="cover"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="active" name="active"
                               value="active"/>
                        <label for="active">{{__('Active?')}}</label>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </form>
            </div>
        </div> <!-- ./row -->

        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        <img src="images/{{ Session::get('image') }}">
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- ./row -->

    </div>
@endsection