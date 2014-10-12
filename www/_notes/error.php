<?php
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$id = abs(intval($id));
}
else
{
	$id = 400;
}

// ������������� ������ ����� � ��������
$a[401] = "��������� �����������";
$a[403] = "������������ �� ������ ��������������, ������ ��������";
$a[404] = "�������� �� ������";
$a[500] = "���������� ������ �������";
$a[503] = "���������� ������ �������";
$a[400] = "������������ ������";
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<HTML><HEAD>
<TITLE><?php echo $a[$id]; ?></TITLE>
<meta content="text/html"; charset="windows-1251" />
<!-- <meta http-equiv="refresh" content="25;url=http://www.rnv-r.ru/"> -->
<meta http-equiv="refresh" content="25;url=http://xn--80aafm4an.xn--p1ai">
</HEAD>
<BODY>
<?php
//��������� ����������� ����������
$server_name     = $_SERVER['SERVER_NAME'];
if(isset($_GET['request']))
{
	$request_url = $_GET['request'];
}
else
{
	$request_url = $_SERVER['REQUEST_URI'];
}
$remote_addr     = $_SERVER['REMOTE_ADDR'];
$http_user_agent = $_SERVER['HTTP_USER_AGENT'];
if(isset($_SERVER['HTTP_REFERER'])){
    $http_referer    = $_SERVER['HTTP_REFERER'];
}
else{
    $http_referer = '';
}


// ���������� ���� � ����� � ����������� �������
$time = date("d.m.Y H:i:s");
// ��� ���������� �������� ���� ���������
switch($id)
{
	case 404:
	$body = '����������� ���� URL: <b>'.$server_name.$request_url.' </b> �� ������ (Not Found)!<br />
������ ��������� �� <a href="http://'.$server_name.'">������� ��������</a> � ������ �� ������ ������ �� ����� <br />
��� ������ �� ����� �� ��������� ������:<hr>
<a href="http://'.$server_name.'">�� ������� </a> |
<a href="/about">� ��� </a> |
<a href="/oplata">������ � �������� </a> |
<a href="/catalog">������� </a> |
<a href="/contacts">��������</a>
<hr>';
    break;
	case 500:
	$body = '����������� ���� URL: <b>'.$server_name.$request_url.' </b> �������� ����������.<br />
��������� �������: ����������� ������ �� �������, ������ �������, ���� ������.<br />
���������� ����� �����.
<hr>';
    break;
	case 503:
	$body = '����������� ���� URL: <b>'.$server_name.$request_url.' </b> �������� ����������.<br />
��������� �������: ����������� ������ �� �������, ������ �������, ���� ������.<br />
���������� ����� �����.
<hr>';
    break;
    default:
	 $body = '����������� ���� URL: <b>'.$server_name.$request_url.' </b> �� ������ (Not Found)!<br />
������ ��������� �� <a href="http://'.$server_name.'">������� ��������</a> � ������ �� ������ ������ �� ����� <br />
��� ������ �� ����� �� ��������� ������:<hr>
<a href="http://'.$server_name.'">�� ������� </a> |
<a href="/about">� ��� </a> |
<a href="/oplata">������ � �������� </a> |
<a href="/catalog">������� </a> |
<a href="/contacts">��������</a>
<hr>';
}
$finish = '��� IP: <b>'.$remote_addr.'</b><br />
��� �������: <b>'.$http_user_agent.'</b><br />
������� ����� �������: <b>'.$time.'</b><br />';
//���� ����� � ������� ������
if ($http_referer !='')
$body .= "�� ������ �� ��������: <b>".$http_referer."</b><br />\n";


?>
<!-- ����� ��������� -->
<h1><i><?=$id?></i> <?=$a[$id]?></h1>
<p><?=$body.$finish?></p>
<?=$_SERVER['SERVER_SIGNATURE']?> 

</BODY></HTML>




























































































































































































































































