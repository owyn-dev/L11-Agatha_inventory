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
              <div class="form-group">
                <label class="form-label">Transaction Date</label>
                <input class="form-control form-control-lg" type="text" value="{{ \Carbon\Carbon::parse($this->sales->transaction_date)->format('Y-m-d') }}" readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Total Amount</label>
                <input class="form-control form-control-lg" type="text" value="{{ 'Rp ' . number_format($this->sales->total_amount, 0, ',', '.') }}" placeholder="Total Amount" readonly>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-detail-sales">
                      <thead>
                        <tr>
                          <th>Code Product</th>
                          <th>Name Product</th>
                          <th>Variant Product</th>
                          <th>Price Product</th>
                          <th>Quantity</th>
                          <th>Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($this->sales->detailSales as $item)
                          <tr>
                            <td>{{ $item->product->code }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->variant->label() }}</td>
                            <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp. {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                          </tr>
                        @endforeach
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
