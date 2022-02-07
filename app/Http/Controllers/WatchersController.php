<?php

namespace App\Http\Controllers;

use App\Models\Watcher;
use Illuminate\Support\Facades\Auth;

class WatchersController extends Controller
{
    public function watch($id)
    {
        Watcher::create([
            'discussion_id' => $id,
            'user_id' => Auth::id()
        ]);
        toastr()->success('You are watching this discussion.');
        return redirect()->back();
    }

    public function unwatch($id)
    {
        $watcher = Watcher::where('discussion_id', $id)->where('user_id', Auth::id());
        $watcher->delete();
        toastr()->success('You are no longer watching this discussion.');
        return redirect()->back();
    }
}
