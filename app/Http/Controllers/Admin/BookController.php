<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreBookRequest, UpdateBookRequest};
use App\Models\{Book, Genre};
use Illuminate\Http\RedirectResponse;
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
            'genres' => Genre::select('name')->get()->pluck('name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        DB::transaction(function() use ($request) {

            Book::create($request->safe([
                'name',
                'isbn',
                'year',
                'penerbit',
                'edition',
                'price'
            ]))
            ->syncGenres($request->genres)
            ->newItems($request->qty)
            ->syncWriters($request->writers);

        });

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book): View
    {
        return view('admin.books.show', [
            'book' => $book->load(['items.latestCondition', 'images', 'writers', 'genres'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book): View
    {
        $writers = $book->load('writers')->writers->pluck('name');

        return view('admin.books.edit', [
            'book' => $book,
            'genres' => Genre::select('name')->get()->pluck('name'),
            'bookGenres' => $book->load('genres:name')->genres->pluck('name'),
            'writers' => $writers,
            'writersArrayed' => $writers->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        DB::transaction(function() use ($request, $book) {
            $book
            ->syncWriters($request->writers)
            ->syncGenres($request->genres)
            ->update($request->safe([
                'name',
                'isbn',
                'year',
                'penerbit',
                'edition',
                'price'
            ]));

        });

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book): RedirectResponse
    {
        DB::transaction(function () use ($book) {
            $book->genres()->detach();
            $book->delete();
        });

        return redirect()->route('books.index');
    }
}
