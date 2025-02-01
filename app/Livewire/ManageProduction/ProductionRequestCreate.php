<?php

namespace App\Livewire\ManageProduction;

use App\Enum\StatusProduction;
use App\Models\Production;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Production Request ')]
class ProductionRequestCreate extends Component
{
    public $title = 'Create Production Request';

    public $text_subtitle = 'This page displays for create data production.';

    public Production $production;

    public $production_date;

    public $status = statusProduction::IN_PROGRESS;

    public $note = '';

    public $productList = [];

    public function statusProduction()
    {
        return [
            StatusProduction::IN_PROGRESS,
            StatusProduction::COMPLETE,
            StatusProduction::REJECTED,
        ];
    }

    public function mount(Production $production): void
    {
        $this->production = Production::with('detailProductions.product')->find($production->id);

        $this->note = $production->note;

        if ($production->detailProductions) {
            $this->productList = [];

            foreach ($production->detailProductions as $detail) {
                $product = $detail->product;

                $this->productList[$product->id] = [
                    'product_id' => $product->id,
                    'code' => $product->code,
                    'name' => $product->name,
                    'variant' => $product->variant?->label(),
                    'price' => $product->price,
                    'batch_code' => $detail->batch_code,
                    'shelf_name' => $detail->shelf_name,
                    'quantity' => $detail->quantity,
                ];
            }
        } else {
            $this->productList = [];
        }
    }

    public function render()
    {
        return view('livewire.manage-production.production-request-create');
    }

    public function edit()
    {
        if (empty($this->productList)) {
            return flash()->warning('The Product Production List is still empty!');
        }

        $this->validate([
            'production_date' => ['required', 'date'],
            'status' => ['required', new Enum(StatusProduction::class)],
            'note' => ['required'],
        ]);

        if ($this->status == StatusProduction::COMPLETE) {
            $this->status = StatusProduction::PENDING_APPROVAL;
        }

        $this->production->update([
            'production_user_id' => auth()->user()->id,
            'production_date' => $this->production_date,
            'status' => $this->status,
            'note' => $this->note,
        ]);

        $this->redirect(route('production.request'), navigate: true);
        flash()->success('Data Changed Successfully.');
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
