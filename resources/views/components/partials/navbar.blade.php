<nav class="navbar navbar-expand navbar-light navbar-top">
  <div class="container-fluid">
    <a class="burger-btn d-block" href="#">
      <i class="bi bi-justify fs-3"></i>
    </a>

    <button data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-lg-0">
        <li class="nav-item dropdown me-3">
          <a data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false" class="nav-link active dropdown-toggle text-gray-600" href="#">
            <i class='bi bi-bell bi-sub fs-4'></i>
            <span class="badge badge-notification bg-danger">7</span>
          </a>
          <ul aria-labelledby="dropdownMenuButton" class="dropdown-menu dropdown-center  dropdown-menu-sm-end notification-dropdown">
            <li class="dropdown-header">
              <h6>Notifications</h6>
            </li>
            <li class="dropdown-item notification-item">
              <a class="d-flex align-items-center" href="#">
                <div class="notification-icon bg-primary">
                  <i class="bi bi-cart-check"></i>
                </div>
                <div class="notification-text ms-4">
                  <p class="notification-title font-bold">Successfully check out</p>
                  <p class="notification-subtitle font-thin text-sm">Order ID #256</p>
                </div>
              </a>
            </li>
            <li class="dropdown-item notification-item">
              <a class="d-flex align-items-center" href="#">
                <div class="notification-icon bg-success">
                  <i class="bi bi-file-earmark-check"></i>
                </div>
                <div class="notification-text ms-4">
                  <p class="notification-title font-bold">Homework submitted</p>
                  <p class="notification-subtitle font-thin text-sm">Algebra math homework</p>
                </div>
              </a>
            </li>
            <li>
              <p class="text-center py-2 mb-0"><a href="#">See all notification</a></p>
            </li>
          </ul>
        </li>
      </ul>
      <div class="dropdown">
        <a data-bs-toggle="dropdown" aria-expanded="false" href="#">
          <div class="user-menu d-flex">
            <div class="user-name text-end me-3">
              <h6 class="mb-0 text-gray-600">John Ducky</h6>
              <p class="mb-0 text-sm text-gray-600">Administrator</p>
            </div>
          </div>
        </a>
        <ul aria-labelledby="dropdownMenuButton" class="dropdown-menu dropdown-menu-end" style="min-width: 11rem;">
          <li><a class="dropdown-item" href="{{ route('manage-access.user.show') }}"><i class="icon-mid bi bi-person me-2"></i> My Profile</a></li>
          <li><a class="dropdown-item" href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
