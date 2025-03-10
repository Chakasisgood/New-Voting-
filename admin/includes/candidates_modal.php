<!-- Description -->
<div class="modal fade" id="platform">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b><span class="fullname"></span></b></h4>
      </div>
      <div class="modal-body">
        <p id="desc"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Add -->
<div class="modal fade" id="addnew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Add New Candidate</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="candidates_add.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="fullname" class="col-sm-3 control-label">Fullname</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="fullname" name="fullname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="age" class="col-sm-3 control-label">Age</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="age" name="age" required>
            </div>
          </div>
          <div class="form-group">
            <label for="position" class="col-sm-3 control-label">Position</label>

            <div class="col-sm-9">
              <select class="form-control" id="position" name="position" required>
                <option value="" selected>- Select -</option>
                <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $row['id'] . "'>" . $row['description'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="photo" class="col-sm-3 control-label">Profile</label>

            <div class="col-sm-9">
              <input type="file" id="photo" name="photo">
            </div>
          </div>
          <div class="form-group">
            <label for="platform" class="col-sm-3 control-label">Platform</label>

            <div class="col-sm-9">
              <textarea class="form-control" id="platform" name="platform" rows="7"></textarea>
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
        <h4 class="modal-title"><b>Edit Candidate</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="candidates_edit.php">
          <input type="hidden" class="id" name="id">
          <div class="form-group">
            <label for="edit_fullname" class="col-sm-3 control-label">Fullname</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_fullname" name="fullname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_age" class="col-sm-3 control-label">Age</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_age" name="age" required>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_position" class="col-sm-3 control-label">Position</label>

            <div class="col-sm-9">
              <select class="form-control" id="edit_position" name="position" required>
                <option value="" selected id="posselect"></option>
                <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                  echo "
                              <option value='" . $row['id'] . "'>" . $row['description'] . "</option>
                            ";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_platform" class="col-sm-3 control-label">Platform</label>

            <div class="col-sm-9">
              <textarea class="form-control" id="edit_platform" name="platform" rows="7"></textarea>
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
        <form class="form-horizontal" method="POST" action="candidates_delete.php">
          <input type="hidden" class="id" name="id">
          <div class="text-center">
            <p>DELETE CANDIDATE</p>
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

<!-- Add time for voting -->
<div class="modal fade" id="addtime">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Add Date & Time For Voting</b></h4>
        <form class="form-horizontal" action="votingtime.php" method="post">
          <label id="countdown" for="countdown">Set Time for Voting</label>
          <input type="datetime-local" id="countdown" name="countdown" required><br>
          <button class="btn btn-primary btn-sm btn-flat" id="button" type="submit">Start Voting</button>
        </form>
      </div>
    </div>
  </div>
</div>
</div>