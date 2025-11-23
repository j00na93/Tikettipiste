<?php $this->layout('template', ['title' => 'Tulevat tapahtumat']) ?>

<h1 class="otsikko">Tulevat tapahtumat</h1>

<div class='tapahtumat'>
<?php

foreach ($tapahtumat as $tapahtuma) {

  $start = new DateTime($tapahtuma['tap_alkaa']);
  $end = new DateTime($tapahtuma['tap_loppuu']);
  $saleStart = new DateTime($tapahtuma['myynti_alkaa']);
  $saleEnd = new DateTime($tapahtuma['myynti_loppuu']);
  $style = "font_" . $tapahtuma['genre'];


  echo "<div class='$style tapahtuma'>";
    echo "<div><h2>$tapahtuma[nimi]</h2></div>";
    echo "<div>" . $start->format('j.n.Y') . "-" . $end->format('j.n.Y') . "</div>";
    echo "<div>$tapahtuma[paikkakunta]</div><br>";
    echo "<div>" . nl2br($tapahtuma['kuvaus']) . "</div><br>";
    echo "<div>" . $saleStart->format('j.n.Y') . "-" . $saleEnd->format('j.n.Y') . "</div>";
    echo "<div>" . "hinta:" . $tapahtuma['hinta'] . "€" . "</div>";
    echo "<div><a href='tapahtuma?id=" . $tapahtuma['idtapahtuma'] . "'>TIEDOT</a></div>";

    echo "</div>";

}

?>
</div>