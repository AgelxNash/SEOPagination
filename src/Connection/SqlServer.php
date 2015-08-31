<?php namespace AgelxNash\SEOPagination\Connection;

use AgelxNash\SEOPagination\Query\ReplaceBuilder;

class SqlServer extends \Illuminate\Database\SqlServerConnection{
	use ReplaceBuilder;
}