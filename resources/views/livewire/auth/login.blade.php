<div class="row h-100">
  <div class="col-lg-5 col-12">
    <div id="auth-left">
      <h1 class="auth-title">Log in.</h1>
      <p class="auth-subtitle mb-5">Log in with your data user.</p>

      <form wire:submit="login" method="POST">
        <div class="form-group position-relative has-icon-left mb-4">
          <input wire:model="username" class="form-control form-control-xl @error('username') is-invalid @enderror" type="text" placeholder="Username">
          <div class="form-control-icon">
            <i class="bi bi-person"></i>
          </div>
          @error('username')
            <div class="invalid-feedback">
              <i class="bx bx-radio-circle"></i>
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
          <input wire:model="password" class="form-control form-control-xl @error('password') is-invalid @enderror" type="password" placeholder="Password">
          <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
          @error('password')
            <div class="invalid-feedback">
              <i class="bx bx-radio-circle"></i>
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-check form-check-lg d-flex align-items-end">
          <input class="form-check-input me-2" id="flexCheckDefault" type="checkbox" value="">
          <label class="form-check-label text-gray-600" for="flexCheckDefault">
            Keep me logged in
          </label>
        </div>
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
      </form>
    </div>
  </div>
  <div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right">

    </div>
  </div>
</div>
