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


    echo "<div class='tapahtuma'>";
    echo "<div><h2 class='" .htmlspecialchars($style) . "'>"
    . htmlspecialchars($tapahtuma['nimi'])
    . "</h2></div>";
    echo "<div>" . htmlspecialchars($start->format('j.n.Y')) . "-" . htmlspecialchars($end->format('j.n.Y')) . "</div>";
    echo "<div> Paikkakunta: " . htmlspecialchars($tapahtuma['paikkakunta']) . "</div><br>";
    echo "<div><p>" . nl2br(htmlspecialchars($tapahtuma['kuvaus'])) . "</p></div><br>";
    echo "<div>Myynti: " . htmlspecialchars($saleStart->format('j.n.Y')) . "-" . htmlspecialchars($saleEnd->format('j.n.Y')) . "</div>";
    echo "<div> hinta: " . htmlspecialchars($tapahtuma['hinta']) . "€" . "</div>";
    echo "<div><a href='tapahtuma?id=" . htmlspecialchars($tapahtuma['idtapahtuma']) . "'>TIEDOT</a></div>";
    echo "</div>";

}

?>
</div>