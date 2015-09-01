<?
if (empty($data['articles'])) {
    ob_end_clean();
    throw new MVCException(E_ARTICLES_NOT_FOUND);
}
?>
<div id="user_table">
    <h3> <? echo L_ARTICLES_LIST; ?> </h3>
    <a href="/admin/load_insert_article_form"><? echo L_ADD_ARTICLE; ?></a>
    <table>
        <tr><td><? echo L_ARTICLE_ID; ?></td><td><? echo L_ARTICLE_TITLE; ?></td><td><? echo L_ARTICLE_BRIEFLY; ?></td>
            <td><img src="/img/change.png"/></td>
            <td><img src="/img/delete.png"/></td></tr>
        <?
        $t = new Template('app/views/adminview/', 'article_table_item.htx');
        try {
            $list = '';
            foreach($data['articles'] as $article) {
                $t->addKey('article_id', $article['article_id']);
                $t->addKey('article_title', $article['article_title']);
                $t->addKey('article_briefly', strip_tags(mb_substr($article['article_text'], 0, 32, 'UTF-8')).'...');

                $t->addKey('hint_update', L_ARTICLE_UPDATE);
                $t->addKey('hint_delete', L_ARTICLE_DELETE);

                $list .= $t->parseTemplate();
            }
            echo $list;
        }catch (TemplateException $e){
            ob_end_clean();
            throw $e;
        }
        unset($t);
        ?>
    </table>
</div>