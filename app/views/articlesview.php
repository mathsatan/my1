<?
if (empty($data['article'])) {
    ob_end_clean();
    throw new MVCException(E_NO_ARTICLE_DATA);
}
(empty($data['comments']))? $str = L_NO_COMMENTS : $str = L_COMMENTS;
?>
<div class="article">
    <h1><? echo $data['article']['article_title']; ?></h1>
    <? echo $data['article']['article_text']; ?>
    <h3><? echo $str ?></h3>
    <?
    if (!empty($data['comments']))
    {
        $t = new Template('app/views/mainview/', 'comment.htx');
        $comments = '';
        try {
            for ($i = 0; $i < count($data['comments']); $i++) {

                $t->addKey('user_name', $data['comments'][$i]['user_name']);
                $t->addKey('comment_date', $data['comments'][$i]['comment_date']);
                $t->addKey('article_comment_text', $data['comments'][$i]['comment_text']);
                $comments .= $t->parseTemplate();
            }
            echo $comments;
        } catch(TemplateException $e) {
            ob_end_clean();
            throw $e;
        }
        unset($t);
    }

    if ($_SESSION['user_id'] == true)
    {
        $t = new Template('app/views/mainview/', 'add_comment.htx');
        try{
            $t->addKey('article_id', $data['article']['article_id']);
            $t->addKey('user_id', $_SESSION['user_id']);


            $t->addKey('your_comment', L_YOUR_COMMENT);
            $t->addKey('submit', L_SUBMIT);

            $t->display();
        }catch (TemplateException $e) {
            throw $e;
        }
        unset($t);
    }
    ?>
</div>