<!-- Add -->
<div class="modal fade" id="profile">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Voters Profile</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="fullname" class="col-sm-3 control-label">Fullname</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $voter['fullname']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" value="<?php echo $voter['password']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="course" class="col-sm-3 control-label">Course</label>
            <div class="col-sm-9">
              <input type="course" class="form-control" id="course" name="course" value="<?php echo $voter['course']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Evsu Email</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="email" name="email" value="<?php echo $voter['email']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="studentid" class="col-sm-3 control-label">Student Id</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="studentid" name="studentid" value="<?php echo $voter['studentid']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label for="curr_password" class="col-sm-3 control-label">Current Password:</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="curr_password" name="curr_password" placeholder="input current password to save changes" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i></i> Close</button>
        <button type="submit" class="btn btn-success btn-flat" name="save"><i></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>