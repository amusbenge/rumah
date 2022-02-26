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
        $data['roles'] = $this->db->get_where('user_role', ['role <>' => 'Kepala Dusun'])->result_array();

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
            $this->insert_user();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil ditambahkan.</div>');
            redirect('admin/users');
        }
    }
    public function insert_user()
    {
        // $tipe = $this->input->post('tipe');
        $role_id = $this->input->post('role_id');
        // if ($tipe == "Admin") {
        //     $role_id = 1;
        // } elseif ($tipe == "Surveyor") {
        //     $role_id = 2;
        // } else {
        //     $role_id = 3;
        // }

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
            'jabatan'      => $this->input->post('jabatan'),
            'aktif'     => "aktif",
            'role_id'   => $role_id
        ];

        $this->ModelUser->tmbhUser($data, 'user');
        return $this->db->insert_id();
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
        $data['roles'] = $this->db->get_where('user_role', ['role <>' => 'Kepala Dusun'])->result_array();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('footer');
    }

    public function update_user($id) //Fungsi Update User
    {
        $role_id = $this->input->post('role_id');

        // if ($tipe == "Admin") {
        //     $role_id = 1;
        // } elseif ($tipe == "Surveyor") {
        //     $role_id = 2;
        // } else {
        //     $role_id = 3;
        // }

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
            // 'tipe'      => $tipe,
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
        $data['data_dusun'] = $this->ModelAHP->getDusun();
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

    public function tmbh_kepkel()
    {
        $this->form_validation->set_rules('username', 'username', 'is_unique[user.username]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username sudah ada. Coba dengan Username berbeda.</div>');
            redirect('admin/users');
        } else {
            $data = [
                'no_kk'         => htmlspecialchars($this->input->post('no_kk', true)),
                'nm_kpl_kel'    => htmlspecialchars($this->input->post('nama', true)),
                'alamat'        => htmlspecialchars($this->input->post('alamat', true)),
                'rt'            => htmlspecialchars($this->input->post('rt', true)),
                'rw'            => htmlspecialchars($this->input->post('rw', true)),
                'desa'          => "Kabuna",
                'kec'           => "Kakuluk Mesak",
                'kab'           => "Belu",
                'id_dusun'      => htmlspecialchars($this->input->post('id_dusun'))
            ];

            $this->db->insert('kep_keluarga', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kepala Keluarga berhasil ditambahkan.</div>');
            redirect('admin/kepkel');
        }
    }

    public function hapus_kepkel($no_kk)
    {
        $this->db->where('no_kk', $no_kk);
        $this->db->delete('kep_keluarga');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kepala Keluarga berhasil dihapus.</div>');
        redirect('admin/kepkel');
    }

    public function dusun() //FUNGSI TAMPIL HALAMAN USERS
    {
        $data['title'] = 'Dusun';
        $userdata = $this->session->userdata();
        $username = $userdata['user']['username'];
        $data['user'] = $this->ModelUser->getUser($username);
        // $data['kep_dusun'] = $this->ModelUser->getUserWhTypDusun();
        // var_dump($data['kep_dusun']);
        // die();
        $data['dusun'] = $this->ModelUser->getAllDusun();

        $this->load->view('header', $data);
        $this->load->view('sidebar', $data);
        $this->load->view('topbar', $data);
        $this->load->view('admin/dusun', $data);
        $this->load->view('footer', $data);
    }

    public function tambah_dusun() // FUNGSI TAMBAH DUSUN
    {
        $this->form_validation->set_rules('nama_dusun', 'Nama Dusun', 'is_unique[dusun.nama_dusun]');
        // $this->form_validation->set_rules('id_user', 'id_user', 'is_unique[dusun.id_user]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dusun atau Kepala Dusun existed.</div>');
            redirect('admin/dusun');
        } else {
            $nama_dusun = $this->input->post('nama_dusun');
            // $id_user = $this->input->post('id_user');

            $data = [
                'nama_dusun'      => htmlspecialchars($nama_dusun),
                // 'id_user'        => $id_user
            ];

            $this->ModelUser->tmbhUser($data, 'dusun');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dusun berhasil ditambahkan.</div>');
            redirect('admin/dusun');
        }
    }

    public function update_dusun() // FUNGSI TAMBAH DUSUN
    {
        // $this->form_validation->set_rules('id_user', 'id_user', 'is_unique[dusun.id_user]');
        // $this->;
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Dusun atau Kepala Dusun existed.</div>');
            redirect('admin/dusun');
        } else {

            $id = $this->input->post('id');
            $nama_dusun = $this->input->post('nama_dusun');
            $id_user = $this->input->post('id_user');

            $data = [
                'nama_dusun'      => htmlspecialchars($nama_dusun),
                // 'id_user'        => $id_user
            ];

            // var_dump($data);
            // die();

            $this->ModelUser->updateDusun($data, $id);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Dusun berhasil diubah.</div>');
            redirect('admin/dusun');
        }
    }

    public function tmbh_kepala_dusun()
    {
        $this->form_validation->set_rules('username', 'username', 'is_unique[user.username]');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('id_dusun', 'Dusun', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        if ($this->form_validation->run()) {
            $dusun = $this->ModelUser->getAllDusun($this->input->post('id_dusun'));
            // var_dump($dusun);
            // die();
            $id_user = $this->insert_user();
            // echo $id_user;
            // die();
            $data['id_user'] = $id_user;
            $this->ModelUser->updateDusun($data, $dusun['id']);
            $this->ModelUser->hapusUser('user', $dusun['id_user']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kepala Dusun berhasil diubah.</div>');
        } else {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('message', $this->form_validation->error_string());
        }
        redirect('admin/dusun');
    }
}
