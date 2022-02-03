<?php
/*
 +-=========================================================================-+
 |                       php Kolay Forum (phpKF) v2.10                       |
 +---------------------------------------------------------------------------+
 |               Telif - Copyright (c) 2007 - 2017 phpKF Ekibi               |
 |                 http://www.phpKF.com   -   phpKF@phpKF.com                |
 |                 Tüm hakları saklıdır - All Rights Reserved                |
 +---------------------------------------------------------------------------+
 |  Bu yazılım ücretsiz olarak kullanıma sunulmuştur.                        |
 |  Dağıtımı yapılamaz ve ücretli olarak satılamaz.                          |
 |  Yazılımı dağıtma, sürüm çıkartma ve satma hakları sadece phpKF`ye aittir.|
 |  Yazılımdaki kodlar hiçbir şekilde başka bir yazılımda kullanılamaz.      |
 |  Kodlardaki ve sayfa altındaki telif yazıları silinemez, değiştirilemez,  |
 |  veya bu telif ile çelişen başka bir telif eklenemez.                     |
 |  Yazılımı kullanmaya başladığınızda bu maddeleri kabul etmiş olursunuz.   |
 |  Telif maddelerinin değiştirilme hakkı saklıdır.                          |
 |  Güncel telif maddeleri için  www.phpKF.com  adresini ziyaret edin.       |
 +-=========================================================================-+*/


class eposta_yolla
{
	var $normal = false;
	var $smtp = false;

	var $sunucu;
	var $kullanici_adi;
	var $sifre;
	var $smtp_dogrulama;

	var $gonderen;
	var $gonderen_adi;
	var $kime;
	var $kopya;
	var $yanitla;
	var $hata_bilgi;

	var $konu;
	var $icerik;
	var $baslik;



	// gönderilecek adres
	function GonderilenAdres($adres)
	{
		$this->kime = $adres;
	}

	// gönderene bir kopya yolla
	function DigerAdres($adres)
	{
		$this->kopya = $adres;
	}

	// yanıtlama adresi
	function YanitlamaAdres($adres)
	{
		$this->yanitla = $adres;
	}

	// mail fonksiyonu kullan
	function MailKullan()
	{
		$this->normal = true;
	}

	// smtp kullan
	function SMTPKullan()
	{
		$this->smtp = true;
	}




	//  E-POSTA BAŞLIK BİLGİLERİ    //

	function Baslik_Olustur()
	{
		$sunucu_ip = $_SERVER['REMOTE_ADDR'];
		if ($this->normal == true) $this->baslik  = 'From: '.$this->gonderen_adi.' <'.$this->gonderen.">\r\n";
		$this->baslik .= 'Reply-To: '.$this->yanitla."\r\n";
		$this->baslik .= 'Return-Path: '.$this->yanitla."\r\n";
		$this->baslik .= 'Message-ID: <'.md5(uniqid(time())).'@'.$_SERVER['SERVER_NAME'].'> '."\r\n";
		$this->baslik .= 'X-Priority: 3'."\r\n";
		$this->baslik .= "X-Originating-IP: {$sunucu_ip}\r\n";
		$this->baslik .= "X-Originating-Email: $_SERVER[SCRIPT_NAME]\r\n";
		$this->baslik .= "X-Sender: $_SERVER[SCRIPT_NAME]\r\n";
		$this->baslik .= 'X-Mailer: phpKF'."\r\n";
		$this->baslik .= 'MIME-Version: 1.0'."\r\n";
		$this->baslik .= 'Content-Transfer-Encoding: 8bit'."\r\n";
		$this->baslik .= 'Content-Type: text/plain; charset="UTF-8"'."\r\n";
		$this->baslik .= 'Importance: Normal'."\r\n";
	}




	//  SMTP E-POSTA YÖNTEMİ    //

