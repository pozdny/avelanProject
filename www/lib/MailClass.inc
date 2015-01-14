<?php
require_once('phpmailer/PHPMailer_v5.1/class.phpmailer.php');


class FreakMailer extends PHPMailer 
{
    	var $priority = 3;
    	var $to_name = 'avelan.info';
    	var $to_email = 'avelan.info@gmail.com';
        var $to_email2 = '';
    	var $From = 'avelan.info';
    	var $FromName ='avelan.info';
    	var $Sender = 'avelan.info';

    	function FreakMailer()
    	{
            global $site;
            $this->Mailer = "mail";
            $this->CharSet = "utf-8";
      		if($site['smtp_mode'] == 'enabled')
     		{
        		$this->Host = $site['smtp_host'];
        		$this->Port = $site['smtp_port'];
        		if($site['smtp_username'] != '')
        		{
         			$this->SMTPAuth  = true;
        			$this->Username  = $site['smtp_username'];
        			$this->Password  =  $site['smtp_password'];
        		}
        		$this->Mailer = "smtp";
      		}

      		if(!$this->From)
      		{
        		$this->From = $site['from_email'];
      		}

      		if(!$this->FromName)
      		{
        		$this->FromName = $site['from_name'];
      		}
            else{
                $this->FromName = $this->FromName.' [Сайт] ';
            }
      		if(!$this->Sender)
      		{
        		$this->Sender = $site['from_email'];
      		}
      		$this->Priority = $this->priority;
    	}
}
