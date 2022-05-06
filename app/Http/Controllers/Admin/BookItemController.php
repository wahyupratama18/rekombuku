<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{StoreBookItemRequest, UpdateBookItemRequest};
use App\Models\{Book, BookItem};
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BookItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Book $book, StoreBookItemRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($book, $request) {
            $book->newItems($request->qty);
        });
        
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Book  $book
     * @param  BookItem  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book, BookItem $item): View
    {
        return view('admin.books.items.edit', [
            'book' => $book,
            'item' => $item->load('latestCondition')
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookItemRequest  $request
     * @param  Book  $book
     * @param  BookItem  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookItemRequest $request, Book $book, BookItem $item): RedirectResponse
    {
        DB::transaction(function () use ($request, $item) {
            $item
            ->newCondition($request->scale)
            ->update(['is_available' => isset($request->is_available)]);
        });

        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Book  $book
     * @param  BookItem  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, BookItem $item)
    {
        $item->delete();

        return redirect()->route('books.show', $book);
    }
}
