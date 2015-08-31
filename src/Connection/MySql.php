<?php namespace AgelxNash\SEOPagination\Connection;

use AgelxNash\SEOPagination\Query\ReplaceBuilder;

class MySql extends \Illuminate\Database\MySqlConnection{
	use ReplaceBuilder;
}