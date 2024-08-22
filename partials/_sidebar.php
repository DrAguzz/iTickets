<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <div class="d-flex sidebar-profile">
              <!-- <div class="sidebar-profile-image">
                <img src="../images/user.png" alt="image" class="bg-white">
              </div> -->
              <div class="sidebar-profile-name">
                <p class="sidebar-name">
                  <?=$fetchAcc['name']?>
                </p>
                <p class="sidebar-designation">
                  Selamat Datang
                </p>
              </div>
            </div>
            <p class="sidebar-menu-title">Menu</p>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="typcn typcn-th-large-outline menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="typcn typcn-ticket menu-icon"></i>
              <span class="menu-title">Tiket</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="buyticket.php">Beli Tiket</a></li>
                <li class="nav-item"><a class="nav-link" href="detailticket.php">Semak Pembelian</a></li>
              </ul>
            </div>
          </li>
          <?php
          if($fetchAcc['role'] != '0'){
          ?>
          <p class="sidebar-menu-title">Pengurusan</p>
          <li class="nav-item">
            <a class="nav-link" href="listbuyer.php">
              <i class="typcn typcn-th-list-outline menu-icon"></i>
              <span class="menu-title">Senarai Penumpang</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="typcn typcn-input-checked-outline menu-icon"></i>
              <span class="menu-title">Pengesahan Tiket</span>
            </a>
          </li>
          <?php
          }
          ?>
          <p class="sidebar-menu-title">Tetapan</p>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">
              <i class="typcn typcn-user-outline menu-icon"></i>
              <span class="menu-title">Profil</span>
            </a>
          </li>
        </ul>
        <!-- <ul class="sidebar-legend">
          <li>
            <p class="sidebar-menu-title">Category</p>
          </li>
          <li class="nav-item"><a href="#" class="nav-link">#Sales</a></li>
          <li class="nav-item"><a href="#" class="nav-link">#Marketing</a></li>
          <li class="nav-item"><a href="#" class="nav-link">#Growth</a></li>
        </ul> -->
      </nav>