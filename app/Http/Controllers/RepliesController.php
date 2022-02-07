<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;

class RepliesController extends Controller
{
    public function like($id)
    {
        Like::create([
            'reply_id' => $id,
            'user_id' => Auth::id()
        ]);
        toastr()->success('You Liked the Reply');
        return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();
        toastr()->success('You unliked the reply.');
        return redirect()->back();
    }

    public function best_answer($id)
    {
        $reply = Reply::find($id);
        $reply->best_answer = 1;
        $reply->save();
        $reply->user->points += 100;
        $reply->user->save();
        toastr()->success('Reply has been marked as best answer.');
        return redirect()->back();
    }

    public function edit($id)
    {
        return view('replies.edit')->with('reply', Reply::find($id));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'description' => 'required'
        ]);
        $r = Reply::find($id);
        $r->content = request()->description;
        $r->save();
        toastr()->success('Reply Updated Successfully');
        return redirect()->route('discussion', ['slug' => $r->discussion->slug]);
    }
}
