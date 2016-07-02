<?php

class get_content {

	function getcookie_https($url) {
		$curl = curl_init();
		$headers = array();
		$headers[] = 'Connection: keep-alive';
		$headers[] = 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Accept-Language: vi-VN,vi;q=0.8,en-US;q=0.5,en;q=0.3';
		// $headers[] = 'Cache-Control: no-cache';
		// $headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=utf-8';
		$headers[] = 'Host: agent.vietjetair.com';
		$headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:45.0) Gecko/20100101 Firefox/45.0'; //

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Accepts all CAs
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_COOKIEJAR, APP_PATH.'app/library/cookies.cookie'); // Stores cookies in the temp file
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_exec($curl);
		curl_close($curl);
	}
	function login_https($url, $data) {

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_COOKIEJAR, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_COOKIEFILE, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_exec($curl);
		curl_close($curl);
	}
	function PostHtml($url, $data) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_COOKIEJAR, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_COOKIEFILE, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_exec($curl);
		curl_close($curl);
	}
	function SelectTrevel($url, $data) {
		$curl = curl_init();
		$headers = array();
		$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
		$headers[] = 'Accept-Encoding: gzip, deflate, br';
		$headers[] = 'Accept-Language: en-US,en;q=0.5';
		$headers[] = 'Connection: keep-alive';
		// 			$headers[] = 'Cookie: __utma=105704979.1902167024.1458910074.1459003197.1459035812.4; __utmz=105704979.1459035812.4.4.utmcsr
		// =vietjetair.com|utmccn=(referral)|utmcmd=referral|utmcct=/Sites/Web/vi-VN/Home; _ga=GA1.2.1244478946
		// .1458916230; ASP.NET_SessionId=gndpcdodzuu5e1stof50il2q; __utmc=105704979; _ga=GA1.3.1244478946.1458916230
		// ; __sonar=7217737681034748969; _gat=1; _dc_gtm_UA-26874513-1=1; __utmb=105704979.3.10.1459035812; __utmt
		// =1; _dc_gtm_UA-27871415-1=1; _dc_gtm_UA-26874513-2=1';
		$headers[] = 'Host: agent.vietjetair.com';
		$headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:45.0) Gecko/20100101 Firefox/45.0';
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_COOKIEJAR, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_COOKIEFILE, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		curl_setopt($curl, CURLOPT_URL, "https://agent.vietjetair.com/Details.aspx?lang=vi&st=ae&sesid=");
		curl_setopt($curl, CURLOPT_POSTFIELDS, "__VIEWSTATE=%2FwEPDwUJNjcxMTMyNzkxZGSCOKkzyxi7dOwf9MgoTNDG0yP2nw%3D%3D&__VIEWSTATEGENERATOR=C9F36B63&SesID=&DebugID=09&button=continue&txtPax1_Gender=M&txtPax1_LName=Ngo&txtPax1_FName=An+Ninh&txtPax1_Addr1=Lien+Chau+-+Yen+Lac+-+Vinh+Phuc&txtPax1_City=Ho+Chi+Minh&txtPax1_Ctry=234&txtPax1_Prov=10241&txtPax1_EMail=ninh.uit%40gmail.com&txtPax1_DOB_Day=&txtPax1_DOB_Month=&txtPax1_DOB_Year=&txtPax1_Phone2=0912546855&txtPax1_Phone1=&txtPax1_Passport=135542350&dlstPax1_PassportExpiry_Day=&dlstPax1_PassportExpiry_Month=&lstPax1_PassportCtry=VNM&txtPax1_Nationality=");
		curl_exec($curl);
		curl_setopt($curl, CURLOPT_URL, "https://agent.vietjetair.com/AddOns.aspx?lang=vi&st=ae&sesid=");
		curl_setopt($curl, CURLOPT_POSTFIELDS, "__VIEWSTATE=%2FwEPDwULLTE4MTA4MjAxODdkZA2xHA%2BYHcZ0N6YqkY6JUmYWWW36&__VIEWSTATEGENERATOR=E5A93F9D&SesID=&DebugID=11&button=continue&m1th=9&m1p=1&m1p1=&m1p1rpg=&ctrSeatAssM=1&ctrSeatAssP=1&lstPaxItem%3A-1%3A1%3A17%3A0=-1&-1=-1&chkInsuranceNo=N");
		curl_exec($curl);
		curl_setopt($curl, CURLOPT_URL, "https://agent.vietjetair.com/Payments.aspx?lang=vi&st=ae&sesid=");
		curl_setopt($curl, CURLOPT_POSTFIELDS, "__VIEWSTATE=%2FwEPDwUKMTc1Njc0ODY4OA9kFgICAQ9kFgQCEA8QZGQWAGQCEQ8QZGQWAGRkQSW1866QbcOAGvzsqqFvYrWwoqA%3D&__VIEWSTATEGENERATOR=8259F811&button=3rd&SesID=&DebugID=11&SesID=&DebugID=11&SesID=&DebugID=11&lstPmtType=5%2CPL%2C0%2CV%2C0%2C0%2C0&txtCardNo=&dlstExpiry=2016%2F03%2F31&txtCVC=&txtCardholder=&txtAddr1=&txtCity=&txtPCode=&lstCtry=-1&lstProv=-1&txtPhone=");
		curl_exec($curl);
		curl_close($curl);
	}
	function HtmlGet($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_COOKIEJAR, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_COOKIEFILE, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		return $html;
		curl_close($curl);
	}
	function PostGetHtml($url, $fields_string) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($curl, CURLOPT_COOKIEJAR, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_COOKIEFILE, APP_PATH.'app/library/cookies.cookie');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$html = curl_exec($curl);
		curl_close($curl);
		return $html;
	}
}
?>