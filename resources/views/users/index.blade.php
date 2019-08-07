
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Following -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    All Users
                </div>

                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Action</td>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@foreach ($user->roles as $role)
                                    {{ $role->name }}
                                  @endforeach
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
