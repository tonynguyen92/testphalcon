<?php

use Phalcon\Http\Client\Request;

class SearchController extends ControllerBase
{

	public function indexAction()
	{

	}
	public function gethtmlAction()
	{
		try{
			
			echo "ok";
		}
		catch (Exception $e){
			echo $e->getMessage() . '<br>';
			echo '<pre>' . $e->getTraceAsString() . '</pre>';
		}
	}
	public function SearchFlightAction()
	{
		try {
			$vietjetair = new vietjetair();

			$RoundTrip = $this->request->getPost("RoundTrip");
			$Destination1 = $this->request->getPost("Destination1");
			$Origin1 = $this->request->getPost("Origin1");
			$_time1 = $this->request->getPost("_time1");
			$_time2 = $this->request->getPost("_time2");
			$FindMonth = $this->request->getPost("FindMonth");

			$split_time1 = explode("/", $_time1);
			$split_time2 = explode("/", $_time2);
			$Month1 = $split_time1[1] . "/" . $split_time1[2];
			$Day1 = $split_time1[0];
			$Month2 = $split_time2[1] . "/" . $split_time2[2];
			$Day2 = $split_time2[0];
			$postfields = array(
				'__VIEWSTATE' => '/wEPDwULLTEzMTM5OTIwMDgPZBYCAgIPZBYQAgYPEGRkFgBkAgcPEGRkFgBkAgoPEGRkFgBkAgsPEGRkFgBkAgwPEGRkFgBkAg0PEGRkFgBkAg4PEGRkFgBkAhMPEGRkFgBkZBmDyKPtY+pZYWLQHJOHAHcLr39R',
				'button' => 'vfto',
				'chkRoundTrip' => '',
				'departTime1' => '0000',
				'departTime2' => '0000',
				'departure1' => $_time1,
				'departure2' => $_time1,
				'dlstDepDate_Day' => $Day1,
				'dlstDepDate_Month' => $Month1,
				'dlstRetDate_Day' => $Day2,
				'dlstRetDate_Month' => $Month2,
				'lstDepDateRange' => '0',
				'lstDestAP' => $Destination1,
				'lstLvlService' => '1',
				'lstOrigAP' => $Origin1,
				'lstResCurrency' => 'VND',
				'lstRetDateRange' => '0',
				'txtNumAdults' => '1',
				'txtNumChildren' => '0',
				'txtNumInfants' => '0');

			if ($FindMonth == 0) {
				if ($RoundTrip == 1) {
				} else {

			// $start = microtime(true);
					$data = $vietjetair->find_data_table_vietjet($RoundTrip, 1, $postfields, $Day1);

			//$data = $vietjetair->get_flight_by_month(1, $postfields);
					echo json_encode($data);
			// $time_elapsed_secs = microtime(true) - $start;
			// echo "<br>============" . $time_elapsed_secs . "===================<br>";
				}
			} else {
				$start = microtime(true);
				$data = $vietjetair->get_flight_by_month(1, $postfields);
				echo json_encode($data);
				$time_elapsed_secs = microtime(true) - $start;
				echo "<br>============" . $time_elapsed_secs . "===================<br>";
			}
		}
		catch (Exception $e){
			echo $e->getMessage() . '<br>';
			echo '<pre>' . $e->getTraceAsString() . '</pre>';
		}

	}
}

