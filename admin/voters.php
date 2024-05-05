 <?php include 'includes/session.php'; ?>
 <?php include 'includes/header.php'; ?>
 <?php include 'includes/conn.php'; ?>


 <body class="hold-transition skin-blue sidebar-mini">
   <div class="wrapper">

     <?php include 'includes/navbar.php'; ?>
     <?php include 'includes/menubar.php'; ?>
     <style>
       #button {
         border-radius: 5px;
       }
     </style>

     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
         <h1>
           Voters List
         </h1>
         <ol class="breadcrumb">
           <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <li class="active">Voters</li>
         </ol>
       </section>
       <!-- Main content -->
       <section class="content">
         <?php
          if (isset($_SESSION['error'])) {
            echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
            unset($_SESSION['error']);
          }
          if (isset($_SESSION['success'])) {
            echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
            unset($_SESSION['success']);
          }
          ?>
         <div class="row">
           <div class="col-xs-12">
             <div class="box">
               <div class="box-header with-border">
                 <a href="#addnew" data-toggle="modal" id="button" class="btn btn-primary btn-sm btn-flat">
                   <i></i> New
                 </a>
               </div>
               <div class="box-body">
                 <table id="example1" class="table table-bordered">
                   <thead>
                     <th>Fullname</th>
                     <th>Course</th>
                     <th>EVSU Email</th>
                     <th>Student ID</th>
                     <th>Tools</th>
                   </thead>
                   <tbody>
                     <?php
                      $sql = "SELECT * FROM voters";
                      $query = $conn->query($sql);
                      while ($row = $query->fetch_assoc()) {
                        $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.jpg';
                        echo "
                        <tr>
                          <td>" . $row['fullname'] . "</td>
                          <td>" . $row['course'] . "</td>
                          <td>" . $row['email'] . "</td>
                          <td>" . $row['studentid'] . "</td>
                          <td>
                            <button id='button' class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['id'] . "'><i></i> Edit</button>
                            <button id='button' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i></i> Delete</button>
                          </td>
                        </tr>
                      ";
                      }
                      ?>
                   </tbody>
                 </table>
               </div>
             </div>
           </div>
         </div>
       </section>
     </div>

     <?php include 'includes/footer.php'; ?>
     <?php include 'includes/voters_modal.php'; ?>
   </div>
   <?php include 'includes/scripts.php'; ?>
   <script>
     $(function() {
       $(document).on('click', '.edit', function(e) {
         e.preventDefault();
         $('#edit').modal('show');
         var id = $(this).data('id');
         getRow(id);
       });

       $(document).on('click', '.delete', function(e) {
         e.preventDefault();
         $('#delete').modal('show');
         var id = $(this).data('id');
         getRow(id);
       });

     });

     function getRow(id) {
       $.ajax({
         type: 'POST',
         url: 'voters_row.php',
         data: {
           id: id
         },
         dataType: 'json',
         success: function(response) {
           $('.id').val(response.id);
           $('#edit_fullname').val(response.fullname);
           $('#edit_course').val(response.course);
           $('#edit_email').val(response.email);
           $('#edit_studentid').val(response.studentid);
           $('#edit_password').val(response.password);
           $('.fullname').html(response.fullname + ' , ' + response.course + ' , ' + response.email + ' , ' + response.studentid);
         }
       });
     }
   </script>
 </body>

 </html>