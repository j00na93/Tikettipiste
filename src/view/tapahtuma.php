<?php 

$this->layout('template', ['title' => $tapahtuma['nimi']]) ?>

<?php
  $start = new DateTime($tapahtuma['tap_alkaa']);
  $end = new DateTime($tapahtuma['tap_loppuu']);
  $saleStart = new DateTime($tapahtuma['myynti_alkaa']);
  $saleEnd = new DateTime($tapahtuma['myynti_loppuu']);
?>
<div class="tapahtumanTiedot">
<h2><?=htmlspecialchars($tapahtuma['nimi'])?></h2>
<div><p>Paikkakunta: <?=htmlspecialchars($tapahtuma['paikkakunta'])?></p></div><br>
<div><p><?=nl2br(htmlspecialchars($tapahtuma['kuvaus']))?></p></div><br>
<div><p>Alkaa: <?=htmlspecialchars($start->format('j.n.Y G:i'))?></p></div>
<div><p>Loppuu: <?=htmlspecialchars($end->format('j.n.Y G:i'))?></p></div>
<div><p>Lippujen myynti: <?=htmlspecialchars($saleStart->format('j.n.Y')) . "-" . htmlspecialchars($saleEnd->format('j.n.Y'))?></p></div>


<form class="ostoTiedot" action=<?=BASEURL . "/tilaa"?> method="post">
  <input type="hidden" name="idtapahtuma" value="<?=$tapahtuma['idtapahtuma']?>">

  <?php if (isset($_SESSION['user'])) {
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
  ?>
  <div class="error"><?= getValue($error,'maara'); ?></div>
</div>

</form>
  
