<?php       

function isValidAlphabeticString($input) {
  return preg_match('/^[A-Za-z\s]+$/', $input) === 1;
}
 
function isValidNumericString($input) {
  return preg_match('/^[0-9]+$/', $input) === 1;
}

?>