<?php
	function setDatabase($dbConn, $dbname) {
		$stmt = $dbConn->query("USE " . $dbname);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getAllData($dbConn, $table) {
		$stmt = $dbConn->query("SELECT * FROM" . $table);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getColData($dbConn, $table, $col) {
		$colString = "";
		foreach ($col as $key => $value) {
			if($key == $numCols) {
				$colString += $value;
			}
			else {
				$colString += $value . ', ';
			}
		}
		$stmt = $dbConn->query("SELECT " . $colString . " FROM " . $table);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getRowData($dbConn, $table, $col, $condition, $limit) {
		$colString = "";
		$numCols = $count($col);
		foreach ($col as $key => $value) {
			if($key == $numCols) {
				$colString += $value;
			}
			else {
				$colString += $value . ', ';
			}
		}
		$stmt = $dbConn->query("SELECT " . $colString . " FROM " . $table . " WHERE " . $condition . " LIMIT " . $limit);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
?>