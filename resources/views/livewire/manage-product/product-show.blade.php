<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a wire:navigate.hover class="btn icon icon-left btn-lg btn-primary" href="{{ route('product.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-12 col-md-2">
            <img class="rounded img-fluid" src="{{ asset('storage/images/' . $this->product->image) }}" alt="Card image cap" style="height: 22rem; object-fit: cover;">
          </div>
          <div class="col-12 col-md-9">
            <table class="table mb-0">
              <tbody>
                <tr>
                  <td class="col-4 col-md-4 col-lg-4 col-xl-4 col-xxl-2">Code Product</td>
                  <td>{{ $this->product->code }}</td>
                </tr>
                <tr>
                  <td>Name Product</td>
                  <td>{{ $this->product->name }}</td>
                </tr>
                <tr>
                  <td>Variant Product</td>
                  <td>{{ $this->product->variant->label() }}</td>
                </tr>
                <tr>
                  <td>Price Product</td>
                  <td>Rp. {{ number_format($this->product->price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                  <td>Expired Day Product</td>
                  <td>{{ $this->product->expired_day }} Day</td>
                </tr>
                <tr>
                  <td>Stock Product</td>
                  <td>{{ $this->product->stock }}</td>
                </tr>
                <tr>
                  <td>Updated At</td>
                  <td>{{ $this->product->updated_at }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>
  </div>
</div>
