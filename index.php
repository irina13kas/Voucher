<?php
session_start();

// Данные пользователей (временное хранилище)
$users = [
    'admin' => [
        'password' => '123',
        'name' => 'Иван',
        'surname' => 'Иванов',
        'phone' => '+79001234567',
        'email' => 'koskinae92@gmail.com'
    ]
];

// Выход из системы
if (isset($_POST['logout'])) {
    session_destroy();
    setcookie('auth', '', time() - 3600, '/');
    header("Location: index.php");
    exit;
}

// Авторизация через куки
if (!isset($_SESSION['user']) && isset($_COOKIE['auth'])) {
    $_SESSION['user'] = json_decode($_COOKIE['auth']);
}

// Обработка формы входа
if (isset($_POST['login'])) {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    if (isset($users[$login]) && $users[$login]['password'] === $password) {
        $_SESSION['user'] = $users[$login];
        // Сохранение в куки на 7 дней
        if (isset($_POST['remember'])) {
            setcookie('auth', json_encode($users[$login]), time() + 604800, path: '/');
        }
        header("Location: index.php");
        exit;
    } else {
        $error = "Неверные данные!";
    }
}
?>

<html>
    <head>
        <title>Работа</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body topmargin="0" bottommargin="0" rightmargin="0"  leftmargin="0"   background="images/back_main.gif">
        <table cellpadding="0" cellspacing="0" border="0"  align="center" width="583" height="614">
            <tr>
                <td valign="top" width="583" height="208" background="images/row1.gif">
                    <div style="margin-left:88px; margin-top:57px "><img src="images/w1.gif"></div>
                    <div style="margin-left:50px; margin-top:69px ">
                        <a href="index.php">Главная<img src="images/m1.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="10" height="10">
                        <a href="/pages/order.php">Заказ<img src="images/m2.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="5" height="10">
                        <a href="/pages/basket.php">Корзина<img src="images/m3.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="5" height="10">
                        <a href="/pages/index-3.php">О компании<img src="images/m4.gif" border="0" ></a>
                        <img src="images/spacer.gif" width="5" height="10">
                        <a href="/pages/index-4.php">Контакты<img src="images/m5.gif" border="0" ></a>

                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top" width="583" height="338"  bgcolor="#FFFFFF">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td valign="top" height="338" width="42"></td>
                            <td valign="top" height="338" width="492">
                                <table cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td width="492" valign="top" height="106">

                                            <div style="margin-left:1px; margin-top:2px; margin-right:10px "><br>
                                                <div style="margin-left:5px "><img src="./images/1_p1.gif" align="left"></div>
                                                <div style="margin-left:95px "><font class="title">Вокруг света за 80 дней</font><br>                                  
                                                    <?php if (!isset($_SESSION['user'])): ?>
                                                        <form method="post">
                                                            <input type="login" name="login" placeholder="Login" required><br>
                                                            <input type="password" name="password" placeholder="Password" required><br>
                                                            <label><input type="checkbox" name="remember"> Запомнить меня</label><br>
                                                            <button type="submit" name="login_btn">Войти</button>
                                                            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
                                                        </form>
                                                    <?php else: ?>
                                                        <h3>Добро пожаловать, <?= htmlspecialchars($_SESSION['user']['name']. " ". $_SESSION['user']['surname']) ?>!</h3>
                                                        <p>Email: <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                                                        <p>Телефон: <?= htmlspecialchars($_SESSION['user']['phone']) ?></p>
                                                        <form method="post">
                                                            <button type="submit" name="logout">Выйти</button>
                                                        </form>
                                                    <?php endif; ?>
                                                </div> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="492" valign="top" height="232">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td valign="top" height="232" width="248">
                                                        <div style="margin-left:6px; margin-top:2px; "><img src="./images/hl.gif"></div>
                                                        <div style="margin-left:6px; margin-top:7px; "><img src="./images/1_w2.gif"></div>                                         
                                     

                                                    <td valign="top" height="215" width="1" background="./images/tal.gif" style="background-repeat:repeat-y"></td>
                                                    <td valign="top" height="215" width="243">
                                                        <div style="margin-left:22px; margin-top:2px; "><img src="./images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="./images/1_w2.gif"></div>
                                                        <div style="margin-left:22px; margin-top:13px; ">
                                                            
                                                            <br><br><br><br>
                                                           
                                                        </div>
                                                        <div style="margin-left:22px; margin-top:16px; "><img src="./images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="./images/1_w4.gif"></div>
                                                        <div style="margin-left:22px; margin-top:9px; ">
                                             
                                                        </div> 
                                                        </div>

                                                  


                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td valign="top" height="338" width="49"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td valign="top" width="583" height="68" background="images/row3.gif">
                    <div style="margin-left:51px; margin-top:31px ">
                        <a href="#"><img src="images/p1.gif" border="0"></a>
                        <img src="images/spacer.gif" width="26" height="9">
                        <a href="#"><img src="images/p2.gif" border="0"></a>
                        <img src="images/spacer.gif" width="30" height="9">
                        <a href="#"><img src="images/p3.gif" border="0"></a>
                        <img src="images/spacer.gif" width="149" height="9">
                        <a href="index-5.html"><img src="images/copyright.gif" border="0"></a>
                    </div>
                </td>
            </tr>
        </table>
    </body>
</html>
