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
              <input class="form-control" type="text" value="01-12-2024" readonly>
            </div>
            <div class="form-group">
              <label class="form-label">Product</label>
              <input class="form-control" type="text" value="NSR-S-001 - Nastar - Tabung S" readonly>
            </div>
            <div class="form-group">
              <label class="form-label">Quantity</label>
              <input class="form-control" type="text" value="0" readonly>
            </div>
            <div class="form-group">
              <label class="form-label">Note</label>
              <input class="form-control" type="number" placeholder="Your Note">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save Changes</button>
            </div>
          </form>
        </div>
      </div>

    </section>
  </div>
</div>
