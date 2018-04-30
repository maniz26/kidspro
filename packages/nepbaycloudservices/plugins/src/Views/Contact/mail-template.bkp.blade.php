<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Summit Air</title>
</head>

<body style="margin:0 !important; padding:0 !important; background-color:#f7f7f7; font-family:Arial, Helvetica, sans-serif;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#f7f7f7" align="center" style="padding:50px;"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="max-width:650px; padding:20px; border:1px solid #b2b2b2;">
        <tr>
          <td style="border-bottom:1px dashed #b2b2b2; padding-bottom:20px;" align="center"><img src="{{asset('newsletter/summit-air.png')}}" /></td>
        </tr>
        <tr>
          <td align="center" style="font-size:14px; font-weight:bold; color:#227bc1; text-transform:uppercase; margin:0; padding:0; padding-top:30px">Hello,  Admin </td>
        </tr>
        <tr>
          <td align="center" style="font-size:12px; font-weight:normal; color:#868787; margin:0; padding:0; padding-bottom:30px; padding-top:10px;">You have a contact us email</td>
        </tr>
        <tr>
          <td align="center" style="border-top:1px solid #ededed; border-bottom:1px solid #ededed; padding-top:10px; padding-bottom:10px">
          	<table border="0" cellspacing="0" cellpadding="0" style=" padding-bottom:10px; padding-top:10px; padding-left:20px; padding-right:20px; background:#f5f5f5">
  <tr>
    <td width="30"><img src="img/user.png" /></td>
    <td style="font-size:12px; color:#545454; font-weight:bold;" width="50">Name</td>
    <td style="font-size:12px; color:#545454; font-weight:bold;" width="30" align="center">:</td>
    <td style="font-size:12px; color:#545454; font-weight:normal;">{{$details['fullname']}}</td>
  </tr>
  <tr>
    <td style="padding-top:10px"><img src="{{asset('newsletter/email.png')}}" /></td>
    <td style="font-size:12px; color:#545454; font-weight:bold; padding-top:10px">Email</td>
    <td style="font-size:12px; color:#545454; font-weight:bold; padding-top:10px" width="30" align="center">:</td>
    <td style="font-size:12px; color:#545454; font-weight:normal; padding-top:10px"><a href="mailto:{{$details['email']}}">{{$details['email']}}</a></td>
  </tr>
  <tr>
    <td style="padding-top:10px"><img src="{{asset('newsletter/telephone.png')}}" /></td>
    <td style="font-size:12px; color:#545454; font-weight:bold; padding-top:10px">Phone</td>
    <td style="font-size:12px; color:#545454; font-weight:bold; padding-top:10px" width="30" align="center">:</td>
    <td style="font-size:12px; color:#545454; font-weight:normal; padding-top:10px"><a href="tel:{{$details['phone']}}">{{$details['phone']}}</a></td>
  </tr>
  <tr>
    <td style="padding-top:10px"><img src="{{asset('newsletter/message.png')}]" width="16" height="16" /></td>
    <td style="font-size:12px; color:#545454; font-weight:bold; padding-top:10px">Message</td>
    <td style="font-size:12px; color:#545454; font-weight:bold; padding-top:10px" width="30" align="center">:</td>
    <td style="font-size:12px; color:#545454; font-weight:normal; padding-top:10px">{{$details['message']}}</td>
  </tr>
</table>

          
          </td>
        </tr>
        
        <tr>
          <td align="center" style="font-size:12px; font-weight:normal; color:#807e7e; padding-top:10px;">Thank You</td>
        </tr>
        <tr>
          <td align="center" style="font-size:12px; font-weight:normal; color:#807e7e; padding-top:5px; padding-bottom:15px">© 2011 – 2018 Summit Air, All rights reserved </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
