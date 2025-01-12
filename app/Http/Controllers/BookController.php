<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $books = Book::where('user_id', $user->id)->paginate(10);
        return Inertia::render('Index', ['books' => $books]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = $this->prepareYearFormatToSave($data);
        $data['user_id'] = Auth::user()->id;

        // adicionar validações
        Book::create($data);
        return redirect(route('books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return Inertia::render('Books/Edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->all();

        $data = $this->prepareYearFormatToSave($data);
        $data['user_id'] = Auth::user()->id;

        $book->update($data);
        return redirect(route('books'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
    }

    public function prepareYearFormatToSave(array $data): array
    {
        $data['year'] = $data['year'] ? $data['year'] . '-01-01' : null;
        $data['read_in'] = $data['read_in'] ? $data['read_in'] . '-01-01' : null;
        return $data;
    }
}
