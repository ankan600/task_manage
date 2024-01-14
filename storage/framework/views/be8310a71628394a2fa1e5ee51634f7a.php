<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-6">
                <div class="card-body p-md-5 p-sm-5 p-4 mx-md-4 mx-sm-3">
                    <div class="text-center">
                        <h4 class=" heading mt-1  pb-1"><?php echo e(request()->is('/') ? 'User Login' : 'Admin Login'); ?></h4>
                    </div>
                    <form class="p-1" id="login_form" method="post">
                        <?php echo csrf_field(); ?>
                        <div class="form-outline mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" id="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="check_login()">Submit</button>
                    </form>
                    <div class="text-right <?php echo e(request()->is('/') ? '' : 'hidden'); ?>">
                        <a href="<?php echo e(url('reg')); ?>"><p class="mt-1 pb-1"><?php echo e(request()->is('/') ? 'Register' : ''); ?></p></a>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>

    <script>
        function check_login(){
        

            $.ajax({
                url: "<?php echo e(url('api/login/')); ?>",
                type: "POST",
                data: {
                "email": $("#email").val(),
                "password": $("#password").val(),
                "_token": "<?php echo e(csrf_token()); ?>",

                },
                error: function(a, b, c){
                    
                    console.log(a);
                    console.log(b);
                    console.log(c);
                },
                success: function(response){
                    console.log(response);
                    if(response.status== true){
                        // console.log(response.data);
                        var data =response.data;
                        localStorage.setItem("token", data.token);
                        localStorage.setItem("user_id", data.user.id);
                        console.log(data.user);
                        if(data.user.role=='1'){
                            // console.log("if");
                            window.location.href="<?php echo e(url('dashboard')); ?>";
                        }
                        else{
                            window.location.href="<?php echo e(url('user-dashboard')); ?>";
                        }
                    }
                    else{
                       alert("unauthorize credential");
                    }
                }
            });
        }
        // console.log(localStorage.getItem('token'));
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php /**PATH C:\Users\papiy\OneDrive\Documents\ecotance\task_test\resources\views/login.blade.php ENDPATH**/ ?>