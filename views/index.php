<?php
session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("../config/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id']) && isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    header('Content-Type: application/json');

    $deleteId = $_POST['delete_id'];

    $stmt = $con->prepare("DELETE FROM student WHERE id = ?");
    $stmt->bind_param("i", $deleteId);
    $deleteResult = $stmt->execute();

    if ($deleteResult) {
        echo json_encode([
            'status' => 'success',
            'message' => 'User deleted successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to delete the user. Please try again.'
        ]);
    }

    $stmt->close();
    exit();
}

$result = mysqli_query($con, "SELECT * FROM student ORDER BY id DESC");
?>

<?php
include("header.php");
include("sidebar.php");?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item">Student List</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Student Details</h3>
              <a href="create.php" class="btn btn-primary px-4 float-right">Add Student</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-center">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Profile Image</th>
                    <th>Gender</th>
                    <th>Language</th>
                    <th>Subject</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($res = mysqli_fetch_assoc($result)): ?>
                      <tr id="user-row-<?= htmlspecialchars($res['id']) ?>">
                        <td><?= htmlspecialchars($res['id']) ?></td>
                        <td><?= htmlspecialchars($res['firstname']) ?> - <?= htmlspecialchars($res['lastname']) ?></td>
                        <td><?= htmlspecialchars($res['email']) ?></td>
                        <td>
                          <?php if (!empty($res['image_path'])): ?>
                            <img src="<?= htmlspecialchars($res['image_path']) ?>" alt="Profile Picture" style="width:50px; height:auto; object-fit:cover;" />
                          <?php else: ?>
                            <img src="./uploads/default.png" alt="No Profile Picture" style="width:50px; height:auto; object-fit:cover;" />
                          <?php endif; ?>
                        </td>
                        <td>
                          <?php
                            $gender = $res['gender'];
                            if ($gender === 'male') {
                              echo "<span class='badge badge-info text-sm'>Male</span>";
                            } elseif ($gender === 'female') {
                              echo "<span class='badge badge-danger text-sm'>Female</span>";
                            } else {
                              echo "<span class='badge badge-secondary text-sm'>Other</span>";
                            }
                          ?>
                        </td>
                        <td><?= htmlspecialchars($res['languages']) ?></td>
                        <td><?= htmlspecialchars($res['subjects']) ?></td>
                        <td>
                          <button class="btn btn-sm btn-warning editUserBtn" data-id="<?= htmlspecialchars($res['id']) ?>"><i class="fas fa-edit"></i></button>
                          <button class="ajaxDeleteBtn btn btn-sm btn-danger" data-id="<?= htmlspecialchars($res['id']) ?>"><i class="fa fa-trash"></i></button>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr><td colspan="8" class="text-center">No users found.</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
      <!-- Modal for Editing Student -->
  <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title text-white"><i class="fas fa-edit mr-2"></i> Edit User</h5>
          <button type="button" class="close text-white" data-dismiss="modal"><span style="font-size:22px;">&times;</span></button>
        </div>
        <div class="modal-body p-3" id="editStudentContent">
          <div class="text-center text-muted">Loading...</div>
        </div>
      </div>
    </div>
  </div>
  </section>
</div>

<?php include_once("footer.php"); ?>

<script>
$(document).on('click', '.ajaxDeleteBtn', function () {
    const studentId = $(this).data('id');
    
    if (!confirm('Are you sure you want to delete this student?')) return;

    $.ajax({
        url: 'index.php',
        type: 'POST',
        data: { delete_id: studentId },
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        success: function (res) {
            if (res.status === 'success') {
                toastr.success(res.message);
                $('#user-row-' + studentId).fadeOut(800, function () { 
                    $(this).remove(); 
                });
            } else {
                toastr.error(res.message);
            }
        },
        error: function () {
            toastr.error('An error occurred while deleting the student.');
        }
    });
});

$(document).on('click', '.editUserBtn', function () {
  const studentId = $(this).data('id');
  $('#editStudentModal').modal('show');
  $('#editStudentContent').html('<div class="text-center text-muted">Loading...</div>');

  $.ajax({
    url: 'edit.php',
    type: 'GET',
    data: { id: studentId },
    success: function (data) {
      $('#editStudentContent').html(data);
    },
    error: function () {
      $('#editStudentContent').html('<div class="text-danger text-center">Failed to load content.</div>');
    }
  });
});



</script>



