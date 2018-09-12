@extends('layouts.admin')
@section('page-title', 'Edit User | ')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Edit User')}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.user.update', [$user->id]) }}" method="post">

                            {{ method_field('put') }}

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">{{ __('Name') }}:</label>
                                <input id="name" class="form-control" type="text" name="name"
                                       value="{{ old('name', $user->name) }}">
                                @if($errors->has('name'))
                                    <div class="alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="last_name">{{ __('Last Name') }}:</label>
                                <input id="last_name" class="form-control" type="text" name="last_name"
                                       value="{{ old('last_name', $user->last_name) }}">
                                @if($errors->has('last_name'))
                                    <div class="alert-danger">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}:</label>
                                <input id="email" class="form-control" type="email" name="email"
                                       value="{{ old('email', $user->email) }}">
                                @if($errors->has('email'))
                                    <div class="alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                @if($errors->has('password'))
                                    <div class="alert-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Repeat Password">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
                                <a class="btn btn-primary" href="{{route('admin.user.index')}}">{{__("Back")}}</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection