<div>
  <div class="page-heading">
    {{-- Page-Title --}}
    <x-partials.page-title :title="$title" :text_subtitle="$text_subtitle" />
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="col-auto" id="title-datatable">{{ $title }} Datatable</h4>
          </div>
          <div class="card-body">
            <livewire:datatable.inventory-in-table lazy />
          </div>
        </div>
      </div>

    </section>
  </div>
</div>
