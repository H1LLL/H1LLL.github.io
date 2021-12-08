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
                                    <a class="nav-link" href="rosklad.php">Розклад</a>
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
    
    <?php
        

        $data = $_POST;
        if( isset($data['do_login']) ){
            $errors = array();
            $user = R::findOne('users', 'login = ? ', array($data['login']));
            if( $user ){
                // логін існує
                if( password_verify($data['password'], $user->password) ){
                    // password true
                    $_SESSION['logged_user'] = $user;
                    header('Location: /');
                }else{
                    $errors[] = 'Пароль введено не правильно!';
                }
            }else{
                $errors[] = 'Користувача з таким логіном не знайдено!';
            }

            if( ! empty($errors) ){
                echo '<div class="alert alert-danger">'.array_shift($errors).'</div>';
            }
        }
    ?>
     <?php if( isset($_SESSION['logged_user'])) : ?>
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <p class="alert alert-success">Ви авторизовані!</p>
                </div>
            </div>
        </div>
    
    <?php else : ?>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-4">
            <form action="login.php" method="POST">
            <p>Введіть логін</p>
            <input type="text" name="login" value="<?php echo @$data['login']; ?>">
            
            <p>Введіть пароль</p>
            <input type="password" name="password" value="<?php echo @$data['password']; ?>">

            <p><button type="submit" name="do_login" class="btn">Увійти</button></p>
    </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
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