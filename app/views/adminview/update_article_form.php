<div id="edit_article">
    <h3> <? echo L_ARTICLE_UPDATE; ?> </h3>
    <form method="post" action="/admin/update_article/article_id/<? echo $data['article']['article_id']; ?>">
        <p><? echo L_ARTICLE_ID; ?>: <? echo $data['article']['article_id']; ?></p>
        <p><? echo L_ARTICLE_TITLE; ?> <input type="text" name="new_title" value="<? echo $data['article']['article_title']; ?>"> </p>
        <p><? echo L_ARTICLE_TEXT; ?> <textarea name="new_text"> <? echo $data['article']['article_text']; ?> </textarea></p>
        <p>
            <select name="new_cat">
                <option disabled><? echo L_ARTICLE_CAT; ?></option>
                <option <? if ($data['article']['cat_id'] == 1) echo 'selected'; ?> value="1"><? echo L_ART; ?></option>
                <option <? if ($data['article']['cat_id'] == 2) echo 'selected'; ?> value="2"><? echo L_MATH; ?></option>
                <option <? if ($data['article']['cat_id'] == 3) echo 'selected'; ?> value="3"><? echo L_PROG; ?></option>
            </select>
            <? echo L_ARTICLE_AUTHOR; ?>: <? echo $data['author']['login']; ?>
       <input type="submit" value="<? echo L_SUBMIT; ?>"></p>
    </form>
</div>