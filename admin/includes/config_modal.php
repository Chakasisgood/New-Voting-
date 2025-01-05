<!-- Config -->
<div class="modal fade" id="config">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Title</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="title.php">
          <div class="form-group">
            <label class="col-sm-3 control-label">Title</label>

            <div class="col-sm-9">
              <input class="form-control" name="title" required>
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