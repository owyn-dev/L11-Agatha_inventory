<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a class="btn icon icon-left btn-lg btn-primary" href="{{ route('product.index') }}">
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
              <label class="form-label">Code Product</label>
              <input class="form-control" type="text" placeholder="Your Code Product">
            </div>
            <div class="form-group">
              <label class="form-label">Name Product</label>
              <input class="form-control" type="text" placeholder="Your Name Product">
            </div>
            <div class="form-group">
              <label class="form-label">Image Product</label>
              <input class="form-control" type="file">
            </div>
            <div class="form-group">
              <label class="form-label" for="phone">Variant</label>
              <select class="choices form-select">
                <option value="" selected>Select Your Variant</option>
                <option value="Tabung S">Tabung S</option>
                <option value="Tabung M">Tabung M</option>
                <option value="Kotak">Kotak</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Price Product</label>
              <input class="form-control" type="number" placeholder="Your Price Product">
            </div>
            <div class="form-group">
              <label class="form-label">Expired Day</label>
              <input class="form-control" type="number" placeholder="Expired Day">
            </div>

            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save Product</button>
            </div>
          </form>
        </div>
      </div>

    </section>
  </div>
</div>

@push('styles-priority')
  <link href="{{ asset('storage/assets/extensions/choices.js/public/assets/styles/choices.css') }}" rel="stylesheet">
@endpush

@push('scripts')
  <script src="{{ asset('storage/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
  <script src="{{ asset('storage/assets/static/js/pages/form-element-select.js') }}"></script>
@endpush
