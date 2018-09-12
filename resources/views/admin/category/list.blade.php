@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Categories
                        <a class="btn btn-sm btn-primary float-right" href="{{ route('admin.category.create') }}">{{ __('Add Category') }}</a>
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
                                <th>Slug</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>@if ($category->cover)
                                            <img width="100" src="{{ Storage::url($category->cover) }}">
                                        @endif</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <label for="active">
                                            <input id="active" type="checkbox" name="active" value="1"
                                                    {{ old('active', $category->active) ? 'checked' : '' }} disabled
                                            >
                                        </label>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('admin.category.edit', [$category->id]) }}">{{ __('Edit') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                            {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection