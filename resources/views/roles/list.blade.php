@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Roles') }} <a href="{{ route('admin.roles.add') }}" class="btn btn-primary btn-sm float-right">Add Roles</a></div>

        <div class="card-body">
            <table id="rolesTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Display Name</th>
                <th>Status</th>
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
            @if(isset($roles))
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td><a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-success btn-sm">Update</a> | <a href="{{ url('admin/roles/delete',['id' => $role->id]) }}" class="btn btn-danger btn-sm">Delete</a></td>
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
                <th>Display Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
        </div>
    </div>
@endsection
