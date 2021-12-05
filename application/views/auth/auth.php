<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="<?= base_url('assets/img/icon/house.png') ?>">
    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- css ex -->
    <link href="<?= base_url('assets/'); ?>css/private.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-8 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="d-flex justify-content-center">
                                    <img class="img-auth" src="<?= base_url('assets/img/icon/administration.png'); ?>" alt="">
                                </div>
                                <div class="text-center mt-2 mb-3">
                                    <h1 class="h4 text-gray-900"><strong>SELAMAT DATANG</strong></h1>
                                </div>
                                <?= $this->session->flashdata('pesan'); ?>
                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group icon-cont">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukan Username">
                                        <?= form_error('username', '<small class="text-warning ml-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group icon-cont">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Masukan Password">
                                        <span toggle="#password" class="fa fa-fw fa-eye pass toggle-pass" data-toggle="tooltip" data-placement="top" title="Lihat Password"></span>
                                        <?= form_error('password', '<small class="text-warning ml-3">', '</small>') ?>
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Masuk
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

    <!-- javascript ex -->
    <script src="<?= base_url('assets/'); ?>js/private.js"></script>

</body>

</html>