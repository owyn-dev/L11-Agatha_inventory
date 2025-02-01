<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a wire:navigate.hover class="btn icon icon-left btn-lg btn-primary" href="{{ route('production.request') }}">
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
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-label">Production Request From</label>
                      <input class="form-control form-control-lg" type="text" value="{{ $this->production->inventoryUser->full_name }}" readonly>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label class="form-label">Production Request Date</label>
                      <input class="form-control form-control-lg" type="text" value="{{ \Carbon\Carbon::parse($this->production->production_request_date)->format('Y-m-d') }}" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Production Date</label>
                  <input wire:model="production_date" class="form-control form-control-lg @error('production_date') is-invalid @enderror" type="date" placeholder="Select Production Date">
                  @error('production_date')
                    <div class="invalid-feedback">
                      <i class="bx bx-radio-circle"></i>
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label">Production Status</label>
                  <select wire:model="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="">Select Status</option>
                    @foreach ($this->statusProduction() as $statusOption)
                      <option value="{{ $statusOption->value }}">
                        {{ ucwords(str_replace('_', ' ', $statusOption->value)) }}
                      </option>
                    @endforeach
                  </select>
                  @error('status')
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
                  <button class="btn btn-primary" type="submit">Make Production</button>
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
