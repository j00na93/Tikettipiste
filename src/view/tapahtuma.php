<?php 

$this->layout('template', ['title' => $tapahtuma['nimi']]) ?>

<?php
  $start = new DateTime($tapahtuma['tap_alkaa']);
  $end = new DateTime($tapahtuma['tap_loppuu']);
  $saleStart = new DateTime($tapahtuma['myynti_alkaa']);
  $saleEnd = new DateTime($tapahtuma['myynti_loppuu']);
?>

<h1><?=$tapahtuma['nimi']?></h1>
<div>Paikkakunta: <?=$tapahtuma['paikkakunta']?></div><br>
<div><?=nl2br($tapahtuma['kuvaus'])?></div><br>
<div>Alkaa: <?=$start->format('j.n.Y G:i')?></div>
<div>Loppuu: <?=$end->format('j.n.Y G:i')?></div>
<div>Lippujen myynti: <?=$saleStart->format('j.n.Y') . "-" . $saleEnd->format('j.n.Y')?></div>