<!DOCTYPE html>
<html lang="fi">
  <head>
    <link href="styles/styles.css" rel="stylesheet">
    <title>Tikettipiste - <?=$this->e($title)?></title>
    <meta charset="UTF-8">    
  </head>
  <body>
    <header>
      <div class="navbar">
        <ul>
          <li><a href="<?=BASEURL?>">Tikettipiste</a></li>
          <li><a href="<?=BASEURL?>/musiikki">Musiikki</a></li>
          <li><a href="<?=BASEURL?>/urheilu">Urheilu</a></li>
          <li>            <div class="profile">
        <?php
          if (isset($_SESSION['user'])) {
            echo "<div>$_SESSION[user]";
            echo "<a id='kirjaudu_ulos' href='logout'>Kirjaudu ulos</a></div>";
          } else {
            echo "<div><a href='kirjaudu'>Kirjaudu</a></div>";
          }
        ?></li></div>
      
        </ul>
      </div>

    </header>
    <section class="main">
      <?=$this->section('content')?>
    </section>
    <footer>
      <hr>
      <div>Tikettipiste by j00na93</div>
    </footer>
  </body>
</html>