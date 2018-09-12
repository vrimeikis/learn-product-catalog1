@extends('layouts.admin')
@section('page-title', 'User List | ')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{__('Users')}}
                        <a class="btn btn-sm btn-primary float-right" href="{{ route('admin.user.create') }}">{{ __('Add User') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="table-responsive-lg">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-sm btn-success"
                                               href="{{ route('admin.user.edit', [$user->id]) }}">{{ __('Edit') }}</a>

                                            <form action="{{ route('admin.user.destroy', [$user->id]) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <input class="btn btn-sm btn-danger ml-2" type="submit" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection