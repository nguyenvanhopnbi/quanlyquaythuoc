<!-- <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>

	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
	<title></title>
	<meta name="generator" content="https://conversiontools.io" />
	<meta name="author" content="tuan anh dao"/>
	<meta name="created" content="2015-04-17T10:05:38"/>
	<meta name="changedby" content="DELL"/>
	<meta name="changed" content="2021-01-05T07:57:34"/>
	<meta name="AppVersion" content="16.0300"/>
	<meta name="DocSecurity" content="0"/>
	<meta name="HyperlinksChanged" content="false"/>
	<meta name="LinksUpToDate" content="false"/>
	<meta name="ScaleCrop" content="false"/>
	<meta name="ShareDoc" content="false"/>

	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  }
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  }
		comment { display:none;  }
	</style>

</head> -->

<!-- <body> -->
<!-- <style type="text/css">
    body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
    a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  }
    a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  }
    comment { display:none;  }
</style> -->
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=bbds.xlsx");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div style="font-family:'Calibri'; font-size:x-small" class="modal fade" id="preview-download-audit-partner-{{$partnerCode}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-modal="true">
    <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
            <table cellspacing="0" border="0">
                <colgroup width="108"></colgroup>
                <colgroup width="135"></colgroup>
                <colgroup width="133"></colgroup>
                <colgroup width="129"></colgroup>
                <colgroup width="127"></colgroup>
                <colgroup width="138"></colgroup>
                <colgroup width="116"></colgroup>
                <colgroup width="139"></colgroup>
                <colgroup width="197"></colgroup>
                <colgroup width="147"></colgroup>
                <colgroup width="168"></colgroup>
                <tr>
                    <td style="font-family: Times New Roman;text-align: center;font-size:x-small" colspan=9 height="19" align="center" valign=middle><font face="Times New Roman" color="#000000">C???ng h??a x?? h???i ch??? ngh??a Vi???t Nam</font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;text-align: center;font-size:x-small" colspan=9 height="19" align="center" valign=middle><font face="Times New Roman" color="#000000">?????c l???p - T??? Do - H???nh Ph??c</font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;text-align: center;font-size:x-small" colspan=9 height="19" align="center" valign=middle><font face="Times New Roman" color="#000000">***</font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#FF0000"></font></td>
                    <td align="right" valign=middle sdval="" sdnum="1033;"><font face="Times New Roman" color="#FF0000"></font></td>
                </tr>
                <tr>
                    <td colspan=9 height="19" align="center" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#FF0000"></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;text-align: center;font-size:x-small" colspan=9 height="19" align="center" valign=middle><font face="Times New Roman" color="#000000">BI??N B???N X??C NH???N S???N L?????NG V?? DOANH THU.</font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;text-align: center;font-size:x-small" colspan=9 height="19" align="center" valign=middle><font face="Times New Roman" color="#000000">Gi???a C??ng ty C??? Ph???n APPOTAPAY v?? {{$audit['name']}}</font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;text-align: center;font-size:x-small" colspan=9 height="19" align="center" valign=middle><font face="Times New Roman" color="#000000">(T??? ng??y {{$startTime}} ?????n h???t ng??y {{$endTime}})</font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td height="27" align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" height="33" align="left" colspan="5" valign=middle><font face="Times New Roman" color="#000000">- C??n c??? theo h???p ?????ng h???p t??c kinh doanh s???: {{$audit['contract_number']}}</font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" height="30" align="left" colspan="5" valign=middle><font face="Times New Roman" color="#000000"><span>- H??m nay, ng??y {{date('d')}} th??ng {{date('m')}} n??m {{date('Y')}}, hai b??n c??ng k?? k???t bi??n b???n x??c nh???n s??? li???u s???n l?????ng & doanh thu</span><br>
<span>(T??? ng??y {{$startTime}} ?????n h???t ng??y {{$endTime}}) nh?? sau:</span></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td width="12" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;white-space:normal;font-size:x-small" height="40" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">Lo???i giao d???ch</font></b></td>
                    <td width="12" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;white-space: pre-wrap;font-size:x-small" align="center" text-wrap=true valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">S??? l?????ng giao d???ch th??nh c??ng<br>(1)</font></b></td>
                    <td width="18" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">S??? l?????ng giao d???ch ho??n ti???n<br>(2)</font></b></td>
                    <td width="18" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">T???ng gi?? tr??? giao d???ch th??nh c??ng<br>(3)</font></b></td>
                    <td width="18" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">T???ng gi?? tr??? giao d???ch ho??n ti???n<br>(4)</font></b></td>
                    <td width="10" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">Ph?? x??? l?? giao d???ch<br>(5)</font></b></td>
                    <td width="10" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;white-space: nowarp;font-size:x-small" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">Ph?? thanh to??n<br>(6)</font></b></td>
                    <td width="18" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;white-space: nowarp;font-size:x-small" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">Ph?? APPOTAPAY ???????c h?????ng<br>(7)</font></b></td>
                    <td width="18" style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;white-space: nowarp;font-size:x-small" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">S??? ti???n APPOTAPAY thanh to??n cho ?????i t??c<br>(8)</font></b></td>
                    <td align="left" valign=bottom><b><font face="Times New Roman" color="#000000"><br></font></b></td>
                    <td align="left" valign=bottom><b><font face="Times New Roman" color="#000000"><br></font></b></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" height="28" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">Th??? n???i ?????a </font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdnum="1033;0;#,##0">{{number_format($audit['atm']['success'], 0, '.', ',')}}<font face="Times New Roman"><br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle><font face="Times New Roman"></font>{{number_format($audit['atm']['refund'], 0, '.', ',')}}<br></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['atm']['total_success'], 0, '.', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['atm']['total_refund'], 0, '.', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="1100" sdnum="1033;"><font face="Times New Roman">{{number_format($audit['atm']['transaction_fee'], 0, '.', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0.011" sdnum="1033;0;0.00%"><font face="Times New Roman">{{$audit['atm']['payment_fee'] * 100}}%</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['atm']['appotapay_income'], 0, '.', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000";font-size:x-small align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['atm']['payout'], 0, '.', ',')}}</font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" height="28" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">Th??? qu???c t???</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle><font face="Times New Roman">{{number_format($audit['cc']['success'], 0, ',', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle><font face="Times New Roman">{{number_format($audit['cc']['refund'], 0, ',', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['cc']['total_success'], 0, ',', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['cc']['total_refund'], 0, ',', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="2200" sdnum="1033;"><font face="Times New Roman">{{number_format($audit['cc']['transaction_fee'], 0, ',', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0.027" sdnum="1033;0;0.00%"><font face="Times New Roman">{{$audit['cc']['payment_fee'] * 100}}%</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['cc']['appotapay_income'], 0, ',', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['cc']['payout'], 0, ',', ',')}}</font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                @isset($audit['ewallet'])
                <tr>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" height="28" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">Ewallet</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle><font face="Times New Roman">{{number_format($audit['ewallet']['success'], 0, ',', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle><font face="Times New Roman">{{number_format($audit['ewallet']['refund'], 0, ',', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['ewallet']['total_success'], 0, ',', ',')}}<br></font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['ewallet']['total_refund'], 0, ',', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="2200" sdnum="1033;"><font face="Times New Roman">{{number_format($audit['ewallet']['transaction_fee'], 0, ',', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0.027" sdnum="1033;0;0.00%"><font face="Times New Roman">{{$audit['ewallet']['payment_fee'] * 100}}%</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['ewallet']['appotapay_income'], 0, ',', ',')}}</font></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['ewallet']['payout'], 0, ',', ',')}}</font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                @endisset
                <tr>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" height="28" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman">T???ng</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><b><font face="Times New Roman">{{number_format($audit['success'], 0, ',', ',')}}</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><b><font face="Times New Roman">{{number_format($audit['refund'], 0, ',', ',')}}</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><b><font face="Times New Roman">{{number_format($audit['total_success'], 0, ',', ',')}}</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><b><font face="Times New Roman">{{number_format($audit['total_refund'], 0, ',', ',')}}</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><b><font face="Times New Roman">{{number_format($audit['totalInCome'], 0, ',', ',')}}</font></b></td>
                    <td style="font-family: Times New Roman;border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;font-size:x-small" align="right" valign=middle sdval="0" sdnum="1033;0;#,##0"><b><font face="Times New Roman">{{number_format($audit['totalPayout'], 0, ',',',')}}</font></b></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td height="19" align="center" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" height="19" align="left" colspan="3" valign=bottom><font face="Times New Roman">S??? ti???n APPOTAPAY ph???i thanh to??n cho {{$audit['name']}} l??:</font></td>
                    <td style="font-family: Times New Roman;font-size:x-small" align="right" valign=bottom sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman">{{number_format($audit['totalPayout'], 0, ',', ',')}}</font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom sdnum="1033;0;#,##0"><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" height="19" align="left" valign=bottom><i><font face="Times New Roman" color="#FF0000">B???ng ch???:</font></i></td>
                    <td colspan="5" style="font-family: Times New Roman;font-size:x-small" align="left" valign=bottom sdval="0" sdnum="1033;"><i><font face="Times New Roman" color="#000000">{{$audit['totalPayoutString']}}</font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" height="19" align="left" colspan="3" valign=bottom><font face="Times New Roman">Ph?? d???ch v??? (???? bao g???m VAT) APPOTAPAY ???????c h?????ng l??:</font></td>
                    <td style="font-family: Times New Roman;font-size:x-small" align="right" valign=bottom sdval="0" sdnum="1033;0;#,##0"><font face="Times New Roman" color="#000000">{{number_format($audit['totalInCome'], 0, ',', ',')}}</font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="right" valign=middle sdnum="1033;0;#,##0"><b><font face="Times New Roman"><br></font></b></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom sdnum="1033;0;#,##0"><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" height="19" align="left" valign=bottom><i><font face="Times New Roman" color="#FF0000">B???ng ch???: </font></i></td>
                    <td colspan="5" style="font-family: Times New Roman;font-size:x-small" align="left" valign=bottom sdval="0" sdnum="1033;"><i><font face="Times New Roman" color="#000000">{{$audit['totalInComeString']}}</font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman" color="#000000"><br></font></i></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" height="19" align="left" colspan="5" valign=bottom><font face="Times New Roman">Bi??n b???n n??y ???????c th??nh l???p th??nh 04 b???n c?? gi?? tr??? ph??p lu???t nh?? nhau, m???i b??n gi??? 02 b???n.</font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td height="30" align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle sdnum="1033;0;_-* #,##0 _&#8363;_-;-* #,##0 _&#8363;_-;_-* &quot;-&quot;?? _&#8363;_-;_-@_-"><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=middle sdnum="1033;0;_(* #,##0_);_(* \(#,##0\);_(* &quot;-&quot;??_);_(@_)"><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=middle sdnum="1033;0;_(* #,##0_);_(* \(#,##0\);_(* &quot;-&quot;??_);_(@_)"><b><font face="Times New Roman" color="#000000"><br></font></b></td>
                    <td align="center" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="center" valign=middle><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td colspan=5 height="19" align="right" valign=bottom><i><font face="Times New Roman"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman"><br></font></i></td>
                    <td align="left" valign=bottom><i><font face="Times New Roman"><br></font></i></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" color="#000000"><br></font></td>
                </tr>
                <tr>
                    <td style="font-family: Times New Roman;font-size:x-small" colspan=6 height="19" align="center" valign=bottom><b><font face="Times New Roman" color="#000000">C??NG TY C??? PH???N APPOTAPAY</font></b></td>
                    <td style="font-family: Times New Roman;font-size:x-small" colspan=3 align="center" valign=bottom><b><font face="Times New Roman" color="#000000">{{$audit['name']}}</font></b></td>
                    <td align="center" valign=bottom><b><font face="Times New Roman" color="#000000"><br></font></b></td>
                    <td align="center" valign=bottom><b><font face="Times New Roman" color="#000000"><br></font></b></td>
                </tr>
                <tr>
                    <td colspan=5 height="100" align="right" valign=bottom><i><font face="Times New Roman"><br></font></i></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<!-- ************************************************************************** -->
<!-- </body>

</html> -->
