<?php $this->layout('template', ['title' => 'Etusivu']) ?>

<div class="etusivu" id="iso_kuva">
<img src="<?= BASEURL ?>/public/images/etusivu_iso.jpg" alt="Etusivun kuva"  style="width: 100%; height: auto;">
</div> 

<div class="etusivu_alaosa">
    <div id="vasen"> 
        <h2>Suositut tapahtumat</h2>
        <?php
        foreach ($suositutTapahtumat as $tapahtuma) {
            $start = new DateTime($tapahtuma['tap_alkaa']);

            echo "<div class='suositutTapahtumat'>";
            echo "<div><h2>$tapahtuma[nimi]</h2></div>";
            echo "<div><p>" . $start->format('j.n.Y') . "</p></div>";
            echo "<div><p>$tapahtuma[paikkakunta]</p></div><br>";
            echo "</div>";
        } ?>
    </div>
    <div id="oikea">
        <h2>Uudet tapahtumat</h2>
        <?php
        foreach ($uudetTapahtumat as $tapahtuma) {
            $start = new DateTime($tapahtuma['tap_alkaa']);

            echo "<div class='uudetTapahtumat'>";
            echo "<div><h2>$tapahtuma[nimi]</h2></div>";
            echo "<div><p>" . $start->format('j.n.Y') . "</p></div>";
            echo "<div><p>$tapahtuma[paikkakunta]</p></div><br>";
            echo "</div>";
        }
        ?>
    </div>          
