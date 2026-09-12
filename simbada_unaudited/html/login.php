<form name="mFrmLogin" method="post" action="login_.php">
<table align="right" class="table-login" >
	<tr>
		<th colspan="4">LOGIN USER</th>
	</tr>
	<tr>
	  <td width="30" height="5"></td>
	  <td width="100"></td>
	  <td width="100"></td>
	  <td></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="text" name="fUsr" placeholder='username' onkeypress="if(event.keyCode==13){pLogin();}" style="width:100px; box-sizing: border-box; padding: 5px 5px 5px 25px; background-image: url('css/images/admi.gif'); background-position: 5px 5px; background-repeat: no-repeat;" /></td>
	  <td><input type="password" name="fPas" placeholder='password' onkeypress="if(event.keyCode==13){pLogin('','');return false;}" style="width:100px; box-sizing: border-box; padding: 5px 5px 5px 25px; background-image: url('css/images/key.png'); background-position: 5px 5px; background-repeat: no-repeat;" /></td>
	  <td><input type="button" value="LOGIN" onClick="pLogin('','')" name="B1" style="width: 50px; height: 21px" /></td>
	</tr>
	<tr>
	  <td height="20" ondblclick="pLogin_xx('creator','')">&nbsp;</td>
	  <!--td colspan="3"><a href="#" class="icor reg" onclick="testLOGIN_xxx();return false">Register User Baru</a></td-->
	  <td colspan="3">&nbsp;</td>
    </tr>
</table>
</form>
<script languange="javascript">
	function testLOGIN()
	{
		$(document).ready(function() {
			$("#divTEST").load('reg_user_add.php');
		});
	}
</script>