<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Product</h5>
              <h1 class="card-text">{{ $this->totalProducts }}</h1>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Transaction [{{ \Carbon\Carbon::parse($this->currentMonth)->format('F') }} {{ $this->currentYear }}]</h5>
              <h1 class="card-text">{{ $this->totalTransactions }}</h1>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total User</h5>
              <h1 class="card-text">{{ $this->totalUsers }}</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Sales Chart [{{ $this->currentYear }}]</h4>
            </div>
            <div class="card-body">
              <div id="chart-sales"></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Production Chart [{{ $this->currentYear }}]</h4>
            </div>
            <div class="card-body">
              <div id="chart-production"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row justify-content-between">
                <h4 class="col-auto">Latest Sales</h4>
                <a wire:navigate.hover class="col-3 btn btn-sm btn-outline-primary" href="{{ route('sales.index') }}">More Info</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Transaction Date</th>
                      <th>Total Product</th>
                      <th>Sub Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($this->latestSales as $sale)
                      <tr>
                        <td>{{ $sale->salesUser->full_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($sale->transaction_date)->format('Y-m-d') }}</td>
                        <td>{{ $sale->detail_sales_count }}</td>
                        <td>Rp. {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                        <td><a wire:navigate.hover class="btn btn-info" href="{{ route('sales.show', $sale->id) }}"><i class="bi bi-eye"></i></a></td>
                      </tr>
                    @empty
                      <tr>
                        <td class="text-center" colspan="5">No Data Available</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row justify-content-between">
                <h4 class="col-auto">Latest Production</h4>
                <a wire:navigate.hover class="col-3 btn btn-sm btn-outline-primary" href="{{ route('production.index') }}">More Info</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Production Request From</th>
                      <th>Request Date</th>
                      <th>Total Product</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($this->latestProductions as $production)
                      <tr>
                        <td>{{ $production->inventoryUser->full_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($production->production_request_date)->format('Y-m-d') }}</td>
                        <td>{{ $production->detail_productions_count }}</td>
                        <td><span class="badge {{ $production->status->getBadgeClass() }}">{{ $production->status->label() }}</span></td>
                        <td><a wire:navigate.hover class="btn btn-info" href="{{ route('production.show', $production->id) }}"><i class="bi bi-eye"></i></a></td>
                      </tr>
                    @empty
                      <tr>
                        <td class="text-center" colspan="5">No Data Available</td>
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
      min-width: 680px !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      let chartSales, chartProduction;

      function formatRupiah(value) {
        return new Intl.NumberFormat("id-ID", {
          style: "currency",
          currency: "IDR",
          minimumFractionDigits: 0,
        }).format(value);
      }

      function renderCharts() {
        setTimeout(() => {
          let salesEl = document.querySelector("#chart-sales");
          let productionEl = document.querySelector("#chart-production");

          if (!salesEl || !productionEl) {
            console.warn("Chart container not found, retrying...");
            return;
          }

          if (chartSales) chartSales.destroy();
          if (chartProduction) chartProduction.destroy();

          var optionsChartSales = {
            chart: {
              type: "bar",
              height: 300
            },
            series: [{
              name: "Sales",
              data: @json(array_values($this->salesChartData->toArray()))
            }],
            colors: "#435ebe",
            xaxis: {
              categories: @json(array_keys($this->salesChartData->toArray()))
            },
            yaxis: {
              labels: {
                formatter: value => formatRupiah(value)
              }
            },
            tooltip: {
              y: {
                formatter: value => formatRupiah(value)
              }
            },
            dataLabels: {
              enabled: false
            }
          };

          var optionsChartProduction = {
            chart: {
              type: "bar",
              height: 300
            },
            series: [{
              name: "Production",
              data: @json(array_values($this->productionChartData->toArray()))
            }],
            colors: "#f59e0b",
            xaxis: {
              categories: @json(array_keys($this->productionChartData->toArray()))
            },
            yaxis: {
              labels: {
                formatter: value => value
              }
            },
            tooltip: {
              y: {
                formatter: value => value
              }
            },
            dataLabels: {
              enabled: false
            }
          };

          chartSales = new ApexCharts(salesEl, optionsChartSales);
          chartProduction = new ApexCharts(productionEl, optionsChartProduction);

          chartSales.render();
          chartProduction.render();
        }, 300);
      }

      renderCharts();

      // Memastikan chart dirender setelah Livewire selesai memuat konten
      document.addEventListener("livewire:load", function() {
        renderCharts();
      });

      // Event tambahan untuk Livewire navigasi
      document.addEventListener("livewire:navigated", function() {
        renderCharts();
      });

      // Pastikan chart tetap dirender jika ada update Livewire yang mempengaruhi chart
      Livewire.on('contentLoaded', function() {
        renderCharts();
      });
    });
  </script>
@endpush
