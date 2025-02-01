<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a wire:navigate.hover class="btn icon icon-left btn-lg btn-primary" href="{{ route('inventory.request.index') }}">
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
                  <label class="form-label">Production Request Date</label>
                  <input wire:model="production_request_date" class="form-control form-control-lg @error('production_request_date') is-invalid @enderror" type="date">
                  @error('production_request_date')
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label">Note</label>
                  <input wire:model="note" class="form-control form-control-lg @error('note') is-invalid @enderror" type="text" placeholder="Note">
                  @error('note')
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      {{ $message }}
                    </div>
                  @enderror
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
                <form wire:submit.prevent="addProductList">
                  <div class="col-12">
                    <div class="row g-3">
                      <div class="col-12 col-lg-5">
                        <div wire:ignore>
                          <select wire:model="product" class="form-select select-2 @error('product') is-invalid @enderror">
                            <option value="" selected>Select Product</option>
                            @foreach ($this->products() as $productOption)
                              <option value="{{ $productOption->id }}">{{ $productOption->code }} - {{ $productOption->name }} - {{ $productOption->variant->label() }}</option>
                            @endforeach
                          </select>
                        </div>
                        @error('product')
                          <div class="invalid-feedback d-block">
                            <i class="bx bx-radio-circle"></i>
                            {{ $message }}
                          </div>
                        @enderror
                      </div>

                      <div class="col-12 col-md-3">
                        <input wire:model="quantity_production" class="form-control form-control-md @error('quantity_production') is-invalid @enderror" type="number" placeholder="Quantity">
                        @error('quantity_production')
                          <div class="invalid-feedback d-block">
                            <i class="bx bx-radio-circle"></i>
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="col-12 col-md-2">
                        <input wire:model="shelf_name" class="form-control form-control-md @error('quantity_production') is-invalid @enderror" type="text" placeholder="Shelf Name">
                        @error('shelf_name')
                          <div class="invalid-feedback d-block">
                            <i class="bx bx-radio-circle"></i>
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="col-12 col-md-auto">
                        <button class="btn btn-md btn-primary" type="submit">Add To List</button>
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
                          <th>Stock Produced</th>
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

@push('styles-priority')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
@endPush

@push('styles')
  <style>
    .table {
      min-width: 1000px !important;
    }
  </style>
@endpush

@pushOnce('scripts')
  <script src="{{ asset('storage/assets/extensions/jquery/jquery.min.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endPushOnce

<script data-navigate-once>
  function initPlugins() {
    if (typeof jQuery === 'undefined') {
      setTimeout(initPlugins, 100);
      return;
    }

    $('.select-2').select2({
      theme: 'bootstrap-5',
      width: function() {
        return $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style';
      }
    });

    Livewire.on('select-2', () => {
      $('.select-2').val(null).trigger('change');
    });

    $('.select-2').on('change', function() {
      var data = $(this).val();
      @this.set('product', data);
    });
  }

  document.addEventListener('livewire:navigated', () => {
    initPlugins();
  });

  initPlugins();
</script>
