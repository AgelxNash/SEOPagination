Update to Laravel 5.2 by Daguilarm
====================

Just a symple update to this great package.

Laravel SEO Pagination
====================
This extension pack pagination laravel. With it, you can prevent the opening of blank pages.
For example, in your pagination has only 10 pages, but the user has requested page with number 101. With this extension pack, user redirected to the last (10) or first page... or send 404 error.

And most importantly, paginator now contains no reference to the first page with the GET variable.
### Old
```
http://example.com/news?page=1
http://example.com/news?page=2
http://example.com/news?page=3
...
etc.
```
### New
```
http://example.com/news
http://example.com/news?page=2
http://example.com/news?page=3
...
etc.
```

Installation
============
### Step 1

Add to your composer file:

```
"repositories": [
    {
        "url": "https://github.com/daguilarm/SEOPagination.git",
        "type": "vcs"
    }
],
```
-------------

And this in your `require:

```
"agelxnash/seopagination": "dev-laravel-5.2"
```
-------------
### Step 2
Once SEOPagination is installed you need to register the service provider with the application. Open up `config/app.php` and replace `Illuminate\Pagination\PaginationServiceProvider` the providers key to 
```
AgelxNash\SEOPagination\PaginationServiceProvider::class
```


Configuration
=============
You will want to run the following command to publish the config to your application, otherwise it will be overwritten when the package is updated.
```shell
php artisan vendor:publish --provider="AgelxNash\SEOPagination\PaginationServiceProvider"
```

Now you can edit the file `config/seo-pagination.php`
### action_on_error
* **first** (*Send redirect to first pagination page with error_status response status code*)
* **out** (*Send redirect to end pagination page with error_status response status code*)
* **abort** (*Return 404 error. Not use error_status*)

### error_status
**Any response status code**. For example - 307 (*default*) or 301

Usage
======
Add the trait to your model
```php
use Illuminate\Database\Eloquent\Model;

Class Post extends Model{
	use \AgelxNash\SEOPagination\Eloquent\ReplaceBuilder
}
```
After the call paginate() method, you can check data variable in the method `checkPaginate()`. The result will be object `\Illuminate\Http\RedirectResponse` or `true`
Look at the example method of a controller with check pagination:
```php
public function example()
{
	$posts = Post::->orderBy('created_at', 'DESC')->paginate(10);
	if(($out = $posts->checkPaginate()) === true){
		$out = View::make('index', array('data'=> $posts));
	}
	return $out;
}
```