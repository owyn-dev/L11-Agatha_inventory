<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a wire:navigate.hover class="btn icon icon-left btn-lg btn-primary" href="{{ route('sales.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form wire:submit.prevent="save">
                <div class="form-group">
                  <label class="form-label">Transaction Date</label>
                  <input wire:model="transaction_date" class="form-control form-control-lg @error('transaction_date') is-invalid @enderror" type="date" placeholder="Select Transaction Date">
                  @error('transaction_date')
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label">Total Amount</label>
                  <input wire:model="total_amount" class="form-control form-control-lg @error('total_amount') is-invalid @enderror" type="text" placeholder="Total Amount" readonly>
                </div>

                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <form autocomplete="off">
                  <div class="col-12">
                    <div class="row g-3">
                      <div class="col-12 col-lg-3">
                        <input wire:model="batch_code" wire:keydown.enter="focusQuantity" class="form-control form-control-md @error('batch_code') is-invalid @enderror" id="scan_barcode" type="text" placeholder="Scan the Barcode Code" autofocus>
                      </div>
                      <div class="col-12 col-lg-2">
                        <input wire:model="quantity" class="form-control form-control-md @error('quantity') is-invalid @enderror" id="quantity" type="number" placeholder="Your Product Quantity">
                      </div>
                      <div class="col-12 col-md-auto">
                        <a wire:click="addProductList" class="btn btn-md btn-primary">Add To List</a>
                      </div>
                    </div>
                  </div>
                </form>

                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Code</th>
                          <th>Batch Code</th>
                          <th>Name</th>
                          <th>Variant</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Shelf Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($this->productList as $item)
                          <tr>
                            <td>{{ $item['code'] }}</td>
                            <td>{{ $item['batch_code'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['variant'] }}</td>
                            <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $item['shelf_name'] }}</td>
                            <td>
                              <a wire:click="removeProduct({{ $item['product_id'] }})" class="btn icon icon-left btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td class="text-center" colspan="8">No items to display</td>
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
@script
  <script>
    Livewire.on('focus-quantity', function() {
      const quantityInput = document.getElementById('quantity');
      if (quantityInput) {
        quantityInput.focus();
      }
    });
  </script>
@endscript
