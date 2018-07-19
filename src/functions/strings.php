<?php

/* Ambas funções abaixo esperam receber
(string, quantos caracteres) */
// Função retorna parte da direita da Esquerda da String
function left($str, $length) {
     return substr($str, 0, $length);
}

// Função retorna parte da direita da String
function right($str, $length) {
     return substr($str, -$length);
}

?>