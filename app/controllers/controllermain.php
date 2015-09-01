<?php

class ControllerMain extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

	public function action_index()
    {
        if ($this->msg !== false) {
            $data['message'] = $this->msg;
            $data['msg_type'] = 'classic';
        } else $data['message'] = '';

        if (file_exists('app/models/modelarticles.php')) {
            include 'app/models/modelarticles.php';
        } else {
            throw new MVCException(E_MODEL_FILE_DOESNT_EXIST);
        }
        try {
            $this->model = new ModelArticles();
            $this->model->getArticles(4);
            $data['articles'] = $this->model->getData();
        } catch (PDOException $e) {
            throw $e;
        }

        unset($this->model);

        try {
            $this->view->generate('mainview.php', 'templateview.php', $data);
        }catch (TemplateException $e){
            throw $e;
        }
	}

    public function action_change_lang()
    {
        $_SESSION['lang'] = 'en';
        $this->view->generate('mainview.php', 'templateview.php');
    }
}