<?php
defined('BASEPATH') or exit('no redirect script allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUser');
        $this->load->model('ModelAHP');
        is_login();
    }

    public function index() //FUNGSI TAMPIL HALAMAN HOME
    {
        $data['title'] = 'Home';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('footer', $data);
    }

    public function users() //FUNGSI TAMPIL HALAMAN USERS
    {
        $data['title'] = 'Users';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['users'] = $this->ModelUser->getAllUser();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/users', $data);
        $this->load->view('footer', $data);
    }

    public function tmbh_user() // FUNGSI TAMBAH USER
    {
        $this->form_validation->set_rules('username', 'username', 'is_unique[user.username]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username sudah ada. Coba dengan Username berbeda.</div>');
            redirect('admin/users');
        } else {
            $tipe = $this->input->post('tipe');

            if ($tipe == "Admin") {
                $role_id = 1;
            } elseif ($tipe == "Surveyor") {
                $role_id = 2;
            } else {
                $role_id = 3;
            }

            $foto   = $_FILES['foto'];

            if ($foto = '') {
            } else {
                $config['allowed_types']    = 'jpeg|gif|jpg|png';
                $config['max_size']         = '2048';
                $config['upload_path']      = './assets/img/auth/user/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                } else {
                    echo "Foto Gagal Di-Upload!";
                }
            }

            $data = [
                'nama'      => htmlspecialchars($this->input->post('nama', true)),
                'jk'        => $this->input->post('jk'),
                'username'  => htmlspecialchars($this->input->post('username', true)),
                'foto'      => $foto,
                'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'tipe'      => $tipe,
                'aktif'     => "aktif",
                'role_id'   => $role_id
            ];

            $this->ModelUser->tmbhUser($data, 'user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil ditambahkan.</div>');
            redirect('admin/users');
        }
    }

    public function hapus_user($id) // Fungsi Hapus User
    {
        $this->ModelUser->hapusUser('user', $id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil dihapus.</div>');
        redirect('admin/users');
    }

    public function edit_user($id) //Fungsi Update User
    {
        $data['title'] = 'Edit User';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['users'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('footer');
    }

    public function update_user($id) //Fungsi Update User
    {
        $tipe = $this->input->post('tipe');

        if ($tipe == "Admin") {
            $role_id = 1;
        } elseif ($tipe == "Surveyor") {
            $role_id = 2;
        } else {
            $role_id = 3;
        }

        //jika ada gambar yang diupload
        $upload_foto = $_FILES['foto'];

        if ($upload_foto) {
            $config['allowed_types'] = 'jpeg|gif|jpg|png';
            $config['max_size']      = '3072';
            $config['upload_path']   = './assets/img/auth/user/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $new_foto = $this->upload->data('file_name');
                $this->db->set('foto', $new_foto);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $data = [
            'nama'      => htmlspecialchars($this->input->post('nama', true)),
            'jk'        => $this->input->post('jk'),
            'tipe'      => $tipe,
            'aktif'     => "aktif",
            'role_id'   => $role_id
        ];

        $this->db->where('id', $id);
        $this->db->update('user', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data user has been updated.</div>');
        redirect('admin/users');
    }

    public function kepkel() //Halaman Kepala Keluarga
    {
        $data['title'] = 'Kepala Keluarga';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['kepkel'] = $this->ModelAHP->getAllKepalaKeluarga();
        // var_dump($data['user']);
        // die();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/kepkel.php', $data);
        $this->load->view('footer', $data);
    }

    public function edit_kepkel($no_kk)
    {
        $data['title'] = 'Edit';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        $data['kepkel'] = $this->ModelAHP->getKepalaKelByNoKK($no_kk);

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/edit_kepkel.php', $data);
        $this->load->view('footer', $data);
    }

    public function update_kepkel($no_kk)
    {
        $data = [
            'no_kk' => $this->input->post('no_kk'),
            'nm_kpl_kel' => $this->input->post('nm_kpl_kel'),
            'alamat' => $this->input->post('alamat'),
            'rt' => $this->input->post('rt'),
            'rw' => $this->input->post('rw'),
            'desa' => $this->input->post('desa'),
            'kec' => $this->input->post('kec'),
            'kab' => $this->input->post('kab')
        ];

        $this->db->where('no_kk', $no_kk);
        $this->db->update('kep_keluarga', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kepala Keluarga has been updated.</div>');
        redirect('admin/kepkel');
    }
}
