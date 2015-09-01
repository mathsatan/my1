<?
if (empty($data)) {
    ob_end_clean();
    throw new MVCException(E_NO_ARTICLE_DATA);
}
?>
    <h1><? echo $data['cat_info']['cat_name']; ?></h1>

    <?
    if (!empty($data['articles_list'])) {
        $t = new Template('app/views/mainview/', 'article_item.htx');
        $items = '';
        try {
            foreach($data['articles_list'] as $id => $title) {
                $t->addKey('article_id', $id);
                $t->addKey('article_title', $title);
                $items .= $t->parseTemplate();
            }
            echo $items;
        } catch(TemplateException $e) {
            ob_end_clean();
            throw $e;
        }
        unset($t);
    }
    else {
        echo '<h3>'.L_NO_ARTICLES_FOUND.'</h3>';
    }
    ?>