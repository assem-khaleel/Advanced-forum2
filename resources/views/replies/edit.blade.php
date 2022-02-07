@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Update a Reply
        </div>
        <div class="card-body">

            <form action="{{route('reply.update',['id'=>$reply->id])}}" method="post">
                {{csrf_field()}}
                @method('POST')

                <div class="form-group">
                    <label for="description">Answer a Question</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$reply->content}}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success float-right" type="submit">Update Reply</button>
                </div>
            </form>

        </div>
    </div>
@endsection
