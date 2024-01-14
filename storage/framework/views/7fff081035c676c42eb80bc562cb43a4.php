<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- DataTables JS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">



    </script>
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
    <script src="<?php echo e(asset('script.js')); ?>"></script>

    <?php echo $__env->yieldContent('custom_css'); ?>
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

            </nav>
        </div>
        <div class="main d-flex">
            <div class="left_bar">
                <div class="menu p-2">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="<?php echo e(url('/dashboard')); ?>" class="nav-link link-light <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>" aria-current="page">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#home"></use>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/emplyee-list')); ?>" class="nav-link link-light <?php echo e(request()->is('emplyee-list') ? 'active' : ''); ?>">
                                <svg class="bi me-2" width="16" height="16">
                                    <use xlink:href="#table"></use>
                                </svg>
                                Emplyee list
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
<?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>



  <?php echo $__env->yieldContent('custom_js'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.0.1/js/dataTables.select.min.js"></script>
    
</body>

</html>
<?php /**PATH C:\Users\papiy\OneDrive\Documents\ecotance\task_test\resources\views/admin_app.blade.php ENDPATH**/ ?>