<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class StudentTable extends DataTableComponent
{
    protected $model = User::class;

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
                ->sortable()
                ->searchable(),
            Column::make("Prodi")
                ->label(fn($row) => $row->major?->name)
                ->sortable(),
            Column::make('action')
                ->label(fn($row) => view('components.action', [
                    'route' => (object) [
                        'edit' => route('students.edit', $row->id),
                        'destroy' => route('students.destroy', $row->id),
                    ]
                ]))
        ];
    }

    public function builder(): Builder
    {
        return User::query()
            ->has('major')
            ->with('major')
            /* ->when($this->columnSearch['name'], fn($query, $name) => $query->where('name', 'like', "%$name%")) */;
    }
}
