<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Catering\Funding;

class FundingsTable extends TableComponent
{
    use HtmlComponents;

    public function query(): Builder
    {
        return User::withoutTrashed();
    }

    public function columns(): array
    {
        return [
            Column::make('ID')
                ->searchable()
                ->sortable(),
            Column::make('Name')
                ->searchable()
                ->sortable(),
            Column::make('E-mail', 'email')
                ->searchable()
                ->sortable()
                ->format(function (User $model) {
                    return $this->mailto($model->email, null, ['target' => '_blank']);
                }),
            Column::make('Fundings [PLN]', 'funding.amount')
                ->sortable(),
            Column::make('Actions')
                ->format(function (User $model) {
                    return view('administration.fundings.actions', ['user' => $model]);
                }),
        ];
    }
}
