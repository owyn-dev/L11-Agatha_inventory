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

      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-12 col-md-3">
            <img class="rounded img-fluid" src="https://asset.kompas.com/crops/VnqoA6qVt8W13t9l8ffMTPchAmY=/10x7:1000x667/1200x800/data/photo/2020/10/12/5f840dcab3c2b.jpg" alt="Card image cap" style="height: 22rem; object-fit: cover;">
          </div>
          <div class="col-12 col-md-9">
            <table class="table mb-0">
              <tbody>
                <tr>
                  <td class="col-4 col-md-4 col-lg-4 col-xl-4 col-xxl-2">Code Product</td>
                  <td>NSR-S-001</td>
                </tr>
                <tr>
                  <td>Name Product</td>
                  <td>Nastar</td>
                </tr>
                <tr>
                  <td>Variant Product</td>
                  <td>Tabung S</td>
                </tr>
                <tr>
                  <td>Price Product</td>
                  <td>Rp. 0</td>
                </tr>
                <tr>
                  <td>Expired Day Product</td>
                  <td>30 Day</td>
                </tr>
                <tr>
                  <td>Stock Product</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>Updated At</td>
                  <td>01-12-2024</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </section>
  </div>
</div>
