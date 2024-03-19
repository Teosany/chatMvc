let msgBox = $('#message-box');
let wsUri = "ws://localhost:9000/server.php";
websocket = new WebSocket(wsUri);

websocket.onopen = function (ev) { // connection is open
    msgBox.append('<div class="system_msg" style="color:#bbbbbb">Welcome to my "Demo WebSocket Chat box"!</div>'); //notify user
}
// Message received from server
websocket.onmessage = function (ev) {
    let response = JSON.parse(ev.data); //PHP sends Json data

    let res_type = response.type; //message type
    let user_message = response.message; //message text
    let user_name = response.name; //user name
    let user_color = response.color; //color

    const user_date = () => {
        const unixTime = response.date * 1000
        return(new Date (unixTime).toLocaleString('fr-FR'))
    }

    switch (res_type) {
        case 'usermsg':
            msgBox.append('<div><span class="user_name" style="color:' + user_color + '">' + user_name +  user_date() + ' </span> : </br> <span class="user_message">' + user_message + '</span></div>');
            break;
        case 'system':
            msgBox.append('<div style="color:#bbbbbb">' + user_message + '</div>');
            break;
    }
    msgBox[0].scrollTop = msgBox[0].scrollHeight; //scroll message
};

websocket.onerror = function (ev) {
    msgBox.append('<div class="system_error">Error Occurred - ' + ev.data + '</div>');
};
websocket.onclose = function (ev) {
    msgBox.append('<div class="system_msg">Connection Closed</div>');
};

//Message send button
$('#send-message').click(function () {
    send_message();
});

//User hits enter key
$("#message").on("keydown", function (event) {
    if (event.which == 13) {
        send_message();
    }
});

//Send message
function send_message() {
    let message_input = $('#message'); //user message text
    let name_input = $('#name'); //user name

    if (message_input.val() == "") { //empty name?
        alert("Enter your Name please!");
        return;
    }
    if (message_input.val() == "") { //emtpy message?
        alert("Enter Some message Please!");
        return;
    }

    //prepare json data
    let msg = {
        message: message_input.val(),
        name: name_input.val(),
        color: 'black',
        date: 'date',
    };

    let d0 = $.ajax({
        type: 'POST',
        url: '/chatmvc/index.php',
        data: msg,
    });
    $.when(d0).done(function (msg1) {
        msg['color'] = msg1['color'];
        msg['date'] = msg1['date'];

        websocket.send(JSON.stringify(msg));
        message_input.val('');
    });


    // Envoyr les données du message à la base de données
    //convert and send data to server

    // websocket.send(JSON.stringify(msg));
    // message_input.val(''); //reset message input
}