<?php 

$this->layout('template', ['title' => $tapahtuma['nimi']]) ?>

<?php
  $aika = new datetime();
  $start = new DateTime($tapahtuma['tap_alkaa']);
  $end = new DateTime($tapahtuma['tap_loppuu']);
  $saleStart = new DateTime($tapahtuma['myynti_alkaa']);
  $saleEnd = new DateTime($tapahtuma['myynti_loppuu']);

  if ($start > $aika) {
  echo "<div class='tapahtumanTiedot'>";
  echo "<h2>" . htmlspecialchars($tapahtuma['nimi']) . "</h2>";
  echo "<div><p>Paikkakunta: " . htmlspecialchars($tapahtuma['paikkakunta']) . "</p></div><br>";
  echo "<div><p>" . nl2br(htmlspecialchars($tapahtuma['kuvaus'])) . "</p></div><br>";
  echo "<div><p>Alkaa: " . htmlspecialchars($start->format('j.n.Y G:i')) . "</p></div>";
  echo "<div><p>Loppuu: " . htmlspecialchars($end->format('j.n.Y G:i')) . "</p></div>";
  echo "<div><p>Lippujen myynti: " . htmlspecialchars($saleStart->format('j.n.Y')) . "-" . htmlspecialchars($saleEnd->format('j.n.Y')). "</p></div>";


  echo "<form class='ostoTiedot' action='" . BASEURL . "/tilaa' method='post'>";
  echo "<input type='hidden' name='idtapahtuma' value='$tapahtuma[idtapahtuma]'>";

  if (isset($_SESSION['user'])) {
    echo "<label for='maara'>Määrä</label>";
    echo "<input type='number' name='maara' min='1' required>";
    echo "<button type='submit'>Tilaa</button>";
    echo "<div class='saatavuus'>";
    echo "<p>Saatavuus: </p>";
    echo "<span class=$saatavuusluokka></span>";
    echo "</div>";
  } else {
    echo "<div class='saatavuus'>";
    echo "<p>Saatavuus: </p>";
    echo "<span class=$saatavuusluokka></span>";
    echo "</div>";  
  }
  echo "</form>";
  echo "<div class='error'>" . getValue($error, 'maara') . "</div>";
  echo "</div>";
} 

  



?>
  
