<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function show($id) {
        $idea = Idea::find($id);
        $idea->viewed = $idea->viewed + 1;
        $idea->save();
        $data['idea'] = $idea;

        return view('show_idea')->with($data);
    }

    public function store(Request $request) {

        $newIdea = new Idea();
        $newIdea->name = $request->name;
        $newIdea->description = $request->description;
        $newIdea->save();

        return back();
    }

    public function like(Request $request) {
        $idea = Idea::find($request->id);
        $idea->like = $idea->like + 1;
        $idea->save();

        return redirect()->route('idea.show', [$request->id+1]);
    }

    public function skip(Request $request) {
        $idea = Idea::find($request->id);
        $idea->skip = $idea->skip + 1;
        $idea->save();

        return redirect()->route('idea.show', [$request->id+1]);
    }
}
