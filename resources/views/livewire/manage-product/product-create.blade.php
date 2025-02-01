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

      <div class="card">
        <div class="card-body">
          <form wire:submit="save">
            <div class="form-group">
              <label class="form-label">Code Product</label>
              <input wire:model="form.code" class="form-control @error('form.code') is-invalid @enderror" type="text" autofocus>
              @error('form.code')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label">Name Product</label>
              <input wire:model="form.name" class="form-control @error('form.name') is-invalid @enderror" type="text">
              @error('form.name')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="phone">Variant</label>
              <select wire:model="form.variant" class="form-select @error('form.variant') is-invalid @enderror">
                <option value="" selected>Select Variant</option>
                @foreach ($this->variantProduct() as $variantOption)
                  <option value="{{ $variantOption->value }}">
                    {{ ucwords(str_replace('_', ' ', $variantOption->value)) }}
                  </option>
                @endforeach
              </select>
              @error('form.variant')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label">Price Product</label>
              <input wire:model="form.price" class="form-control @error('form.price') is-invalid @enderror" type="number">
              @error('form.price')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label">Expired Day</label>
              <input wire:model="form.expired_day" class="form-control @error('form.expired_day') is-invalid @enderror" type="number">
              @error('form.expired_day')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label">Image Product <div wire:loading wire:target="form.image" class="text-danger">Uploading...</div></label>
              <input wire:model="form.image" class="form-control @error('form.image') is-invalid @enderror" type="file">
              @error('form.image')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save</button>
            </div>
          </form>
        </div>
      </div>

    </section>
  </div>
</div>
