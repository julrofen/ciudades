function validarCampoCompletado(idCampo){
	var campo=document.getElementById(idCampo).value;
	if (campo==""){
		alert ("Por favor, introduzca " + idCampo);
		return false;
	}
  else{
		return true;
	}
}

function validar(){
	if (validarCampoCompletado('nombre')==false) return false;
	if (validarCampoCompletado('apellidos')==false) return false;
	if (validarCampoCompletado('usuario')==false) return false;
	if (validarCampoCompletado('contrasena')==false) return false;
	return true;
}
