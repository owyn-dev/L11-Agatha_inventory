<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form wire:submit.prevent="generateReport">
                <div class="row g-3 align-items-start">
                  <div class="col-12 col-md-auto">
                    <input wire:model="startDate" class="form-control form-control-lg @error('startDate') is-invalid @enderror" type="date" placeholder="Select Start Date">
                    @error('startDate')
                      <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="col-12 col-md-auto">
                    <input wire:model="endDate" class="form-control form-control-lg @error('endDate') is-invalid @enderror" type="date" placeholder="Select End date">
                    @error('endDate')
                      <div class="invalid-feedback">
                        <i class="bx bx-radio-circle"></i>
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <button class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary" type="submit">
                    <i class="bi bi-journal-bookmark"></i> Generate Inventory Report
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h5 class="card-title">{{ $title }} Datatable</h5>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a wire:click.prevent="setActiveTab('inventory_in')" class="nav-link {{ $activeTab === 'inventory_in' ? 'active' : '' }}" href="#">Inventory [IN]</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a wire:click.prevent="setActiveTab('inventory_out')" class="nav-link {{ $activeTab === 'inventory_out' ? 'active' : '' }}" href="#">Inventory [OUT]</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade {{ $activeTab === 'inventory_in' ? 'show active' : '' }}" id="report-inventory-in" role="tabpanel">
                  @if ($inventoryIn)
                    <div class="col-12 col-md-auto mt-4">
                      <button wire:click.prevent="exportInventoryInPdf" class="col-12 col-md-auto btn icon icon-left btn-md btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                      </button>
                    </div>
                  @endif
                  <div class="table-responsive mt-2">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Transaction Date</th>
                          <th>Batch Code Production</th>
                          <th>Product Name</th>
                          <th>Variant</th>
                          <th>Shelf Name</th>
                          <th>Stock Start</th>
                          <th>Current Stock</th>
                          <th>Expiration Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($inventoryIn as $item)
                          <tr>
                            <td>{{ \Carbon\Carbon::parse($item->transaction_date)->format('Y-m-d') }}</td>
                            <td>{{ $item->batch_code }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->variant->label() }}</td>
                            <td>{{ $item->shelf_name }}</td>
                            <td>{{ $item->stock_start }}</td>
                            <td>{{ $item->current_stock }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->expiration_date)->format('Y-m-d') }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td class="text-center text-muted" colspan="8">There is no Inventory [IN] data.</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="tab-pane fade {{ $activeTab === 'inventory_out' ? 'show active' : '' }}" id="report-inventory-out" role="tabpanel">
                  @if ($inventoryOut)
                    <div class="col-12 col-md-auto mt-4">
                      <button wire:click.prevent="exportInventoryOutPdf" class="col-12 col-md-auto btn icon icon-left btn-md btn-danger">
                        <i class="bi bi-file-earmark-pdf"></i> Export PDF
                      </button>
                    </div>
                  @endif
                  <div class="table-responsive mt-2">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Transaction Date</th>
                          <th>Batch Code</th>
                          <th>Product Name</th>
                          <th>Variant</th>
                          <th>Unit Price</th>
                          <th>Shelf Name</th>
                          <th>Stock Out</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($inventoryOut as $item)
                          <tr>
                            <td>{{ \Carbon\Carbon::parse($item->transaction_date)->format('Y-m-d') }}</td>
                            <td>{{ $item->batch_code }}</td>
                            <td>{{ $item->inventoryIn->product->name }}</td>
                            <td>{{ $item->inventoryIn->product->variant->label() }}</td>
                            <td>Rp. {{ number_format($item->inventoryIn->unit_price, 0, ',', '.') }}</td>
                            <td>{{ $item->shelf_name }}</td>
                            <td>{{ $item->stock_out }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td class="text-center text-muted" colspan="7">There is no Inventory [OUT] data.</td>
                          </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
</div>
