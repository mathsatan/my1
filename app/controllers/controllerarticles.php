<?php

class ControllerArticles extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

	public function action_index()
	{
	}

    public function action_article_by_cat()
    {
        try {
            $this->model = new ModelArticles();
            $data['cat_info'] = $this->model->getCategories($this->cat_id);

            $this->model->getArticlesByCat($this->cat_id);
            $data['articles_list'] = $this->model->getData();

            unset($this->model);

            $this->view->generate('articleslistview.php', 'templateview.php', $data);
        } catch (PDOException $e1) {
            throw $e1;
        } catch (MVCException $e2) {
            throw $e2;
        } catch (TemplateException $e3) {
            throw $e3;
        }
    }

    public function action_add_comment()
    {
        if (!empty($_POST['comment_text'])) {
            try {
                $this->model = new ModelArticles();
                $this->model->addComment($_POST['user_id'], $_POST['article_id'], $_POST['comment_text']);
                unset($this->model);
            } catch (PDOException $e1) {
                throw $e1;
            } catch (MVCException $e2) {
                throw $e2;
            }
        }
        header('Location:/articles/read/article_id/'.$_POST['article_id'].'#pointer');
    }

    public function action_read()
    {
        try {
            $this->model = new ModelArticles();
            $this->model->getArticleById($this->article_id);
            $data = $this->model->getData();
            unset($this->model);
            $this->view->generate('articlesview.php', 'templateview.php', $data);
        }catch (PDOException $e1) {
            throw $e1;
        }catch (MVCException $e2) {
            throw $e2;
        }catch (TemplateException $e3){
            throw $e3;
        }
    }
}