<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class DiscussionsController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discussion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'channel_id' => 'required',
            'description' => 'required',
            'title' => 'required'
        ]);

        $discussion = Discussion::create([
            'title' => $request->title,
            'content' => $request->description,
            'channel_id' => $request->channel_id,
            'user_id' => Auth::id(),
            'slug' => Str::slug($request->title, '-')
        ]);

        $discussion->save();
        toastr()->success('discussion created Successfully');
        return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        $best_answer = $discussion->replies()->where('best_answer', 1)->first();
        return view('discussions.show')->with('d', $discussion)->with('best_answer', $best_answer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $discussion = Discussion::where('slug', $slug)->first();
        return view('discussions.edit')->with('discussion', $discussion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $d = Discussion::find($id);
        $d->content = $request->description;
        $d->save();
        toastr()->success('discussion Updated Successfully');
        return redirect()->route('discussion', ['slug' => $d->slug]);
    }

    public function reply($id)
    {
        $d = Discussion::find($id);

        $reply =
            Reply::create([
                'user_id' => Auth::id(),
                'discussion_id' => $id,
                'content' => \request()->reply
            ]);

        $reply->user->points += 25;
        $reply->user->save();
        $watchers = array();
        foreach ($d->watchers as $watcher):
            array_push($watchers, User::find($watcher->user_id));
        endforeach;

        Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));
        toastr()->success('Replied to Discussion');
        return redirect()->back();
    }
}
