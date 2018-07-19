<?php
function validaSenha($senha1, $senha2) {
  if(($senha1=="" && $senha2=="") || ($senha1 != $senha2)) {
    return false;
  }else{
      return true;
  }
}
//----------------------------------------------------------------------------
function criarCriptografia($email){
  $valor_criptografado = sha1($email);
  return $valor_criptografado;//gera sempre o mesmo valor, com isso o link antigo funciona(pegar a dada do link?)
}
//----------------------------------------------------------------------------
//não estou usando esta função
function validarCriptografia($cripto, $senhaTemporaria){
  if($cripto == $senhaTemporaria){
    return true;
  }else{
    return false;
  }
}
?>
