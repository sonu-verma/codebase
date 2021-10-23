@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Users') }} <a href="" class="btn btn-primary btn-sm float-right">Add Roles</a></div>

        <div class="card-body">
            <table id="userTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(session('status'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                     {{ session('status') }}
                </div>
            @endif
            @if(isset($users))
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                        @if(isset($user->roles))
                           @foreach($user->roles as $key => $role)
                              {{ $role->display_name.(count($user->roles) != ($key+1) ? ',':'' ) }}
                           @endforeach
                        @else
                           {{ __('No Roles Assign')}}
                        @endif      
                     </td>
                    <td><a href="{{ route('users.edit',$user->id) }}" class="btn btn-success btn-sm">Update</a> | <a href="" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">No data found.</td>
                </tr>
            @endif
        </tbody>
        <tfoot>
            <tr>
                 <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
        </div>
    </div>
@endsection
