<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add New Course</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="courses_add.php">
                    <div class="form-group">
                        <label for="courses" class="col-sm-3 control-label">Course</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="courses" name="courses" required>
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
                <h4 class="modal-title"><b>Edit Courses</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="courses_edit.php">
                    <div class="form-group">
                        <label for="edit_course" class="col-sm-3 control-label">Course</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_course" name="courses" required>
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
                <form class="form-horizontal" method="POST" action="courses_delete.php">
                    <input type="hidden" class="id" name="id">
                    <div class="text-center">
                        <p>DELETE THIS COURSE</p>
                        <h2 class="bold description"></h2>
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