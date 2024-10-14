<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="dashboard.php" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="./assets/images/eaglestar_logo.png" alt="">
              </span>
              
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <li class="menu-item active">
              <a href="products_manage.php" class="menu-link">
                <i class="menu-icon tf-icons bx bxl-product-hunt"></i>
                <div data-i18n="Analytics">Manage Products</div>
              </a>
            </li>
            <li class="menu-item active">
              <a href="orders.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cart-alt"></i>
                <div data-i18n="Analytics">Orders</div>
              </a>
            </li>
            <li class="menu-item active">
              <a href="messages.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-dots"></i>
                <div data-i18n="Analytics">Messages</div>
              </a>
            </li>
            <li class="menu-item active">
              <a href="subscribe.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Subscribers</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">User Account</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Authentications</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="auth-register.php" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Register</div>
                  </a>
                </li>
              </ul>
            </li>


            <li class="menu-item">
              <a
                href="./logOut.php"
                class="menu-link"
              >
                <i class="bx bx-power-off me-2"></i>
                <div data-i18n="Basic">Log Out</div>
              </a>
            </li>
          </ul>
        </aside>