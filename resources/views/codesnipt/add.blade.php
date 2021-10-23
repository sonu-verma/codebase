@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Add Code Snipt') }} <a href="" class="btn btn-primary btn-sm float-right">Add Snipt</a></div>
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
          <form action="{{ route('codesnipt.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="Enter snipt title">
                 @if ($errors->has('title')) <p style="color:red;">{{ $errors->first('title') }}</p> @endif
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" name="description" id="description" value="{{ old('description') }}"  placeholder="Enter snipt description"></textarea>
                  @if ($errors->has('description')) <p style="color:red;">{{ $errors->first('description') }}</p> @endif
               
                </div>
                <div class="mb-3">
                    <label for="code_snipt" class="form-label">Description</label>
                    <textarea name="code_snipt"  id="code_snipt" value="{{ old('code_snipt') }}"  class="codesniptTextArea form-contol" style="width: 800px; height: 200px"  placeholder="Enter code snipt here..."></textarea>
                    @if ($errors->has('code_snipt')) <p style="color:red;">{{ $errors->first('code_snipt') }}</p> @endif
               
                </div>  
                <div class="mb-3">
                  <input type="submit" value="Save" class="btn btn-success btn-lg">
                  <a href="{{ route('codesnipt.index' )}}" class="btn btn-primary btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
