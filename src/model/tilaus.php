<?php

  require_once HELPERS_DIR . 'DB.php';


function luoTilaus($henkilo_id, $tapahtuma_id){
    DB::run('INSERT INTO tilaukset (henkilo_id, tapahtuma_id) VALUES (?,?)',
    [$henkilo_id,$tapahtuma_id] );
    return DB::lastInsertid();
}

  function lisaaTilausRivi($tilaus_id,$tapahtuma_id,$maara) {
    DB::run('INSERT INTO tilausrivit (tilaus_id, tapahtuma_id, maara) VALUES (?,?,?)',
            [$tilaus_id, $tapahtuma_id,$maara]);
    return DB::lastInsertId();
  }


function paivitaVarasto($maara,$idtapahtuma) {
    DB::run('UPDATE tapahtumat SET varasto = varasto - ?
    WHERE idtapahtuma = ?',
    [$maara,$idtapahtuma] );
}

function varastoaJaljella($tapahtuma_id) {
  $tulos = DB::run('SELECT varasto / alkuvarasto AS osuus FROM tapahtumat
  WHERE idtapahtuma = ?;',[$tapahtuma_id])->fetch();
  return $tulos['osuus'];
}

