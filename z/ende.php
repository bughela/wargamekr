<?php 
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value)
    {
        $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);

        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}
?>
<html>
<head>
<title>## BlueH4G ##</title>
<style type="text/css">
input.btn{
        border-top-color:#c63;
        border-left-color:#c63;
        border-right-color:#930;
        border-bottom-color:#930;
        color:#930;
		width:200;
}
td{
	text-align:center;
}
</style>
<script>

function toasc(){
	str=ed.txta.value;
	ed.txta.value='';
		//ed.txta.value="char(";
		ed.txta.value="0x";
	for(i=0;i<str.length;i++){
		tmp=str.charCodeAt(i);
		tmp=tmp.toString(16).toUpperCase();
		if(tmp.length=='1')tmp='0'+tmp;
		//ed.txta.value=ed.txta.value+'0x'+tmp;
		ed.txta.value=ed.txta.value+tmp;
		//if(i!=(str.length-1)){} ed.txta.value+=",";
	}
	//ed.txta.value+=")";
}


function fromasc(){
	str=ed.txta.value;
	tmpl=str;
	tmp='';
	ed.txta.value='';
	for(i=0;i<str.length;i=i+2){
		tmpl = trim(tmpl);
		tmp = tmpl.substring(0,2);
		tmpl = tmpl.substring(2,tmpl.length);
		ed.txta.value=ed.txta.value+String.fromCharCode(parseInt(tmp.toString(),16));
	}
}

function tobin(){
	str=ed.txta.value;
	ed.txta.value='';
	for(i=0;i<str.length;i++){
		tmp=str.charCodeAt(i);
		tmp=tmp.toString(2);
		dummy='';
		for(j=7;j>=1;j--){
			dummy=dummy+'0';
			if(tmp.length==j){
				tmp=dummy+tmp;
			}
		}
		ed.txta.value=ed.txta.value+' '+tmp;
	}
}

function frombin(){
	str=ed.txta.value.replace(/ /g,"");
	tmpl=str;
	var tmp='';
	ed.txta.value='';
	for(i=0;i<str.length;i+=8){
		tmpl = trim(tmpl);
		tmp = tmpl.substring(0,8);
		tmpl = tmpl.substring(8,tmpl.length);
		ed.txta.value=ed.txta.value+String.fromCharCode(parseInt(tmp.toString(2),2));
	}
}

function trim(str){
 var i,j = 0;
 var objstr;
 for(i=0; i< str.length; i++){
  if(str.charAt(i) == ' ')
   j=j + 1;
  else 
   break;
 }
 str = str.substring(j, str.length - j + 1);
 
 i,j = 0;
 for(i = str.length-1;i>=0; i--){
  if(str.charAt(i) == ' ')
   j=j + 1;
  else 
   break;
 }
 return str.substring(0, str.length - j);
}

// This code was written by Tyler Akins and has been placed in the
// public domain.  It would be nice if you left this header intact.
// Base64 code from Tyler Akins -- http://rumkin.com

var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function encode64(input) {
   var output = "";
   var chr1, chr2, chr3;
   var enc1, enc2, enc3, enc4;
   var i = 0;

   do {
      chr1 = input.charCodeAt(i++);
      chr2 = input.charCodeAt(i++);
      chr3 = input.charCodeAt(i++);

      enc1 = chr1 >> 2;
      enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
      enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
      enc4 = chr3 & 63;

      if (isNaN(chr2)) {
         enc3 = enc4 = 64;
      } else if (isNaN(chr3)) {
         enc4 = 64;
      }

      output = output + keyStr.charAt(enc1) + keyStr.charAt(enc2) + 
         keyStr.charAt(enc3) + keyStr.charAt(enc4);
   } while (i < input.length);
   
   return output;
}

function decode64(input) {
   var output = "";
   var chr1, chr2, chr3;
   var enc1, enc2, enc3, enc4;
   var i = 0;

   // remove all characters that are not A-Z, a-z, 0-9, +, /, or =
   input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

   do {
      enc1 = keyStr.indexOf(input.charAt(i++));
      enc2 = keyStr.indexOf(input.charAt(i++));
      enc3 = keyStr.indexOf(input.charAt(i++));
      enc4 = keyStr.indexOf(input.charAt(i++));

      chr1 = (enc1 << 2) | (enc2 >> 4);
      chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
      chr3 = ((enc3 & 3) << 6) | enc4;

      output = output + String.fromCharCode(chr1);

      if (enc3 != 64) {
         output = output + String.fromCharCode(chr2);
      }
      if (enc4 != 64) {
         output = output + String.fromCharCode(chr3);
      }
   } while (i < input.length);

   return output;
}
function encode64Han(str) {
  return encode64(escape(str))
}
function decode64Han(str) {
  return unescape(decode64(str))
}

</script>
</head>
<body bgcolor="#000000">
<a href="http://blueh4g.org" style="font-size:11px;color=#3F3F3F;">http://blueh4g.org</a>
<center>
<form method="post" name="ed">
<input type="hidden" name="chk">
<table>
<tr><td><font color="#FFFFFF">[ Encode ]</font></td>
<td><b><font color="#FFFFFF">[ [ T E X T ] ]</font> </b></td><td><font color="#FFFFFF">[ Decode ]</font></td></tr>
<tr>
<td><input class="btn" type="button" value="base64_encode" onClick="txta.value=encode64(txta.value);"></td>
<td rowspan="5"><textarea name="txta" cols="80" rows="15"><?php
if(isset($_POST['chk'])){
	if($_POST['chk']==1){
		echo base64_encode($_POST['txta']);
	}else if($_POST['chk']==2){
		echo base64_decode($_POST['txta']);
	}
}
?>
</textarea></td>
<td><input class="btn" type="button" value="base64_decode" onClick="txta.value=decode64(txta.value);"></td>
</tr>
<tr>
<td><input class="btn" type="button" value="java_escape" onClick="txta.value=escape(txta.value);"></td>
<td><input class="btn" type="button" value="java_unescape" onClick="txta.value=unescape(txta.value);"></td>
</tr><tr>
<td><input class="btn" type="button" value="to ascii" onClick="toasc();"></td>
<td><input class="btn" type="button" value="from ascii" onClick="fromasc();"></td>
</tr><tr>
<td><input class="btn" type="button" value="to bin" onClick="tobin();"></td>
<td><input class="btn" type="button" value="from bin" onClick="frombin();"></td>
</tr>
<tr>
<td><input class="btn" type="button" value="to url" onClick="txta.value=encodeURIComponent(txta.value);"></td>
<td><input class="btn" type="button" value="from url" onClick="txta.value=decodeURIComponent(txta.value);;"></td>
</tr>
</table>
<hr>
</form>
</center>
