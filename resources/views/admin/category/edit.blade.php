@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit category
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.category.update', [$category->id]) }}" method="post" enctype="multipart/form-data">

                            {{ (method_field('put')) }}

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">{{ __('Title') }}:</label>
                                <input id="title" class="form-control" type="text" name="title"
                                       value="{{ old('title', $category->title) }}">
                                @if($errors->has('title'))
                                    <div class="alert-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="cover">{{ __('Cover') }}</label>
                                @if ($category->cover)
                                    <br>
                                    <img width="200" src="{{ Storage::url($category->cover) }}">
                                @endif
                                <input id="cover" class="form-control" type="file" name="cover" accept=".jpg, .jpeg, .png">
                                @if($errors->has('cover'))
                                    <div class="alert-danger">{{ $errors->first('cover') }}</div>
                                @endif
                            </div>

                            <div class="form_group">
                                <label>{{ __('Active') }}</label>
                                <br>
                                <label for="active">
                                    <input id="active" type="checkbox" name="active" value="1"
                                            {{ old('active', $category->active) ? 'checked' : '' }}
                                    > {{ __('Check if active') }}
                                </label>
                                @if($errors->has('active'))
                                    <div class="alert-danger">{{ $errors->first('active') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
                            </div>

                            <a class="btn btn-primary" href="javascript:history.back();">{{__('Back')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection