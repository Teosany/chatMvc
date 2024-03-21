<?php
if (!isset($_SESSION['userid']) || strlen($_SESSION['userid']) == 0) {
    header('location:index.php?action=login/login');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="FR">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chat</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet"/>
        <link href="/assets/css/styleChat.css" rel="stylesheet"/>
    </head>

    <body class="d-flex flex-column min-vh-100">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-8 offset-md-3">
                <div class="mb-3 mt-3">
                    <h3>Vous discutez dans la room <?= $room['room_name']; ?></h3>
                </div>
                <hr>
            </div>
        </div>
        <div class="chat-wrapper container">
            <div id="message-box">
                <?php if (isset($messages)) {
                    foreach ($messages as $item) { ?>
                        <div>
                        <span class="user_name"
                              style="color:<?= $item['msg_color']; ?>"><?= $item['user_name'] . ' ' . $item['msg_date']; ?></span>
                            : <br> <span class="user_message"><?= $item['msg_text']; ?></span>
                        </div>
                    <?php }
                } ?>
            </div>
            <div class="user-panel">
                <input type="text" name="name" id="name" placeholder="Your Name" maxlength="15"
                       value="<?= $_SESSION['user_name'] ?>"/>
                <input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100"/>
                <button id="send-message">Send</button>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="/assets/js/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
    </body>

    </html>
<?php } ?>