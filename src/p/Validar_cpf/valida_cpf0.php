<?php
/*
@autor: Moacir SelÃ­nger Fernandes
@email: hassed@hassed.com
Qualquer dÃºvida Ã© sÃ³ mandar um email
*/

// FunÃ§Ã£o que valida o CPF
function validaCPF($cpf)
{	// Verifiva se o nÃºmero digitado contÃ©m todos os digitos
    $cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

	// Verifica se nenhuma das sequÃªncias abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
	{
	return false;
    }
	else
	{   // Calcula os nÃºmeros para verificar se o CPF Ã© verdadeiro
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}
// Verifica se o botÃ£o de validaÃ§Ã£o foi acionado
if(isset($_POST['btvalidar']))
	{// Adiciona o numero enviado na variavel $cpf_enviado, poderia ser outro nome, e executa a funÃ§Ã£o acima
	$cpf_enviado = validaCPF($_POST['cpf']);
	// Verifica a resposta da funÃ§Ã£o e exibe na tela
	if($cpf_enviado == true)
		echo "CPF VERDADEIRO";
	elseif($cpf_enviado == false)
		echo "CPF FALSO";
	}
?>
<html>
<head>
</head>
<body>
<form action="valida_cpf.php" method="post" name="cpf" id="cpf">
  CPF:
  <label>
  <input name="cpf" type="text" id="cpf" size="11" maxlength="11">
  </label>
  <label>
  <input name="btvalidar" type="submit" id="btvalidar" value="  Validar  ">
  </label>
</form>
</body>
</html>
