@extends('admin_app')

@section('custom_css')
@endsection


@section('content')
    <div class="main_content">
        <div class="content p-3">

            <div class="container-lg ">
                <div class="fs-2 fw-semibold">Tasks</div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <p>All taskes</p>
                                <span><button type="button"class="btn btn-primary" id="show_add_task_modal"> <i
                                            class="bi bi-plus"></i></button></span>
                            </div>
                            <div class="card-body">
                                
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Emplyee Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id ="task_list_data">
                                        {{-- list render here --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Emplyee Name</th>
                                            <th>Date</th>
                                            <th>Action</th>
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



    {{-- add task  modal start  --}}
    <div class="modal fade" id="add_tast_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Add task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="hide_add_task_modal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_task_form">
                        @csrf
                        <input type="hidden" id="task_id" name="task_id">
                        <div class="form-group">
                            <label for="emplyee_list_html" >Emplyee List</label>
                            <select class="form-control" id="emplyee_list_html" name="emp_id">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Task Title:</label>
                            <input type="text" name="title" class="form-control" id="edit_title">
                        </div>
                        <div class="form-group">
                            <label for="edit_description" class="col-form-label">Task Description::</label>
                            <textarea class="form-control"  name="description" id="edit_description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="hide_add_task_modal()">Close</button>
                    <button type="button" class="btn btn-primary" onclick="add_task()" id="add_task_btn">ADD TASK</button>
                    <button type="button" class="btn btn-primary" onclick="update_task()" id="update_task_btn" style="display: none;">Update TASK</button>
                </div>
            </div>
        </div>
    </div>
    {{-- add task  modal end  --}}


    
@endsection



@section('custom_js')
    <script>
        $("#show_add_task_modal").click(function() {

            $("#add_tast_modal").modal('show');
            get_emplyee();
        })

        function hide_add_task_modal() {
            $("#add_tast_modal").modal('hide');
        }


        function get_task() {
            var token = localStorage.getItem("token");

            $.ajax({
                url: "{{ url('api/get-task/') }}",
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
        get_task();
        function render_task_table(data) {
            console.log(data);
            var details_html = '';
            if (data.length > 0) {
                $("#task_list_data").html("");
                data.forEach((details, i) => {

                    const dateString = details.created_at;

                    
                    const originalDate = new Date(dateString);

                    const day = originalDate.getDate().toString().padStart(2, '0');
                    const month = (originalDate.getMonth() + 1).toString().padStart(2, '0'); // Month is zero-based
                    const year = originalDate.getFullYear().toString().slice(-2);

                    const formattedDate = `${day}/${month}/${year}`;

                    details_html += `<tr>
                                        <td>${i+1}</td>
                                        <td>${details.title}</td>
                                        <td>${details.description}</td>
                                        <td>${details.user.name}</td>
                                        <td>${formattedDate}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick=" return edit_task('${details.id}')"><i class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="btn btn-danger" onclick=" return delete_task('${details.id}')"><i class="bi bi-trash"></i></button>
                                            </td>
                                    </tr>`;

                });
                $("#task_list_data").html(details_html);
               
                
                                    $('#example').DataTable();
                               
            }

        }

        function get_emplyee(emplyee_id=null) {
            var token = localStorage.getItem("token");

            $.ajax({
                url: "{{ url('api/get-emplyee/') }}",
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
                        console.log(response.data);
                        render_emplyee_list(response.data, emplyee_id);
                    } else {
                        alert("Something went to wrong !..");
                    }
                }
            });
        }
        

        
        function render_emplyee_list(data, emplyee_id) {
            console.log(data);
            var emp_details_html = '<option >Select A option---</option>';
            if (data.length > 0) {
                $("#emplyee_list_html").html("");
                data.forEach((details, i) => {

                    const dateString = details.created_at;

                    // Create a Date object using the given string
                    const originalDate = new Date(dateString);

                    // Format the date in a desired way (e.g., as a string)
                    const formattedDate = originalDate.toLocaleDateString();

                    emp_details_html += `<option value="${details.id}" ${(details.id == emplyee_id) ? 'selected' : ''} > ${details.name}</option>`;

                });
                $("#emplyee_list_html").html(emp_details_html);
                $('#example').DataTable();
            }

        }

        function add_task(){

            if($("#edit_title").val()==""){
                alert("Please enter Title");
                return false;
            }
            else if($("#edit_title").val().length > 100){
                alert("Title should not exceed 100 characters");
                return false;
            }
            if($("#emplyee_list_html").val()==""){
                alert("Please  Select a Option");
                return false;
            }
            if($("#edit_description").val()==""){
                alert("Please enter description");
                return false;
            }
            else if($("#edit_description").val().length > 200){
                alert("Title should not exceed 100 characters");
                return false;
            }
            var token = localStorage.getItem("token");
            // const formData = new FormData(document.getElementById('myForm'));
            const formData = $('#add_task_form').serialize();
            $.ajax({
                url: "{{ url('api/add-task/') }}",
                type: "POST",
                data:  formData,
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
                        hide_add_task_modal();
                        document.getElementById("add_task_form").reset();
                        alert("Task add successfull");
                    } else {
                        alert("Something went to wrong !..");
                    }
                }
            });

        }
        function delete_task(task_id){
            var token = localStorage.getItem("token");
            if(confirm("Do You want to delete?")){
                $.ajax({
                    url: "{{ url('api/delete-task/') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "task_id": task_id,
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
                            
                            alert("Task Delete successfull");
                            get_task();
                        } else {
                            alert("Something went to wrong !..");
                        }
                    }
                });
            }
            else{
                return false;
            }

        }

        function edit_task(task_id){
            var token = localStorage.getItem("token");
            $.ajax({
                url: "{{ url('api/get-single-task') }}/"+task_id,
                type: "GET",
                error: function(a, b, c) {

                    console.log(a);
                    console.log(b);
                    console.log(c);
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                    $("#modal_title").text("Edit Task");
                    $("#add_task_btn").hide();
                    $("#update_task_btn").show();
                },
                success: function(response) {
                    // console.log(response);
                    if (response.status == true) {
                        console.log(response.data);
                        $("#add_tast_modal").modal('show');
                        console.log(response.data.description);
                        get_emplyee(response.data.user_id);

                        $("#edit_title").val(response.data.title);
                        $("#edit_description").text(response.data.description);
                        $("#task_id").val(response.data.id);
                       
                        
                    } else {
                        alert("Something went to wrong !..");
                    }
                }
            });
        }

        function update_task(){
            var token = localStorage.getItem("token");
            // const formData = new FormData(document.getElementById('myForm'));
            const formData = $('#add_task_form').serialize();
            $.ajax({
                url: "{{ url('api/edit-task/') }}",
                type: "POST",
                data:  formData,
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
                        hide_add_task_modal();
                        document.getElementById("add_task_form").reset();
                        alert("Task add successfull");
                        get_task();
                    } else {
                        alert("Something went to wrong !..");
                    }
                }
            });

        }


        $("#add_tast_modal").on("hidden.bs.modal", function () {
            $("#modal_title").text("Add Task");
            $("#add_task_btn").show();
            $("#update_task_btn").hide();
            $("#task_id").val("");
            $("#edit_title").val("");
            $("#edit_description").text("");
        });

    </script>
@endsection
