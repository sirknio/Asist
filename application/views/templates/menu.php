
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=site_url('dashboard')?>">Concretos Mixer</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <?= $page['buttons'] ?>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?= $userdata['Usuario'] ?>
						<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?=site_url('Usuario/updateItem/'.$userdata['idUsuario'])?>"><i class="fa fa-user fa-fw"></i> Perfil Usuario</a>
                        </li>
                        <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a> -->
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=site_url('login/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> Aplicación<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <?php if ($userdata['TipoUsuario'] == 'Admin'): ?>
                                <li>
                                    <a href="<?=site_url('aplicacion')?>">Configuración</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('Usuario')?>">Usuarios</a>
                                </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?=site_url('Integrante')?>">Lista Empleados</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('asistencia/index/1')?>">Registrar Ingreso</a>
                                </li>
                                <li>
                                    <a href="<?=site_url('asistencia/index/0')?>">Registrar Salida</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



		<!-- !PAGE CONTENT! -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
