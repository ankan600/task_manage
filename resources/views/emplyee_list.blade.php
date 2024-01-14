@extends('admin_app')

@section('custom_css')
@endsection


@section('content')
    <div class="main_content">
        <div class="content p-3">

            <div class="container-lg ">
                <div class="fs-2 fw-semibold">Emplyee List</div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between">
                                <p>All Emplyee List</p>
                                {{-- <span><button type="button"class="btn btn-primary" id="show_add_task_modal"> <i
                                            class="bi bi-plus"></i></button></span> --}}
                            </div>
                            <div class="card-body">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody id ="emp_list_data">
                                        {{-- list render here --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
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
        // $("#show_add_task_modal").click(function() {

        //     $("#add_tast_modal").modal('show');
        //     get_emplyee();
        // });

        // function hide_add_task_modal() {
        //     $("#add_tast_modal").modal('hide');
        // }


        function get_emplyee() {
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
                        render_emplyee_list(response.data);
                    } else {
                        alert("Something went to wrong !..");
                    }
                }
            });
        }
        function render_emplyee_list(data) {
            console.log(data);
            var details_html='';
            if (data.length > 0) {
                $("#emp_list_data").html("");
                data.forEach((details, i) => {

                    const dateString = details.created_at;

                    const originalDate = new Date(dateString);

                    const day = originalDate.getDate().toString().padStart(2, '0');
                    const month = (originalDate.getMonth() + 1).toString().padStart(2, '0'); // Month is zero-based
                    const year = originalDate.getFullYear().toString().slice(-2);
                    //   time as hh:mm AM/PM
                    const hours = originalDate.getHours() % 12 || 12; // Convert 24-hour to 12-hour format
                    const minutes = originalDate.getMinutes().toString().padStart(2, '0');
                    const ampm = originalDate.getHours() >= 12 ? 'PM' : 'AM';

                    const formattedDateTime = `${day}/${month}/${year} ${hours}:${minutes} ${ampm}`;

                    details_html += `<tr>
                                        <td>${i+1}</td>
                                        <td>${details.name}</td>
                                        <td>${details.email}</td>
                                        <td>${formattedDateTime}</td>
                                    </tr>`;

                });
                $("#emp_list_data").html(details_html);
                $('#example').DataTable();
            }

        }
        get_emplyee()

       

    </script>
@endsection
