<?php

namespace App\Livewire\DataTable;

use App\Models\User;
use Livewire\Attributes\On;
use App\Livewire\Forms\UserForm;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class UsersTable extends DataTableComponent {

    public UserForm $form;

    public $SelectedId = '';

    public function builder(): Builder {
        return User::query();
    }

    public function configure(): void {
        $this->setPrimaryKey('id');

        $this->setTableWrapperAttributes([
            'class' => 'table-responsive text-nowrap',
        ])->setTableAttributes([
            'class' => 'table table-striped',
        ])->setTrAttributes(function () {
            return ['default' => false];
        })->setTdAttributes(function () {
            return ['default' => true];
        });

        $this->setToolBarAttributes(['class' => ' mt-1', 'default-colors' => true, 'default-styling' => true]);

        $this->setColumnSelectEnabled();
        $this->setPerPageAccepted([10, 25, 50, 100, 200]);
    }

    public function columns(): array {
        return [
            Column::make('Id', 'id')
                ->sortable(),
            Column::make('Full name', 'full_name')
                ->sortable(),
            Column::make('Username', 'username')
                ->sortable(),
            Column::make('Role', 'modelHasRole.role.name')
                ->sortable()
                ->searchable(),
            Column::make('Updated at', 'updated_at')
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return ['default' => true];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                        ->title(fn() => '<i class="bi bi-eye"></i>')
                        ->location(fn($row) => route('manage-access.user.show', $row))
                        ->attributes(function () {
                            return [
                                'class' => 'btn icon icon-left btn-sm btn-info',
                            ];
                        })->html(),
                    LinkColumn::make('Update')
                        ->title(fn() => '<i class="bi bi-pencil"></i>')
                        ->location(fn($row) => route('manage-access.user.update', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn icon icon-left btn-sm btn-warning',
                            ];
                        })->html(),
                    LinkColumn::make('Delete')
                        ->title(fn() => '<i class="bi bi-trash"></i>')
                        ->location(fn($row) => '#title-datatable')
                        ->attributes(function ($row) {
                            return [
                                'wire:click' => 'deleteData(' . $row . ')',
                                'class' => 'btn icon icon-left btn-sm btn-danger',
                            ];
                        })->html(),
                ]),
        ];
    }

    public function filters(): array {
        return [
            DateFilter::make('Updated Date From')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.updated_at', '>=', $value);
                }),
            DateFilter::make('Updated Date To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('users.updated_at', '<=', $value);
                }),
        ];
    }

    public function deleteData($id) {
        $this->SelectedId = $id;

        sweetalert()
            ->timer(240000)
            ->timerProgressBar(false)
            ->showConfirmButton(true)
            ->showCancelButton(true)
            ->warning('Are you sure you want to delete the data ?');
    }

    #[On('sweetalert:confirmed')]
    public function onConfirmed() {
        try {
            $user = User::find($this->SelectedId);
            if (!$user) {
                flash()->warning('Data not found.');
            }

            if ($this->form->destroy($this->SelectedId)) {
                flash()->success('Data successfully deleted.');
            } else {
                flash()->error('Failed to delete data.');
            }

            $this->resetPage();
        } catch (\Exception $e) {
            $this->resetPage();
            flash()->error('An error occurred while deleting the data: ' . $e->getMessage());
        }
    }
}
