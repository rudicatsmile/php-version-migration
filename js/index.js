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

/*
function func_select(CrT)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		if (CrT=="CrVisi")
		{
			gVisi = encodeURIComponent(document.getElementById("Id_Visi").value);
			xmlHttp.open("GET", "index_.php?CrT="+CrT+"&gVisi="+gVisi, true);
			xmlHttp.onreadystatechange = handleServerResponseMisi;
			xmlHttp.send(null);
		}
	}
	else setTimeout('select()', 1000);
}

function handleServerResponseMisi()
{
	if (xmlHttp.readyState == 4)
	{
		if (xmlHttp.status == 200)
		{
			xmlResponse = xmlHttp.responseXML;
			xmlRoot     = xmlResponse.documentElement;
			ArrMisi     = xmlRoot.getElementsByTagName("ArrMisi");
			ArrMisiKey  = xmlRoot.getElementsByTagName("ArrMisiKey");
			htmlA= "<option value=''>Pilih Misi Daerah...!!!</option>";
			
			for (var i=0; i<ArrMisi.length; i++)
			{
				htmlA += "<option value='" 
				+ ArrMisiKey.item(i).firstChild.data 
				+ "'>" 
				+ ArrMisiKey.item(i).firstChild.data+" : "+ArrMisi.item(i).firstChild.data+ "</option>";
			}
			document.getElementById("Id_Misi").innerHTML = htmlA;
			//func_view_data('detail_data','');
		}
		else
		{
			alert("Ada kesalahan dalam mengakses server: " +
			xmlHttp.statusText);
		}
	}
}
*/

function func_view_data(dom,gFile,gIdT)
{
	if (gIdT=="FindData")
	{
		gFind = encodeURIComponent(document.getElementById("fFind").value);
		var url=gFile+"?gFind="+gFind;
		var param="";
	}
	else
	{
		var url=gFile+"?gIdT="+gIdT;
		var param="";
	}
	
	document.getElementById(dom).innerHTML="Loading ...";
	//tidak perlu dirubah
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
		{
			var res=xmlHttp.responseText;
			document.getElementById(dom).innerHTML=res;
		}
	}
	xmlHttp.open("GET",url,true);
	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlHttp.setRequestHeader("Content-length", param.length);
	xmlHttp.setRequestHeader("Connection", "close");
	xmlHttp.send(param);
	//tidak perlu dirubah
}
