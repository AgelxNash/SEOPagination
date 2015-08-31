<?php namespace AgelxNash\SEOPagination\Connection;

use AgelxNash\SEOPagination\Query\ReplaceBuilder;

class Postgres extends \Illuminate\Database\PostgresConnection{
	use ReplaceBuilder;
}