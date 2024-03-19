<?php if (isset($_SESSION['userid'])) : ?>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (isset($navbar)) {
                        foreach ($navbar as $item) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/chatmvc/chat/chitchat/<?=$item['id']?>"><?= $item['room_name'] ?></a>
                            </li>
                        <?php }
                    } ?>
                </ul>
            </div>
            <div class="right-div">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="change-password.php">Rechercher</a>
                    </li>
                    <li class="nav-item">
                        <a href="/chatmvc/login/login" class="btn btn-danger pull-right">DECONNEXION</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php ; else : ?>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="adminlogin.php">ADMINISTRATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">CREER UN COMPTE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">LOGIN LECTEUR</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif ?>