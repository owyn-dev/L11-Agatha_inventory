<?php

namespace App\Livewire\DataTable;

use App\Enum\VariantProduct;
use App\Models\DetailProduction;
use App\Models\InventoryIn;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Milon\Barcode\DNS1D;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

class InventoryInTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return InventoryIn::query();
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
                ->hideIf(true),
            Column::make('Transaction Date', 'transaction_date')
                ->format(fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d'))
                ->sortable(),
            Column::make('Batch Code', 'batch_code')
                ->sortable()
                ->searchable(),
            Column::make('Product Name', 'product.name')
                ->sortable()
                ->searchable(),
            Column::make('Variant', 'product.variant')
                ->format(fn ($value) => VariantProduct::getNameByValue($value))
                ->sortable()
                ->searchable(),
            Column::make('Shelf name', 'shelf_name')
                ->sortable()
                ->searchable(),
            Column::make('Stock start', 'stock_start')
                ->sortable(),
            Column::make('Current stock', 'current_stock')
                ->sortable(),
            Column::make('Unit price', 'unit_price')
                ->format(fn ($value) => 'Rp '.number_format($value, 0, ',', '.'))
                ->sortable(),
            Column::make('Expiration date', 'expiration_date')
                ->format(fn ($value) => \Carbon\Carbon::parse($value)->format('Y-m-d'))
                ->sortable(),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $barcodeButton = '
                            <a href="#datatable" wire:click="generateBarcodePdf('.$row->id.')" wire:key="barcode-'.$row->id.'" class="btn btn-sm btn-primary" wire:loading.class="disabled">
                                <span wire:loading.remove wire:target="generateBarcodePdf('.$row->id.')">Show Barcode</span>
                                <span aria-hidden="true" wire:loading wire:target="generateBarcodePdf('.$row->id.')" class="spinner-border spinner-border-sm ms-2" role="status"></span>
                                <span wire:loading wire:target="generateBarcodePdf('.$row->id.')"> Loading...</span>
                            </a>
                        ';

                        return $barcodeButton;
                    }
                )->html(),
        ];
    }

    public function filters(): array
    {
        return [
            DateFilter::make('Transaction From')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('transaction_date', '>=', $value);
                }),
            DateFilter::make('Transaction To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('transaction_date', '<=', $value);
                }),
            DateFilter::make('Expiration Date From')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('expiration_date', '>=', $value);
                }),
            DateFilter::make('Expiration Date To')
                ->filter(function (Builder $builder, string $value) {
                    $builder->where('expiration_date', '<=', $value);
                }),
        ];
    }

    public function generateBarcodePdf($detail_production_id)
    {
        $detail_production = DetailProduction::with('production')->findOrFail($detail_production_id);

        $barcodes = [];
        $barcodeGenerator = new DNS1D;

        for ($i = 0; $i < $detail_production->quantity; $i++) {
            $barcodes[] = [
                'product_name' => $detail_production->product->name,
                'code' => $detail_production->product->code,
                'barcode' => $barcodeGenerator->getBarcodeHTML($detail_production->batch_code, 'C128', 2, 40),
                'expiry_date' => Carbon::parse($detail_production->production->production_date)
                    ->addDays($detail_production->product->expired_day)
                    ->format('Y-m-d'),
            ];
        }

        $pdf = Pdf::loadView('livewire.layouts.barcode', compact('barcodes'));

        $filename = 'Production_Barcodes_'.now()->format('Ymd').'.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
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
