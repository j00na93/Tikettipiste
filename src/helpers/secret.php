<?php

  function generateActivationCode($text='') {
    return hash('sha1', $text . rand());
  }

  // luodaan salasanan vaihtoavain
  function generateResetCode($text='') {
    return generateActivationCode($text);
  }
  

?>