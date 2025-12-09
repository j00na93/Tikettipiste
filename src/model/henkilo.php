<?php

  require_once HELPERS_DIR . 'DB.php';

  function lisaaHenkilo($nimi,$email,$puhnro,$salasana) {
    DB::run('INSERT INTO kayttaja (nimi, email, puhnro, salasana) VALUE  (?,?,?,?);',[$nimi,$email,$puhnro,$salasana]);
    return DB::lastInsertId();
  }
    function haeHenkiloSahkopostilla($email) {
    return DB::run('SELECT * FROM kayttaja WHERE email = ?;', [$email])->fetchAll();
  }
    function haeHenkilo($email) {
    return DB::run('SELECT * FROM kayttaja WHERE email = ?;', [$email])->fetch();
  }

    function paivitaVahvavain($email,$avain) {
    return DB::run('UPDATE kayttaja SET vahvavain = ? WHERE email = ?', [$avain,$email])->rowCount();
  }

  function vahvistaTili($avain) {
    return DB::run('UPDATE kayttaja SET vahvistettu = TRUE WHERE vahvavain = ?', [$avain])->rowCount();
  }

  // salasanan vaihtoavaimet
  function asetaVaihtoavain($email,$avain) {
    return DB::run('UPDATE kayttaja SET nollausavain = ?, nollausaika = NOW() + INTERVAL 30 MINUTE WHERE email = ?', [$avain,$email])->rowCount();
  }

  function tarkistaVaihtoavain($avain) {
    return DB::run('SELECT nollausavain, nollausaika-NOW() AS aikaikkuna FROM kayttaja WHERE nollausavain = ?', [$avain])->fetch();
  }

  function vaihdaSalasanaAvaimella($salasana,$avain) {
    return DB::run('UPDATE kayttaja SET salasana = ?, nollausavain = NULL, nollausaika = NULL WHERE nollausavain = ?', [$salasana,$avain])->rowCount();
  }  

?>