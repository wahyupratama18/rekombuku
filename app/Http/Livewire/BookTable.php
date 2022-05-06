<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

class BookTable extends DataTableComponent
{
    protected $model = Book::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "name")
                ->sortable(),
            /* Column::make("ISBN", "isbn")
                ->sortable(), */
            Column::make("Tahun", "year")
                ->sortable(),
            /* Column::make("Penerbit", "penerbit")
                ->sortable(), */
            /* Column::make("Edisi", "edition")
                ->sortable(), */
            Column::make("Genre")
                ->label(fn($row) => $row->implodeGenres()),
            Column::make("Tersedia")
                ->label(fn($row) => $row->available_books_count)
                ->footer(fn($rows) => $rows->sum('available_books_count')),
            Column::make("Tidak Tersedia")
                ->label(fn($row) => $row->unavailable_books_count)
                ->footer(fn($rows) => $rows->sum('unavailable_books_count')),
            Column::make("Total")
                ->label(fn($row) => $row->available_books_count + $row->unavailable_books_count)
                ->footer(fn($rows) => $rows->sum('available_books_count') + $rows->sum('unavailable_books_count')),
            Column::make('action')
                ->label(fn($row) => view('admin.books.action', [
                    'book' => $row,
                    'route' => (object) [
                        'edit' => route('books.edit', $row->id),
                        'destroy' => route('books.destroy', $row->id),
                    ]
                ]))
        ];
    }

    public function builder(): Builder
    {
        return Book::query()
            ->withCount([
                'items as available_books_count' => fn (Builder $query) => $query->where('is_available', true),
                'items as unavailable_books_count' => fn (Builder $query) => $query->where('is_available', false),
            ])
            ->with('genres');
    }
}
