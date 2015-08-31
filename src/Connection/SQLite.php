<?php namespace AgelxNash\SEOPagination\Connection;

use AgelxNash\SEOPagination\Query\ReplaceBuilder;

class SQLite extends \Illuminate\Database\SQLiteConnection{
	use ReplaceBuilder;
}