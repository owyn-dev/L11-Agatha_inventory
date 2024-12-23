<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('product.create') }}">
                <i class="bi bi-plus"></i>
                Add Data Product
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
              <table class="table table-striped" id="table-product">
                <thead>
                  <tr>
                    <th>Code Product</th>
                    <th>Name Product</th>
                    <th>Variant Product</th>
                    <th>Price Product</th>
                    <th>Expired Day</th>
                    <th>Stock</th>
                    <th data-type="date">Updated At</th>
                    <th data-sortable="false">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>NSR-S-001</td>
                    <td>Nastar</td>
                    <td>Tabung S</td>
                    <td>Rp. 0</td>
                    <td>30</td>
                    <td>0</td>
                    <td>01-12-2024</td>
                    <td>
                      <a class="btn icon icon-left btn-sm btn-info" href="{{ route('product.show') }}"><i class="bi bi-eye"></i></a>
                      <a class="btn icon icon-left btn-sm btn-warning" href="{{ route('product.update') }}"><i class="bi bi-pencil"></i></a>
                      <a class="btn icon icon-left btn-sm btn-danger" href="#"><i class="bi bi-trash"></i></a>
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
      initDataTable("table-product");
    });
  </script>
@endpush
