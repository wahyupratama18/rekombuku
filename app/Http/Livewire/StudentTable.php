<?php

namespace App\Http\Livewire;

use App\Models\Major;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;

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

    public function filters(): array
    {
        return [
            MultiSelectFilter::make('Program studi')
                ->setFilterPillTitle('Prodi')
                ->options(
                    Major::select('id', 'name')->get()
                    ->mapWithKeys(fn($item) => [ $item->id => $item->name ])
                    ->all()
                )
                ->filter(fn(Builder $builder, array $value) => 
                    $builder->when(
                        $value,
                        fn($query, $value) => $query->whereHas('major', fn(Builder $q) => $q->whereIn('majors.id', $value))
                    )
                )
        ];
    }
}
