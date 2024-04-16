<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(auth()->id());
        // retrieve all notes from the DB
        // $notes = Note::all();
        // $notes = Note::where("user_id", auth()->id())->get();

        // fetch only the notes created by the looged in user
        // $notes = Note::where("user_id", auth()->id())->get();
        //OR

        $notes = Note::whereUserId(auth()->id())->latest()->paginate(5);
        return view("notes.index", compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Note";
        return view("notes.create", compact("title"));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validattion
        $validated = $request->validate([
            "title" => "required|string|min:5|max:255|unique:notes",
            "body" => "required|string|min:10",
        ]);

        //creating thee note
        $request->user()->notes()->create($validated);
        dd('created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
