<?php
if (!isset($_SESSION['userid']) || strlen($_SESSION['userid']) == 0) {
    header('location:index.php?action=login/login');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="FR">

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet"/>
        <link href="/assets/css/styleChat.css" rel="stylesheet"/>
    </head>

<body class="d-flex flex-column min-vh-100">
<div class="container">
    <div class="row">
        <div class="col-xs-14 col-sm-7 col-md-7 col-lg-7 offset-md-3">
            <div class="mb-3 mt-3">
                <h3>RECHERCHE DANS LE CHAT</h3>
                <h5> Vous etes connecté en tant que <?= $_SESSION['user_name'] ?></h5>
            </div>
            <hr>
        </div>
    </div>
    <div class="card">
    <div class="card-header">
        <div class="container-fluid">
            <form class="d-flex mb-3" role="search" method="post" action="index.php?action=search/searchMessages">
                <input type="search" name="search" class="form-control me-2" placeholder="Search"
                       aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="card-body">
    <div class="table-responsive-md">
    <table class="table table-sm table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Utilisateur</th>
        <th scope="col">Room</th>
        <th scope="col">Date</th>
        <th scope="col">Message</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($messages)) :
        $i = 1;
    foreach ($messages as $result) : ?>
        <tr class="table-success">
            <th class="table-light" scope="row">
                <?php echo $i; ?></th>
            <td><?php echo $result->user_name; ?></td>
            <td><?php echo $result->room_name; ?></td>
            <td><?php echo $result->msg_date; ?></td>
            <td><?php echo $result->msg_text; ?></td>
        </tr>
    <?php $i++;
    endforeach;
    endif;
    ?>
        </tbody>
        </table>
        </div>
        </div>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
                integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
                crossorigin="anonymous"></script>
        </body>

        </html>
        <?php
    } ?>