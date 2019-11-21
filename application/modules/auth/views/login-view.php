<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/PACE/themes/green/pace-theme-barber-shop.css') ?>"> -->
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="card-columns">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Login</h4>
                        <hr>
                        <div class="container-fluid">
                            <form method="POST" action="<?php echo base_url('api/auth'); ?>">
                                <div class="form-group">
                                    <label for="username" class="col-sm-1-12 col-form-label">Username</label>
                                    <div class="col-sm-1-12">
                                        <input type="text" class="form-control" name="username" id="username" required placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-1-12 col-form-label">Password</label>
                                    <div class="col-sm-1-12">
                                        <input type="password" class="form-control" name="password" id="password" required placeholder="">
                                    </div>
                                </div>
                                <input type="hidden" name="X-API-KEY" value="ggscscs4g8k0ww0ssk84w8k8so8s0wowkoc0gsg8">
                                <div class="form-group">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Action</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/PACE/pace.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>

</html>