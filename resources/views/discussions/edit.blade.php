@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            Update a Discussion
        </div>
        <div class="card-body">

            <form action="{{route('discussion.update',['id'=>$discussion->id])}}" method="post">
                {{csrf_field()}}
                @method('POST')

                <div class="form-group">
                    <label for="description">Ask a Question</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$discussion->content}}</textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success float-right" type="submit">Update Discussion</button>
                </div>
            </form>

        </div>
    </div>
@endsection
