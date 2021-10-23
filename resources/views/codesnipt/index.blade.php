@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Code Snipts') }} <a href="{{ route('codesnipt.create') }}" class="btn btn-primary btn-sm float-right">Add Code Snipt</a></div>

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

        <table id="codesniptTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Code Snipt</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($codesnipts))
                    @foreach($codesnipts as $codesnipt)
                        <tr>
                            <td>{{ $codesnipt->title}}</td>
                            <td>{{ $codesnipt->slug}}</td>
                            <td>{{ $codesnipt->description}}</td>
                            <td>{!! htmlspecialchars_decode($codesnipt->code_snipt) !!}</td>
                            <td>{{ $codesnipt->images ?? 'No Image'}}</td>
                            <td width="16%">
                                <a href="{{ route('codesnipt.edit',$codesnipt->id) }}" class="btn btn-primary btn-sm">E</a> | 
                                
                                <a href="{{ route('codesnipt.show',$codesnipt->slug) }}" class="btn btn-primary btn-sm">V</a> |
                                <form action="{{ route('codesnipt.destroy', $codesnipt->id) }}" method="POST">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button class="btn btn-danger btn-sm" style="position: relative;left: 75px;top: -28px;">D</button>
                                </form> 
                        </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan='4'>No Data Found</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Code Snipt</th>
                    <th>Images</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
