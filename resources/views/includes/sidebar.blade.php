    <!-- Side Navbar -->
    <nav class="side-navbar" id="sidebar">
      <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header d-flex align-items-center justify-content-center">
          <!-- User Info-->
          <div class="sidenav-header-inner text-center">
            <img src="/img/toyota_logo_2.png" alt="..." class="img-fluid" style="width: 169px; height: 59px">
            <br>
            @role('admin')
            <h2 class="h5">TOYOTA MAIN</h2><span>Admin</span>
            @endrole

            @role('dealer')
            <h2 class="h5">{{ auth()->user()->GetDealerInfo()->dealer_name }}</h2><span>Dealer</span>
            @endrole

            @if(auth()->user()->is_admin_level >= 2)
            <h2 class="h5">{{ auth()->user()->username }}</h2>
            @endif
          </div>
          <!-- Small Brand information, appears on minimized sidebar-->
          <div class="sidenav-header-logo"><a href="/s/dashboard" class="brand-small text-center"> <img src="/img/toyota_icon.png" alt="..."></a></div>
        </div>

        <input type="hidden" id="activedet" value="{{ session()->get('activeside') }}" />

        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
          <h5 class="sidenav-heading">Main</h5>
          <ul id="side-main-menu" class="side-menu list-unstyled"> 
            <li><a id="sb-dashboard" href="/s/dashboard"> <i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            @permission(['approve-con-view-all','approve-con-view-list'])
            <li><a id="sb-appcontracts" href="/s/appcontracts"> <i class="fa fa-file-contract"></i>Approved Contracts</a></li>
            @endpermission
            @permission(['contract-view-all','contract-view-list'])
            <li><a id="sb-contracts" href="/s/contracts"> <i class="fa fa-file-text"></i> Line up for Booking</a></li>
            @endpermission
            @permission(['signa-loc-view-list','signa-tfsph-view-list'])
            <li><a id="sb-signatories" href="/s/signatories"> <i class="fa fa-file-signature"></i> Signatories</a></li>
            @endpermission
            @permission('cwriter-encode')
            <li><a id="sb-cheque" href="/s/chequewriter"> <i class="fas fa-pen-nib"></i> Cheque Writer</a></li>
            @endpermission
            @permission('form-temp-view-list')
            <li><a id="sb-ftemplates" href="/s/formtemplates"> <i class="fas fa-file-alt"></i> Form Template</a></li>
            @endpermission

            @permission(['report-gen-appcon', 'report-gen-con'])
            <li><a id="sb-reports" href="/s/reportlist"> <i class="fas fa-file-alt"></i> Reports</a></li>
            @endpermission

            {{-- <li><a id="sb-settings" href="#settingsDropdown" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-cog"></i></i> Settings</a>
              <ul id="settingsDropdown" class="collapse list-unstyled ">
                @role('dealer')
                <li><a id="sb-s-dprofile" href="/s/dealerprofile"><i class="fas fa-cogs"></i> Profile</a></li>
                @endrole
                <li><a id="sb-s-dcpass" href="/s/dchangepass"><i class="fas fa-cogs"></i> Change Password</a></li>
              </ul>
            </li> --}}
          </ul>
            
        </div>
        <br>
        <div class="settings-menu">
          <h5 class="sidenav-heading">Settings</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
              @role('dealer')
              <li><a id="sb-dprofile" href="/s/dealerprofile"><i class="fas fa-user"></i> Profile</a></li>
              @endrole
              @role('admin')
              <li><a id="sb-spolicy" href="/s/policy"><i class="fas fa-cogs"></i> Policy</a></li>
              @endrole
              <li><a id="sb-dcpass" href="/s/dchangepass"><i class="fas fa-cogs"></i> Change Password</a></li>
              @permission('contract-update-con-req')
              <li><a id="sb-conreqs" href="/s/conreqs"><i class="fas fa-cogs"></i> File Requirements</a></li>
              @endpermission
          </ul>
        </div>
        <br>

        @permission(['ulevel3-view-list', 'udealer-view-list', 'vehicle-view-list', 'cm-view-list', 'role-view-list', 'dfees-view-list', 'dfees-tableref-view-list'])
        <div class="list-menu">
          <h5 class="sidenav-heading">List</h5>
          <ul id="side-admin-menu" class="side-menu list-unstyled"> 
            @permission('ulevel3-view-list')
            <li><a id="sb-userlist" href="/s/userlist"> <i class="fas fa-users"></i>Users</a></li>
            @endpermission
            @permission('udealer-view-list')
            <li><a id="sb-dealerlist" href="/s/dealerlist"> <i class="fas fa-users"></i>Dealers</a></li>
            @endpermission
            @permission('vehicle-view-list')
            <li><a id="sb-vehicles" href="/s/vehiclelist"> <i class="fas fa-car"></i>Vehicles</a></li>
            @endpermission
            @permission('cm-view-list')
            <li><a id="sb-citymun" href="/s/citymunlist"> <i class="fas fa-university"></i>City / Municipality</a></li>
            @endpermission
            @permission('role-view-list')
            <li><a id="sb-rolelist" href="/s/rolelist"> <i class="fas fa-tasks"></i>Roles</a></li>
            @endpermission
            @permission(['dfees-view-list','dfees-tableref-view-list'])
            <li><a id="sb-dealerfee" href="/s/dealerfee"> <i class="fas fa-address-card"></i>Dealer Fees</a></li>
            @endpermission
          </ul>
        </div>
        @endpermission


      </div>
    </nav>