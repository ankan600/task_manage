<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .card-body {
            background-color: #7bbeee77;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.24) 2px 5px 8px;
        }

        .heading {
            font-size: 50px;
            font-weight: 600;
            background-image: linear-gradient(to left, #553c9a, #b393d3);
            color: transparent;
            background-clip: text;
            radial-gradient(circle, #553c9a, #ee4b2b);
            -webkit-background-clip: text;
        }

        @media only screen and (max-width: 480px) {

            .heading {
                font-size: 30px;
                padding-top: 20px !important;
            }
        }

        @media only screen and (max-width: 320px) {

            .heading {
                font-size: 30px;
                padding-top: 20px !important;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10">
                <div class="card-body p-md-5 p-sm-5 p-4 mx-md-4 mx-sm-3">
                    <div class="text-center">
                        <h4 class=" heading mt-1  pb-1">Registration</h4>
                    </div>
                    <form class=" form " id="user_reg_form" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-outline mb-3">
                            <label for="exampleInputName" class="form-label">Name</label>
                            <input type="test" name="name"class="form-control" id="exampleInputName"
                                aria-describedby="emailHelp">
                            
                        </div>
                        <div class="form-outline mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                            
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                            <input type="password" name="c_password" class="form-control" id="exampleInputPassword2">
                        </div>
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#user_reg_form").submit(function(e) {
            e.preventDefault();
        var form = document.getElementById("user_reg_form");
        var formData = new FormData(form);

            $.ajax({
                url: "<?php echo e(url('api/reg/')); ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                error: function(a, b, c) {

                    console.log(a);
                    console.log(b);
                    console.log(c);
                },
                beforeSend: function(xhr) {
                    // xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                },
                success: function(response) {
                    // console.log(response);
                    if (response.status == true) {
                        console.log(response.data);
                        alert("User add successfull");
                        $('#user_reg_form')[0].reset();
                        window.location.href="<?php echo e(url('/')); ?>";
                    } else {
                        alert(response.message);
                    }
                }
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
<?php /**PATH C:\Users\papiy\OneDrive\Documents\ecotance\task_test\resources\views/reg.blade.php ENDPATH**/ ?>