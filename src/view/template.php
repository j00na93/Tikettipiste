<!DOCTYPE html>
<html lang="fi">
  <head>
    <link href="styles/styles.css" rel="stylesheet">
    <title>Tikettipiste - <?=$this->e($title)?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">    
  </head>
  <body>
    <header>
      <div class="navbar">
        <ul>
          <li><a href="<?=BASEURL?>">Tikettipiste</a></li>
          <li><a href="<?=BASEURL?>/musiikki">Musiikki</a></li>
          <li><a href="<?=BASEURL?>/urheilu">Urheilu</a></li>
          <li>
          <div class="profile">
          <div class="profile_buttons">
              
        <?php
          if (isset($_SESSION['user'])) {

           if (isset($_SESSION['admin']) && $_SESSION['admin']) {
              echo "<a href='admin'>Ylläpitosivut</a>";  
            }  
            echo "<a id='kirjaudu_ulos' href='logout'>Kirjaudu ulos</a>";
            echo "<p id='session_id'>$_SESSION[user]</p>";
    
          } else {
            echo "<a href='kirjaudu'>Kirjaudu</a>";
          }
        ?></div></div></li>
      
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