<?= $this->extend('layout/layout.php') ?>

<?= $this->section('content') ?>
  <!-- Modal -->
  <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Full Name</label>
            <input type="text" class="form-control name" placeholder="Full Name">
            <div id="error_name" class="form-text text-danger"></div>
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" class="form-control email" placeholder="Email">
            <div id="error_email" class="form-text text-danger"></div>
          </div>
          <div class="form-group">
            <label for="">Phone</label>
            <input type="text" class="form-control phone" placeholder="Phone">
            <div id="error_phone" class="form-text text-danger"></div>
          </div>
          <div class="form-group">
            <label for="">Course</label>
            <input type="text" class="form-control course" placeholder="Course">
            <div id="error_course" class="form-text text-danger"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary ajaxstudent-save">Save</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md 12 my-4">
        <h1 class="text-center"> JQuery Ajax </h1>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Student Data <a href="#" data-bs-toggle="modal" data-bs-target="#studentModal" class="btn btn-primary float-end">Add Student</a></h4>

          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Course</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="studentdata">

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
  $(document).ready(function(){
    loadstudent()
  });
  function loadstudent(){
    $.ajax({
      method: "GET",
      url: "ajax-student/getdata",
      success: function(response){
        $.each(response.students, function(key, value){
          $('.studentdata').append('<tr>\
              <td class="stud_id">'+value['id']+'</td>\
              <td>'+value['name']+'</td>\
              <td>'+value['email']+'</td>\
              <td>'+value['phone']+'</td>\
              <td>'+value['course']+'</td>\
              <td>\
                <a class="btn btn-primary" >View</a>\
                <a class="btn btn-info" >Update</a>\
                <a class="btn btn-danger" >Delete</a>\
              </td>\
            </tr>'
          );
        });
      }
    });
  }
</script>
<script>
  $(document).ready(function () {
    $(document).on('click','.ajaxstudent-save', function() {
      if($.trim($('.name').val()).length == 0){
        error_name = 'Name Cannot Be Empty';
        $('#error_name').text(error_name);
      }
      else{
        error_name = '';
        $('#error_name').text(error_name);
      }

      if($.trim($('.email').val()).length == 0){
        error_email = 'Email Cannot Be Empty';
        $('#error_email').text(error_email);
      }
      else{
        error_email = '';
        $('#error_email').text(error_email);
      }

      if($.trim($('.phone').val()).length == 0){
        error_phone = 'Phone Cannot Be Empty';
        $('#error_phone').text(error_phone);
      }
      else{
        error_phone = '';
        $('#error_phone').text(error_phone);
      }
      if($.trim($('.course').val()).length == 0){
        error_course = 'Course Cannot Be Empty';
        $('#error_course').text(error_course);
      }
      else{
        error_course = '';
        $('#error_course').text(error_course);
      }

      if (error_name != '' || error_email != '' || error_phone != '' || error_course != ''  ) {
        console.log("open")
      }
      else{
        var data = {
          'name': $('.name').val(),
          'email': $('.email').val(),
          'phone': $('.phone').val(),
          'course': $('.course').val(),
        };
        $.ajax({
          method: "POST",
          url: "/ajax-student/store",
          data: data,
          success: function(response){
            $('#studentModal').modal('hide');
            $('#studentModal').find('input').val('');
            console.log(response.status)
          },
          error: function(request){
             console.log(request.responseText);
          }
        })
      }
    });
  });
</script>
<?= $this->endSection() ?>
