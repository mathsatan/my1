<?php


class ModelLogin extends Model
{
    private $RESULT = null;

    public function __construct()
    {
    }

    protected function checkUserData($login, $pass, $mail, $isAdmin, $isActive)
    {
        if (empty($login) || empty($pass)|| empty($mail))
            throw new MVCException(E_EMPTY_FIELD);

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            throw new MVCException(E_INVALID_EMAIL);

        if ((!is_numeric($isAdmin)) || !is_numeric($isActive))
            throw new MVCException(E_INCORRECT_DATA);
    }
    protected function userExist($login)
    {
        if (empty($login)) return false;

        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("SELECT * FROM mvc_users WHERE login = :login");
            $sth->execute(array(':login' => $login));
            $user = $sth->fetch();
            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
        if (empty($user))
            return false;
        else
            return $user;
    }
    public function tryLogin($login, $pass)
    {
        if (empty($login) || empty($pass))
            throw new MVCException(E_EMPTY_FIELD);

        try{
            $user = $this->userExist($login);
        }
        catch(PDOException $e){
            throw $e;
        }

        if ($user === false)
            throw new MVCException(E_USER_NOT_FOUND);

        if ($user['login'] == $login && $user['pass'] == md5($pass))
        {
            $this->RESULT = $user;
        }
        else
            throw new MVCException(E_WRONG_LOGIN_OR_PASS);
    }
    public function tryReg($login, $pass, $mail, $isAdmin = 0, $isActive = 1)
    {
        try{
            $this->checkUserData( $login, $pass, $mail, $isAdmin, $isActive);
            $this->RESULT['user'] = $this->userExist($login);
        }catch (PDOException $e1){
            throw $e1;
        }catch (MVCException $e2){
            throw $e2;
        }

        if (!empty($this->RESULT['user']))   // if login already exist
            throw new MVCException(E_LOGIN_ALREADY_EXIST);

        try{
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("INSERT INTO mvc_users (user_id, login, pass, email, status, is_active) VALUES (NULL, :login, MD5(:pass), :mail, :status, :is_active)");
            $this->RESULT['exec_res'] = $sth->execute(array(':login' => $login, ':pass' => $pass, ':mail' => $mail, ':status' => $isAdmin, ':is_active' => $isActive));
            $dbh = null;
        }catch (PDOException $e){
            throw $e;
        }
    }
            // invoke from admin controller
    public function updateUser($id, $login, $pass, $mail, $status, $isActive)
    {
        if (empty($login) || empty($mail))
            throw new MVCException(E_EMPTY_FIELD);

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
            throw new MVCException(E_INVALID_EMAIL);

        if ((!is_numeric($status)) || !is_numeric($isActive))
            throw new MVCException(E_INCORRECT_DATA);

        try{
            $user = $this->userExist($login);
        }catch (PDOException $e){
            throw $e;
        }

        if (($user['user_id'] != $id) && ($login === $user['login']))   // if login already exist
            throw new MVCException(E_LOGIN_ALREADY_EXIST);

        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DATA_BASE, LOGIN, PASS, $opt);
            if (empty($pass))  {
                $sth = $dbh->prepare("UPDATE mvc_users SET login = :login, email = :mail, status = :status, is_active = :is_active WHERE user_id = :id;");
                $this->RESULT['is_update'] = $sth->execute(array(':id' => $id, ':login' => $login, ':mail' => $mail, ':status' => $status, ':is_active' => $isActive));
            }
            else{
                $sth = $dbh->prepare("UPDATE mvc_users SET login = :login, pass = :pass, email = :mail, status = :status, is_active = :is_active WHERE user_id = :id;");
                $this->RESULT['is_update'] = $sth->execute(array(':id' => $id, ':login' => $login, ':pass' => MD5($pass), ':mail' => $mail, ':status' => $status, ':is_active' => $isActive));
            }
            $dbh = null;
        }catch (PDOException $e) {
            throw $e;
        }
    }

    public function getData()
    {
        return $this->RESULT;
    }
}