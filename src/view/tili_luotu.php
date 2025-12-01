<?php $this->layout('template', ['title' => 'Tili luotu']) ?>

<h1 id="tili_luotu_otsikko">Sinulle on luotu uusi tili!</h1>
<div class="tili_luotu">
<p id="tili_luotu">Sinun tulee varmistaa sähköpostiosoitteesi ennen, kuin voit käyttää
tiliäsi. Sinulle on lähetetty sähköpostiisi (<b><?= getValue($formdata,'email') ?></b>)
vahvistusviesti. Ole hyvä ja käy vahvistamassa sähköpostiosoitteesi klikkaamalla
viestissä olevaa linkkiä.</p>
</div>
