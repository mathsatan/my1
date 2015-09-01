<div class="login_form">
<h1><?echo L_REG_PAGE?></h1>
<form action='' method='post'>
    <table>
        <tr><td><?echo L_USER_LOGIN?>*</td> <td><input type='text' name='login'></td></tr>
        <tr><td><?echo L_USER_PASS?>*</td><td><input type='password' name='password'></td></tr>
        <tr><td><?echo L_USER_MAIL?>*</td> <td><input type='text' name='email'></td></tr>
        <input type="hidden" name="try_reg" value="1">
        <tr><td colspan="2"><input type='submit' value="<? echo L_SUBMIT; ?>"</td></tr>
    </table>
</form>
</div>