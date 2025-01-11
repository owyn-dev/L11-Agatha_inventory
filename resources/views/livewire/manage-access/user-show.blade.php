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

                <h3 class="mt-3">User Production 01</h3>
                <p class="text-small"><span class="badge bg-primary">Production</span></p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-lg-8">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Full Name</label>
                <input class="form-control" type="text" placeholder="Your Full Name" readonly>
              </div>
              <div class="form-group">
                <label class="form-label">Username</label>
                <input class="form-control" type="text" placeholder="Your Username" readonly>
              </div>
              <div class="form-group">
                <label class="form-label" for="phone">Role</label>
                <input class="form-control" type="text" placeholder="Your Role" readonly>
              </div>

              <div class="form-group">
                <a class="btn btn-primary" href="{{ route('manage-access.user.my-profile.update') }}">Change Your Profile</a>
              </div>
            </div>
          </div>
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
