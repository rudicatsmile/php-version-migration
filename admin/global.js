var xmlHttp = createXmlHttpRequestObject();
function createXmlHttpRequestObject()
{
	var xmlHttp;
	if(window.ActiveXObject)
	{
		try 
			{xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");}
		catch (e) 
			{xmlHttp = false;}
	}
	else
	{
		try 
			{xmlHttp = new XMLHttpRequest();}
		catch (e) 
			{xmlHttp = false;}
	}
	
	if (!xmlHttp) 
		{alert("Obyek XMLHttpRequest gagal dibuat");}
	else 
		{return xmlHttp;}
}

function fCariGLOBAL(CrT,gVL)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		gMST = "";
		xmlHttp.open("GET", "php/global.php?CrT="+CrT+"&gMST="+gMST+"&gVL="+gVL, true);
		xmlHttp.onreadystatechange = function(){handleServerResponseNiL(CrT);}
		xmlHttp.send(null);
	}
	else 
	{
		setTimeout('select()', 1000);
	}
}

function fCariDATA(CrT,gMS,gSB,gUP)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		if (CrT=="CrSub" || CrT=="CrUpb")
		{
			gMS = encodeURIComponent(document.getElementById(gMS).value);
			xmlHttp.open("GET", "global.php?CrT="+CrT+"&gMS="+gMS, true);
		}
		if (CrT=="CrKLP")
		{
			gMS = gMS;
			xmlHttp.open("GET", "global.php?CrT="+CrT+"&gMS="+gMS, true);
		}
		xmlHttp.onreadystatechange = function(){handleServerResponse(CrT,gMS,gSB,gUP);}
		xmlHttp.send(null);
	}
	else 
	{
		setTimeout('select()', 1000);
	}
}

function handleServerResponse(CrT,gMS,gSB,gUP)
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlResponse = xmlHttp.responseXML;
			xmlRoot     = xmlResponse.documentElement;
			
			if (CrT=="CrSub" || CrT=="CrUpb" || CrT=="CrKLP")
			{
				ArrGlobNma  = xmlRoot.getElementsByTagName("ArrGlobNma");
				ArrGlobKey  = xmlRoot.getElementsByTagName("ArrGlobKey");
				//htmlA= "<option value=''></option><option value='All'>All</option>";
				//htmlB= "<option value=''></option><option value='All'>All</option>";
				htmlA= "<option value='All'>All</option>";
				htmlB= "<option value='All'>All</option>";
				
				for (var i=0; i<ArrGlobNma.length; i++)
				{
					htmlA += "<option value='"+ ArrGlobKey.item(i).firstChild.data+ "'>"+ ArrGlobNma.item(i).firstChild.data+ "</option>";
				}
				document.getElementById(gSB).innerHTML = htmlA;
				if (gUP){
					document.getElementById(gUP).innerHTML = htmlB;
				}
				display_data();
			}
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function handleServerResponseNull()
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			display_data();
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function display_data()
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.setRequestHeader("Content-length", param.length);
			xmlHttp.setRequestHeader("Connection", "close");
			xmlHttp.send(param);
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function addSeparatorNum(fldID)
{
	var posCaret = getPosition(fldID); 
	var fldVal   = fldID.value;
	
	if((fldVal.length === 3 || 7 || 11 ) && (fldVal.length === posCaret)) 
	{ 
		posCaret = posCaret +1;  
	}
	
	//nStr = fldVal.replace(/,/g,'');
	nStr = fldVal.replace(/\./g,'');
	nStr += ''; 
	//x = nStr.split('.');
	x = nStr.split(',');
	x1 = x[0];
	//x2 = x.length > 1 ? '.' + x[1] : '';
	x2 = x.length > 1 ? ',' + x[1] : '';
	
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) 
	{ 
		x1 = x1.replace(rgx, '$1' + '.' + '$2');  //awalnya pake ',' (koma)
	}
	
	fldID.value = x1 + x2; 
	setCaretPosition(fldID, posCaret);
}

function addSeparatorSkpd(fldID)
{
	var temp="";
	for (var i=0; i<fldID.value.length; i++)
	{
		rD=fldID.value.substring(i, i+1);
		if ((i==1 || i==4)&& rD!='.'){
			temp = temp+"."+fldID.value.substring(i, i+1);
		}
		else{
			temp = temp+fldID.value.substring(i, i+1);
		}
	}
	
	fldID.value = temp;
	setCaretPosition(fldID, posCaret);
	
}

function setCaretPosition(elem, caretPos) 
{
	if(elem != null) 
	{
		if(elem.createTextRange) 
		{
			var range = elem.createTextRange();
			range.move('character', caretPos);
			range.select();
		}
		else 
		{
			if(elem.selectionStart) 
			{
				elem.focus();
				elem.setSelectionRange(caretPos, caretPos);
			}
			else
			{
				elem.focus();
			}
		}
	}
}

function getPosition(amtFld)
{
	var iCaretPos = 0;
	if (document.selection) 
	{ 
		amtFld.focus ();
		var oSel = document.selection.createRange ();
		oSel.moveStart ('character', - amtFld.value.length);
		iCaretPos = oSel.text.length;
	}
	else if (amtFld.selectionStart || amtFld.selectionStart == '0')
	{
		iCaretPos = amtFld.selectionStart;
	}
	
	return(iCaretPos);
}

function ToNumeric(gD)
{
	if (gD=='' || gD==' '){gD=0;}
	for (i=1; i<=10; i++)
	{
		gD = gD.replace('.','');
	}
	
	for (i=1; i<=10; i++)
	{
		gD = gD.replace(',','.');
	}
	return gD;
}

function dispBlockOrNo(xY)
{
	if (document.getElementById(xY).style.display == "block") 
	{
		document.getElementById(xY).style.display = "none"; 
	}
	else
	{
		document.getElementById(xY).style.display = "block";
	}
}

function dispBLOCK(xY)
{
	document.getElementById(xY).style.display = "block"; 
}

function dispNO(xY)
{
	document.getElementById(xY).style.display = "none"; 
}

function globalClose(xY) 
{
	document.getElementById(xY).style.display = "none"; 
} 

function ReplaceText(gFnD)
{
	for (i=1; i<=100; i++)
	{
		gFnD = gFnD.replace(' ','**');
	}
	return gFnD;
}
