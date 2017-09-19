            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php
                            foreach($_SESSION["user_menu"] as $menu){
                            ?>
                            <li>
                                <a href="<?php echo _URL_.$menu["url"]; ?>"><i class="<?php echo $menu["icono"];?> fa-fw"></i> <?php echo utf8_encode($menu["nombre"]);?></a>
                                <?php
                                if($menu["childs"] != "0"){
                                    $childs = $menu["childs"];
                                    echo "<ul class='nav nav-second-level'>";
                                    foreach($childs as $child){
                                    ?>
                                        <li>
                                            <a href="<?php echo _URL_.$child["url"]; ?>"><i class="<?php echo $child["icono"];?> fa-fw"></i> <?php echo utf8_encode($child["nombre"]);?></a>
                                        </li>
                                    <?php
                                    }
                                    echo "</ul>";
                                }
                                ?>
                            </li>
                            <?php
                                
                            }
                            ?>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        