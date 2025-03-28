<?php
session_start();
// Базовые цены путевок
$tourTypes = [
    'Круиз' => 2000,
    'Сафари' => 3000,
    'Гастротур' => 1000
];

$mealTypes = [
    'Завтрак' => 10,
    'Ужин' => 20,
    'Пансион' => 50
];

// Сохранение данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['order'] = [
        'type' => ['name' => $_POST['type'],'price'=>$tourTypes[$_POST['type']]],
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'meal' => ['name' => $_POST['meal'], 'price' => $mealTypes[$_POST['meal']]]
    ];
    header("Location: bill.php");
    exit;
}
?>

<html>
    <head>
        <title>Работа</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="../css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body topmargin="0" bottommargin="0" rightmargin="0"  leftmargin="0"   background="../images/back_main.gif">


        <table cellpadding="0" cellspacing="0" border="0"  align="center" width="583" height="614">
            <tr>
                <td valign="top" width="583" height="208" background="../images/row1.gif">
                    <div style="margin-left:88px; margin-top:57px "><img src="../images/w1.gif">    </div>
                    <div style="margin-left:50px; margin-top:69px ">
                        <a href="../index.php">Главная<img src="../images/m1.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="20" height="10">
                        <a href="order.php">Заказ<img src="../images/m2.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="basket.php">Корзина<img src="../images/m3.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="index-3.php">О компании<img src="../images/m4.gif" border="0" ></a>
                        <img src="../images/spacer.gif" width="5" height="10">
                        <a href="index-4.php">Контакты<img src="../images/m5.gif" border="0" ></a>
                        </form>
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
                                                <div style="margin-left:5px "><img src="../images/1_p1.gif" align="left"></div>
                                                <div style="margin-left:95px "><font class="title">Вокруг света за 80 дней</font><br>
                                                <?php if (!isset($_SESSION['user'])): ?>
                                                    <div style="text-align: center; margin-top: 50px;">
                                                        <h3>Для оформления заказа войдите в систему</h3>
                                                        <a href="/index.php"><button>Войти в профиль</button></a>
                                                    </div>
                                                <?php else: ?>
                                                    <!-- Форма заказа -->
                                                    <form action="order.php" method="post">
                                                        <h3>Тип путевки</h3>
                                                        <select name="type" required>
                                                            <?php foreach ($tourTypes as $key => $type): ?>
                                                                <option value="<?= $key ?>"><?= $key ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                </div> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="492" valign="top" height="232">
                                            <table cellpadding="0" cellspacing="0" border="0">
                                                <tr>
                                                    <td valign="top" height="232" width="248">
                                                        <div style="margin-left:6px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:6px; margin-top:7px; "><img src="../images/1_w2.gif"></div>
                                                        <h3>Питание</h3>
                                                            <input type="radio" name="meal" value="Завтрак" required checked> Завтрак <br>
                                                            <input type="radio" name="meal" value="Ужин"> Ужин <br>
                                                            <input type="radio" name="meal" value="Пансион"> Пансион <br>
                                                            
                                                        
                                                    
                                                    <td valign="top" height="215" width="1" background="../images/tal.gif" style="background-repeat:repeat-y"></td>
                                                    <td valign="top" height="215" width="243">
                                                        <div style="margin-left:22px; margin-top:2px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w2.gif"></div>
                                                        <div style="margin-left:22px; margin-top:13px; ">
                                                        <h3>Контактные данные</h3>
                                                            <input type="text" name="name" 
                                                                value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['name']) : '' ?>" 
                                                                placeholder="Имя" required><br>
                                                                <input type="text" name="surname" 
                                                                value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['surname']) : '' ?>" 
                                                                placeholder="Фамилия" required><br>
                                                            <input type="tel" name="phone" 
                                                                value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['phone']) : '' ?>" 
                                                                placeholder="Телефон" required><br>
                                                            <input type="email" name="email" 
                                                                value="<?= isset($_SESSION['user']) ? htmlspecialchars($_SESSION['user']['email']) : '' ?>" 
                                                                placeholder="Email" required><br>
           
<br><br><br><br>
                                                         
                                                        </div>
                                                        <div style="margin-left:22px; margin-top:16px; "><img src="../images/hl.gif"></div>
                                                        <div style="margin-left:22px; margin-top:7px; "><img src="../images/1_w4.gif"></div>
                                                        <div style="margin-left:22px; margin-top:9px; ">
                                                            <button type="submit">Далее</button>
                                                            </form>
                                                        <?php endif; ?> 
                                                            
                                                            
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
                <td valign="top" width="583" height="68" background="../images/row3.gif">
                    <div style="margin-left:51px; margin-top:31px ">
                        <a href="#"><img src="../images/p1.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="26" height="9">
                        <a href="#"><img src="../images/p2.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="30" height="9">
                        <a href="#"><img src="../images/p3.gif" border="0"></a>
                        <img src="../images/spacer.gif" width="149" height="9">
                        <a href="index-5.php"><img src="../images/copyright.gif" border="0"></a>
                    </div>
                </td>
            </tr>

        </table>
    </body>
</html>
