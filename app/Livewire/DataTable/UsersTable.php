<?php

namespace App\Livewire\DataTable;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class UsersTable extends DataTableComponent
{
    public UserForm $form;

    public $SelectedId = '';

    public function builder(): Builder
    {
        return User::query();
    }

    public function configure(): void
    {
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

        $this->setColumnSelectDisabled();

        $this->storeFiltersInSessionDisabled();
        $this->setToolBarAttributes(['class' => ' mt-1', 'default-colors' => true, 'default-styling' => true]);

        $this->setDefaultPerPage(10);
        $this->setPerPageAccepted([10, 25, 50, 100, 200]);
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
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
                    LinkColumn::make('View')
                        ->title(fn () => '<i class="bi bi-eye"></i>')
                        ->location(fn ($row) => route('manage-access.user.show', $row))
                        ->attributes(function () {
                            return [
                                'class' => 'btn icon icon-left btn-sm btn-info',
                                'wire:navigate.hover' => '',
                            ];
                        })->html(),
                    LinkColumn::make('Update')
                        ->title(fn () => '<i class="bi bi-pencil"></i>')
                        ->location(fn ($row) => route('manage-access.user.update', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => 'btn icon icon-left btn-sm btn-warning',
                                'wire:navigate.hover' => '',
                            ];
                        })->html(),
                    LinkColumn::make('Delete')
                        ->title(fn () => '<i class="bi bi-trash"></i>')
                        ->location(fn ($row) => '#title-datatable')
                        ->attributes(function ($row) {
                            return [
                                'wire:click' => 'deleteData('.$row.')',
                                'class' => 'btn icon icon-left btn-sm btn-danger',
                            ];
                        })->html(),
                ]),
        ];
    }

    public function filters(): array
    {
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

    public function deleteData($id)
    {
        $this->SelectedId = $id;

        sweetalert()
            ->timer(240000)
            ->timerProgressBar(false)
            ->showConfirmButton(true)
            ->showCancelButton(true)
            ->warning('Are you sure you want to delete the data ?');
    }

    #[On('sweetalert:confirmed')]
    public function onConfirmed()
    {
        try {
            $user = User::find($this->SelectedId);
            if (! $user) {
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
            flash()->error('An error occurred while deleting the data: '.$e->getMessage());
        }
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="text-center py-5">
            <img src="data:image/svg+xml,%3csvg%20xmlns='http://www.w3.org/2000/svg'%20width='38'%20height='38'%20stroke='%235d79d3'%20viewBox='0%200%2038%2038'%3e%3cg%20fill='none'%20fill-rule='evenodd'%3e%3cg%20stroke-width='2'%20transform='translate(1%201)'%3e%3ccircle%20cx='18'%20cy='18'%20r='18'%20stroke-opacity='.5'/%3e%3cpath%20d='M36%2018c0-9.94-8.06-18-18-18'%3e%3canimateTransform%20attributeName='transform'%20dur='1s'%20from='0%2018%2018'%20repeatCount='indefinite'%20to='360%2018%2018'%20type='rotate'/%3e%3c/path%3e%3c/g%3e%3c/g%3e%3c/svg%3e" class="me-4" style="width: 3rem" alt="audio">
        </div>
        HTML;
    }
}
