<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form wire:submit.prevent="loadResults">
                <div class="row g-3">
                  <div class="col-12 col-md-auto">
                    <input wire:model="date_start" class="form-control form-control-lg @error('date_start') is-invalid @enderror" type="date" placeholder="Select Start Date">
                  </div>
                  <div class="col-12 col-md-auto">
                    <input wire:model="date_end" class="form-control form-control-lg @error('date_end') is-invalid @enderror" type="date" placeholder="Select End Date">
                  </div>
                  <button class="col-12 col-md-auto btn icon icon-left btn-lg btn-primary" type="submit">
                    <i class="bi bi-calculator"></i> Product Priority Analysis
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
              @if ($results)
                <div class="col-12 my-2">
                  <button wire:click.prevent="exportPdf" class="col-12 col-md-auto btn icon icon-left btn-md btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                  </button>
                </div>
              @endif

              <input wire:model.live.debounce.500ms="search" class="form-control" type="text" placeholder="Search">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th wire:click="sortBy('code')" style="cursor: pointer;">
                        Code Product
                        @if ($sortField === 'code')
                          <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                      </th>
                      <th wire:click="sortBy('product')" style="cursor: pointer;">
                        Name
                        @if ($sortField === 'product')
                          <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                      </th>
                      <th wire:click="sortBy('variant')" style="cursor: pointer;">
                        Variant
                        @if ($sortField === 'variant')
                          <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                      </th>
                      <th wire:click="sortBy('percentage_quantity')" style="cursor: pointer;">
                        Percentage of Amount
                        @if ($sortField === 'percentage_quantity')
                          <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                      </th>
                      <th wire:click="sortBy('percentage_sales')" style="cursor: pointer;">
                        Percentage of Sales
                        @if ($sortField === 'percentage_sales')
                          <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                      </th>
                      <th wire:click="sortBy('total_percentage')" style="cursor: pointer;">
                        Total Percentage
                        @if ($sortField === 'total_percentage')
                          <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                      </th>
                      <th wire:click="sortBy('classification')" style="cursor: pointer;">
                        Priority Group
                        @if ($sortField === 'classification')
                          <i class="bi bi-chevron-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                        @endif
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($results as $result)
                      <tr>
                        <td>{{ $result['code'] }}</td>
                        <td>{{ $result['product'] }}</td>
                        <td>{{ $result['variant'] }}</td>
                        <td>{{ $result['percentage_quantity'] }}%</td>
                        <td>{{ $result['percentage_sales'] }}%</td>
                        <td>{{ $result['total_percentage'] }}%</td>
                        <td>
                          <span class="{{ $result['badge_class'] }}">{{ $result['classification'] }}</span>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td class="text-center" colspan="7">No data available</td>
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
