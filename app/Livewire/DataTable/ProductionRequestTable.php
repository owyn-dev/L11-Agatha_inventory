<?php

namespace App\Livewire\DataTable;

use App\Enum\StatusProduction;
use App\Models\Production;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class ProductionRequestTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Production::query()->withCount('detailProductions')->where('status', StatusProduction::WAITING_FOR_RESPONSE);
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
                ->format(
                    fn ($value) => 'PR-'.str_pad($value, 5, '0', STR_PAD_LEFT)
                )
                ->sortable(),
            Column::make('Production Request From', 'inventoryUser.full_name')
                ->sortable()
                ->searchable(),
            Column::make('Production request date', 'production_request_date')
                ->format(fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d'))
                ->sortable(),
            Column::make('Production List')->label(function ($row) {
                return $row->detail_productions_count.' Products';
            }),
            Column::make('Status', 'status')
                ->sortable()
                ->format(
                    fn ($value) => '<span class="badge '.$value->getBadgeClass().'">'.$value->label().'</span>'
                )
                ->searchable()
                ->html(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return ['default' => true];
                })
                ->buttons([
                    LinkColumn::make('production')
                        ->title(fn () => 'Make Production')
                        ->location(fn ($row) => route('production.request.create', $row))
                        ->attributes(function () {
                            return [
                                'class' => 'btn btn-sm btn-primary',
                                'wire:navigate.hover' => '',
                            ];
                        })->html(),
                ]),
        ];
    }

    public function filters(): array
    {
        return [
            DateFilter::make('Request Date From')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('production_request_date', '>=', $value);
                }),
            DateFilter::make('Request Date To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('production_request_date', '<=', $value);
                }),
        ];
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
