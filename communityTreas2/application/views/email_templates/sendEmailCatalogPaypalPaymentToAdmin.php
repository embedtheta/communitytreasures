<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<table width="600" border="0" cellpadding="2" cellspacing="2" align="center">

    <tr>

        <td valign="top" align="left">Hello Admin,<br /><br/>
            Here is a new payment. Payment details are given below.<br/>

        </td>

    </tr>

    <tr><td width="400">---------------------------------------------------------------------</td></tr>

    <tr><td valign="top" align="left">Invoice No :&nbsp;<?php echo $invoice[0]->id; ?></td></tr>
    
    <tr><td valign="top" align="left">Paid Total:&nbsp; &pound; <?php echo $invoice[0]->gross_total; ?></td></tr>
    
    <tr><td valign="top" align="left">Payment Currency :&nbsp; <?php echo $invoice[0]->payment_currency; ?></td></tr>   
    
    <tr><td valign="top" align="left">User :&nbsp;<?php echo $invoice[0]->firstName." ".$invoice[0]->lastName; ?></td></tr>

    <tr><td width="400">---------------------------------------------------------------------</td></tr>

    <tr><td height="5"></td></tr>

    <tr><td height="5"></td></tr>

    <tr><td align="left">Thank you very much.</td></tr>
    
    <tr><td align="left">globalblackenterprises.com</td></tr>

</table>


