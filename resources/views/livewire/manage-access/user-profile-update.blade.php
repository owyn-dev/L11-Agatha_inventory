<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">

        <div class="col-12 col-lg-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-center align-items-center flex-column">
                <div class="avatar avatar-2xl">
                  <img src="{{ asset('storage/assets/compiled/jpg/2.jpg') }}" alt="Avatar">
                </div>

                <h3 class="mt-3">{{ $this->user->full_name }}</h3>
                <p class="text-small"><span class="badge bg-primary">{{ $this->user->roles->first()->name }}</span></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-8">
          <div class="card">
            <div class="card-body">
              <form wire:submit="edit" method="POST">
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
                  <label class="form-label" for="password ">New Password</label>
                  <input wire:model="form.password" class="form-control @error('form.password') is-invalid @enderror" type="password" placeholder="Enter New Password">
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
                  <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </section>
  </div>
</div>
