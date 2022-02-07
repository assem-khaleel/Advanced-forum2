@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Create a New Discussion
        </div>
        <div class="card-body">

            <form action="{{route('discussion.store')}}" method="post">
                {{csrf_field()}}
                 @method('POST')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{old('title')}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="channel_id">Pick a Channel</label>
                    <select id="channel_id" name="channel_id" class="form-control">
                        @foreach($channels as $channel)
                                    <option value="{{$channel->id}}">
                                        {{$channel->title}}
                                    </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Ask a Question</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success float-right" type="submit">Create a Discussion</button>
                </div>
            </form>

        </div>
    </div>
@endsection
