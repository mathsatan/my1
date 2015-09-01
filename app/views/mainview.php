<h1><? echo L_NEWS; ?></h1>
<?
if (!empty($data['articles']))
{
    $t = new Template('app/views/mainview/', 'article.htx');
    try {
        $list = '';
        foreach($data['articles'] as $article)
        {
            $t->addKey('article_title', $article['article_title']);
            $t->addKey('date', $article['article_date']);
            $t->addKey('path_to_title_pic', $article['title_pic']);
            $t->addKey('article_id', $article['article_id']);
            $begin = strip_tags(mb_substr($article['article_text'], 0, 255, 'UTF-8'));
            $t->addKey('article_text_briefly', $begin."...");
            $list .= $t->parseTemplate();
        }

        echo $list;
    }catch (TemplateException $e){
        ob_end_clean();
        throw $e;
    }
    unset($t);
}
?>
