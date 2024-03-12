<?php
session_start();

if (strlen($_SESSION['userid']) == 0) {
    header('location:../../index.phpd');
} else {
    ?>
    <html lang="fr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chat</title>
        <link href="../../css/style.css" rel="stylesheet"/>
    </head>

    <body>

    <div class="chat-wrapper">
        <div id="message-box"></div>
        <div class="user-panel">
            <input type="text" name="name" id="name" placeholder="Your Name" maxlength="15"/>
            <input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100"/>
            <button id="send-message">Send</button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/chat.js"></script>
    </body>

    </html>
<?php } ?>