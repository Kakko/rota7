<?php

class categoriesController extends Controller {

    public function index() {
        $data = array();
        $users = new Users();
        $users->setLoggedUser();

        $categories = new Categories();

        //VERIFY IF THE USER IS LOGGED, IF NOT, REDIRECT TO LOGIN PAGE
        if($users->isLogged() == false){
            header("Location:".BASE_URL."login");
        }

        if(!empty($_POST['action']) && isset($_POST['action'])) {
            if($_POST['action'] == 'add') {
                $name = addslashes($_POST['name']);

                $categories->addNewCategory($name);
                header('Location: ' . BASE_URL . 'categories');
                exit;
            }
        }

        //UTILITIES
        if(!empty($_POST['utility_action']) && isset($_POST['utility_action'])) {
            //DELETE ITEM
            if($_POST['utility_action'] == 'delete_item') {
                $id = addslashes($_POST['id']);

                echo $categories->deleteBrand($id);
                exit;
            }
        }

        $data['categories'] = $categories->fetchCategories();
        $data['user_name'] = $users->getName();
        $this->loadTemplate('categories', $data);
    }

}