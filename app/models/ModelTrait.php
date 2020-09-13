<?php
namespace App\Models;

trait ModelTrait {
	public static function escapeString($var) {
		return $var === null || empty($var) ? null : htmlspecialchars($var);
	}
	public static function escapeInt($var) {
		return $var === null || empty($var) ?  null : (int)$var;
	}
	public static function escapeDouble($var) {
		return $var === null || empty($var) ?  null : (double)$var;
	}
	public static function escapeDate($var) {
		return $var === null || empty($var) ? null : date('Y-m-d', strtotime($var));
	}
	public static function escapeDatetime($var) {
		return $var === null || empty($var) ? null : date('Y-m-d H:i:s', strtotime($var));
	}

	public static $fb = null;
	public static function getFb() {
		if(self::$fb === null)
			self::$fb = new \Facebook\Facebook([
			  'app_id' => FB_APP_ID,
			  'app_secret' => FB_APP_SECRET,
			  'default_graph_version' => 'v2.10',
			  'default_access_token' => FB_APP_ACCESS_TOKEN, // optional
			]);
		return self::$fb;
	}

	public static function orderBy($order_by) {
		switch($order_by) {
			case 'id':
				return 'id';
			case 'created_at':
				return 'created_at';
			case 'updated_at':
				return 'updated_at';
			case 'orderby':
				return 'orderby';
			default:
				return htmlspecialchars($order_by);
		}
	}

	public static function desc($desc) {
		return $desc ? 'DESC' : 'ASC';
	}

	public static function limit($limit_total, $lim_from) {
		$query = '';
		$limit_total = (int)$limit_total;
		$lim_from = (int)$lim_from;
		if($limit_total > -1 || $lim_from > -1)
			$query .= ' LIMIT';
		if($lim_from != -1) {
			$query .= ' ' . $lim_from;
			if($limit_total != -1)
				$query .= ', ' . $limit_total;
		} else if($limit_total != -1)
			$query .= ' ' . $limit_total;
		return $query;
	}
}