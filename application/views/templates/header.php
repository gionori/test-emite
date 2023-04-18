<html>
        <head>
                <title>Hugo Blog</title>
        	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
        <body>

        <header>
                <?php $url = docker_url() ?>
                <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <div class="container-fluid">
                                <a
                                        class="navbar-brand"
                                        href="<?php echo $url ?>"
                                >
                                        <strong>
                                                H U G O · U S E R S
                                        </strong>
                                </a>

                                <?php if ($this->session->has_userdata('email')): ?>                                
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                        <li class="nav-item">
                                                                <a
                                                                        class="nav-link active"
                                                                        href="<?php echo "$url/users" ?>"
                                                                >
                                                                        Usuarios        
                                                                </a>
                                                        </li>
                                                        <li class="nav-item">
                                                                <a
                                                                        class="nav-link active"
                                                                        href="<?php echo "$url/pages/logout" ?>"
                                                                >
                                                                        Cerrar        
                                                                </a>
                                                        </li>
                                                </ul>
                                        </div>
                                <?php else: ?>
                                        <div class="collapse navbar-collapse d-flex" id="navbarSupportedContent">
                                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                        <li class="nav-item">
                                                                <a
                                                                        class="nav-link active"
                                                                        href="<?php echo "$url/pages/login" ?>"
                                                                >
                                                                        Login        
                                                                </a>
                                                        </li>
                                                        <li class="nav-item">
                                                                <a
                                                                        class="nav-link active"
                                                                        href="<?php echo "$url/pages/registro" ?>"
                                                                >
                                                                        Registro        
                                                                </a>
                                                        </li>
                                                </ul>
                                        </div>
                                <?php endif; ?>
                        </div>
                </nav>
        </header>
        <div class="container mt-5">