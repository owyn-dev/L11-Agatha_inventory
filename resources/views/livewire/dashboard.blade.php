<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Product [Agustus 2024]</h5>
              <h1 class="card-text">0</h1>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total Transaction [Agustus 2024]</h5>
              <h1 class="card-text">0</h1>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Total User</h5>
              <h1 class="card-text">0</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Sales Chart</h4>
            </div>
            <div class="card-body">
              <div id="chart-sales"></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Production Chart</h4>
            </div>
            <div class="card-body">
              <div id="chart-production"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="row justify-content-between">
                  <h4 class="col-auto">Latest Sales</h4>
                  <a class="col-2 btn btn-sm btn-outline-primary" href="{{ route('sales.index') }}">More Info</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-sales">
                    <thead>
                      <tr>
                        <th>User</th>
                        <th data-type="date">Transaction Date</th>
                        <th>Total Product</th>
                        <th>Sub Total</th>
                        <th data-sortable="false">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>User Sales 01</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td>Rp. 50.000</td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Sales 02</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td>Rp. 50.000</td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Sales 03</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td>Rp. 50.000</td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Sales 04</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td>Rp. 50.000</td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Sales 05</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td>Rp. 50.000</td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="card">
              <div class="card-header">
                <div class="row justify-content-between">
                  <h4 class="col-auto">Latest Production</h4>
                  <a class="col-2 btn btn-sm btn-outline-primary" href="{{ route('production.index') }}">More Info</a>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-production">
                    <thead>
                      <tr>
                        <th>Production Request From</th>
                        <th data-type="date">Request Date</th>
                        <th>Total Product</th>
                        <th>Status</th>
                        <th data-sortable="false">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>User Production 01</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td><span class="badge bg-warning">In Progress</span></td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Production 02</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td><span class="badge bg-info">Complete</span></td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Production 03</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td><span class="badge bg-danger">Cancelled</span></td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Production 04</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td><span class="badge bg-info">Complete</span></td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
                      <tr>
                        <td>User Production 05</td>
                        <td>01-12-2024</td>
                        <td>1</td>
                        <td><span class="badge bg-info">Complete</span></td>
                        <td><a class="btn btn-info" href="#"><i class="bi bi-eye"></i></a></td>
                      </tr>
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

@push('styles-priority')
  <link href="{{ asset('storage/assets/extensions/simple-datatables/style.css') }}" rel="stylesheet">
  <link href="{{ asset('storage/assets/compiled/css/table-datatable.css') }}" rel="stylesheet" crossorigin>
@endpush

@push('styles')
  <style>
    .dataTable-table {
      min-width: 650px !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/dashboard.js') }}"></script>

  <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      initDataTable("table-sales");
      initDataTable("table-production");
    });
  </script>
@endpush
