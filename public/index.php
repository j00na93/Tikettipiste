<?php

// Suoritetaan projektin alustusskripti.
require_once '../src/init.php';
  // Siistitään polku urlin alusta ja mahdolliset parametrit urlin lopusta.
  // Siistimisen jälkeen osoite /~koodaaja/lanify/tapahtuma?id=1 on 
  // lyhentynyt muotoon /tapahtuma.
  $request = str_replace('/~p43849/tikettipiste','',$_SERVER['REQUEST_URI']);
  $request = strtok($request, '?');

  // Luodaan uusi Plates-olio ja kytketään se sovelluksen sivupohjiin.
  $templates = new League\Plates\Engine(TEMPLATE_DIR);

  // Selvitetään mitä sivua on kutsuttu ja suoritetaan sivua vastaava 
  // käsittelijä.
  if ($request === '/') {
    echo $templates->render('etusivu');
  }
  else if ($request === '/urheilu') {
    require_once MODEL_DIR . 'tapahtuma.php';
    $tapahtumat = haeTapahtumatUrheilu();
    echo $templates->render('urheilu',['tapahtumat' => $tapahtumat]);
    
  } else if ($request === '/musiikki') {
    require_once MODEL_DIR . 'tapahtuma.php';
     $tapahtumat = haeTapahtumatMusiikki();
     echo $templates->render('musiikki',['tapahtumat' => $tapahtumat]);
  } else {
    echo '<h1>Pyydettyä sivua ei löytynyt :(</h1>';
  }

?> 
