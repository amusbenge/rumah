<!-- Sidebar -->
<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3" href="<?= base_url('admin'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Desa Kabuna</sup></div>
    </a>

    <!-- Query Menu-->
    <?php
    $role_id = $user['role_id'];
    $queryMenu = "SELECT `user_menu`.`id`, `title`
                    FROM `user_menu` JOIN `user_access_menu`
                        ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `user_access_menu`.`menu_id` ASC
                ";

    $menu = $this->db->query($queryMenu)->result_array();

    ?>

    <!-- LOOPING TAMPIL MENU -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['title']; ?>
        </div>

        <!-- Siapkan Sub Menu sesuai Menu-->
        <?php
        $menuId = $m['id'];
        $querySubmenu = "SELECT * FROM `user_sub_menu`
                            WHERE `id_menu` = $menuId
                            AND `is_active` = 1
                        ";

        $subMenu = $this->db->query($querySubmenu)->result_array();
        ?>

        <!-- LOOPING TAMPIL SUB MENU -->
        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link collapsed dm" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span>
                </a>
                </li>
            <?php endforeach; ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

    <?php endforeach; ?>
    <!-- Akhir LOOPING Menu dan SUB Menu -->

</ul>
<!-- End of Sidebar -->