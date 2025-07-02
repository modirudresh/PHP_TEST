<?php
include_once("createAction.php");
include_once("header.php");
include_once("sidebar.php");


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<!-- Content Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add New Student</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php">Student List</a></li>
          <li class="breadcrumb-item active">Add New Student</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main Content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <!-- Form Card -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add New Student Details</h3>
          </div>

          <!-- Form Start -->
        <form id="studentForm" enctype="multipart/form-data">
          <div class="card-body">

              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="firstname">First Name <span class="text-danger">*</span></label>
                  <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter first name">
                </div>
                <div class="form-group col-lg-6">
                  <label for="lastname">Last Name <span class="text-danger">*</span></label>
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter last name">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-lg-6">
                  <label for="email">Email Address <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                </div>
                <div class="form-group col-lg-6">
                  <label for="profileImage">Profile Image <span class="text-danger">*</span></label>
                  <div class="custom-file">
                    <input type="file" name="image_path" class="custom-file-input" id="profileImage">
                    <label class="custom-file-label" for="profileImage">Choose file</label>
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-6">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" class="form-control password" id="password" name="password" placeholder="Enter password" autocomplete="new-password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fa fa-eye toggle" style="cursor: pointer;"></span>
                                    </div>
                                </div>
                            </div>
                </div>

                <div class="form-group col-lg-6">
                  <label for="confirmPassword">Confirm Password <span class="text-danger">*</span></label>
                  <input type="password" name="confirm_password" class="form-control" id="confirmPassword" placeholder="Re-enter password">
                </div>
              </div>

              <div class="row">
                <div class="form-group col-lg-6">
                  <label>Gender <span class="text-danger">*</span></label>
                  <div class="bg-light p-3 rounded">
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" id="genderMale" value="male" class="form-control">
                      <label class="form-check-label ml-1" for="genderMale">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" id="genderFemale" value="female" class="form-control">
                      <label class="form-check-label ml-1" for="genderFemale">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" id="genderOther" value="other" class="form-control">
                      <label class="form-check-label ml-1" for="genderOther">Other</label>
                    </div>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                  <label>Subjects <span class="text-danger">*</span></label>
                  <div class="bg-light p-3 rounded">
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_maths" value="maths" class="form-control">
                      <label class="form-check-label ml-1" for="subject_maths">Maths</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_physics" value="physics" class="form-control">
                      <label class="form-check-label ml-1" for="subject_physics">Physics</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_computer" value="computer" class="form-control">
                      <label class="form-check-label ml-1" for="subject_computer">Computer</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_chemistry" value="chemistry" class="form-control">
                      <label class="form-check-label ml-1" for="subject_chemistry">Chemistry</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="languageSelect">Select Languages <span class="text-danger">*</span></label>
                <select class="select2 form-control" name="languages[]" id="languageSelect" multiple="multiple" data-placeholder="Select options" data-dropdown-css-class="select2-purple" style="width: 100%;">
                  <option value="English">English</option>
                  <option value="German"> German</option>
                  <option value="French">French</option>
                  <option value="Italian">Italian</option>
                </select>
              </div>

            </div>

            <!-- Form Footer -->
            <div class="card-footer">
              <a href="index.php" class="btn btn-secondary float-left">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Add Student</button>
              </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function () {
        $('#studentForm').on('submit', function (e) {
            e.preventDefault();
            var form = this;
            if (!$(form).valid()) return;
            var formData = new FormData(form);
            var submitBtn = $(form).find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Submitting...');
            $.ajax({
                url: 'create.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.status === 'success') {
                        toastr.success(res.message);
                        setTimeout(() => location.href = 'index.php', 1500);
                    } else {
                        toastr.error(res.message);
                    }
                },
                complete: function() {
                    submitBtn.prop('disabled', false).text('Add Student');
                }
            });
        });
    });
</script>
<?php include_once("footer.php"); ?>
