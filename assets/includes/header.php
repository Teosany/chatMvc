<?php if (isset($_SESSION['userid']) && $_SESSION['userid'] !== '') : ?>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
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
                                <a class="nav-link"
                                   href="index.php?action=chat/chitChat/<?= $item['id'] ?>"><?= $item['room_name'] ?></a>
                            </li>
                        <?php }
                    } ?>
                </ul>
            </div>
            <div class="right-div">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <div class="container-fluid">
                            <form class="d-flex mb-3" role="search" method="post" action="index.php?action=search/searchMessages">
                                <input type="search" name="search" class="form-control me-2" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-secondary" type="submit">Search</button>
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="container-fluid">
                            <a href="index.php?action=login/login" class="btn btn-outline-secondary link-danger pull-right">DECONNEXION</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php ; else : ?>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="index.php?action=login/login">LOGIN</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="index.php?action=login/signup">SIGNUP</a>
                            </li>
                </ul>
            </div>
        </div>
    </nav>
<?php endif ?>