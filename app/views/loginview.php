<div class="login_form">
<h1><?echo L_LOGIN_PAGE?></h1>
<form action='' method='post'>
    <table>
    <tr><td><?echo L_USER_LOGIN?>:</td> <td><input type='text' name='login'></td></tr>
    <tr><td><?echo L_USER_PASS?>:</td> <td><input type='password' name='password'></td></tr>
    <input name="try_login" type="hidden" value="1">
    <tr><td colspan="2"><input type='submit' value="<? echo L_SUBMIT; ?>"></td></tr>
   <!---- <tr><td colspan="2"></td>--->
    </table>
</form>
</div>
