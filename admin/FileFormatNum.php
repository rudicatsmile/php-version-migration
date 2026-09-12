<script language="javascript">
	function addSeparator(fldID)
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
	
	function NumValidate(field)
	{
		if (field.value.length==0)
		{window.alert("Input nilai error..!!");}
		else
		{
			var valid = "0123456789,."
			var ok = "yes";
			var temp;
			for (var i=0; i<field.value.length; i++)
			{
				temp = "" + field.value.substring(i, i+1);
				if (valid.indexOf(temp) == "-1") ok = "no";
			}
			
			if (ok == "no")
			{
				alert("Input nilai error..!!");
				field.focus();
				field.select();
			}
		}
	}

</script>
