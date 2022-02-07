@extends('layouts.app')

@section('content')
    @foreach($discussions as $d)
        <div class="card">
            <div class="card-header">
                <img src="{{$d->user->avatar}}" alt="assem" width="70px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{$d->user->name }},<b>{{$d->created_at->diffForHumans()}}</b></span>
                <a href="{{route('discussion',['slug'=>$d->slug])}}" class="btn btn-primary float-right">View</a>

                @if ($d->hasBestAnswer())
                    <span class="btn btn-success btn-sm">Closed</span>
                @else
                    <span class="btn btn-danger btn-sm">Open</span>
                @endif
            </div>
            <div class="card-body">
                <h4 class="text-center">{{$d->title}}</h4>
                <p class="text-center">{{\Illuminate\Support\Str::limit($d->content, 30)}}</p>

            </div>
            <div class="card-footer">
                <p class="text-center">{{$d->replies->count()}} Replies</p>

            </div>
        </div>
        <br>
    @endforeach


    <div class="text-center">
        {{$discussions->onEachSide(5)->links()}}
    </div>
@endsection
