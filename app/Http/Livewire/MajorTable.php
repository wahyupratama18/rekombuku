<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Major;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class MajorTable extends DataTableComponent
{
    protected $model = Major::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ;
    }

    public function columns(): array
    {
        return [
            LinkColumn::make("Id", "id")
                ->title(fn($row) => $row->id)
                ->location(fn($row) => route('majors.show', $row))
                ->sortable(),
            Column::make("Nama", "name")
                ->sortable()
                ->searchable(),
            Column::make("Jumlah Mahasiswa")
                ->label(fn($row, Column $column) => $row->students_count)
                ->sortable(),
            Column::make('action')
                ->label(fn($row) => view('admin.majors.action', [
                    'route' => (object) [
                        'edit' => route('majors.edit', $row->id),
                        'destroy' => route('majors.destroy', $row->id),
                    ],
                    'id' => $row->id
                ]))
        ];
    }

    public function builder(): Builder
    {
        return Major::query()
        ->withCount('students');
    }
}
