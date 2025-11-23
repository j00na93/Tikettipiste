<?php $this->layout('template', ['title' => 'Etusivu']) ?>

<div class="etusivu" id="iso_kuva">
<img src="<?= BASEURL ?>/public/images/etusivu_iso.jpg" alt="Etusivun kuva"  style="width: 100%; height: auto;">
</div> 

<div class="etusivu_alaosa">
    <div id="vasen"> 
        <h2>Suositut tapahtumat</h2>
    </div>
    <div id="oikea">
        <h2>Uudet tapahtumat</h2>
    </div>       
</div>