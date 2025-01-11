<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
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
              <table class="table table-striped" id="table-production">
                <thead>
                  <tr>
                    <th>Production Request From</th>
                    <th data-type="date">Production Request Date</th>
                    <th data-type="date">Production Date</th>
                    <th>Production Status</th>
                    <th>Note</th>
                    <th data-sortable="false">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>user_production_01</td>
                    <td>01-12-2024</td>
                    <td>01-12-2024</td>
                    <td><span class="badge bg-info">Complete</span></td>
                    <td>-</td>
                    <td>
                      <a class="btn icon icon-left btn-sm btn-info" href="{{ route('production.show') }}"><i class="bi bi-eye"></i></a>
                      <a class="btn icon icon-left btn-sm btn-warning" href="{{ route('production.update') }}"><i class="bi bi-pencil"></i></a>
                    </td>
                  </tr>
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
      min-width: 1200px !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/simple-datatables.js') }}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      initDataTable("table-production");
    });
  </script>
@endpush
