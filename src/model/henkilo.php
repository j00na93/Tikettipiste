<?php

  require_once HELPERS_DIR . 'DB.php';

  function lisaaHenkilo($nimi,$email,$puhnro,$salasana) {
    DB::run('INSERT INTO kayttaja (nimi, email, puhnro, salasana) VALUE  (?,?,?,?);',[$nimi,$email,$puhnro,$salasana]);
    return DB::lastInsertId();
  }
    function haeHenkiloSahkopostilla($email) {
    return DB::run('SELECT * FROM kayttaja WHERE email = ?;', [$email])->fetchAll();
  }

?>