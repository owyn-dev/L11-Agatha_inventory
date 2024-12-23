<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('inventory.request.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <form action="#">
            <div class="form-group">
              <label class="form-label">Request Date</label>
              <input class="form-control flatpickr" type="date">
            </div>
            <div class="form-group">
              <label class="form-label">Product</label>
              <select class="choices form-select">
                <option value="" selected>Select Your Product</option>
                <option value="Product 001">NSR-S-001 - Nastar - Tabung S</option>
                <option value="Product 002">Product 002</option>
                <option value="Product 003">Product 003</option>
                <option value="Product 004">Product 004</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Quantity</label>
              <input class="form-control" type="number" placeholder="Your Quantity">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save Production Request</button>
            </div>
          </form>
        </div>
      </div>

    </section>
  </div>
</div>

@push('styles-priority')
  <link href="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.css') }}" rel="stylesheet">

  <link href="{{ asset('storage/assets/extensions/choices.js/public/assets/styles/choices.css') }}" rel="stylesheet">
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/flatpickr/flatpickr.min.js') }}"></script>

  <script src="{{ asset('storage/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/form-element-select.js') }}"></script>

  <script>
    flatpickr('.flatpickr', {
      dateFormat: "d-m-Y",
      defaultDate: new Date(),
    })
  </script>
@endpush
