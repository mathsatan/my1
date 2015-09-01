<?php

class ControllerError extends Controller
{
    private $msg;
    public function __construct($errorMsg)
    {
        parent::__construct();
        $this->msg = $errorMsg;
    }

    public function action_index()
	{
        $data['error_msg'] = $this->msg;
		$this->view->generate('errorview.php', 'templateview.php', $data);
	}
}
