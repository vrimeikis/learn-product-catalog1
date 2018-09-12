@extends('layouts.admin')
@section('page-title', 'Add User | ')
@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">{{__('Add User')}}</h2>
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
                <form action="{{route('admin.user.store')}}" method="post">
                    @csrf
                    <div class="form-group">

                        <label for="name">{{__('Name:')}}</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <div class="alert-danger">{{ $errors->first('name') }}</div>
                            @endif
                    </div>
                    <div class="form-group">
                        <label for="last_name">{{__('Last Name:')}}</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" value="{{old('last_name')}}">
                        @if($errors->has('last_name'))
                            <div class="alert-danger">{{ $errors->first('last_name') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">{{__('Name:')}}</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{old('email')}}">
                        @if($errors->has('email'))
                            <div class="alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">{{__('Password')}}</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        @if($errors->has('password'))
                            <div class="alert-danger">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">{{__('Repeat Password')}}</label>
                        <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Repeat Password">
                        @if($errors->has('password_confirmation'))
                            <div class="alert-danger">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection