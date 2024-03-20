<!DOCTYPE html>
<html lang="FR">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Messagerie instantanee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/chatmvc/assets/css/style.css" rel="stylesheet"/>
</head>

<body class="d-flex flex-column min-vh-100">
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 offset-md-3">
            <div class="mb-3 mt-3">
                <h3>LOGIN CHAT</h3>
            </div>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 offset-md-3">
            <form method="post" action="login">
                <div class="mb-3">
                    <label for="pseudo" class="form-label">Entrez votre pseudo</label>
                    <input type="text" class="form-control" name="pseudo" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Entrez votre mot de passe</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <p>
                        <a href="/chatmvc/login/forgot">Mot de passe oublié ?</a>
                    </p>
                </div>
                <label for="vercode" class="form-label">Code de vérification:</label>
                <div class="mb-3">
                    <input type="text" onkeyup="this.value = this.value.replace(/[^\d]/g,'')"
                           class="form-control col"
                           id="vercode" name="vercode" required
                    >
                    <img class="form-text col-3" style="height:35px; width: auto" src="assets/captcha.php" alt="captcha">
                </div>
                <button type="submit" name="login" id="button" class="btn btn-info mb-3">LOGIN</button>
                <a class="btn mb-3" href="/chatmvc/login/signup">Je n'ai pas de compte</a>
            </form>
        </div>
    </div>
</div>

<!-- FOOTER SECTION END-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>