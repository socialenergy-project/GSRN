<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FilterRec
 *
 * @author John Papagiannis <intelen>
 */
class FilterRec {

	//put your code here

	function filterGameValues($dbResult) {


		$printData = [];

		$index = 0;

		foreach ($dbResult->result() as $row) {

			$printData[$index] = [
				"username" => $row->username,
				"Player" => $row->Player,
				"Badges" => $row->Badges,
				"ActionObjects" => $row->ActionObjects,
				"JobPlanner" => $row->JobPlanner,
				"Avatar" => $row->Avatar,
				"GameTime" => $row->GameTime,
			];

			$index++;
		}

		return $printData;
	}

	function filterGameValuesJson($dbResult) {

		$Json = "";

		foreach ($dbResult->result() as $row) {

			$Json = $row->JsonString;
		}

		return $Json;
	}

	function filterRecValuesActionsTLG($dbResult) {

		$index = 0;

		$count = 0;

		foreach ($dbResult->result() as $row) {

			$count = $row->totalScoreSum;
		}


		return $count;
	}

	function filterRecValuesActions($dbResult) {

		$index = 0;

		$count = 0;

		foreach ($dbResult->result() as $row) {

			$count = $row->NumVisits;
		}


		return $count;
	}

	function filterRecValues($dbResult) {


		$printData = [];

		$index = 0;

		foreach ($dbResult->result() as $row) {

			$printData[$index] = [
				"id" => $row->row_id,
				"text" => $row->descM,
				"dateFrom" => $row->dateFrom,
				"dateTo" => $row->dateTo,
				"status" => $row->statusR,
			];

			$index++;
		}

		return $printData;
	}

	function filterLcmsValues($dbResult) {

		foreach ($dbResult->result() as $row) {


			yield [

				"Title" => $row->CompTitle,
				"username" => $row->username,
			];

			//$index++;
		}
	}

	function filterLcmsValuesBadges($dbResult) {

		foreach ($dbResult->result() as $row) {


			yield [

				"BadgeName" => $row->BadgeName,
				"BadgeDesc" => $row->BadgeDesc,
				"DateGiven" => $row->DateGiven,
				"username" => $row->username,
			];

			//$index++;
		}
	}

	function filterLcmsValuesCourses($dbResult) {

		foreach ($dbResult->result() as $row) {
//grademin,grademax,gradepass

			yield [

				"CourseName" => $row->ObjectName,
				"DateGraded" => $row->DateGraded,
				"CurrentGrade" => $row->CurrentGrade,
				"TimeSpent" => $row->TimeSpent,
				"Grademin" => $row->grademin,
				"Grademax" => $row->grademax,
				"Gradepass" => $row->gradepass,
				"username" => $row->username,
			];

			//$index++;
		}
	}

	function filterGameLcmsValuesScore($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"Name" => $row->Name,
				"username" => $row->username,
				"Value" => $row->valuesServi,
			];

			//$index++;
		}

		//return $printData;
	}

	function filterGameLcmsValuesAgregateTotal($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"totalScore" => $row->totalScore,
				"lastWeekTotalScore" => $row->lastWeekTotalScore,
				"username" => $row->username,
				"lastMonthTotalScore" => $row->lastMonthTotalScore,
			];

			//$index++;
		}

		//return $printData;
	}

	function filterGameLcmsValuesOlnyBages($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

			
				"allBadges" => $row->all_badges,
					
			];

			
		}

		
	}

	function filterGameLcmsValues($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"totalScore" => $row->total_score,
				"dailyScore" => $row->daily_score,
				"username" => $row->user_id,
				"gameDuration" => $row->game_duration,
				"timestampUserloggedin" => $row->timestamp_user_logged_in,
				"energyProgram" => $row->energy_program,
				"levelGame" => $row->level_game,
				"jobName" => $row->job_name,
				"allBadges" => $row->all_badges,
				"devices" => $row->devices,
			];

		
		}

		
	}

	
	function filterGameRewards($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"totalCredits" => $row->totalCredits,
				"totalCash" => $row->totalCash,
				"username" => $row->user_id,
				"toExPoints" => $row->toExPoints,
				
			];

		
		}

		
	}
	
	function filterGameScoreA($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"totalScore" => $row->totalScore,
				"user_id" => $row->user_id,
				
			];

		
		}

	
	}
	
	
	
	function filterGameScoreB($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"Row_id" => $row->Row_id,
				"id_job" => $row->id_job,
				"total_score" => $row->total_score,
				"daily_score" => $row->daily_score,
				"user_id" => $row->user_id,
				"game_duration" => $row->game_duration,
				"timestamp_user_logged_in" => $row->timestamp_user_logged_in,
				"timestamp_user_logged_out" => $row->timestamp_user_logged_out,
				"energy_program" => $row->energy_program,
				"level_game" => $row->level_game,
				"devices" => $row->devices,
				"timestampReceived" => $row->timestampReceived,
				
			];

			
		}

		
	}
	
	
	
	
	function filterGameScoreC($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"GameLevel1monthback" => $row->GameLevel1monthback,
				"user_id" => $row->user_id,
				
			];

		
		}

		
	}
	
	function filterGameScoreD($dbResult) {



		foreach ($dbResult->result() as $row) {


			yield [

				"CommunityPricing" => $row->CommunityPricing,
				"energy_program" => $row->energy_program,
				"user_id" => $row->user_id,
				
			];

			
		}

	
	}
	
}
