
<br /><br /><br /><br /><br /><br />
	  <form id="login" method="POST" action="javascript: verificarLogin();">
      <table width="400" border="0" cellspacing="0" cellpadding="0" class="ventana">
        <tr>
          <td class="tituloVentana" height="23">INGRESAR AL SISTEMA</td>
        </tr>
        <tr>
          <td align="center"><br />

        <span class="textosParaInputs">NOMBRE DE USUARIO:</span><br /><input id="usuario" name="usuario" type="text" maxlength="12" onkeyup="this.value = this.value.toUpperCase();" onfocus="javascript: document.getElementById('estado').innerHTML = '&nbsp;';" />
        <br /><br />   
        <span class="textosParaInputs">CONTRASEÑA:</span><br /><input id="pass" name="pass" type="password" maxlength="12" onkeyup="this.value = this.value.toUpperCase();" onfocus="javascript: document.getElementById('estado').innerHTML = '&nbsp;';" />
        <br /><br />   


  <input name="entrar" type="submit" value="Ingresar" class="botones"  />
  <br /><br /><span id="estado" class="error">&nbsp;</span>
		  </td>
        </tr>
      </table>
      </form>