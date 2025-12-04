<?php $this->layout('template', ['title' => 'Ylläpitosivut.']) ?>

<h1> Ylläpitosivut</h1>
<h2>lisää tapahtuma</h2>

<div>    
    <form class="lisaaTapahtuma" action="" method="post">
        <div> 
            <label for ="nimi"> Nimi: </label>
            <input type="text" name="nimi">
        </div> 
        <div>
            <label for="genre">Genre: </label>
            <input type="text" name="genre">
        </div>
        <div>
            <label for ="category"> Category_id: </label>
            <input type="number" name="category">
        </div>
        <div>
            <label for ="paikkakunta"> Paikkakunta: </label>
            <input type="text" name="paikkakunta">
        </div>        
        <div>
            <label for="tap_alkaa">Tapahtuma alkaa:</label>
            <input type="datetime-local" name="tap_alkaa" required>
        </div> 
        <div>   
            <label for="tap_loppuu">Tapahtuma loppuu:</label>
            <input type="datetime-local" name="tap_loppuu" required>
        </div>
        <div>    
            <label for="myynti_alkaa">Myynti alkaa:</label>
            <input type="datetime-local" name="myynti_alkaa" required>
        </div>
        <div>    
            <label for="myynti_loppuu">Myynti loppuu:</label>
            <input type="datetime-local" name="myynti_loppuu" required> 
        </div>
        <div>    
            <label for="hinta">Hinta: </label>
            <input type="number" name="hinta">
        </div>
        <div>    
            <label for="varasto">Varasto: </label>
            <input type="number" name="varasto">
        </div>
        <div>    
            <label for ="kuvaus"> Kuvaus: </label>
            <textarea name="kuvaus" rows="4"></textarea>
        </div>    
            <input type="submit" name="lisaaTapahtuma" value="Lisää">
    </form>    



