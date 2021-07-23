<?php

function is_login()
{
    $ci = get_instance();

    $userdata = $ci->session->userdata();
    $username = $userdata['user']['username'];

    if (!$username) {
        $ci->session->set_flashdata('pesan', '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Gagal!</strong> Anda Harus Login Terlebih dahulu!.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        ');
        redirect('auth');
    }
}
