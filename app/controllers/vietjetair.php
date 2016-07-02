<?php

include_once  APP_PATH."app/library/curl.php";
include_once  APP_PATH."app/library/simple_html_dom.php";

class vietjetair extends get_content {

	private $host = 'https://agent.vietjetair.com/';
	private $url_login = 'https://agent.vietjetair.com/userprofilelogin.aspx?lang=vi';
	private $url_get_content = 'https://agent.vietjetair.com/ViewFlights.aspx?lang=vi&st=ae&sesid=';
	private $fields_string_login = '__VIEWSTATE=%2FwEPDwULLTE0NDMwODIwNDlkZLcj8Iku9nBtQFtRUA6UUD8B7PaU&__VIEWSTATEGENERATOR=2A12EE90&SesID
=&DebugID=08&button=bookflight&txtPublicUserID=ninh.uit@gmail.com&txtPublicUserPswd=kakarotyoyo';
	private $Table_tag = 'table[class=FlightsGrid]';
	private $Row_tag = 'tr[id^=gridTravelOptDep]';
	private $Time1_tag = 'td[class=SegInfo]';
	private $Time1_tag_number = '1';
	private $Time2_tag = 'td[class=SegInfo]';
	private $Time2_tag_number = '2';
	private $codes_flight = 'td[class=SegInfo]';
	private $codes_flight_number = '3';
	private $url_get_cost_by_month = 'https://agent.vietjetair.com//ValueViewer.aspx?lang=vi&st=ae&sesid=';

