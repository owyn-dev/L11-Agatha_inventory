<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('inventory.request.create') }}">
                <i class="bi bi-plus"></i>
                Add Data Request Production
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="col-auto">{{ $title }} Datatable</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped" id="table-request-production">
                <thead>
                  <tr>
                    <th>Production Request From</th>
                    <th data-type="date">Production Request Date</th>
                    <th data-type="date">Production Date</th>
                    <th>Status Request</th>
                    <th data-sortable="false">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>user_inventory_01</td>
                    <td>01-01-2024</td>
                    <td>-</td>
                    <td><span class="badge bg-secondary">Waiting for Response</span></td>
                    <td>
                      <a class="btn btn-sm btn-warning" href="{{ route('inventory.request.update') }}"><i class="bi bi-pencil"></i></a>
                      <a class="btn btn-sm btn-danger" href="#"><i class="bi bi-trash"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>user_inventory_01</td>
                    <td>01-01-2024</td>
                    <td>01-01-2024</td>
                    <td><span class="badge bg-warning">In Progress</span></td>
                    <td>
                      <a class="btn icon icon-left btn-sm btn-info" href="{{ route('inventory.request.show') }}"><i class="bi bi-eye"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>user_inventory_01</td>
                    <td>01-01-2024</td>
                    <td>01-01-2024</td>
                    <td><span class="badge bg-warning">Pending Approval</span></td>
                    <td>
                      <a class="btn icon icon-left btn-sm btn-info" href="{{ route('inventory.request.show') }}"><i class="bi bi-eye"></i></a>
                      <a class="btn btn-sm btn-success" href="#"><i class="bi bi-check2-all"></i></a>
                      <a class="btn btn-sm btn-danger" href="{{ route('inventory.request.update-status') }}"><i class="bi bi-x-octagon"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>user_inventory_01</td>
                    <td>01-01-2024</td>
                    <td>01-01-2024</td>
                    <td><span class="badge bg-danger">Rejected</span></td>
                    <td>
                      <a class="btn icon icon-left btn-sm btn-info" href="{{ route('inventory.request.show') }}"><i class="bi bi-eye"></i></a>
                      <a class="btn btn-sm btn-success" href="#"><i class="bi bi-check2-all"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>user_inventory_01</td>
                    <td>01-01-2024</td>
                    <td>01-01-2024</td>
                    <td><span class="badge bg-success">Approved</span></td>
                    <td>
                      <a class="btn icon icon-left btn-sm btn-info" href="{{ route('inventory.request.show') }}"><i class="bi bi-eye"></i></a>
                    </td>
                </tbody>
              </table>
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
      min-width: 1400px !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      initDataTable("table-request-production");
    });
  </script>
@endpush
