@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Update Role') }}</div>
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
            <form action="{{ route('admin.roles.update')}}" method="POST" >
                @csrf
                <input type="hidden" name="role_id" value="{{ $roleData->id }}">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="exampleFormControlInput1" value="{{old('name') ?? $roleData->name}}" placeholder="Enter Role Name">
                 @if ($errors->has('name')) <p style="color:red;">{{ $errors->first('name') }}</p> @endif
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Display Name</label>
                  <input type="text" class="form-control" name="dname" id="exampleFormControlInput1" value="{{old('dname') ?? $roleData->display_name}}" placeholder="Enter Role Display Name">
                  @if ($errors->has('dname')) <p style="color:red;">{{ $errors->first('dname') }}</p> @endif
               
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Status</label>
                  <select class="form-control" name="status">
                     <option value="1" {{ ( (old('status')  ?? $roleData->status )== "1" )?'selected':'' }}>Active</option>
                      <option value="0" {{ $roleData->status == "0" ?'selected':'' }}>Deactive</option>
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
