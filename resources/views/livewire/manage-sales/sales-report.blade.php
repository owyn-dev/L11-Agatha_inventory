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
                    <i class="bi bi-journal-bookmark"></i> Generate Sales Report
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h4 class="col-auto">{{ $title }} Datatable</h4>
            </div>
            <div class="card-body">
              @if ($reports)
                <div class="col-12 col-md-auto">
                  <button wire:click.prevent="exportPDF" class="col-12 col-md-auto btn icon icon-left btn-md btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                  </button>
                </div>
              @endif
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Transaction Date</th>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Variant</th>
                      <th>Price Product</th>
                      <th>Quantity</th>
                      <th>Total Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($reports as $report)
                      @foreach ($report->detailSales as $detail)
                        <tr>
                          <td>{{ \Carbon\Carbon::parse($report->transaction_date)->format('Y-m-d') }}</td>
                          <td>{{ $detail->product->code }}</td>
                          <td class="text-start">{{ $detail->product->name }}</td>
                          <td>{{ $detail->product->variant->label() }}</td>
                          <td>{{ number_format($detail->price, 0, ',', '.') }}</td>
                          <td>{{ $detail->quantity }}</td>
                          <td>{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                        </tr>
                      @endforeach
                    @empty
                      <tr>
                        <td colspan="7">No Data Available</td>
                      </tr>
                    @endforelse
                    @if ($reports)
                      <tr>
                        <td style="text-align: right; font-weight: bold;" colspan="6"></td>
                        <td style="font-weight: bold;">{{ number_format($totalAmount, 0, ',', '.') }}</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
