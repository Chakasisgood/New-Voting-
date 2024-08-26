<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand"><b>Biometric Voting System</a>
      </div>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo (!empty($voter['photo'])) ? 'images/' . $voter['photo'] : 'images/profile.jpg' ?>" class="user-image" alt="User Image">
              <span><?php echo $voter['fullname'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#profile" data-toggle="modal" class='btn btn-success btn-sm btn-flat' id="admin_profile">Update</a>
                </div> -->
                <div class="pull-right">
                  <a id="logoutButton" class='btn btn-danger btn-sm btn-flat'>Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>