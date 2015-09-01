<?php


class ModelAdmin extends Model
{
    private $RESULT = null;

    public function __construct()
    {
    }

    public function getUsers($count = null)
    {
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);
            if ($count === null) {
                $sth = $dbh->prepare("SELECT * FROM mvc_users");
                $sth->execute(array(':num' => $count));
            }
            else{
                if ($count < 1) throw new MVCException(E_INCORRECT_DATA);

                $sth = $dbh->prepare("SELECT * FROM mvc_users WHERE LIMIT 0, :num");
                $sth->execute(array(':num' => $count));
            }

            $this->RESULT = $sth->fetchAll();
            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    public function deleteUser($id)
    {
        if (!is_numeric($id) || $id < 0) throw new MVCException(E_INCORRECT_DATA);
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("DELETE FROM mvc_users WHERE  user_id = :id;");
            $this->RESULT['is_delete'] = $sth->execute(array(':id' => $id));
            $dbh = null;
        }catch (PDOException $e) {
            throw $e;
        }
    }

    public function getUserInfo($id)
    {
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("SELECT * FROM mvc_users WHERE user_id = :user_id");
            $sth->execute(array(':user_id' => $id));
            $this->RESULT['user_info'] = $sth->fetch();
            $dbh = null;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function getData()
    {
        return $this->RESULT;
    }
}