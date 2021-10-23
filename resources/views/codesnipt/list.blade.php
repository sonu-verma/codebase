@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <form class="card card-sm" action="{{ url('codesnipts') }}" method="get">
                <div class="card-body row no-gutters align-items-center">
                    <div class="col-auto">
                        <i class="fas fa-search h4 text-body"></i>
                    </div>
                    <!--end of col-->
                    <div class="col">
                        <input  name="search" value="{{ request()->get('search') }}" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search topics or keywords">
                    </div>
                    <!--end of col-->
                    <div class="col-auto">
                        <button class="btn btn-lg btn-success" type="submit">Search</button>
                    </div>
                    <!--end of col-->
                </div>
            </form>
        </div>
        <!--end of col-->
    </div>
    <div id="products" class="row view-group">
        @if(isset($codesnipts) && count($codesnipts) > 0)
            @foreach($codesnipts as $codesnipt)
                <div class="item col-xs-4 col-lg-4 grid-group-item list-group-item">
                    <div class="thumbnail card">
                        <div class="caption card-body">
                            <h4 class="group card-title inner list-group-item-heading">{{ $codesnipt->title }}</h4>
                            <p class="group inner list-group-item-text">{{ $codesnipt->description }}</p>
                            <p class="group inner list-group-item-text">{!! htmlspecialchars_decode($codesnipt->code_snipt) !!}</p>
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <p class="lead">{{ date('d M Y', strtotime($codesnipt->created_at)) }} </p>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
           @endforeach 
           {{ $codesnipts->links() }}
        @else
               <h4>No Data Found.</h4>
        @endif
    </div>
</div>
@endsection