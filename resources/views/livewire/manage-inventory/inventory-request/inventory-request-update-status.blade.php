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
              <form wire:submit.prevent="edit">
                <div class="form-group">
                  <label class="form-label">Production Request Date</label>
                  <input class="form-control form-control-lg" type="text" value="{{ \Carbon\Carbon::parse($this->production->production_request_date)->format('Y-m-d') }}" readonly>
                </div>
                <div class="form-group">
                  <label class="form-label">Note <span class="text-danger">*</span></label>
                  <input wire:model="note" class="form-control form-control-lg @error('note') is-invalid @enderror" type="text" placeholder="Note">
                  <small class="form-text text-primary">Provide a reason why the product was rejected</small>
                  @error('note')
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
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
                          </tr>
                        @empty
                          <tr>
                            <td class="text-center" colspan="7">No items to display</td>
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
