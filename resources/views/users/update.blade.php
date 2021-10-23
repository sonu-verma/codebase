@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Update User') }}</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert">×</button>
              {{ session('status') }}
            </div>
            @elseif(session('failed'))
            <div class="alert alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert">×</button>
              {{ session('failed') }}
            </div>
          @endif
            <form action="{{ route('users.update',$user->id)}}" method="POST" >
                @method('put')

                @csrf
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="{{old('name') ?? $user->name}}" placeholder="Enter Role Name" disabled>
                 @if ($errors->has('name')) <p style="color:red;">{{ $errors->first('name') }}</p> @endif
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Display Name</label>
                  <input type="text" class="form-control" name="email" id="exampleFormControlInput1" value="{{old('email') ?? $user->email}}" placeholder="Enter Role Display Name" disabled>
                  @if ($errors->has('email')) <p style="color:red;">{{ $errors->first('email') }}</p> @endif
               
                </div>

                <div class="md-3">
                  <label>Select Roles</label>
                  <select class="form-select form-control" multiple aria-label="multiple select example" name="roles[]">
                    @if(isset($roles))
                        @foreach($roles as $role)
                              <option value="{{ $role->id }}" {{ check_value_in_associated_array($user->roles,$role->id)?'selected': '' }}>{{ $role->display_name }}</option>
                        @endforeach
                    @endif
                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                  <select class="form-control" name="status">
                     <option value="1" {{ ( (old('status')  ?? $user->status )== "1" )?'selected':'' }}>Active</option>
                      <option value="0" {{ $user->status == "0" ?'selected':'' }}>Deactive</option>
                  </select>
                  @if ($errors->has('status')) <p style="color:red;">{{ $errors->first('status') }}</p> @endif
               
                </div>
                <div class="mb-3">
                  <input type="submit" value="Save" class="btn btn-success btn-lg">
                  <a href="{{ route('admin.roles' )}}" class="btn btn-primary btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
