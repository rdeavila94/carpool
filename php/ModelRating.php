<?php
require_once("ModelMyRides3.php");

class ModelRating
{
	public $DEBUG_INFO=0;
	public $sqlStmt = 'I am a Model.';

	public function updateRating($dbConn,$routeId,$userName,$rating,$msgId)
	{
		
		$statusModel = new ModelMyRides3();

		$this->addRating($dbConn,$routeId,$userName,$rating);
		$this->updateRatingMessage($dbConn,$msgId);
		if ($this->haveAllPassengersRated($dbConn,$routeId))
		{
			$statusModel->setRideClosed($dbConn,$routeId);
		}
	}

	public function addRating($dbConn,$routeId,$userName,$rating)
	{
		$sqlStmt = "insert into ratings
			(
				route_id,
				username_passenger,
				rating
			)
			values
			(
				$routeId,
				'$userName',
				$rating
			)";
// echo "sqlStmt($sqlStmt)<br>";

		$sth = mysqli_query($dbConn,$sqlStmt);

		mysqli_free_result($sth);
		mysqli_next_result($dbConn);
	}

	public function updateRatingMessage($dbConn,$msgId)
	{
		$sqlStmt = "
			update messages set
				message_text = 'Thank you for your feedback.'
			where message_id = $msgId ";

		$sth = mysqli_query($dbConn,$sqlStmt);

		mysqli_free_result($sth);
		mysqli_next_result($dbConn);
	}

	public function haveAllPassengersRated($dbConn,$routeId)
	{
		$status=0;
		$rows = array();
		$sqlStmt = "
			select count(*) as num_unrated 
			from 
				passenger_list p
				left join ratings r
					on p.route_id = r.route_id
					and p.username = r.username_passenger
			where 
				p.route_id = $routeId 
				and r.username_passenger is null
		";
// echo $sqlStmt."<br>";
		$sth = mysqli_query($dbConn,$sqlStmt);
		$row = mysqli_fetch_assoc($sth);
		if ($row[num_unrated] == 0)
		{
			$status=1;
		}

		mysqli_free_result($sth);
		mysqli_next_result($dbConn);
		return $status;
	}

	public function getRating($dbConn,$userId)
	{
		$rows = array();
		$sqlStmt = "
			select 
				ifnull(avg(rtg.rating),0) as rating
			from
				routes r
				join ratings rtg 
					on r.route_id = rtg.route_id
			where
				r.email = '$userId'
			";
		$sth = mysqli_query($dbConn,$sqlStmt);
		while ($row = mysqli_fetch_assoc($sth))
		{
			$rows[] = $row;
$this->debugMsg($this->DEBUG_INFO,"::rating(".$row[rating].")");
		}
		mysqli_free_result($sth);
		mysqli_next_result($dbConn);
		return $rows[0]["rating"];
	}

	public function debugMsg($debugLevel,$pMsg)
	{
		if ($debugLevel == 1)
		{
			echo "$pMsg<br>";
		}
	}
}

?>
