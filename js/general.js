function pLogin(xA,xB)
{
	var objf = document.mFrmLogin;
	if (xA!="" && xB!=""){
		objf.fUsr.value=xA;
		objf.fPas.value=xB;
	}
	if (objf.fUsr.value=="") {window.alert('Silahkan masukan userid anda..!!'); return false;}
	if (objf.fPas.value=="") {window.alert('Silahkan masukan kata kunci..!!'); return false;}
	objf.submit();
}

function pSend()
{
	var objf = document.mFrmKritik;
	//window.alert(objf.file.value);
	if (objf.fT1.value=="") {window.alert('Silahkan masukan nama anda..!!'); return false;}
	//if (objf.fPas.value=="") {window.alert('Silahkan masukan kata kunci..!!'); return false;}
	objf.submit();
}

