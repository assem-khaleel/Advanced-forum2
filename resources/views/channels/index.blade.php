@extends('layouts.app')

@section('content')
                <div class="card">
                    <div class="card-header">Channels</div>

                    <div class="card-body">
                  <table class="table table-hover">
                      <thead>
                      <th>
                          Name
                      </th>

                      <th>
                          Edit
                      </th>

                      <th>
                          Delete
                      </th>
                      </thead>

                      <tbody>

                      @if ($channels->count() >0)
                          @foreach($channels as $channel)

                              <tr>
                                  <td>{{$channel->title}}</td>
                                  <td><a href="{{route('channels.edit',['channel'=>$channel->id])}}" class="btn btn-sm btn-info">Edit</a></td>
                                  <td>
                                      <form action="{{route('channels.destroy',['channel'=>$channel->id])}}" method="post">
                                          {{csrf_field()}}
                                          @method('DELETE')
                                          <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                      </form>
                                  </td>

                              </tr>

                          @endforeach
                      @else
                          <tr><td> <h1 class="text-center"> No Channels yet </h1></td></tr>

                      @endif

                      </tbody>

                  </table>
                    </div>
                </div>
@endsection
