@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <img src="{{$d->user->avatar}}" alt="assem" width="70px" height="40px">&nbsp;&nbsp;&nbsp;
            <span>{{$d->user->name }} <b>({{$d->user->points}})</b></span>
            @if ($d->hasBestAnswer())
                <span class="btn btn-success btn-sm">Closed</span>
            @else
                <span class="btn btn-danger btn-sm">Open</span>
            @endif

            @if(\Illuminate\Support\Facades\Auth::id() == $d->user->id)
                @if(!$d->hasBestAnswer())
                    <a href="{{ route('discussion.edit', ['slug' => $d->slug ]) }}"
                       class="btn btn-info btn-xs float-right"
                       style="margin-right: 8px;">Edit</a>
                @endif
            @endif

            @if($d->is_being_watched_by_auth_user())
                <a href="{{ route('discussion.unwatch', ['id' => $d->id ]) }}"
                   class="btn btn-primary btn-xs float-right" style="margin-right: 8px;">unwatch</a>
            @else
                <a href="{{ route('discussion.watch', ['id' => $d->id ]) }}" class="btn btn-primary btn-xs float-right"
                   style="margin-right: 8px;">watch</a>
            @endif
        </div>
        <div class="card-body">
            <h4 class="text-center">{{$d->title}}</h4>
            <hr>
            <p class="text-center">{!! Markdown::convertToHtml($d->content) !!}</p>
            <hr>
            @if ($best_answer)
                <div class="text-center">
                    <h3>BEST ANSWER</h3>
                    <div class="card badge-success">
                        <div class="card-header">
                            <img src="{{$best_answer->user->avatar}}" alt="assem" width="70px" height="40px">&nbsp;&nbsp;&nbsp;
                            <span>{{$best_answer->user->name }} <b>({{$best_answer->user->points}})</b></span>
                        </div>
                        <div class="card-body">
                            {!! Markdown::convertToHtml($best_answer->content) !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer">
            <p class="text-center">{{$d->replies->count()}} Replies</p>
            <a href="{{route('channel',['slug'=>$d->channel->slug])}}"
               class="float-right btn btn-info btn-sm">{{$d->channel->title}}</a>
            <a href="{{route('forum')}}" class=" btn btn-info btn-sm float-left">Back</a>
        </div>
    </div>
    <br>

    @foreach($d->replies as $r)
        <div class="card">
            <div class="card-header">
                <img src="{{$r->user->avatar}}" alt="assem" width="70px" height="40px">&nbsp;&nbsp;&nbsp;
                <span>{{$r->user->name }},<b>({{$r->user->points}})</b></span>
                @if (!$best_answer)
                    @if (\Illuminate\Support\Facades\Auth::id() == $d->user->id)
                        @if ($r->user_id !== $d->user->id)
                            <a href="{{route('discussion.best.answer',['id'=>$r->id])}}"
                               class="btn btn-sm btn-primary  float-right" style="margin-left:8px ">Mark as Best Answer</a>
                        @endif
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::id() == $r->user->id)
                        @if(!$r->best_answer)
                            <a href="{{route('reply.edit',['id'=>$r->id])}}"
                               class="btn btn-sm btn-info float-right">Edit a Reply</a>
                        @endif
                    @endif
                @endif
            </div>
            <div class="card-body">
                <b class="text-center">{!! Markdown::convertToHtml($r->content) !!}</b>
            </div>
            <hr>
            <div class="card-footer">
                <p class="text-center">
                    @if ($r->is_liked_by_auth_user())
                        <a href="{{route('reply.unlike',['id'=>$r->id])}}" class="btn btn-danger btn-sm">Unlike
                            <span class="badge">{{$r->likes->count()}}</span>
                        </a>
                    @else
                        <a href="{{route('reply.like',['id'=>$r->id])}}" class="btn btn-success btn-sm">Like
                            <span class="badge">{{$r->likes->count()}}</span></a>
                    @endif


                </p>
            </div>
        </div>
    @endforeach

    <div class="card">
        <div class="card-body">
            @if (\Illuminate\Support\Facades\Auth::check())
                <form action="{{route('discussion.reply',['id'=>$d->id])}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="reply">leave a reply...</label>
                        <textarea name="reply" id="reply" cols="10" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary float-right">Leave a Reply</button>
                    </div>

                </form>
            @else
                <div class="text-center">
                    <h2><a href="{{ route('login') }}">Sign in to leave a reply</a></h2>
                </div>

            @endif
        </div>
    </div>

@endsection
