<ul class="list-unstyled components">
    <?php foreach ($menus as $menu): ?>

        <?php if ($menu->sub_menu == ""): ?>
            <li>
                <a href="<?= $BASE_URL . $menu->url; ?>" target="myFrame" onclick="addClass(<?= $menu->id_menu ?>)">
                    <i class="<?= $menu->class_icon ?>"></i>
                    <?= $menu->menu_name ?>
                </a>
            </li>
        <?php else: ?>
            <li>
                <a href="<?= $menu->url; ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                    onclick="addClass(<?= $menu->id_menu ?>)">
                    <i class="<?= $menu->class_icon ?>"></i>
                    <?= $menu->menu_name ?>
                </a>
                <ul class="collapse list-unstyled" id="<?= substr($menu->url, 1); ?>">
                    <?php $subMenus = $menu_Dao->findSubMenu($menu->id_menu); ?>
                    <?php foreach ($subMenus as $subMenu): ?>

                        <li>
                            <a href="<?= $BASE_URL ?><?= $subMenu->url_submenu; ?>" onclick="addClass(<?= $menu->id_menu ?>)"
                                target="myFrame"><i class="<?= $subMenu->class_icon_submenu ?>"></i>
                                <?= $subMenu->submenu_name; ?>
                            </a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </li>

        <?php endif; ?>

    <?php endforeach; ?>
</ul>