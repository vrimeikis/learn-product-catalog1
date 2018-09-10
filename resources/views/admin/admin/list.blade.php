@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif



                            {{ csrf_field() }}
                        <h2>Product List</h2>
                          <table>
                              <tr>
                              <th>Title</th>
                              <th>Price</th>
                              <th>Context</th>
                              <th>Cover</th>
                              <th>Slug</th>

                          </tr>
                              <hr>
                              <th>Pira</th>
                              <th>20.50$</th>
                              <th>Textas</th>
                              <th>Paveiksliukas.png</th>
                              <th>pira</th>
                          </table>




                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
th{
    padding:20px;
}
</style>