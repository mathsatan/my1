<?php

class ControllerLogin extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function action_index()
	{
        if($_POST['try_login'] == '1')
        {
            $data['message'] = '';
            try {
                $this->model = new ModelLogin();
                $this->model->tryLogin($_POST['login'], $_POST['password']);
                $userData = $this->model->getData();
            } catch (PDOException $e1) {
                $data['message'] = $e1->getMessage();

            } catch (MVCException $e2) {
                $data['message'] = $e2->getMessage();
            }
            unset($this->model);

            if (!empty($data['message'])){
                $data['msg_type'] = 'classic stick_error';
                $this->view->generate('loginview.php', 'templateview.php', $data);
            }
            elseif ($userData != null)
            {
                $data['message'] = I_LOGIN_SUCCESS;
                $data['msg_type'] = 'classic';
                session_start();
                $_SESSION["user_id"] = $userData['user_id'];
                $_SESSION["login"] = $userData['login'];
                $_SESSION["user_status"] = $userData['status'];
                header('Location:/main/index/msg/'.I_LOGIN_SUCCESS);
            }
        }else
        $this->view->generate('loginview.php', 'templateview.php');
	}

    public function action_registration()
    {
        if(isset($_POST['try_reg']))
        {
            $data['message'] = '';
            try {
                $this->model = new ModelLogin();
                $this->model->tryReg($_POST['login'], $_POST['password'], $_POST['email']);
                $res = $this->model->getData();
            } catch (PDOException $e1) {
                $data['message'] = $e1->getMessage();

            } catch (MVCException $e2) {
                $data['message'] = $e2->getMessage();
            }
            unset($this->model);

            if (!empty($data['message'])){
                $data['msg_type'] = 'classic stick_error';
                $this->view->generate('regview.php', 'templateview.php', $data);
            }
            elseif ($res['exec_res'] === true)
            {
                $data['message'] = I_REG_SUCCESS;
                $data['msg_type'] = 'classic';
                header('Location:/main/index/msg/'.I_REG_SUCCESS);
            }
        }
        else
            $this->view->generate('regview.php', 'templateview.php');
    }

    public function action_logout()
    {
        session_start();
        session_destroy();
        header('Location:/');
    }
}
