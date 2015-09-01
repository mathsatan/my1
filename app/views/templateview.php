<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<title><?echo L_TITLE?></title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="/img/icon.ico" type="image/x-icon">

	<link rel="stylesheet" type="text/css" href="/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/css/message.css" />
	<script src="/js/jquery-2.1.1.js" type="text/javascript"></script>
    <script src="/js/message.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var msg = decodeURIComponent('<?echo $data['message']?>');
            var msg_type = '<?echo $data['msg_type']?>';
            if (msg != '')
                if (msg_type == 'classic')
                    $.stickr({note: msg, className: 'classic'});
                else
                    $.stickr({note: msg, className: 'classic stick_error', sticked: true});
        });
    </script>
</head>
<body>

<div id="wrapper">
    <div id="header">
        <div id="logo">
            <h1><a href="/"><?echo L_SITE_TITLE?></a></h1>
        </div>
        <div id="login_menu">
            <h4>
            <?php
            if ($_SESSION['user_id'] == true)
                echo L_HELLO.', '.$_SESSION['login']." <a href='/login/logout'>&nbsp;".L_OUT.'</a>';
            else
                echo '<a href="/login">'.L_LOGIN.'</a>&nbsp|&nbsp<td><a href="/login/registration">'.L_REG.'</a>';
            ?>
            </h4>
        </div>
    </div>

    <div id="page">
        <?
        (empty($data['menu_type'])) ? include 'app/views/left_menu.php':
        include 'app/views/'.$data['menu_type'];
        ?>
        <div id="content">
            <?php include 'app/views/'.$content_view; ?>
            <br class="clearfix" />
        </div>
        <br class="clearfix" />
    </div>

    <!-----PAGE BOTTOM------>
    <div id="page-bottom">
        <div id = "lang_menu">
            <form method="post" id="lang_ru"><input type="hidden" name="lang" value="ru"></form>
            <form method="post" id="lang_en"><input type="hidden" name="lang" value="en"></form>
            <a href="#" onclick="document.getElementById('lang_ru').submit(); return false;">ru</a>&nbsp;|&nbsp;
            <a href="#" onclick="document.getElementById('lang_en').submit(); return false;">en</a>
        </div>
        <br class="clearfix" />
    </div>
</div>
<div id="footer">
    <h4><a href="/">mephistofel</a> &copy; 2015</a></h4>
</div>

</body>
</html>