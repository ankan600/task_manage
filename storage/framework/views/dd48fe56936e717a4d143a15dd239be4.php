<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <!-- DataTables JS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
    <script src="<?php echo e(asset('script.js')); ?>"></script>
</head>

<body>
    <div class="wrapper">
        <div class="header px-2">
            <nav class="navbar navbar-expand-lg  d-flex justify-content-between">
                <div class="header_left d-flex justify-content-between">
                    <a class="navbar-brand" href="#">Task Project</a>
                </div>
                <div class="vr"></div>
                <div class="header_right d-flex justify-content-between">
                    <a class="navbar-brand" href="#"><i class="bi bi-list"></i></a>
                    <button type="button" class="navbar-brand" onclick="return logout()"><i class="bi bi-box-arrow-right"></i></button>
                </div>
                </div>

            </nav>
        </div>
        <div class="main d-flex">
            <div class="left_bar">
                <div class="menu p-2">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Home
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="main_content">
                <div class="content p-3">

                    <div class="container-lg ">
                        <div class="fs-2 fw-semibold">Your Tasks</div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between">
                                        <p>DataTables</p>
                                        
                                    </div>
                                    <div class="card-body">
                                        <script>
                                            $('#example').DataTable();
                                        </script>
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sl. No</th>
                                                    <th>Status</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id ="task_list_data">
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Sl. No</th>
                                                    <th>Status</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





<div class="modal fade" id="add_tast_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hide_add_task_modal()">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hide_add_task_modal()">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
  
<script>


function get_task() {
    var user_id = localStorage.getItem("user_id");
    console.log(user_val);

    if(user_id!="" || user_id!=null ||  user_id!= undefined){
        

        var token = localStorage.getItem("token");

        $.ajax({
            url: "<?php echo e(url('api/get-task/')); ?>/"+user_id,
            type: "GET",
            error: function(a, b, c) {

                console.log(a);
                console.log(b);
                console.log(c);
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function(response) {
                // console.log(response);
                if (response.status == true) {
                    // console.log(response.data);
                    render_task_table(response.data);
                } else {
                    alert("Something went to wrong !..");
                }
            }
        });
    }

}
get_task();
function render_task_table(data) {
    console.log(data);
    var details_html = '';
    if (data.length > 0) {
        $("#task_list_data").html("");
        data.forEach((details, i) => {

            const dateString = details.created_at;

            // Create a Date object using the given string
            const originalDate = new Date(dateString);

            // Format the date in a desired way (e.g., as a string)
            const formattedDate = originalDate.toLocaleDateString();

            if(details.task_status == "COMPLETE"){
                var check_status = "checked";
            }
            else{
                var check_status = "";
            }

            details_html += `<tr>
                                <td>${i+1}</td>
                                <td>
                                    <input type="checkbox"  onchange="change_task_status(this)" data-task_id="${details.id}"  ${check_status}>
                                </td>
                                
                                <td>${details.title}</td>
                                <td>${details.description}</td>
                                <td>${formattedDate}</td>
                                
                            </tr>`;

        });
        $("#task_list_data").html(details_html);
        $('#example').DataTable();
    }

}

function change_task_status(checkbox) {
    var task_id = checkbox.getAttribute('data-task_id');
    var isChecked = checkbox.checked;
    console.log(task_id);

    if (isChecked) {
        var task_status="COMPLETE";
    } else {
        var task_status="PENDING";
    }

    var token = localStorage.getItem("token");
            // const formData = new FormData(document.getElementById('myForm'));
            
            $.ajax({
                url: "<?php echo e(url('api/change-task-status/')); ?>",
                type: "POST",
                data:  {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "task_id":task_id,
                    "task_status": task_status,
                },
                error: function(a, b, c) {

                    console.log(a);
                    console.log(b);
                    console.log(c);
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                },
                success: function(response) {
                    // console.log(response);
                    if (response.status == true) {
                        
                        alert("Task add successfull");
                        get_task();
                    } else {
                        alert("Something went to wrong !..");
                    }
                }
            });

}




</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.0.1/js/dataTables.select.min.js"></script>
    
</body>

</html>
<?php /**PATH C:\Users\papiy\OneDrive\Documents\ecotance\task_test\resources\views/user_dashboard.blade.php ENDPATH**/ ?>