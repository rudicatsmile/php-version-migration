<script language="javascript">
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