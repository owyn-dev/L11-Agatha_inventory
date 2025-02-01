<?php

namespace App\Livewire\DataTable;

use App\Enum\StatusProduction;
use App\Models\InventoryIn;
use App\Models\Production;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class ProductionRequestInventoryTable extends DataTableComponent
{
    public $SelectedId = '';

    public function builder(): Builder
    {
        return Production::query();
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
                ->format(fn ($value) => \Carbon\Carbon::createFromTimestamp($value)->format('Y-m-d'))
                ->sortable(),
            Column::make('Production Handled By', 'productionUser.full_name')
                ->sortable()
                ->searchable()
                ->format(fn ($value) => $value ?? 'N/A'),

            Column::make('Production Date', 'production_date')
                ->sortable()
                ->format(fn ($value) => $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : 'N/A'),
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
                    LinkColumn::make('View')
                        ->title(fn () => '<i class="bi bi-eye"></i>')
                        ->location(function ($row) {
                            return $row->status === StatusProduction::WAITING_FOR_RESPONSE ? '#' : route('inventory.request.show', $row);
                        })
                        ->attributes(function ($row) {
                            $class = $row->status === StatusProduction::WAITING_FOR_RESPONSE ? 'd-none btn icon icon-left btn-sm btn-info' : 'btn icon icon-left btn-sm btn-info';

                            return [
                                'class' => $class,
                                'wire:navigate.hover' => '',
                            ];
                        })->html(),
                    LinkColumn::make('Update')
                        ->title(fn () => '<i class="bi bi-pencil"></i>')
                        ->location(function ($row) {
                            return $row->status === StatusProduction::WAITING_FOR_RESPONSE ? route('inventory.request.update', $row) : '#';
                        })
                        ->attributes(function ($row) {
                            $class = $row->status === StatusProduction::WAITING_FOR_RESPONSE ? 'btn icon icon-left btn-sm btn-warning' : 'd-none btn icon icon-left btn-sm btn-warning';

                            return [
                                'class' => $class,
                                'wire:navigate.hover' => '',
                            ];
                        })->html(),
                    LinkColumn::make('Delete')
                        ->title(fn () => '<i class="bi bi-trash"></i>')
                        ->location(function ($row) {
                            return $row->status === StatusProduction::WAITING_FOR_RESPONSE ? '#title-datatable' : '#';
                        })
                        ->attributes(function ($row) {
                            $class = $row->status === StatusProduction::WAITING_FOR_RESPONSE ? 'btn icon icon-left btn-sm btn-danger' : 'd-none btn icon icon-left btn-sm btn-danger';

                            return [
                                'wire:click' => 'deleteData('.$row.')',
                                'class' => $class,
                            ];
                        })->html(),
                    LinkColumn::make('Accepted')
                        ->title(fn () => '<i class="bi bi-check2-all"></i>')
                        ->location(fn () => '#')
                        ->attributes(function ($row) {
                            $class = $row->status === StatusProduction::PENDING_APPROVAL ? 'btn icon icon-left btn-sm btn-success' : 'd-none btn icon icon-left btn-sm btn-success';
                            $redirect = $row->status === StatusProduction::PENDING_APPROVAL ? 'acceptedData('.$row->id.')' : '';

                            return [
                                'wire:click' => $redirect,
                                'class' => $class,
                            ];
                        })->html(),
                    LinkColumn::make('Rejected')
                        ->title(fn () => '<i class="bi bi-x-octagon"></i>')
                        ->location(function ($row) {
                            return $row->status === StatusProduction::PENDING_APPROVAL ? route('inventory.request.update-status', $row) : '#';
                        })
                        ->attributes(function ($row) {
                            $class = $row->status === StatusProduction::PENDING_APPROVAL ? 'btn icon icon-left btn-sm btn-danger' : 'd-none btn icon icon-left btn-sm btn-danger';

                            return [
                                'class' => $class,
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
            DateFilter::make('Production Date From')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('production_date', '>=', $value);
                }),
            DateFilter::make('Production Date To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('production_date', '<=', $value);
                }),
        ];
    }

    public function acceptedData($id)
    {
        DB::beginTransaction();

        try {
            $production = Production::with('detailProductions', 'detailProductions.product')->find($id);

            if (! $production) {
                return flash()->warning('Data not found.');
            }

            $production->status = StatusProduction::APPROVED;
            $production->save();

            foreach ($production->detailProductions as $detail_production) {
                $transactionDate = Carbon::parse($production->production_date)->addDays($detail_production->product->expired_day)->format('Y-m-d');

                $inventory = InventoryIn::create([
                    'product_id' => $detail_production->product_id,
                    'batch_code' => $detail_production->batch_code,
                    'transaction_date' => Carbon::parse($production->production_date)->format('Y-m-d'),
                    'shelf_name' => $detail_production->shelf_name,
                    'stock_start' => $detail_production->quantity,
                    'current_stock' => $detail_production->quantity,
                    'unit_price' => $detail_production->product['price'],
                    'expiration_date' => $transactionDate,
                ]);

                if (! $inventory) {
                    DB::rollBack();

                    return flash()->error('Failed to changes data.');
                }

                $product = $detail_production->product;
                $product->stock += $detail_production->quantity;
                $product->save();
            }

            DB::commit();

            return flash()->success('Data Changed Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return flash()->error('Failed to changes data.');
        }
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
            $production = Production::find($this->SelectedId)->first();

            if (! $production) {
                flash()->warning('Data not found.');
            }

            if ($production->delete()) {
                flash()->success('Data successfully deleted.');
            } else {
                flash()->error('Failed to delete data.');
            }

            $this->resetPage();
            $this->reset(['SelectedId']);
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
