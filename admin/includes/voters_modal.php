<!-- Add -->
<div class="modal fade" id="addnew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Add New Voter</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="voters_add.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="fullname" class="col-sm-3 control-label">Fullname</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="course" class="col-sm-3 control-label">Course</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="course" name="course" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>

            <div class="col-sm-9">
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="studentid" class="col-sm-3 control-label">Student ID</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="studentid" name="studentid" required>
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>

            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i></i> Close</button>
        <button type="submit" class="btn btn-primary btn-flat" name="add"><i></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Edit Voter</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="voters_edit.php">
          <input type="hidden" class="id" name="id">
          <div class="form-group">
            <label for="edit_fullname" class="col-sm-3 control-label">Fullname</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_fullname" name="fullname">
            </div>
          </div>
          <div class="form-group">
            <label for="edit_course" class="col-sm-3 control-label">Course</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_course" name="course">
            </div>
          </div>
          <div class="form-group">
            <label for="edit_email" class="col-sm-3 control-label">Email</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_email" name="email">
            </div>
          </div>
          <div class="form-group">
            <label for="edit_studentid" class="col-sm-3 control-label">Student ID</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_studentid" name="studentid">
            </div>
          </div>
          <div class="form-group">
            <label for="edit_password" class="col-sm-3 control-label">Password</label>

            <div class="col-sm-9">
              <input type="password" class="form-control" id="edit_password" name="password">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i></i> Close</button>
        <button type="submit" class="btn btn-success btn-flat" name="edit"><i></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Deleting...</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="voters_delete.php">
          <input type="hidden" class="id" name="id">
          <div class="text-center">
            <p>DELETE VOTER</p>
            <h2 class="bold fullname"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i></i> Close</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>