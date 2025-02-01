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
                  <div class="col-12 col-md-auto">
                    <button class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary" type="submit">
                      <i class="bi bi-journal-bookmark"></i> Generate Production Report
                    </button>
                  </div>
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
                      <th>Batch Code Production</th>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Variant</th>
                      <th>Production Date</th>
                      <th>Expiration Date</th>
                      <th>Stock Produced</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($reports as $report)
                      @foreach ($report->detailProductions as $detail)
                        <tr>
                          <td>{{ $detail->batch_code }}</td>
                          <td>{{ $detail->product->code }}</td>
                          <td>{{ $detail->product->name }}</td>
                          <td>{{ $detail->product->variant->label() }}</td>
                          <td>{{ \Carbon\Carbon::parse($report->production_date)->format('Y-m-d') }}</td>
                          <td>{{ \Carbon\Carbon::parse($report->production_date)->addDays($detail->product->expired_day)->format('Y-m-d') }}</td>
                          <td>{{ $detail->quantity }}</td>
                        </tr>
                      @endforeach
                    @empty
                      <tr>
                        <td class="text-center" colspan="7">No Data Available</td>
                      </tr>
                    @endforelse
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

@push('styles')
  <style>
    .table {
      min-width: 1000px !important;
    }
  </style>
@endpush
