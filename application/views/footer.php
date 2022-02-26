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
                    Yakin Keluar?
                    <div class="row justify-content-end">
                        <a class="btn btn-outline-warning" href="<?= base_url('auth/logout') ?>">Keluar</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Informasi Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-center">
                            <?php if (!$user['foto']) : ?>
                                <img src="<?= base_url('assets/img/auth/user/profile.png') ?>" class="rounded-circle float-left" width="200px" height="200px" alt="">
                            <?php else : ?>
                                <img src="<?= base_url('assets/img/auth/user/') . $user['foto'] ?>" class="rounded-circle float-left" width="150px" height="150px" alt="">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="">Nama </label>
                            <label for="">Jabatan </label>
                            <label for="">Status </label>
                        </div>
                        <div class="col-md-5">
                            <label for="">: <?= $user['nama']; ?></label>
                            <label for="">: <?= $user['jabatan']; ?></label>
                            <label for="">
                                <?php if ($user['aktif'] == 'aktif') : ?>
                                    : Aktif
                                <?php else : ?>
                                    : Tidak Aktif
                                <?php endif; ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#editUserModal" data-dismiss="modal">Edit</a>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900" id="exampleModalLabel">Ubah Profil Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-gray-800">
                <form action="<?= base_url('user/edit_profil/') . $user['id'] ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username :</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password Baru:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="col-form-label">Foto :</label>
                        <input type="file" id="foto" name="foto" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save mr-2"></i>Simpan</button>
                    </div>
                </form>
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
<!-- <script src="<?= base_url('assets/') ?>vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="<?= base_url('assets/') ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('assets/') ?>js/demo/chart-pie-demo.js"></script> -->

<!-- Sweet alert -->
<script src="<?= base_url('assets/dist/sweetalert.js') ?>"></script>

<!-- javascript ex -->
<script src="<?= base_url('assets/'); ?>js/private.js"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#jtable').DataTable();
    });
</script>

<script>
    $(document).ready(function() {

        // get Edit Product
        $('.btn-edit').on('click', function() {
            // get data from button edit
            const id = $(this).data('id');
            const dusun = $(this).data('dusun');
            const iduser = $(this).data('iduser');
            // Set data to Form Edit
            $('.id').val(id);
            $('.nama_dusun').val(dusun);
            $('.id_user').val(iduser);
            // Call Modal Edit
            $('#updateDusun').modal('show');
        });

        // get Delete Product
        // $('.btn-delete').on('click', function() {
        //     // get data from button edit
        //     const id = $(this).data('id');
        //     // Set data to Form Edit
        //     $('.productID').val(id);
        //     // Call Modal Edit
        //     $('#deleteModal').modal('show');
        // });

    });
</script>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>

</body>

</html>