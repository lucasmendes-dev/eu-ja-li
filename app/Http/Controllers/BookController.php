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
    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search', []);
        $orderByField = $request->input('orderByField', 'title');
        $paginateNumber = $request->input('paginateNumber', 10);

        if (isset($search['read_in'])) {
            $search = $this->prepareYearFormatToSave($search);
        }

        $allBooks = Book::where('user_id', $user->id)->get();
        $books = Book::where('user_id', $user->id)
        ->when(isset($search['title']), fn($query) => $query->where('title', 'like', "%{$search['title']}%"))
        ->when(isset($search['author']), fn($query) => $query->where('author', 'like', "%{$search['author']}%"))
        ->when(isset($search['genre']), fn($query) => $query->where('genre', 'like', "%{$search['genre']}%"))
        ->when(isset($search['read_in']), fn($query) => $query->where('read_in', $search['read_in']))
        ->when(isset($search['status']), fn($query) => $query->where('status', $search['status']))
        ->orderBy($orderByField)
        ->paginate($paginateNumber)
        ->appends(request()->query());

        return Inertia::render('Index', [
            'books' => $books,
            'search' => $search,
            'paginateNumber' => $paginateNumber,
            'allBooks' => $allBooks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data = $this->prepareYearFormatToSave($data);
        $data['user_id'] = Auth::user()->id;

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
        if (isset($data['year'])) {
            $data['year'] = $data['year'] . '-01-01';
        }
        if (isset($data['read_in'])) {
            $data['read_in'] = $data['read_in'] . '-01-01';
        }
        return $data;
    }
}
