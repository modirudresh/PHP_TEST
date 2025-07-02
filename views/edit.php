<?php
include_once("../config/connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $con->prepare("SELECT * FROM student WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($student) {
        $existingSubjects = explode(',', $student['subjects']);
        $existingLanguages = explode(',', $student['languages']);
        ?>
        
        <form id="editStudentForm" method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">
            <input type="hidden" name="existing_image_path" value="<?= htmlspecialchars($student['image_path']) ?>">
            
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="firstname">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="firstname" value="<?= htmlspecialchars($student['firstname']) ?>">
                </div>
                <div class="form-group col-lg-6">
                  <label for="lastname">Last Name <span class="text-danger">*</span></label>
                  <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter last name" value="<?= htmlspecialchars($student['lastname']) ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                  <label for="email">Email Address <span class="text-danger">*</span></label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?= htmlspecialchars($student['email']) ?>">
                </div>
                <div class="form-group col-lg-2">
                  <label for="current_image"></label>
                  <img src="<?= htmlspecialchars($student['image_path']) ?>" alt="profile_img" style="width:60px; height:auto;">
                </div>
                <div class="form-group col-lg-4">
                  <label for="profileImage">Profile Image</label>
                  <div class="custom-file">
                    <input type="file" name="image_path" class="custom-file-input" id="profileImage">
                    <label class="custom-file-label" for="profileImage">Choose file</label>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-lg-6">
                  <label>Gender <span class="text-danger">*</span></label>
                  <div class="bg-light p-3 rounded">
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" id="genderMale" value="male" class="form-check-input" <?= ($student['gender'] == 'male') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="genderMale">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" id="genderFemale" value="female" class="form-check-input" <?= ($student['gender'] == 'female') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="genderFemale">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="radio" name="gender" id="genderOther" value="other" class="form-check-input" <?= ($student['gender'] == 'other') ? 'checked' : '' ?>>
                      <label class="form-check-label" for="genderOther">Other</label>
                    </div>
                  </div>
                </div>

                <div class="form-group col-lg-6">
                  <label>Subjects <span class="text-danger">*</span></label>
                  <div class="bg-light p-3 rounded">
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_maths" value="maths" class="form-control" <?= in_array('maths', $existingSubjects) ? 'checked' : '' ?>>
                      <label class="form-check-label ml-1" for="subject_maths">Maths</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_physics" value="physics" class="form-control" <?= in_array('physics', $existingSubjects) ? 'checked' : '' ?>>
                      <label class="form-check-label ml-1" for="subject_physics">Physics</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_computer" value="computer" class="form-control" <?= in_array('computer', $existingSubjects) ? 'checked' : '' ?>>
                      <label class="form-check-label ml-1" for="subject_computer">Computer</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input type="checkbox" name="subject[]" id="subject_chemistry" value="chemistry" class="form-control" <?= in_array('chemistry', $existingSubjects) ? 'checked' : '' ?>>
                      <label class="form-check-label ml-1" for="subject_chemistry">Chemistry</label>
                    </div>
                  </div>
                </div>
            </div>

            <div class="form-group">
                <label for="languageSelect">Select Languages <span class="text-danger">*</span></label>
                <select class="select2 form-control" name="languages[]" id="languageSelect" multiple="multiple" data-placeholder="Select options" style="width: 100%;">
                  <option value="English" <?= in_array('English', $existingLanguages) ? 'selected' : '' ?>>English</option>
                  <option value="German" <?= in_array('German', $existingLanguages) ? 'selected' : '' ?>> German</option>
                  <option value="French" <?= in_array('French', $existingLanguages) ? 'selected' : '' ?>>French</option>
                  <option value="Italian" <?= in_array('Italian', $existingLanguages) ? 'selected' : '' ?>>Italian</option>
                </select>
            </div>

          </div>

          <!-- Form Footer -->
          <div class="float-right">
            <a href="index.php" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>

        <div id="responseMessage"></div> 

        <?php
    } else {
        echo "<div class='text-danger text-center'>Student not found.</div>";
    }

    $stmt->close();
}
?>
<!-- jQuery Validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>

<script>
  $(function () {
  $('#editStudentForm').validate({
    rules: {
      firstname: {
        required: true,
        minlength: 2
      },
      lastname: {
        required: true,
        minlength: 2
      },
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      confirm_password: {
        required: true,
        equalTo: "#password"
      },
      gender: {
        required: true
      },
      'subject[]': {
        required: true,
        minlength: 1
      },
      'languages[]': {
        required: true,
        minlength: 1
      },
    },
    messages: {
      firstname: {
        required: "Please enter first name",
        minlength: "First name must be at least 2 characters"
      },
      lastname: {
        required: "Please enter last name",
        minlength: "Last name must be at least 2 characters"
      },
      email: {
        required: "Please enter an email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Password must be at least 5 characters long"
      },
      confirm_password: {
        required: "Please confirm your password",
        equalTo: "Passwords do not match"
      },
      gender: "Please select a gender",
      'subject[]': "Please select at least one subject",
      'languages[]': "Please select at least one language",
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

<script>
$(document).ready(function () {
    $('#editStudentForm').on("submit", function (e) {
            e.preventDefault();
            var form = this;
            if (!$(form).valid()) return;
            var formData = new FormData(form);
            var submitBtn = $(form).find('button[type="submit"]');
            submitBtn.prop('disabled', true).text('Submitting...');
            $.ajax({
                url: 'editAction.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        toastr.success(data.message);
                        setTimeout(() => location.href = 'index.php', 10);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    toastr.error('Error processing request.');
                }
            });
    });
});

</script>
