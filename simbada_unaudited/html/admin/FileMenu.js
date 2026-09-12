function winABOUT(w,h,pos)
{	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();       			
		URL_Top = "About_Top.php";
		URL_Mid = "About_Mid.php";
		URL_Bot = "About_Bot.php";
		txtHTML="<html><head><title>SimBADA</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinInfo_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinInfo_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinInfo_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenKKerja(w,h,pos,pil,IdL)
{	
	var win=null;
	var URL_MidA= "";
	var URL_MidB= "";
	var URL_MidC= "";
	var txtHTML = "";
	var iErrors = 0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			switch (pil)
			{
			case '1' :
				URL_Top ="Open_KKR_Top.php?FrmG=PELAPORAN -> DOKUMEN KERTAS KERJA&IdL="+IdL;
				URL_Mid ="Open_KKR_Mid.php?IdL="+IdL;
				URL_Bot ="Open_KKR_Bot.php";
				break;
			case '2' :
				URL_Top ="Open_KKM_Top.php?FrmG=PELAPORAN -> MASA MANFAAT REPAIR&IdL="+IdL;
				URL_Mid ="Open_KKM_Mid.php?IdL="+IdL;
				URL_Bot ="Open_KKM_Bot.php";
				break;
			case '3' :
				URL_Top ="Open_NRC_Top.php?FrmG=PELAPORAN -> REKAP NILAI KE NERACA&IdL="+IdL;
				URL_Mid ="Open_NRC_Mid.php?IdL="+IdL;
				URL_Bot ="Open_NRC_Bot.php";
				break;
			case '4' :
				URL_Top ="Open_KAB_Top.php?FrmG=PELAPORAN -> DOK. REKAP ASET KABUPATEN&IdL="+IdL;
				URL_Mid ="Open_KAB_Mid.php?IdL="+IdL;
				URL_Bot ="Open_KAB_Bot.php";
				break;
			case '5' :
				URL_Top ="Open_PNY_Top.php?FrmG=PELAPORAN -> DOK. REKAP PENYUSUTAN&IdL="+IdL;
				URL_Mid ="Open_PNY_Mid.php?IdL="+IdL;
				URL_Bot ="Open_PNY_Bot.php";
				break;
			}
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' src='"+URL_Top+"' scrolling='no' noresize><frame name='WinOpenKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src='"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>";
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
}

function WinMerger(w,h,pos,pil,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
	win=window.open('','',settings);
	if (win!=null)
	{
		switch (pil)
		{
			case '1':
				gURL_Mid ='zMerger_Kib_A.php';
				gJDL="KIB - A";
				break;
			case '2':
				gURL_Mid ='zMerger_Kib_B.php';
				gJDL="KIB - B";
				break;
			case '3':
				gURL_Mid ='zMerger_Kib_C.php';
				gJDL="KIB - C";
				break;
			case '4':
				gURL_Mid ='zMerger_Kib_D.php';
				gJDL="KIB - D";
				break;
			case '5':
				gURL_Mid ='zMerger_Kib_E.php';
				gJDL="KIB - E";
				break;
			case '6':
				gURL_Mid ='zMerger_Kib_F.php';
				gJDL="KIB - F";
				break;
		}
		win.window.document.open();
		var URL_Top = 'zMerger_Top.php?FrmG=MERGER DATA '+gJDL;
		var URL_Mid = gURL_Mid+"?IdL="+IdL;
		var URL_Bot = 'zMerger_Bot.php';


		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function ManageKritik(w,h,pos,IdL)
{	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();       			
		URL_Top = "Kritik_Top.php?IdL="+IdL;
		URL_Mid = "Kritik_Mid.php?IdL="+IdL;
		URL_Bot = "Kritik_Bot.php?IdL="+IdL;
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinInfo_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinInfo_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinInfo_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function ManageInfo(w,h,pos,IdL)
{	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Information_Top.php?IdL="+IdL;
		URL_Mid = "Information_Mid.php?IdL="+IdL;
		URL_Bot = "Information_Bot.php?IdL="+IdL;
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinInfo_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinInfo_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinInfo_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinImport(w,h,pos,pil,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		switch (pil)
		{
			case '1':
				gURL_Mid ='zImport_Rek_132006.php';
				gJDL="";
				break;
			case '2':
				gURL_Mid ='zImport_Rek_172007.php';
				gJDL="";
				break;
			case '3':
				gURL_Mid ='zImport_Bidang_Pemerintahan.php';
				gJDL="";
				break;
			case '4':
				gURL_Mid ='zImport_Unit_Kerja.php';
				gJDL="";
				break;
			case '5':
				gURL_Mid ='zImport_Sub_Unit.php';
				gJDL="";
				break;
			case '6':
				gURL_Mid ='zImport_Upb.php';
				gJDL="";
				break;
			case '7':
				gURL_Mid ='zImport_Kib_A.php';
				gJDL="KIB - A";
				break;
			case '8':
				gURL_Mid ='zImport_Kib_B.php';
				gJDL="KIB - B";
				break;
			case '9':
				gURL_Mid ='zImport_Kib_C.php';
				gJDL="KIB - C";
				break;
			case '10':
				gURL_Mid ='zImport_Kib_D.php';
				gJDL="KIB - D";
				break;
			case '11':
				gURL_Mid ='zImport_Kib_E.php';
				gJDL="KIB - E";
				break;
			case '12':
				gURL_Mid ='zImport_Kib_F.php';
				gJDL="KIB - F";
				break;
			case '15':
				gURL_Mid ='Utility_Post_Data_A.php';
				gJDL="KIB - A";
				break;
			case '16':
				gURL_Mid ='Utility_Post_Data_B.php';
				gJDL="KIB - B";
				break;
			case '17':
				gURL_Mid ='Utility_Post_Data_C.php';
				gJDL="KIB - C";
				break;
			case '18':
				gURL_Mid ='Utility_Post_Data_D.php';
				gJDL="KIB - D";
				break;
			case '19':
				gURL_Mid ='Utility_Post_Data_E.php';
				gJDL="KIB - E";
				break;
		}
		win.window.document.open();
		var URL_Top = 'zImport_Top.php?FrmG=IMPORT DATA '+gJDL;
		var URL_Mid = gURL_Mid+"?IdL="+IdL;
		var URL_Bot = 'zImport_Bot.php';

		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinDumpDB(w,h,pos,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Backup_Dump_Top.php?FrmG=BACKUP DATABASE";
		URL_Mid = "Backup_Dump_Mid.php?IdL="+IdL;
		URL_Bot = "Backup_Dump_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinKodeUPB(w,h,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Move_Kode_UPB_Top.php?FrmG=PEMINDAHAN KODE UPB DAN DATA KIB";
		URL_Mid = "Move_Kode_UPB_Mid.php?IdL="+IdL;
		URL_Bot = "Move_Kode_UPB_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinCleanData(w,h,pos,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Clean_Data_Aset_Top.php?FrmG=CLEAN / PENGHAPUSAN SEMUA DATA ASET";
		URL_Mid = "Clean_Data_Aset_Mid.php?IdL="+IdL;
		URL_Bot = "Clean_Data_Aset_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinKunciData(w,h,pos,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Kunci_Data_Aset_Top.php?FrmG=KUNCI DATA ASET";
		URL_Mid = "Kunci_Data_Aset_Mid.php?IdL="+IdL;
		URL_Bot = "Kunci_Data_Aset_Bot.php";
		txtHTML="<html><head><title>SimBADA</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinXLS(w,h,pos,gkib,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Import_KIB_Top.php?FrmG=IMPORT KIB-"+gkib+"&gKib="+gkib+"&IdL="+IdL;
		URL_Mid = "Import_KIB_Mid.php?gKib="+gkib+"&IdL="+IdL;
		URL_Bot = "Import_KIB_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='90,*,30' frameborder='0'><frame name='WinOpenXLS_Top"+gkib+"' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenXLS_Mid"+gkib+"' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenXLS_Bot"+gkib+"' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenRKBMD(w,h,pos,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "RKBMD_Top.php?IdL="+IdL;
		URL_Mid = "RKBMD_Mid.php?IdL="+IdL;
		URL_Bot = "RKBMD_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='138,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}
	
function WinOpenRKPBMD(w,h,pos,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "RKPBMD_Top.php?IdL="+IdL;
		URL_Mid = "RKPBMD_Mid.php?IdL="+IdL;
		URL_Bot = "RKPBMD_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='138,*,30' frameborder='0'><frame name='WinOpenRKPB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKPB_Mid' src='"+URL_Mid+"' scrolling='yes'><frame name='WinOpenRKPB_Bot' src='"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}
	
function WinOpenKIB(w,h,pos,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Open_KIB_Top.php?FrmG=PELAPORAN -> DOKUMEN KIB";
		URL_Mid = "Open_KIB_Mid.php?IdL="+IdL;
		URL_Bot = "Open_KIB_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenKIB_New(w,h,pos,pil,IdL)
{	
	var win=null;
	var URL_MidA="";
	var URL_MidB="";
	var URL_MidC="";
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			switch (pil)
			{
			case '1' :
				URL_Top ="Open_KIB_Top.php?FrmG=PELAPORAN -> DOKUMEN KIB&IdL="+IdL;
				URL_Mid ="Open_KIB_Mid.php?IdL="+IdL;
				URL_Bot ="Open_KIB_Bot.php";
				break;
			case '2' :
				URL_Top ="Open_KIB_Choise_Top.php?FrmG=PELAPORAN -> DOKUMEN KIB (<i>Choise</i>)&IdL="+IdL;
				URL_Mid ="Open_KIB_Choise_Mid.php?IdL="+IdL;
				URL_Bot ="Open_KIB_Choise_Bot.php";
				break;
			case '3' :
				URL_Top ="Open_KIB_Choise_N_Top.php?FrmG=PELAPORAN -> DOKUMEN KIB (<i>Tahun N</i>)&IdL="+IdL;
				URL_Mid ="Open_KIB_Choise_N_Mid.php?IdL="+IdL;
				URL_Bot ="Open_KIB_Choise_N_Bot.php";
				break;
			}
			txtHTML= "<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'>";
			txtHTML= txtHTML+"<frame name='WinOpenKIB_Top' src='"+URL_Top+"' scrolling='no' noresize>";
			txtHTML= txtHTML+"<frame name='WinOpenKIB_Mid' src='"+URL_Mid+"' scrolling='auto'>";
			txtHTML= txtHTML+"<frame name='WinOpenKIB_Bot' src='"+URL_Bot+"' scrolling='no'><noframes>";
			txtHTML= txtHTML+"<body><p>=>.............??!</p></body></noframes></frameset></html>";
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
}

function OpenChat(w,h,pos)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	URL="Chat/chat.php";
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
	window.open(URL,'',settings);
}

function OpenReport(w,h,pos,pil,IdL)
{	var win=null;
	var URL_MidA="";
	var URL_MidB="";
	var URL_MidC="";
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open();
			URL_MidA = "Open_Report_Mid.php?";
			URL_TopA = "Open_Report_Top.php?";
			switch (pil)
			{
			case '1' :
				URL_MidB="rCrt=1";
				URL_TopB="FrmG=PELAPORAN -> BUKU INVENTARIS";
				break;
			case '2' :
				URL_MidB="rCrt=2";
				URL_TopB="FrmG=PELAPORAN -> REKAP BUKU INVENTARIS";
				break;
			case '3' :
				URL_MidB="rCrt=3";
				URL_TopB="FrmG=PELAPORAN -> DAFTAR MUTASI MASUK";
				break;
			case '4' :
				URL_MidB="rCrt=4";
				URL_TopB="FrmG=PELAPORAN -> REKAP DAFTAR MUTASI";
				break;
			case '5' :
				URL_MidB="rCrt=5";
				URL_TopB="FrmG=PELAPORAN -> REKAP REKENING";
				break;
			case '6' :
				URL_MidB="rCrt=6";
				URL_TopB="FrmG=PELAPORAN -> DAFTAR MUTASI KELUAR";
				break;
			}
			URL_Bot  = "Open_Report_Bot.php";
			URL_MidC = "&IdL="+IdL;
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_TopA+URL_TopB+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_MidA+URL_MidB+URL_MidC+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close();
			win.setTimeout("self.close()",200000000);
		}
}

function OpenRekap(w,h,pos,pil,IdL)
{	var win=null;
	var URL_MidA="";
	var URL_MidB="";
	var URL_MidC="";
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_MidA = "Open_Rekap_Mid.php?";
		URL_TopA = "Open_Rekap_Top.php?";
		switch (pil)
		{
		case '1' :
			URL_MidB="rCrt=1";
			URL_TopB="FrmG=PELAPORAN -> REKAP PER KELOMPOK ASET";
			break;
		case '2' :
			URL_MidB="rCrt=2";
			URL_TopB="FrmG=PELAPORAN -> REKAPITULASI BARANG PER SKPD";
			break;
		}
		URL_Bot  = "Open_Rekap_Bot.php";
		URL_MidC = "&IdL="+IdL;
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_TopA+URL_TopB+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_MidA+URL_MidB+URL_MidC+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function OpenRekapAllSKPD(w,h,pil,IdL)
{	var win=null;
	var URL_MidA="";
	var URL_MidB="";
	var URL_MidC="";
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_MidA = "Open_Rekap_AllSKPD_Mid.php?";
		URL_TopA = "Open_Rekap_AllSKPD_Top.php?";
		switch (pil)
		{
		case '1' :
			URL_MidB="rCrt=1";
			URL_TopB="FrmG=PELAPORAN -> REKAPITULASI BARANG PER SKPD MODEL (1)";
			break;
		case '2' :
			URL_MidB="rCrt=2";
			URL_TopB="FrmG=PELAPORAN -> REKAPITULASI BARANG PER SKPD MODEL (2)";
			break;
		}
		URL_Bot  = "Open_Rekap_AllSKPD_Bot.php";
		URL_MidC = "&IdL="+IdL;
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='"+URL_TopA+URL_TopB+"' scrolling='no'><frame name='WinOpenKIB_Mid' src='"+URL_MidA+URL_MidB+URL_MidC+"' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenBERKAS(w,h,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Penerimaan_Berkas_Open_Report_Top.php?FrmG=PENGADAAN -> REPORT PENERIMAAN BERKAS";
		URL_Mid = "Penerimaan_Berkas_Open_Report_Mid.php?IdL="+IdL;
		URL_Bot = "Penerimaan_Berkas_Open_Report_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinADA_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinADA_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinADA_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenPGADAN(w,h,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Pengadaan_Open_Report_Top.php?FrmG=PENGADAAN -> REPORT PENGADAAN";
		URL_Mid = "Pengadaan_Open_Report_Mid.php?IdL="+IdL;
		URL_Bot = "Pengadaan_Open_Report_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinADA_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinADA_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinADA_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinOpenREKONS(w,h,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "Pengadaan_Open_Rekon_Top.php?FrmG=PENGADAAN -> REKONSILIASI PENGADAAN ASET";
		URL_Mid = "Pengadaan_Open_Rekon_Mid.php?IdL="+IdL;
		URL_Bot = "Pengadaan_Open_Rekon_Bot.php";
		txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinADA_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinADA_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinADA_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}

function WinExportRek(w,h,pos,IdL)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	var LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	var TopPosition=(screen.height)?(screen.height-h)/2:100;
	var settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
	win=window.open('','',settings);
	if (win!=null)
	{
		win.window.document.open();
		URL_Top = "WinExportRek_Top.php?FrmG=EXPORT REKENING 17-108";
		URL_Mid = "WinExportRek_Mid.php?IdL="+IdL;
		URL_Bot = "WinExportRek_Bot.php";
		txtHTML="<html><head><title>SimBADA</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenRKB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinOpenRKB_Mid' src='"+URL_Mid+"' scrolling='no'><frame name='WinOpenRKB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
		win.focus();
		win.window.document.clear();
		win.window.document.write(txtHTML);
		win.window.document.close();
		win.setTimeout("self.close()",200000000);
	}
}