	function smtp_mail($kime,$konu,$message,$headers)
	{
		global $ayarlar;

		// SMTP sunucuya bağlanılıyor
		$baglan = @fsockopen($this->sunucu, $ayarlar['smtp_port'], $errno, $errstr, 1);

		if (!$baglan)
		{
			$this->hata_bilgi = "Hatalı Adres - SMTP sunucuya bağlanılamadı !<br>SMTP sunucu adresini kontrol edin.<p>".$errno.'<p>'.$errstr;
			return false;
		}


		// bağlantı sonucu
		$satir = fgets($baglan,256);

		if (substr($satir,0,3) != "220")
		{
			$this->hata_bilgi = "SMTP sunucuya bağlanılamadı !<br>SMTP sunucu adresini kontrol edin.<p>".$satir;
			return false;
		}

		while ($satir = fgets($baglan,256))
		{
			if (substr($satir,3,1) != '-') break;
		}


		// EHLO (selamlamaya) karşılık bekleniyor
		fputs($baglan, "EHLO ".$this->sunucu."\r\n");
		$satir = fgets($baglan,256);

		// EHLO cevap vermezse HELO giriliyor
		if (substr($satir,0,3) != "250")
		{
			// HELO (selamlamaya) karşılık bekleniyor
			fputs($baglan, "HELO ".$this->sunucu."\r\n");
			$satir = fgets($baglan,256);

			if (substr($satir,0,3) != "250")
			{
				$this->hata_bilgi = "SMTP sunucu selamlamaya karşılık vermiyor !<p>".$satir;
				return false;
			}
		}

		else
		{
			while ($satir = fgets($baglan,256))
			{
				if (substr($satir,3,1) != '-') break;
			}
		}



		// kimlik doğrulaması kullan işaretli ise
		if ($this->smtp_dogrulama == true)
		{
			// kimlik doğrulaması
			fputs($baglan, "auth login\r\n");
			$satir = fgets($baglan,256);

			if (substr($satir,0,3) != "334")
			{
				$this->hata_bilgi = "SMTP kimlik doğrulaması başarısız !<p>".$satir;
				return false;
			}


			// base64 kullanıcı adı giriliyor
			fputs($baglan, base64_encode($this->kullanici_adi)."\r\n");
			$satir = fgets($baglan,256);

			if (substr($satir,0,3) != "334")
			{
				$this->hata_bilgi = "Kimlik doğrulanamadı !<br>SMTP kullanıcı adınızı kontrol edin.<p>".$satir;
				return false;
			}


			// base64 şifre giriliyor
			fputs($baglan, base64_encode($this->sifre)."\r\n");
			$satir = fgets($baglan,256);

			if (substr($satir,0,3) != "235")
			{
				$this->hata_bilgi = "Kimlik doğrulanamadı !<br>SMTP kullanıcı adı ve şifresinizi kontrol edin.<p>".$satir;
				return false;
			}
		}



		// E-Posta gönderen
		fputs($baglan, "MAIL FROM: <".$this->gonderen.">\r\n");
		$satir = fgets($baglan,256);

		if (substr($satir,0,3) != "250")
		{
			if ($this->smtp_dogrulama == true) $this->hata_bilgi = "Gönderen adresi başarısız !<p> SMTP sunucu sadece giriş yapılan hesabın adresi ile E-Posta yollamaya izin veriyor olabilir.<p>".$satir;

			else $this->hata_bilgi = "Gönderen adresi başarısız !<p> SMTP sunucu sadece giriş yapılan hesabın adresi ile E-Posta yollamaya izin veriyor olabilir;<br> Veya SMTP sunucu kimlik doğrulaması gerektiriyor olabilir !<p>".$satir;

			return false;
		}


		// E-Posta gönderilen
		fputs($baglan, "RCPT TO: <$kime>\r\n");
		$satir = fgets($baglan,256);

		if (substr($satir,0,3) != "250")
		{
			$this->hata_bilgi = "Gönderilen adresi başarısız !<p>".$satir;
			return false;
		}


		// DATA (veri) onayı al
		fputs($baglan, "DATA\r\n");
		$satir = fgets($baglan,256);

		if (substr($satir,0,3) != "354")
		{
			$this->hata_bilgi = "DATA (veri) onayı alınamadı !<p>".$satir;
			return false;
		}


		// gönderilen, gönderen, e-posta konusu, başlık ve e-posta içeriği
		fputs($baglan, "To: $kime\r\nFrom: ".$this->gonderen."\r\nSubject: $konu\r\n$headers\r\n\r\n$message\r\n.\r\n");
		$satir = fgets($baglan,256);

		if (substr($satir,0,3) != "250")
		{
			$this->hata_bilgi = "E-Posta içeriği gönderilemedi !<p>".$satir;
			return false;
		}


		// çıkış yapılıyor
		fputs($baglan,"QUIT\r\n");
		$satir = fgets($baglan,256);

		if (substr($satir,0,3) != "221")
		{
			$this->hata_bilgi = "SMTP çıkışı yapılamadı !<p>".$satir;
			return false;
		}

		return true;
	}




	//  E-POSTA YOLANIYOR   //

	function Yolla()
	{
		$this->konu = '=?utf-8?B?'.base64_encode($this->konu).'?=';

		if ($this->normal == true)
		{
			$this->Baslik_Olustur();

			$yollandi = @mail($this->kime, $this->konu, $this->icerik, $this->baslik);

			if(!$yollandi)
			{
				$this->hata_bilgi = 'Örnek mail() fonksiyonu oluşturulamadı !';
				return false;
			}


			// gönderene bir kopya yolla
			if ($this->kopya != '')
			{
				$this->Baslik_Olustur();

				$yollandi = @mail($this->kopya, $this->konu, $this->icerik, $this->baslik);

				if(!$yollandi)
				{
					$this->hata_bilgi = 'Örnek mail() fonksiyonu oluşturulamadı !';
					return false;
				}
			}
			return true;
		}


		elseif ($this->smtp == true)
		{
			$this->Baslik_Olustur();

			$yollandi = $this->smtp_mail($this->kime, $this->konu, $this->icerik, $this->baslik);

			if(!$yollandi) return false;


			// gönderene bir kopya yolla
			if ($this->kopya != '')
			{
				$this->Baslik_Olustur();

				$yollandi = $this->smtp_mail($this->kopya, $this->konu, $this->icerik, $this->baslik);

				if(!$yollandi) return false;
			}
			return true;
		}


		else
		{
			$this->hata_bilgi = 'Yanlış E-Posta Yöntemi !<p>Yönetim Masası - Genel Ayarlar sayfasındaki <br>"E-Posta göndermede kullanılacak yöntem" alanından bir seçim yapın.';
			return false;
		}
	}
}

?>