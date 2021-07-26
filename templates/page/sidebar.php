<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?php echo $absolute_include ?>design/assets/img/profile.jpg">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                        <div><?php echo $_SESSION['nombre']; ?></div>
                        <span class="user-level text-success">Conectado</span>
                        <span class="caret"></span>
                    </span>
                </a>
                <div class="clearfix"></div>

                <div class="collapse in" id="collapseExample" aria-expanded="true">
                    <ul class="nav">
                        <li>
                            <a>
                                <span class="link-collapse">Horario de salida: <?php echo $_SESSION['horario']; ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="#edit">
                                <span class="link-collapse">Editar perfil</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $absolute_include ?>logout">
                                <span class="link-collapse">Cerrar sesion</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="#settings">
                                <span class="link-collapse">Settings</span>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">

            <li class="nav-item <?php if($page == "home"){ echo "active"; } ?>">
                <a href="<?php echo $absolute_include ?>empleado/home">
                    <i class="la la-home"></i>
                    <p>Menu</p>
                </a>
            </li>

            <li class="nav-item <?php if($page == "atencion"){ echo "active"; } ?>">
                <a href="<?php echo $absolute_include ?>empleado/atencion">
                    <i class="la la-male"></i>
                    <p>Atencion al cliente</p>
                    <!-- <span class="badge badge-count badge-success">3</span> -->
                </a>
            </li>

            <li class="nav-item <?php if($page == "lista"){ echo "active"; } ?>">
                <a href="<?php echo $absolute_include ?>empleado/lista">
                    <i class="la la-list"></i>
                    <p>Lista de turnos hoy</p>
                    <!-- <span class="badge badge-count badge-success">3</span> -->
                </a>
            </li>

            <!-- <li class="nav-item">
                <a href="components.html">
                    <i class="la la-table"></i>
                    <p>Components</p>
                    <span class="badge badge-count">14</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a href="forms.html">
                    <i class="la la-keyboard-o"></i>
                    <p>Forms</p>
                    <span class="badge badge-count">50</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a href="tables.html">
                    <i class="la la-th"></i>
                    <p>Tables</p>
                    <span class="badge badge-count">6</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a href="notifications.html">
                    <i class="la la-bell"></i>
                    <p>Notifications</p>
                    <span class="badge badge-success">3</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a href="typography.html">
                    <i class="la la-font"></i>
                    <p>Typography</p>
                    <span class="badge badge-danger">25</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a href="icons.html">
                    <i class="la la-fonticons"></i>
                    <p>Icons</p>
                </a>
            </li> -->
            <!-- <li class="nav-item update-pro">
                <button  data-toggle="modal" data-target="#modalUpdate">
                    <i class="la la-hand-pointer-o"></i>
                    <p>Update To Pro</p>
                </button>
            </li> -->
        </ul>
    </div>
</div>