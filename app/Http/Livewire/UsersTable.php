<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends TableComponent
{
    use HtmlComponents;

    public $trashed;

    public function query(): Builder
    {
        if ($this->trashed) {
            return User::onlyTrashed()->with('roles');
        } else {
            return User::with('roles');
        }
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
            Column::make('Roles')
                ->format(function (User $model) {
                    return $this->html($model->roles->pluck('name')->map(function ($name) {
                        return
                            '<span class="badge badge-info badge-pill mx-1">' . $name . '</span>';
                    })->join(''));
                }),
            Column::make('Actions')
                ->format(function (User $model) {
                    return view('administration.users.actions', ['user' => $model, 'trashed' => $this->trashed]);
                }),
        ];
    }
}
