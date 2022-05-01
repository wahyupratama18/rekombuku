<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreBookRequest, UpdateBookRequest};
use App\Models\{Book, Genre};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.books.create', [
            'genres' => Genre::select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        DB::transaction(function() use ($request) {
            $book = Book::create($request->safe([
                'name',
                'isbn',
                'year',
                'penerbit',
                'edition',
                'price'
            ]));

            if ($request->genres) {
                Genre::upsert(
                    collect($request->genres)
                    ->map(fn($item) => ['name' => $item])
                    ->toArray(),
                    ['name'],
                    ['name'],
                );
    
                $genres = Genre::select('id')
                ->whereIn('name', $request->genres)
                ->get()
                ->pluck('id');
    
                $book->genres()->attach($genres);

            }

            // $book->items()
        });

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('admin.books.edit', [
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        DB::transaction(function () use ($book) {
            $book->genres()->detach();
            $book->delete();
        });

        return redirect()->route('books.index');
    }
}
