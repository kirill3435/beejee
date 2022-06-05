<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <script src="/public/js/jquery-v4.3.1.min.js"></script>
    <script src="/public/js/form.js"></script>
    <script src="/public/js/all.js"></script>
    <link href="/public/styles/style.css" rel="stylesheet">
    <link href="/public/styles/bootstrap-4.3.1/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="col-27-md">
            <div class="login-container">
                <? if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {?> 
                    <form id="login" action="/login" method="post">
                        <input name="login" placeholder="логин" type="text">

                        <input name="password" placeholder="пароль" type="text">

                        <button type="submit">Вход</button>
                    </form>
                <?} else {?>
                    <a href="/">Главная</a>
                    <button class="logout" type="submit">Выйти</button>
                <?}?>
            </div>
            <?=$content?>
        </div>
    </div>
</body>  
</html>