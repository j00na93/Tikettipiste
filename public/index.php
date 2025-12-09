<?php
  // Aloitetaan istunnot.
  session_start();
// Suoritetaan projektin alustusskripti.
require_once '../src/init.php';

  // Haetaan kirjautuneen käyttäjän tiedot.
  if (isset($_SESSION['user'])) {
    require_once MODEL_DIR . 'henkilo.php';
    $loggeduser = haeHenkilo($_SESSION['user']);
  } else {
    $loggeduser = NULL;
  }
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
      require_once MODEL_DIR . 'tapahtuma.php';
      $suositutTapahtumat = suositutTapahtumat();
      $uudetTapahtumat = uudetTapahtumat();
      echo $templates->render('etusivu',['uudetTapahtumat' => $uudetTapahtumat,
                                        'suositutTapahtumat' => $suositutTapahtumat]);
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
      require_once MODEL_DIR . 'tilaus.php';
      $tapahtuma = haeTapahtuma($_GET['id']);
      $varastoaJaljella = varastoaJaljella($_GET['id']);
      

      if ($varastoaJaljella == 0) {
        $saatavuusluokka = "loppu";  
      } elseif ($varastoaJaljella < 0.25) {
        $saatavuusluokka = "vahissa";
      } else {$saatavuusluokka = "paljon";}
      
      if ($tapahtuma) {
         echo $templates->render('tapahtuma',['tapahtuma' => $tapahtuma,
                                              'saatavuusluokka' => $saatavuusluokka,
                                              'error' => []]);
      } else {
      echo $templates->render('tapahtumanotfound');
    }
      break;
    case '/lisaa_tili':
      if (isset($_POST['laheta'])) {
        $formdata = cleanArrayData($_POST);
        require_once CONTROLLER_DIR . 'tili.php';
        $tulos = lisaaTili($formdata,$config['urls']['baseUrl']);

        if ($tulos['status'] == "200") {
           echo $templates->render('tili_luotu', ['formdata' => $formdata]);
          break;
        }
        echo $templates->render('lisaa_tili', ['formdata' => $formdata, 'error' => $tulos['error']]);
        break;
      } else {
        echo $templates->render('lisaa_tili', ['formdata' => [], 'error' => []]);
        break;
      }
