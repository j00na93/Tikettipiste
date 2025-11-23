<!DOCTYPE html>
<html lang="fi">
  <head>
    <link href="styles/styles.css" rel="stylesheet">
    <title>Tikettipiste - <?=$this->e($title)?></title>
    <meta charset="UTF-8">    
  </head>
  <body>
    <header>
      <div class="ylatunniste">
        <div class="tunniste_painikkeet" id="logo"><h1><a href="<?=BASEURL?>">Tikettipiste</a></h1></div>
        <div class="tunniste_painikkeet"><h1><a href="<?=BASEURL?>/musiikki">Musiikki</a></h1></div>
        <div class="tunniste_painikkeet"><h1><a href="<?=BASEURL?>/urheilu">Urheilu</a></h1></div>


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