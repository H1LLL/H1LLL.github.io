

<?php 
require "db.php";
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>НСК Олімпійський</title>

    <link rel="stylesheet" href="./styles/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
    <link rel="stylesheet" href="./styles/reg.css">
    <link rel="stylesheet" href="./styles/main.css">
    <!-- <link href="путь_до/jquery.fancybox.min.css" rel="stylesheet"> -->
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script type="module">
  import { Fancybox } from "https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.esm.js";
</script>
   
    
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="color1">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md color1 navbar-dark nav">
                        <!-- Brand -->
                        <a class="navbar-brand" href="index.php"><img src="./img/logo.png" alt="logo" class="logo"></a>
                    
                        <!-- Toggler/collapsibe Button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                    
                        <!-- Navbar links -->
                        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="./events.php">Події</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./news.php">Новини</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./photos.php">Фото галерея</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active_nav" href="rosklad.php">Розклад</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="index.php">Про нас</a>
                                </li>
                                <li class="nav-item">
                                <?php
                                    if( isset($_SESSION['logged_user'])) : ?>
                                    <a class="nav-link login" href="logout.php">Вийти</a>
                                    <?php else : ?>
                                    <a class="nav-link login" href="signup.php">Зареэструватись/Увійти</a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 nsk_info">
                    <p>Пропонуємо Вам скористатися унікальною можливістю відвідати одну з найграндіозніших сучасних спортивних споруд в Європі - НСК «Олімпійський». Під час екскурсії Ви дізнаєтеся багато вражаючих фактів з історії стадіону, і зможете оцінити грандіозність і масштабність найбільшої спортивної арени України категорії класу «Еліт».</p>
                </div>
            </div>
            <div class="row">
                    <div class="col-12 nsk_info">
                        <h2>Екскурсії проводяться лише за попереднім обов'язковим бронюванням: </h2>
                        <p>час проведення турів: 11:00, 13:00, 15:00 та 17:00;</p>
                        <p>максимальна кількість відвідувачів – 15 осіб;</p>
                        <p>Тривалість екскурсії - 50 хв. - 1 година.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 nsk_info">
                        <h2>Увага! Наявність у гостей засобів індивідуального захисту: масок та рукавичок – обов’язкова. </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 nsk_info">
                        <h2>Забронювати екскурсію: </h2>
                        <p>mob. +380 63 900 47 49 (Viber/Whatsapp/Telegram)</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 nsk_info">
                        <p>mob. +380 63 900 47 71</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 nsk_info">
                        <h2>Попередній запис - обов'язковий! </h2>
                    </div>
                </div>
                
        </div>
    </section>
    <?php
        
    ?>
    <section>
        
        <div class="container">
            <div class="row">
                <div class="col-12 text-light form-name"><h3>Форма замовлення</h3></div>
            </div>
            <div class="row">
            <?php
        

        $data = $_POST;
        if( isset($data['save']) ){

            $errors = array();
            if( trim($data['adult_count']) == '' ){
                $errors[] = 'Введіть кількість осіб!';
            }
            if( trim($data['time']) == '' ){
                $errors[] = 'Виберіть час!';
            }
            if( trim($data['mounth']) == '' ){
                $errors[] = 'Виберіть місяць!';
            }
            if( trim($data['number_day']) == '' ){
                $errors[] = 'Виберіть число!';
            }
            if( trim($data['year']) == '' ){
                $errors[] = 'Виберіть рік!';
            }

            if(! isset($_SESSION['logged_user'])){
                $errors[] = 'Ввійдіть на свій аккаунт або зареєструйтесь';
            }

            if( empty($errors) ){
                // register
                $exc = R::dispense('rosklad');
                $exc->adult_count = $data['adult_count'];
                $exc->time = $data['time'];
                $exc->mounth = $data['mounth'];
                $exc->number_day = $data['number_day'];
                $exc->year = $data['year'];
                
                R::store($exc);
                header('Location: /index.php');
            }else{
                echo '<div class="alert alert-danger">'.array_shift($errors).'</div>';
            }
        }
    ?>
    
    
        <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12">
                <form action="rosklad.php" method="POST">

                <p class="text_reg">Введіть кількість осіб</p>
                <input type="text" name="adult_count" value="<?php echo @$data['adult_count']; ?>">

                <!-- <input type="date" placeholder="Дата проведення" value="<?php echo @$data['date']; ?>"> -->
                <div class="date d-flex">
                        <select class="s_time" name="mounth" value="<?php echo @$data['mounth']; ?>"> 
                            <option disabled="" selected="">Місяць</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <select class="s_time" name="number_day" value="<?php echo @$data['number_day']; ?>"> 
                            <option disabled="" selected="">Число</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10"10></option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select class="s_time" name="year" value="<?php echo @$data['year']; ?>"> 
                            <option disabled="" selected="">Рік</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            
                        </select>
                </div>
                <select class="s_time" name="time" value="<?php echo @$data['time']; ?>"> 
                            <option disabled="" selected="">ГГ</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                <p><button type="submit" name="save" class="btn">Відправити</button></p>

                </form>
            </div>
        </div>
    </div>
        
                    <!-- <form action="rosklad.php" method="POST" class="form-z col-12">
                        <input type="date" placeholder="Дата проведення" value="<?php echo @$data['date']; ?>">
                        <select class="s_time" name="time" value="<?php echo @$data['time']; ?>"> 
                            <option disabled="" selected="">ГГ</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                        <input type="text" name="adult_count" placeholder="Кількість осіб" maxlength="255" value="<?php echo @$data['adult_count']; ?>">
                        <p><button type="submit" name="save" class="btn">Відправити</button></p> -->
                
                    </form>
                
            </div>
        </div>
    </section>
    
    <footer class="mt-auto container d-flex flex-wrap justify-content-between align-items-center py-3 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
      </a>
      <span class="text-white">© 2021 HILL</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-muted" href="#"><img src="./img/facebook.png" alt="facebook" width="25px"></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><img src="./img/instagram.png" alt="instagram" width="25px"></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><img src="./img/youtube.png" alt="youtube" width="25px"></a></li>
    </ul>
  </footer>

</body>
</html>