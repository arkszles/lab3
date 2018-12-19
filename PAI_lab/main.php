<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .fakeimg {
      height: 200px;
      background: #aaa;
  }
  </style>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h1>My First Bootstrap 4 Page</h1>
  <p>Resize this responsive page to see the effect!</p> 
</div>




<<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="main.php">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="main.php">Strona główna</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Kategoria <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
                $menu = array('kategoria_1.php'=>'Karty sieciowe USB', 'kategoria_2.php'=>'Kategoria_2','kategoria_3.php'=>'Kategoria_3');
                foreach ($menu as $key => $value):
            ?>
            <li><a href="<?php echo $key?>"><?php echo $value?></a></li>
            <?php endforeach ?>
          </ul>
        </li>
        <li><a href="#">Kontakt</a></li>
  
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Rejestracja</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
      </ul>
    </div>
  </div>
</nav>



<div class="container" style="margin-top:30px">
  <div class="row">
    
    <div class="col-sm-8">
      
  <h1>Section 1</h1>
  <?php
  $polaczenie = @mysqli_connect("localhost","root","","pai_szleszynski");
  if (!$polaczenie) {
    die('Wystąpił błąd połączenia: ' . mysqli_connect_errno());
  }
  @mysqli_query($polaczenie, 'SET NAMES utf8');

  $sql = 'SELECT `id`, `nazwa`
               FROM `kategorie`
               ORDER BY `nazwa`';
  $wynik = mysqli_query($polaczenie, $sql);
  if (mysqli_num_rows($wynik) > 0) {
  	echo "<ul>" . PHP_EOL;
    while (($kategoria = @mysqli_fetch_array($wynik))) {
      echo '<li><a href="' . $_SERVER["PHP_SELF"] . '?kat_id=' . $kategoria['id'] . '">' . $kategoria['nazwa'] . '</a></li>' . PHP_EOL;
    }
    echo "</ul>" . PHP_EOL;
  } else {
    echo 'wyników 0';
  }

  //Pobieramy dane produktów z bazy dla wybranej (metodą GET) kategorii
  $kat_id = isset($_GET['kat_id']) ? (int)$_GET['kat_id'] : 1;
  $sql = 'SELECT `nazwa`, `opis`
               FROM `produkty`
               WHERE `kategoria_id` = ' . $kat_id .
               ' ORDER BY `nazwa`';
  $wynik = mysqli_query($polaczenie, $sql);
  if (mysqli_num_rows($wynik) > 0) {
    while (($produkt = @mysqli_fetch_array($wynik))) {
        echo '<p><b>' . $produkt['nazwa'] . '</b>: ' . $produkt['opis'] . '</p>' . PHP_EOL;
    }
  } else {
    echo 'wyników 0';
  }
?>
      <br>
      <h2>TITLE HEADING</h2>
      <h5>Title description, Sep 2, 2017</h5>
      <div class="fakeimg">Fake Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
  </div>
</div>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Footer</p>
</div>

</body>
</html>
