<?php

class ChatController extends Controller
{
    protected ?ChatModel $oChatModel;

    public function __construct()
    {
        $this->oChatModel = new ChatModel();
        $this->oChatModel->connection = new Database();
    }

    public function chitChat($room): void
    {
        $this->oChatModel->table = 'rooms';
        $this->oChatModel->id = $room;

        $navbar = $this->oChatModel->getAll();
        $room = $this->oChatModel->getOne();
        $_SESSION['roomId'] = $room['id'];

        $messages = $this->oChatModel->getMessages();

        require_once(ROOT . 'assets/includes/header.php');
        require_once(ROOT . 'views/chat/ChatView.php');
        require_once(ROOT . 'assets/includes/footer.php');
    }
    public function updateChat(int $userId, int $roomId, string $message, string $name, string $color, $date): void
    {
        $this->oChatModel->insertMessage($userId, $roomId, $message, $color, $date);

        if ($name !== $_SESSION['user_name']) {
            $this->oChatModel->updateUser($userId, $name);
            $_SESSION['user_name'] = $name;
        }

    }
}