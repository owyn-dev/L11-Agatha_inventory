<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <a wire:navigate class="btn icon icon-left btn-lg btn-primary" href="{{ route('manage-access.user.index') }}">
                <i class="bi bi-arrow-left"></i>
                Back
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <form wire:submit="save" method="POST">
            <div class="form-group">
              <label class="form-label">Full Name</label>
              <input wire:model="form.full_name" class="form-control @error('form.full_name') is-invalid @enderror" type="text" placeholder="Your Full Name">
              @error('form.full_name')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label">Username</label>
              <input wire:model="form.username" class="form-control @error('form.username') is-invalid @enderror" type="text" placeholder="Your Username">
              @error('form.username')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="phone">Role</label>
              <select wire:model="form.role" class="form-select @error('form.role') is-invalid @enderror">
                <option value="" disabled selected>Select Your Role</option>
                @foreach ($this->roles as $name)
                  <option value="{{ $name }}">{{ $name }}</option>
                @endforeach
              </select>
              @error('form.role')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="password">Password</label>
              <input wire:model="form.password" class="form-control @error('form.password') is-invalid @enderror" type="password" placeholder="Enter Password">
              @error('form.password')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label class="form-label" for="confirm_password">Confirm Password</label>
              <input wire:model="form.password_confirmation" class="form-control @error('form.password') is-invalid @enderror" type="password" placeholder="Enter Confirm Password">
              @error('form.password_confirmation')
                <div class="invalid-feedback">
                  <i class="bx bx-radio-circle"></i>
                  {{ $message }}
                </div>
              @enderror
            </div>

            <div class="form-group">
              <button class="btn btn-primary" type="submit">Save User</button>
            </div>
          </form>
        </div>
      </div>

    </section>
  </div>
</div>
