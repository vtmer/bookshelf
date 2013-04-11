<?php
require('config.php');
require('class.phpmailer.php');

$activationKey = mt_rand() . mt_rand() . mt_rand() . mt_rand() . mt_rand();
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$email = mysql_real_escape_string($_POST['email']);
$sql="INSERT INTO users (username, password, email, activationkey, status) VALUES ('$username', '$password', '$email', '$activationKey', 'verify')";

@mysql_query($sql) or die("Can't insert into users!");
##Send activation Email

function postmail($to,$subject = "",$body = "")
{
    //$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
    //error_reporting(E_ALL);
    error_reporting(E_STRICT);
    date_default_timezone_set("Asia/Beijing");//设定时区东八区
    require_once('class.phpmailer.php');
    include("class.smtp.php"); 
    $mail             = new PHPMailer(); //new一个PHPMailer对象出来
    $body             = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
    $mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug  = 1;                     // 启用SMTP调试功能
                                           // 1 = errors and messages
                                           // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = "ssl";                 // 安全协议
    $mail->Host       = "smtp.example.com";      // SMTP 服务器
    $mail->Port       = 465;                   // SMTP服务器的端口号
    $mail->Username   = "";  // SMTP服务器用户名
    $mail->Password   = "";            // SMTP服务器密码
   // $mail->SetFrom('发件人地址，如admin#jiucool.com #换成@', '发件人名称');
    //$mail->AddReplyTo("邮件回复地址,如admin#jiucool.com #换成@","邮件回复人的名称");
    $mail->SetFrom('296276305@qq.com','chile');
    $mail->Subject    = $subject;
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer! "; // optional, comment out and test
    $mail->MsgHTML($body);
    $address = $to;
    $mail->AddAddress($address);
    //$mail->AddAttachment("images/phpmailer.gif");      // attachment 
    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
    if(!$mail->Send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } 
    else 
    {
        echo "Message has sent!";
    }
}
    $message = "Welcome to our website!\r\rYou, or someone using your email address, has completed registration at test.chile.com. You can complete registration by clicking the following link:\rhttp://test.chile.com/verify.php?$activationKey\r\rIf this is an error, ignore this email and you will be removed from our mailing list.\r\rRegards,\ test.chile.com";

    postmail($email,'感谢注册',$message);

?>
