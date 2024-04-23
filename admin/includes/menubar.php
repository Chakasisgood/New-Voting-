<style>
  .side-bar {
    background-color: #226dbd;
    font-size: 1.5rem;
    font-weight: bold;
    outline: 0.1px solid black;
  }

  .header {
    font-size: 1.2rem;

  }
</style>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <i class="fa fa-user" alt="User Image"></i>
      </div>
      <div class="pull-left info">
        <p><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>

      <li class="side-bar"><a href="home.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
      <li class="side-bar"><a href="ballot.php"><i class="fa fa-file-text"></i><span>Ballot</span></a></li>
      <li class="side-bar"><a href="votes.php"><i class="fa fa-check-circle"></i><span></span> <span>Cast Votes</span></a></li>
      <li class="header">MANAGE</li>
      <li class="side-bar"><a href="positions.php"><i class="fa fa-file-powerpoint-o"></i><span>Add Positions</span></a></li>
      <li class="side-bar"><a href="candidates.php"><i class="fa fa-user-md"></i><span>Add Candidates</span></a></li>
      <li class="side-bar"><a href="voters.php"><i class="fa fa-user-plus"></i><span>Add Voters</span></a></li>
      <li class="side-bar"><a href="#config" data-toggle="modal"><i class="fa fa-text-width"></i> <span>Election Title</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>