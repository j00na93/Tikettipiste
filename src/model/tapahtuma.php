<?php

  require_once HELPERS_DIR . 'DB.php';

  function haeTapahtumat() {
    return DB::run('SELECT * FROM tapahtumat ORDER BY tap_alkaa;')->fetchAll();
  }

    function haeTapahtumatUrheilu() {
    return DB::run('SELECT * FROM tapahtumat WHERE category_id = 2 ORDER BY tap_alkaa;')->fetchAll();

  }

  function haeTapahtumatMusiikki() {
    return DB::run('SELECT * FROM tapahtumat WHERE category_id = 1 ORDER BY tap_alkaa;')->fetchAll();
    
  }

    function haeTapahtuma($id) {
    return DB::run('SELECT * FROM tapahtumat WHERE idtapahtuma = ?;',[$id])->fetch();
  }

  function formatDateTimeLocal($aika) {
    return str_replace('T', ' ', $aika) . ':00';
  }

  function lisaaTapahtuma($nimi,$genre,$category,$paikkakunta,$tapAlkaa,$tapLoppuu,$mAlkaa,$mLoppuu,$hinta,$varasto,$kuvaus ) {
  DB::run('INSERT INTO tapahtumat (nimi,genre,category_id,paikkakunta,tap_alkaa,tap_loppuu,myynti_alkaa,myynti_loppuu,hinta,varasto,kuvaus)
  VALUES (?,?,?,?,?,?,?,?,?,?,?)', [$nimi,$genre,$category,$paikkakunta,$tapAlkaa,$tapLoppuu,$mAlkaa,$mLoppuu,$hinta,$varasto,$kuvaus]); }  
?>