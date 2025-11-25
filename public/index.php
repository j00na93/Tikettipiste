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
    switch($request) {
    case '/':
    case '/tapahtumat':
      echo $templates->render('etusivu');
      break;
    case '/urheilu':
      require_once MODEL_DIR . 'tapahtuma.php';
      $tapahtumat = haeTapahtumatUrheilu();
      echo $templates->render('urheilu',['tapahtumat' => $tapahtumat]);
      break;
    case '/musiikki':
      require_once MODEL_DIR . 'tapahtuma.php';
      $tapahtumat = haeTapahtumatMusiikki();
      echo $templates->render('musiikki',['tapahtumat' => $tapahtumat,]);
      break; 
    case '/tapahtuma':
      require_once MODEL_DIR . 'tapahtuma.php';
      $tapahtuma = haeTapahtuma($_GET['id']);
      if ($tapahtuma) {
         echo $templates->render('tapahtuma',['tapahtuma' => $tapahtuma]);
      } else {
      echo $templates->render('tapahtumanotfound');
    }
      break;
    case '/lisaa_tili':
      if (isset($_POST['laheta'])) {
        $formdata = cleanArrayData($_POST);
        require_once MODEL_DIR . 'henkilo.php';
        $salasana = password_hash($formdata['salasana1'], PASSWORD_DEFAULT);
        $id = lisaaHenkilo($formdata['nimi'],$formdata['email'],$formdata['puhnro'],$salasana);
        echo "Tili on luotu tunnisteella $id";
        break;
      } else {
        echo $templates->render('lisaa_tili');
        break;
      } 
  default:
    echo '<h1>Pyydettyä sivua ei löytynyt :(</h1>';
    }

?> 
