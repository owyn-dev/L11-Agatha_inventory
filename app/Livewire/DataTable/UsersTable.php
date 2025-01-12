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

    public $selectedId = '';

    /**
     * Query builder for the table.
     */
    public function builder(): Builder
    {
        return User::query();
    }

    /**
     * Configure the table settings.
     */
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableWrapperAttributes(['class' => 'table-responsive text-nowrap'])
            ->setTableAttributes(['class' => 'table table-striped'])
            ->setTrAttributes(fn () => ['default' => false])
            ->setTdAttributes(fn () => ['default' => true])
            ->setToolBarAttributes(['class' => 'mt-1', 'default-colors' => true, 'default-styling' => true])
            ->setColumnSelectEnabled()
            ->setPerPageAccepted([10, 25, 50, 100, 200])
            ->setFilterLayoutSlideDown();
    }

    /**
     * Define the table columns.
     */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->sortable(),
            Column::make('Full name', 'full_name')->sortable(),
            Column::make('Username', 'username')->sortable(),
            Column::make('Role', 'modelHasRole.role.name')->sortable()->searchable(),
            Column::make('Updated at', 'updated_at')->sortable(),
            $this->actionButtons(),
        ];
    }

    /**
     * Define the action buttons column.
     */
    private function actionButtons(): ButtonGroupColumn
    {
        return ButtonGroupColumn::make('Actions')
            ->attributes(fn ($row) => ['default' => true])
            ->buttons([
                LinkColumn::make('View')
                    ->title(fn () => '<i class="bi bi-eye"></i>')
                    ->location(fn ($row) => route('manage-access.user.show', $row))
                    ->attributes(function () {
                        return [
                            'class' => 'btn icon icon-left btn-sm btn-info',
                        ];
                    })->html(),
                LinkColumn::make('Update')
                    ->title(fn () => '<i class="bi bi-pencil"></i>')
                    ->location(fn ($row) => route('manage-access.user.update', $row))
                    ->attributes(function () {
                        return [
                            'class' => 'btn icon icon-left btn-sm btn-warning',
                        ];
                    })->html(),
                LinkColumn::make('Delete')
                    ->title(fn () => '<i class="bi bi-trash"></i>')
                    ->location('#title-datatable')
                    ->attributes(fn ($row) => [
                        'wire:click' => "deleteData({$row})",
                        'class' => 'btn icon icon-left btn-sm btn-danger',
                    ])
                    ->html(),
            ]);
    }

    /**
     * Define the table filters.
     */
    public function filters(): array
    {
        return [
            DateFilter::make('Updated Date From')->filter(fn (Builder $builder, string $value) => $builder->where('updated_at', '>=', $value)),
            DateFilter::make('Updated Date To')->filter(fn (Builder $builder, string $value) => $builder->where('updated_at', '<=', $value)),
        ];
    }

    /**
     * Handle delete data confirmation.
     */
    public function deleteData($id): void
    {
        $this->selectedId = $id;

        sweetalert()
            ->timer(240000)
            ->timerProgressBar(false)
            ->showConfirmButton(true)
            ->showCancelButton(true)
            ->warning('Are you sure you want to delete the data?');
    }

    /**
     * Handle confirmed delete action.
     */
    #[On('sweetalert:confirmed')]
    public function onConfirmed(): void
    {
        try {
            $user = User::find($this->selectedId);

            if (! $user) {
                flash()->warning('Data not found.');

                return;
            }

            if ($this->form->destroy($this->selectedId)) {
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
}
