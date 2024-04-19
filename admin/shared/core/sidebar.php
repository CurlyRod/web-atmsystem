<!-- Sidebar Start -->
  <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../shared/images/desktop.png" width="90" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?php echo isPageActive('dashboard');?>" href="../dashboard" aria-expanded="false">
                <span>
                  <img src="../shared/images/dashboard.png">   
                </span>
                <span class="hide-menu ">Dashboard</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                  <img src="../shared/images/analytics.png">
                </span>
                <span class="hide-menu">Attendance</span>
              </a>
            </li>
             <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Maintenance</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link <?php echo isPageActive('maintenance');?>" href="../maintenance" aria-expanded="false">
                <span>
                   <img src="../shared/images/gear.png">
                </span>
                <span class="hide-menu">Total User</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Reports</span>
            </li> 
            <li class="sidebar-item">
              <a class="sidebar-link" href="#" aria-expanded="false">
                <span>
                  <img src="../shared/images/pie-chart.png">
                </span>
                <span class="hide-menu">Reports</span>
              </a>
            </li>
          </ul>
         
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->