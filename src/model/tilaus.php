<?php

  require_once HELPERS_DIR . 'DB.php';


function luoTilaus($henkilo_id){
    DB::run('INSERT INTO tilaukset (henkilo_id) VALUES (?)',
    [$henkilo_id] );
    return DB::lastInsertid();
}

  function lisaaTilausRivi($tilaus_id,$tapahtuma_id,$maara) {
    DB::run('INSERT INTO tilausrivit (tilaus_id, tapahtuma_id, maara) VALUES (?,?,?)',
            [$idtilaus, $idtapahtuma,$maara]);
    return DB::lastInsertId();
  }


function paivitaVarasto($tapahtuma_id,$maara) {
    DB::run('UPDATE tapahtumat SET varasto = varasto - ?
    WHERE idtapahtuma = ?',
    [$maara,$idtapahtuma] );
}


