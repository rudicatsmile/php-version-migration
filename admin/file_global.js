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

function func_select(CrT,gFrM,rFrM,gALL)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		if (CrT=="Null")
		{
			xmlHttp.open("GET", "file_global.php", true);
			xmlHttp.onreadystatechange = handleServerResponseNull;
			xmlHttp.send(null);
		}
		if (CrT=="CrUPB" || CrT=="CrJNS64" || CrT=="CrOBJ64" || CrT=="CrJNS13" || CrT=="CrOBJ13")
		{
			gMST = encodeURIComponent(document.getElementById(gFrM).value);
			//alert(CrT+' : '+gMST);
			xmlHttp.open("GET", "file_global.php?CrT="+CrT+"&gMST="+gMST, true);
			xmlHttp.onreadystatechange = function(){handleServerResponseNiL(CrT,rFrM,gALL);}
			xmlHttp.send(null);
		}
	}
	else setTimeout('select()', 1000);
}

function handleServerResponseNull()
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			func_view_data();
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function handleServerResponseNiL(CrT,rFrM,gALL)
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlResponse = xmlHttp.responseXML;
			xmlRoot     = xmlResponse.documentElement;
			//alert(CrT);
			
			ArrMisi     = xmlRoot.getElementsByTagName("ArrMisi");
			ArrMisiKey  = xmlRoot.getElementsByTagName("ArrMisiKey");
			
			if (gALL=="LoadNuL") {htmlA= "<option value=''></option>";}
			else if (gALL=="LoadALL") {htmlA= "<option value='%'>ALL</option>";}
			else {htmlA= "";}
			for (var i=0; i<ArrMisi.length; i++)
			{
				if (CrT=="CrUPB")
				{
					
					htmlA += "<option value='"+ArrMisiKey.item(i).firstChild.data+"'>"+ArrMisi.item(i).firstChild.data+"</option>";
				}
				if (CrT=="CrJNS64" || CrT=="CrJNS13")
				{
					htmlA += "<option value='"+ArrMisiKey.item(i).firstChild.data+"'>"+ArrMisi.item(i).firstChild.data+"</option>";
				}
				if (CrT=="CrOBJ64" || CrT=="CrOBJ13")
				{
					htmlA += "<option value='"+ArrMisiKey.item(i).firstChild.data+"'>"+ArrMisi.item(i).firstChild.data+"</option>";
				}
			}
			document.getElementById(rFrM).innerHTML = htmlA;
			if (CrT=="CrJNS13")
			{
				document.getElementById('fRIN13').innerHTML = "";
			}
			if (CrT=="CrJNS64")
			{
				document.getElementById('fRIN64').innerHTML = "";
			}
			func_view_data();
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}

function func_view_data()
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
