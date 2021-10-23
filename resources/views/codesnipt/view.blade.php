@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('View Snipt') }}</div>

        <div class="card-body">
            <div class="jumbotron">
                <h1 class="display-4">{{ $codesnipt[0]->title }}</h1>
                <p class="lead">{{ $codesnipt[0]->description }}</p>
                <hr class="my-4">
                <p>{!! htmlspecialchars_decode($codesnipt[0]->code_snipt) !!}</p>
            </div>
        </div>
    </div>
</div>
@endsection
