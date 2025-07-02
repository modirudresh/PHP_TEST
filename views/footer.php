<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<?php if (!$isAjax): ?>
  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014 - <?php echo Date("Y"); ?> <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
<?php endif; ?>

</div> <!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="../dist/js/adminlte.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- DataTables & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- jQuery Validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>

<script>
  $(function () {
    // DataTable Initialization
    $("#example1").DataTable({
      responsive: true, 
      lengthChange: false, 
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      paging: true,
      searching: true,
      ordering: false,
      info: true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
<script>
    $(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});
</script>
<script>
  $(function () {
    $.validator.addMethod('pattern', function (value, element, param) {
      return this.optional(element) || param.test(value);
    }, 'Invalid format.');

    $('#studentForm').validate({
      rules: {
        firstname: { required: true, minlength: 3, pattern: /^[A-Za-z\s'-]+$/ },
        lastname: { required: true, minlength: 3, pattern: /^[A-Za-z\s'-]+$/ },
        email: { required: true, email: true },
        password: { required: true, minlength: 8, pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#]).{8,}$/ },
        confirm_password: { required: true, equalTo: '#password' },
        gender: { required: true },
        'subject[]': { required: true, minlength: 1 },
        'languages[]': { required: true, minlength: 1 },
        image_path: { 
          required: function () {
            return window.location.pathname.includes('create.php');
          },
          extension: "jpg|jpeg|png|gif"
        }
      },
      messages: {
        firstname: {
          required: "Please enter your first name",
          minlength: "Minimum 3 characters",
          pattern: "Letters, spaces, apostrophes, and hyphens only."
        },
        lastname: {
          required: "Please enter your last name",
          minlength: "Minimum 3 characters",
          pattern: "Letters, spaces, apostrophes, and hyphens only."
        },
        email: "Please enter a valid email",
        password: {
          required: "Enter password",
          minlength: "Min 8 characters",
          pattern: "Include upper, lower, number & special char"
        },
        confirm_password: {
          required: "Confirm password",
          equalTo: "Passwords do not match"
        },
        gender: "Select a gender",
        'subject[]': "Select at least one subject",
        'languages[]': "Select at least one language",
        image_path: {
          required: "Please upload a profile image",
          extension: "Only image files allowed (jpg, jpeg, png, gif)"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
        element.closest('.form-group').find('.bg-light').addClass('is-invalid');
      },
      highlight: function (element) {
        $(element).addClass('is-invalid');
        $(element).closest('.form-group').find('.bg-light').addClass('is-invalid');
      },
      unhighlight: function (element) {
        $(element).removeClass('is-invalid').addClass('is-valid');
        $(element).closest('.form-group').find('.bg-light').removeClass('is-invalid').addClass('is-valid');
      }
    });
    $('.custom-file-input').on('change', function () {
      var fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').html(fileName);
    });
  });
</script>

<script>
$(document).ready(function() {
  $('.select2').select2();
});

$(function () {
  bsCustomFileInput.init();
});
</script>

<!-- Password toggle -->
<script>
  document.querySelectorAll(".toggle").forEach(toggle => {
    toggle.addEventListener("click", () => {
      const input = toggle.closest(".input-group").querySelector(".password");
      if (input.type === "password") {
        input.type = "text";
        toggle.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        input.type = "password";
        toggle.classList.replace("fa-eye-slash", "fa-eye");
      }
    });
  });
</script>

</body>
</html>
