<?php
if (file_exists('app/models/modelarticles.php')) {
    include 'app/models/modelarticles.php';
} else {
    throw new MVCException(E_MODEL_FILE_DOESNT_EXIST);
}

class ControllerAdmin extends Controller
{
    private $data = null;

    public function __construct()
    {
        parent::__construct();

        if ($_SESSION['user_status'] != 1) {
            throw new MVCException(E_NOT_ALLOWED);
        }
        $this->data['admin_page_type'] = 'user_management';
        $this->data['menu_type'] = 'adm_left_menu.php';
    }

        // USER LIST
	public function action_index()
    {
        try {
            $this->model = new ModelAdmin();
            $this->model->getUsers();
            $this->data['users'] = $this->model->getData();
            unset($this->model);
            $this->view->generate('adminview.php', 'templateview.php',  $this->data);
        }catch (PDOException $e1){
            throw $e1;
        }catch (TemplateException $e2){
            throw $e2;
        }catch (MVCException $e3){
            throw $e3;
        }
	}

            // UPDATE USER
    public function action_load_update_form()
    {
        try {
            $this->model = new ModelAdmin();
            $this->model->getUserInfo($this->user_id);
            $res = $this->model->getData();
            $this->data['user_info'] = $res['user_info'];
            unset($this->model);
        }catch (PDOException $e){
            throw $e;
        }

        if (!empty($this->data['user_info'])) {
            $this->data['admin_page_type'] = 'update_form';
            $this->view->generate('adminview.php', 'templateview.php', $this->data);
        }else{
            $this->data['message'] = E_USER_NOT_FOUND;
            $this->action_index();
        }
    }
    public function action_update_user()
    {
        if (file_exists('app/models/modellogin.php')) {
            include 'app/models/modellogin.php';
        } else {
            throw new MVCException(E_MODEL_FILE_DOESNT_EXIST);
        }

        try {
            $this->model = new ModelLogin();
            ($_POST['new_is_active'] == 'on') ? $isActive = 1 : $isActive = 0;
            $this->model->updateUser($this->user_id, $_POST['new_login'], $_POST['new_pass'],
                $_POST['new_email'], $_POST['new_status'], $isActive);
            $res = $this->model->getData();
            unset($this->model);
        }catch (PDOException $e1){
            throw $e1;
        }catch (MVCException $e2){
            throw $e2;
        }

        if ($res['is_update'] === true) {
            $this->data['message'] = I_UPDATE_SUCCESS;
            $this->data['msg_type'] = 'classic';
        }else{
            $this->data['message'] = E_UPDATE_FAIL;
        }
        $this->action_index();
    }

            // INSERT USER
    public function action_load_insert_form()
    {
        $this->data['admin_page_type'] = 'insert_form';
        $this->view->generate('adminview.php', 'templateview.php', $this->data);
    }

    public function action_insert_user()
    {
        if (file_exists('app/models/modellogin.php')) {
            include 'app/models/modellogin.php';
        } else {
            throw new MVCException(E_MODEL_FILE_DOESNT_EXIST);
        }
        try {
            $this->model = new ModelLogin();
            ($_POST['is_active'] == 'on') ? $isActive = 1 : $isActive = 0;
            $this->model->tryReg($_POST['login'], $_POST['pass'], $_POST['email'], $_POST['status'], $isActive);

            $res = $this->model->getData();
            unset($this->model);
        }catch (PDOException $e1){
            throw $e1;
        }catch (MVCException $e2){
            throw $e2;
        }

        if ($res['exec_res'] === true) {
        $this->data['message'] = I_INSERT_SUCCESS;
        $this->data['msg_type'] = 'classic';
    }else{
        $this->data['message'] = E_INSERT_FAIL;
    }
        $this->action_index();
    }

            // DELETE USER
    public function action_delete_user()
    {
        try {
            $this->model = new ModelAdmin();
            $this->model->deleteUser($this->user_id);
            $res = $this->model->getData();
            unset($this->model);
        }catch (MVCException $e1){
            throw $e1;
        }catch (PDOException $e2){
            throw $e2;
        }

        if ($res['is_delete'] === true) {
            $this->data['message'] = I_DELETE_SUCCESS;
            $this->data['msg_type'] = 'classic';
        }else{
            $this->data['message'] = E_DELETE_FAIL;
        }
        $this->action_index();      //    что бы нельзя было повторно отправить
    }


    public function action_articles_list()
    {
        $this->data['admin_page_type'] = 'article_management';
        try {
            $this->model = new ModelArticles();
            $this->model->getArticles();
            $this->data['articles'] = $this->model->getData();
            unset($this->model);
            $this->view->generate('adminview.php', 'templateview.php',  $this->data);
        }catch (PDOException $e1){
            throw $e1;
        }catch (TemplateException $e2){
            throw $e2;
        }catch (MVCException $e3){
            throw $e3;
        }
    }

            // DELETE ARTICLE
    public function action_delete_article()
    {
        try {
            $this->model = new ModelArticles();
            $this->model->deleteArticle($this->article_id);
            $res = $this->model->getData();
            unset($this->model);
        }catch (PDOException $e){
            throw $e;
        }

        if ($res['is_delete'] === true) {
            $this->data['message'] = I_DELETE_SUCCESS;
            $this->data['msg_type'] = 'classic';
        }else{
            $this->data['message'] = E_DELETE_FAIL;
        }
        $this->action_articles_list();      //    что бы нельзя было повторно отправить
    }

            // UPDATE ARTICLE
    public function action_load_update_article_form()
    {
        try {
            $this->model = new ModelArticles();
            $this->model->getArticleById($this->article_id);
            $this->data = $this->model->getData();
            unset($this->model);
            $this->model = new ModelAdmin();
            $this->model->getUserInfo($this->data['article']['user_id']);
            $user = $this->model->getData();
            $this->data['author'] = $user['user_info'];
            unset($this->model);
        }catch (PDOException $e1){
            throw $e1;
        }catch (MVCException $e2){
            throw $e2;
        }

        if (!empty($this->data['article'])) {
            $this->data['admin_page_type'] = 'update_article_form';
            $this->view->generate('adminview.php', 'templateview.php', $this->data);
        }else{
            $this->data['message'] = E_ARTICLES_NOT_FOUND;
            $this->action_index();
        }
    }

    public function action_update_article()
    {
        try {
            $this->model = new ModelArticles();
            $this->model->updateArticle($this->article_id, $_POST['new_title'], $_POST['new_text'], $_POST['new_cat']);
            $res = $this->model->getData();
            unset($this->model);
        }catch (PDOException $e1){
            throw $e1;
        }catch (MVCException $e2){
            throw $e2;
        }

        if ($res['is_update'] === true) {
            $this->data['message'] = I_UPDATE_SUCCESS;
            $this->data['msg_type'] = 'classic';
        }else{
            $this->data['message'] = E_UPDATE_FAIL;
        }
        $this->action_articles_list();
    }

}