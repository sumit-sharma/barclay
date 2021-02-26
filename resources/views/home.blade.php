@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>User Listing</h3>
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            @forelse ($users as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="2">No User Available</td>
                            </tr>
                            @endforelse
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
