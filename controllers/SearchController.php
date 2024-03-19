<?php

class searchController extends Controller
{
    protected ?SearchModel $oSearchModel;

    public function __construct()
    {
        $this->oSearchModel = new searchModel();
        $this->oSearchModel->connection = new Database();
    }

    public function searchMessages($search): void
    {
        $this->oSearchModel->table = 'rooms';

        $navbar = $this->oSearchModel->getAll();

        if (isset($search['search'])) {
            $messages = $this->oSearchModel->searchMessages($search['search']);
        }

        require_once(ROOT . 'assets/includes/header.php');
        require_once(ROOT . 'views/chat/SearchView.php');
        require_once(ROOT . 'assets/includes/footer.php');
    }
}