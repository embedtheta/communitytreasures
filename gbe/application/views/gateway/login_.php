<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form3" name="form3" method="post" action="<?php echo base_url();?>gateway/login">
<table width="621" height="136" border="1">
  <tr>
    <td width="121" height="46">User Name</td>
    <td width="484">
      <label for="textfield"></label>
      <input type="text" name="emailID" id="emailID" />
    </td>
  </tr>
  <tr>
    <td>PassWord</td>
    <td>
      <label for="textfield2"></label>
      <input type="text" name="password" id="password" />
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <input type="submit" name="logIN" id="logIN" value="Submit" />
    </td>
  </tr>
</table>
</form>
</body>
</html>
