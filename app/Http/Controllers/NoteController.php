<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import AuthorizesRequests trait

class NoteController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "All Notes";
        $notes = Note::whereUserId(auth()->id())->latest()->paginate(5);
        return view("notes.index", compact('notes', 'title'));
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
        // Validation
        $validated = $request->validate([
            "title" => "required|string|min:5|max:255|unique:notes",
            "body" => "required|string|min:10",
        ]);

        // Create the note
        $request->user()->notes()->create($validated);

        // Redirect to index or show page after creating
        return redirect()->route('notes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $title = 'Show Note';
        return view('notes.show', compact('note', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        // Authorize the update action
        $this->authorize('update', $note);

        $title = 'Edit Note';
        return view('notes.edit', compact('note', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        // Authorize the update action
        $this->authorize('update', $note);

        // Validation
        $validated = $request->validate([
            "title" => [
                'required',
                'string',
                'min:5',
                'max:255',
                Rule::unique('notes')->ignore($note->id)
            ],
            'body' => 'required|string|min:10',
        ]);

        // Update the note
        $note->update($validated);

        // Redirect to index or show page after updating
        return redirect()->route('notes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        // Authorize the delete action
        $this->authorize('delete', $note);

        // Perform deletion logic (e.g., $note->delete())

        // Redirect to index page after deletion
        return redirect()->route('notes.index');
    }
}

