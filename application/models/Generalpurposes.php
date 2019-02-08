<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Generalpurposes
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Generalpurposes extends CI_Model {

//put your code here

	function deleteAllUserCookies($urd) {

		$cookie_name = "uredf_" . $urd;
		unset($_COOKIE[$cookie_name]);
		unset($_COOKIE[$cookie_name]);
		setcookie($cookie_name, null, -1, '/');
		setcookie($cookie_name, null, -1, '/');
	}

	function removeValueCookie($urd, $prdID) {

		$cookie_value = "";
		$cookie_name = "uredf_" . $urd;


		if (isset($_COOKIE[$cookie_name])) {

			if (substr_count($_COOKIE[$cookie_name], ',') == 0) {

				unset($_COOKIE[$cookie_name]);
				unset($_COOKIE[$cookie_name]);
				setcookie($cookie_name, null, -1, '/');
				setcookie($cookie_name, null, -1, '/');
			} elseif (substr_count($_COOKIE[$cookie_name], ',') > 0) {


				$newCookieValue = str_replace($prdID, ",", $_COOKIE[$cookie_name]);

				$newTable = [];
				$pieces = explode(",", $newCookieValue);
				foreach ($pieces as $row) {

					if ($row) {
						$newTable[] = $row;
					}
				}
				$cookie_value = implode(",", $newTable);



				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			}
		}
	}

	function returnBasketItems($urd) {

		$cookie_value = "";
		$cookie_name = "uredf_" . $urd;



		if (!isset($_COOKIE[$cookie_name])) {
			return FALSE;
		} else {

			if (substr(str_replace(",,", ",", $_COOKIE[$cookie_name]), 0, 1) == ",") {


				return substr(str_replace(",,", ",", $_COOKIE[$cookie_name]), 1);
			}

			return str_replace(",,", ",", $_COOKIE[$cookie_name]);
		}
	}

	function removeItemValueFromCookie($urd, $prdID) {

		$cookie_value = "";
		$cookie_name = "uredf_" . $urd;


		if (!isset($_COOKIE[$cookie_name])) {

			return false;
		} else {

			if (substr_count($_COOKIE[$cookie_name], ',') == 1) {

				$cookie_value = str_replace($prdID, "", $_COOKIE[$cookie_name]);

				$cookie_value = str_replace(",", "", $cookie_value);

				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			} elseif (substr_count($_COOKIE[$cookie_name], ',') > 1) {

				$cookie_value = $_COOKIE[$cookie_name];

				$pieces = explode(",", $cookie_value);

				if (($key = array_search($prdID, $pieces)) !== FALSE) {
					unset($pieces[$key]);
				}

				$sortedArray = [];
				foreach ($pieces as $row) {
					if (isset($row) && mb_strlen(trim($row), 'UTF-8') > 1) {
						$sortedArray[] = $row;
					}
				}

				$cookie_value = implode(",", array_unique($sortedArray));

				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
			} else {

				unset($_COOKIE[$cookie_name]);
				unset($_COOKIE[$cookie_name]);
				setcookie($cookie_name, null, -1, '/');
				setcookie($cookie_name, null, -1, '/');
			}
		}

		return TRUE;
	}

	function createSaveValueCookie($urd, $prdID) {
		$cookie_value = "";
		$cookie_name = "uredf_" . $urd;

		if (!isset($_COOKIE[$cookie_name])) {
			$cookie_value = $prdID;
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		} else {

			if (substr_count($_COOKIE[$cookie_name], ',') == 1) {
				$cookie_value = str_replace($prdID, "", $_COOKIE[$cookie_name]);

				if (strpos($prdID . ",", $cookie_value) === false) {
					$cookie_value = $cookie_value . "," . $prdID;
				} elseif (strpos("," . $prdID, $cookie_value) === false) {

					$cookie_value = $cookie_value . "," . $prdID;
				} else {
					$cookie_value = $_COOKIE[$cookie_name];
				}
			} elseif (substr_count($_COOKIE[$cookie_name], ',') > 1) {

				$stringValues = $_COOKIE[$cookie_name] . "," . $prdID;
				$pieces = explode(",", $stringValues);

				$cookie_value = implode(",", array_unique($pieces));
			} else {

				if ($prdID != $_COOKIE[$cookie_name]) {
					$cookie_value = $_COOKIE[$cookie_name] . "," . $prdID;
				} else {
					$cookie_value = $_COOKIE[$cookie_name];
				}
			}

			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		}

		return $cookie_value;
	}

	function addtoDataZoneOffset($dateTime = null) {

		$date_utc = new \DateTime($dateTime . ' ' . date('H:i:s'));

		$UTC_offset = '+00:00';
		$timezone = new \DateTimeZone(str_replace(':', '', $UTC_offset));
		$date_utc->setTimezone($timezone);

		return $date_utc->format('Y-m-d H:i:s');
	}

	function createGMTtimestampOffset($offset = "+00:00") {

		$Date_GMT = "";
		$Date_GMT = new DateTime(null, new DateTimeZone($offset));

		return $Date_GMT->getTimestamp();
	}

	function createGMTdateOffset($format = "Y-m-d H:i:s") {

		$Date_GMT = "";
		$Date_GMT = new DateTime(null, new DateTimeZone("+00:00"));

		return $Date_GMT->format($format);
	}

	function timestampTOdate($myTimestamp, $offset = "+00:00") {

		$dt = new DateTime();
		$dt->setTimezone(new DateTimeZone($offset));
		$dt->setTimestamp($myTimestamp);

		return $dt->format('Y-m-d H:i:s');
	}

	function createXrandomNumber($x = 3) {

		//$x = 3; // Amount of digits
		$min = pow(10, $x);
		$max = pow(10, ($x + 1) - 1);
		return rand($min, $max);
	}

}
