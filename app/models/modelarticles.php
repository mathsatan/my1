<?php


class ModelArticles extends Model
{
    private $RESULT = null;

    public function addComment($userId, $artId, $text)
    {
        if (empty($userId) || empty($artId) || empty($text))
        {
            throw new MVCException(E_EMPTY_FIELD);
        }

        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("INSERT INTO mvc_comments (comment_id, user_id, article_id, comment_text, comment_date) VALUES (NULL, :user_id, :article_id, :comment_text, CURRENT_TIMESTAMP);");
            $result = $sth->execute(array(':user_id' => $userId, ':article_id' => $artId, ':comment_text' => $text));
            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
        return $result;
    }

    public function getCategories($catId = null)
    {
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DATA_BASE, LOGIN, PASS, $opt);
            $cat = null;
            if ($catId != null) {
                $sth = $dbh->prepare("SELECT * FROM mvc_categories WHERE cat_id = :catId");
                $sth->execute(array(':catId' => $catId));
                $cat = $sth->fetch();
            }
            else {
                $sth = $dbh->prepare("SELECT * FROM mvc_categories");
                $sth->execute();
                $cat = $sth->fetchAll();
            }
            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
        return $cat;
    }

    public function getArticleById($articleId)
    {
        if (empty($articleId) || !is_numeric($articleId))
        {
            throw new MVCException(L_WRONG_ID);
        }
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("SELECT * FROM mvc_articles WHERE article_id = :art_id");
            $sth->execute(array(':art_id' => $articleId));
            $this->RESULT['article'] = $sth->fetch();

            $cat = $this->getCategories($this->RESULT['article']['cat_id']);
            $this->RESULT['cat_name'] = $cat['cat_name'];

            $sth = $dbh->prepare("SELECT login, user_id FROM mvc_users WHERE user_id IN (SELECT user_id FROM mvc_comments WHERE article_id = :art_id )");
            $sth->execute(array(':art_id' => $articleId));
            while($user = $sth->fetch())
            {
                $this->RESULT['users'][$user['user_id']] = $user['login'];
            }

            $sth = $dbh->prepare("SELECT * FROM mvc_comments WHERE article_id = :art_id ORDER BY comment_date");
            $sth->execute(array(':art_id' => $articleId));

            $this->RESULT['comments'] = $sth->fetchAll();
            for($i = 0; $i < count($this->RESULT['comments']); $i++)
            {
                $this->RESULT['comments'][$i]['user_name'] = $this->RESULT['users'][$this->RESULT['comments'][$i]['user_id']];
            }

            unset($this->RESULT['users']);

            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    public function getArticlesByCat($catId)
    {
        if(!is_numeric($catId))
        {
            throw new MVCException(E_WRONG_ID);
        }
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("SELECT article_id, article_title FROM mvc_articles WHERE cat_id = :cat_id");
            $sth->execute(array(':cat_id' => $catId));

            while($article = $sth->fetch())
            {
                $id  = $article['article_id'];
                $this->RESULT[$id]  = $article['article_title'];
            }

            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    public function getArticles($item_count = null)
    {
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);

            $num = $this->getArticlesNumber();
            if ($item_count != null)
            {
                if ($item_count > $num || $item_count < 1) $item_count = $num;
                unset($num);
                $sth = $dbh->prepare("SELECT * FROM mvc_articles ORDER BY (date_format(article_date, '%Y-%m-%d')) DESC LIMIT 0, $item_count;");   // plcaeholder?
            }
            else{
                $sth = $dbh->prepare("SELECT * FROM mvc_articles ORDER BY (date_format(article_date, '%Y-%m-%d')) DESC;");
            }
            $sth->execute();
            $this->RESULT = $sth->fetchAll();
            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }

    public function deleteArticle($id)
    {
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);

            $sth = $dbh->prepare("DELETE FROM mvc_articles WHERE article_id = :art_id");
            $this->RESULT['is_delete'] = $sth->execute(array(':art_id' => $id));
            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
    }


    public function updateArticle($article_id, $new_title, $new_text, $new_cat_id)
    {
        if (empty($article_id) || empty($new_title) || empty($new_text) || empty($new_cat_id)) throw new MVCException(E_EMPTY_FIELD);

        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DATA_BASE, LOGIN, PASS, $opt);

            $sth = $dbh->prepare("UPDATE mvc_articles SET article_title = :title, article_text = :text, cat_id = :cat WHERE article_id = :id;");
            $this->RESULT['is_update'] = $sth->execute(array(':id' => $article_id, ':title' => $new_title, ':text' => $new_text, ':cat' => $new_cat_id));

            $dbh = null;
        }catch (PDOException $e) {
            throw $e;
        }
    }

    public function getData()
    {
        return $this->RESULT;
    }

    // protected:
    protected function getArticlesNumber()
    {
        try {
            $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $dbh = new PDO("mysql:host=".HOST.";dbname=".DATA_BASE, LOGIN, PASS, $opt);
            $sth = $dbh->prepare("SELECT COUNT(*) FROM mvc_articles");
            $sth->execute();
            $number = $sth->fetch();
            $dbh = null;
        }
        catch(PDOException $e) {
            throw $e;
        }
        return $number['COUNT(*)'];
    }

}