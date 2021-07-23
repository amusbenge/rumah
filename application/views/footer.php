<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; SB Admin 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-start">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-auto">
                            <img class="mt-2" src="<?= base_url('assets/img/auth/see-you-soon.png') ?>" width="100px" height="100px" alt="">
                            <img class="mt-2" src="<?= base_url('assets/img/auth/pesan-bye.png') ?>" width="100px" height="100px" alt="">
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <a class="btn btn-outline-warning" href="<?= base_url('auth/logout') ?>"><img src="<?= base_url('assets/img/icon/logout.png') ?>" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Profil Info Modal -->
<div class="modal fade" id="infoUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nama : <?= $user['nama']; ?></label>
                                <label for="">Username : <?= $user['username']; ?></label>
                            </div>
                            <div class="col-md-6">
                                <?php if (!$user['foto']) : ?>
                                    <img src="<?= base_url('assets/img/auth/user/profile.png') ?>" class="rounded float-right" alt="">
                                <?php else : ?>
                                    <img src="<?= base_url('assets/img/auth/user/') . $user['foto'] ?>" class="rounded float-right" alt="">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Profil Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username :</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="col-form-label">Foto :</label>
                        <input type="file" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                        <label for="password1" class="col-form-label">Password :</label>
                        <input type="password" class="form-control" id="password1" name="password1">
                    </div>
                    <div class="form-group">
                        <label for="password2" class="col-form-label">Konfirmasi Password :</label>
                        <input type="password" class="form-control" id="password2" name="password2">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script>

</body>

</html>