	function get_html($PostData) {
	    $this->PostHtml($this->url_get_content, $PostData);
		return $this->HtmlGet('https://agent.vietjetair.com//TravelOptions.aspx?lang=vi&st=ae&sesid=');
	}
	function get_seesion() {
		// echo "Have get session";
		$this->getcookie_https($this->host);
		$this->PostHtml($this->url_login, $this->fields_string_login);
	}
	function get_html_ontrip($PostData) {
		$this->PostHtml($this->url_get_content, $PostData);
	   	return $this->HtmlGet('https://agent.vietjetair.com//TravelOptions.aspx?lang=vi&st=ae&sesid=');
	}
	function get_flight_by_month($Sesion, $PostData) {
		$DataFlight = array();
		$html = "";
		if ($Sesion == 0) {
			$this->get_seesion();
		}
		$this->PostHtml($this->url_get_content, $PostData);
		$html = $this->HtmlGet($this->url_get_cost_by_month);
		$dom = new simple_html_dom();
		$dom->load($html);
		// libxml_use_internal_errors(true);
		$tableinfo = $dom->getElementById("ctrValueViewerDepGrid");
		$articles = array();
		if (count($tableinfo->find("tr")) < 2) {
			return $this->get_flight_by_month(0, $PostData);
		}
		foreach ($tableinfo->find("tr") as $article) {
			foreach ($article->find("div") as $item) {
				$costdiv = $item->plaintext;
				foreach ($item->find("p[class=vvFare]") as $it) {
					$cost = trim(preg_replace("/[^0-9]/", "", $it->plaintext));
					$costdate = str_replace(array($it->plaintext), array(""), $costdiv);
					$item = array();
					$item[$costdate] = $cost;
					$articles[] = $item;
				}

			}
		}
		unset($dom);
		$DataFlight[] = $articles;
		return $DataFlight;
	}
	function find_data_table_vietjet($RoundTrip, $Sesion, $PostData, $Day1) {

		// error_reporting(0);
		$data_airlines = array();
		$html = "";
		$html2 = "";
		if ($Sesion == 0) {
			$this->get_seesion();
		}
		// $this->get_seesion();
		if ($RoundTrip == 1) {
			$html = $this->get_html();
		} else {
			$html = $this->get_html_ontrip($PostData);
			$html2 = $this->HtmlGet($this->url_get_cost_by_month);
		}
		$split = explode($this->Table_tag, $html);

		// for ($j = 0; $j < count($split); $j++) {
		$articles = array();
		$dom = new simple_html_dom();
		// libxml_use_internal_errors(true);
		$dom->load($split[0]);
		if (count($dom->find($this->Row_tag)) < 2) {
			return $this->find_data_table_vietjet($RoundTrip, 0, $PostData, $Day1);
		}
		$i = 0;
		foreach ($dom->find($this->Row_tag) as $article) {
			$str = $article->find($this->Time1_tag, $this->Time1_tag_number)->plaintext;
			$Time1_tag = substr($str, 0, 5);
			if ($Time1_tag != false) {
				$str = $article->find($this->Time2_tag, $this->Time2_tag_number)->plaintext;
				$Time2_tag = substr($str, 0, 5);
				$str = $article->find($this->codes_flight, $this->codes_flight_number)->plaintext;
				$codes_flight = trim(substr($str, 0, 7));
				if (count($article->find('td[data-familyid=Promo]', '0')) > 0) {
					$item = array();
					$item["FlightId"] = $i;
					$i++;
					$item["Time1_tag"] = $Time1_tag;
					$item["Time2_tag"] = $Time2_tag;
					$item["type_journey"] = "Promo";
					$item["cost"] = trim(preg_replace("/[^0-9]/", "", $article->find('td[data-familyid=Promo]', '0')->plaintext));
					$item["codes_flight"] = $codes_flight;
					$item["flighttype"] = "Promo";
					$articles[] = $item;
				}
				if (count($article->find('td[data-familyid=Eco]', '0')) > 0) {
					$item1 = array();
					$item1["FlightId"] = $i;
					$i++;
					$item1["Time1_tag"] = $Time1_tag;
					$item1["Time2_tag"] = $Time2_tag;
					$item1["type_journey"] = "Eco";
					$item1["cost"] = trim(preg_replace("/[^0-9]/", "", $article->find('td[data-familyid=Eco]', '0')->plaintext));
					$item1["codes_flight"] = $codes_flight;
					$item1["flighttype"] = "Eco";
					$articles[] = $item1;
				}
				if (count($article->find('td[data-familyid=SkyBoss]', '0')) > 0) {
					$item2 = array();
					$item2["FlightId"] = $i;
					$i++;
					$item2["Time1_tag"] = $Time1_tag;
					$item2["Time2_tag"] = $Time2_tag;
					$item2["type_journey"] = "SkyBoss";
					$item2["cost"] = trim(preg_replace("/[^0-9]/", "", $article->find('td[data-familyid=SkyBoss]', '0')->plaintext));
					$item2["codes_flight"] = $codes_flight;
					$item2["flighttype"] = "SkyBoss";
					$articles[] = $item2;
				}
			}
		}
		$dom->load($html2);
		// libxml_use_internal_errors(true);
		$tableinfo = $dom->getElementById("ctrValueViewerDepGrid");
		$daypricedata = array();
		$i = 0;
		$itemcost = array();
		foreach ($tableinfo->find("tr") as $article) {
			foreach ($article->find("div") as $item) {
				$cost = 0;
				$costdiv = $item->plaintext;
				foreach ($item->find("p[class=vvFare]") as $it) {
					$cost = trim(preg_replace("/[^0-9]/", "", $it->plaintext));
					$costdate = str_replace(array($it->plaintext), array(""), $costdiv);
					$itemcost[$costdate] = $cost;
				}
			}
		}
		$DateToday = new DateTime();
		$dayssub = $Day1 - $DateToday->format("d");
		$days = -3;
		if ($dayssub == 0) {
			$days = 0;
		}
		if ($dayssub == 1) {
			$days = -1;
		}
		if ($dayssub == 2) {
			$days = -2;
		}
		for ($i = 0; $i < 7; $i++) {
			$dayinfo = $Day1 + $days;
			$item = array();
			if (($dayinfo < 1) || ($dayinfo > 31)) {
				$item["cost"] = 0;
			} else {
				if (isset($itemcost[$dayinfo])) {
					$item["cost"] = $itemcost[$dayinfo];
				} else {
					$item["cost"] = 0;
				}

			}
			$daypricedata[] = $item;
			$days++;
		}
		unset($dom);
		session_start();
		$data_airlines["Vietjetair"] = $articles;
		$_SESSION["DataFlight"] = $articles;
		$data_airlines["DayPriceData"] = $daypricedata;
		// }
		// return $data_airlines;
		return $data_airlines;
		//  echo json_encode($data_airlines);

	}
}

?>