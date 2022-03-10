<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //validate user_id field
        $request->validate([
            'user_id' => 'bail|required|exists:App\Models\User,id|numeric',
        ]);

        //get only the posts by that user
        $notes = Note::where('user_id', $request->get('user_id'))->get();
        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'bail|required|exists:App\Models\User,id|numeric',
            'title' => 'bail|required|max:50',
            'note' => 'max:1000',
        ]);

        $note = new Note([
            'user_id' => $request->get('user_id'),
            'title' => $request->get('title'),
            'note' => $request->get('note')
        ]);

        $note->save();

        return response()->json($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //TODO look up by ID and match to given user_id

        $note = Note::findOrFail($id);
        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        $request->validate([
            'user_id' => 'bail|required|exists:App\Models\User,id|numeric',
            'title' => 'bail|required|max:50',
            'note' => 'max:1000',
        ]);

        $note->user_id = $request->get('user_id');
        $note->title = $request->get('title');
        $note->note = $request->get('note');

        $note->save();

        return response()->json($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return response()->json(["Success" => "Successfully deleted note with ID of $id"]);
    }
}