case "/kirjaudu":
      if (isset($_POST['laheta'])) {
        require_once CONTROLLER_DIR . 'kirjaudu.php';
        if (tarkistaKirjautuminen($_POST['email'],$_POST['salasana'])) {
          require_once MODEL_DIR . 'henkilo.php';
          $user = haeHenkilo($_POST['email']);
          if ($user['vahvistettu']) {
            session_regenerate_id();
            $_SESSION['user'] = $user['email'];
            $_SESSION['admin'] = $user['admin'];
            header("Location: " . $config['urls']['baseUrl']);
          } else {
            echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Tili on vahvistamatta! Ole hyvä, ja vahvista tili sähköpostissa olevalla linkillä.']]);
          }
        } else {
          echo $templates->render('kirjaudu', [ 'error' => ['virhe' => 'Väärä käyttäjätunnus tai salasana!']]);
        }
      } else {
        echo $templates->render('kirjaudu', [ 'error' => []]);
      }
      break;
    case "/logout":
      require_once CONTROLLER_DIR . 'kirjaudu.php';
      logout();
      header("Location: " . $config['urls']['baseUrl']);
      break;
    case "/tilaa":
      
      require_once MODEL_DIR . 'tilaus.php';
      require_once MODEL_DIR . 'tapahtuma.php';

      // tarkastetaan riittävä varastotilanne 
      $varasto = varastotilanne($_POST['idtapahtuma']);
      $varastoaJaljella = varastoaJaljella($_POST['idtapahtuma']);
      $error = [];

      if ($varastoaJaljella == 0) {
        $saatavuusluokka = "loppu";  
      } elseif ($varastoaJaljella < 0.25) {
        $saatavuusluokka = "vahissa";
      } else {
        $saatavuusluokka = "paljon";
      }

      if ($_POST['maara'] > $varasto) {
        $error['maara'] = "lippuja ei ole tarpeeksi";
      }

      if ($error) {
        $tapahtuma = haeTapahtuma($_POST['idtapahtuma']);
        echo $templates->render('tapahtuma', [
            'tapahtuma' => $tapahtuma,
            'error' => $error,
            'saatavuusluokka' => $saatavuusluokka
        ]);
        break;
      }

      // luodaan tilaus
      $tilaus_id = luoTilaus($loggeduser['idhenkilo'], $_POST['idtapahtuma']);
      
      // lisätään tilausrivi
      lisaaTilausRivi($tilaus_id, $_POST['idtapahtuma'], $_POST['maara']);
      
      // päivitetään varasto
      paivitaVarasto($_POST['maara'], $_POST['idtapahtuma']);

      echo $templates->render('tilaus_valmis', [
          'tilaus_id' => $tilaus_id,
          'maara' => $_POST['maara'],
          'tapahtuma' => $_POST['idtapahtuma']
      ]);
      break;


    case "/vahvista":
      if (isset($_GET['key'])) {
        $key = $_GET['key'];
        require_once MODEL_DIR . 'henkilo.php';
        if (vahvistaTili($key)) {
          echo $templates->render('tili_aktivoitu');
        } else {
          echo $templates->render('tili_aktivointi_virhe');
        }
      } else {
        header("Location: " . $config['urls']['baseUrl']);
      }
      break;


    case "/tilaa_vaihtoavain":
      $formdata = cleanArrayData($_POST);

      if (isset($formdata['laheta'])) {    
  
        require_once MODEL_DIR . 'henkilo.php';
        $user = haeHenkilo($formdata['email']);

        if ($user) {
          require_once CONTROLLER_DIR . 'tili.php';
          $tulos = luoVaihtoavain($formdata['email'], $config['urls']['baseUrl']);

          if ($tulos['status'] == "200") {
            echo $templates->render('tilaa_vaihtoavain_lahetetty');
            break;
          }

          echo $templates->render('virhe');
          break;

        } else {
          echo $templates->render('tilaa_vaihtoavain_lahetetty');
          break;
        }
  
      } else {
        echo $templates->render('tilaa_vaihtoavain_lomake');
      }
      break;


    case "/reset":
      $resetkey = $_GET['key'];

      require_once MODEL_DIR . 'henkilo.php';
      $rivi = tarkistaVaihtoavain($resetkey);

      if (!$rivi || $rivi['aikaikkuna'] < 0) {
        echo $templates->render('reset_virhe');
        break;
      }

      $formdata = cleanArrayData($_POST);

      if (isset($formdata['laheta'])) {

        require_once CONTROLLER_DIR . 'tili.php';
        $tulos = resetoiSalasana($formdata, $resetkey);

        if ($tulos['status'] == "200") {
          echo $templates->render('reset_valmis');
          break;
        }

        echo $templates->render('reset_lomake', ['error' => $tulos['error']]);
        break;

      } else {
        echo $templates->render('reset_lomake', ['error' => '']);
        break;
      }


    case (bool)preg_match('/\/admin.*/', $request):

      if (!$loggeduser["admin"]) {
        echo $templates->render('admin_ei_oikeuksia');
        break;
      }
        
      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["lisaaTapahtuma"])) {

        require_once MODEL_DIR . 'tapahtuma.php';
        $tapAlkaa = formatDateTimeLocal($_POST["tap_alkaa"]);
        $tapLoppuu = formatDateTimeLocal($_POST["tap_loppuu"]);
        $mAlkaa   = formatDateTimeLocal($_POST["myynti_alkaa"]);
        $mLoppuu  = formatDateTimeLocal($_POST["myynti_loppuu"]);

        lisaaTapahtuma(
            $_POST["nimi"],
            $_POST["genre"],
            $_POST["category"],
            $_POST["paikkakunta"],
            $tapAlkaa,
            $tapLoppuu,
            $mAlkaa,
            $mLoppuu,
            $_POST["hinta"],
            $_POST["varasto"],
            $_POST["alkuvarasto"],
            $_POST["kuvaus"]
        );

        echo $templates->render('tapahtuma_lisatty');
        break;
      }

      echo $templates->render('yllapitosivut');
      break;


    default:
      echo '<h1>Pyydettyä sivua ei löytynyt :(</h1>';
  }
?>