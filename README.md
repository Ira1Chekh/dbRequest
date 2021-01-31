# Laravel 7.3 dbRequest

## Notes

The task was implemented using MySql, the methods 'union' and 'union all'. 
The results are the same for 'union' and 'union all', but 'union all' usually is faster, because this method does not remove duplicates.
Using subqueries is not suitable for solving the issue, because sorting won't work inside them.

## Installation

* Clone the repository with git clone
* Run composer install
* Run php artisan key:generate
* Run php artisan migrate
* Run php artisan db:seed --class=OrdersTableSeeder
* launch the main URL, test date and limit, offset filter by adding query parameters named date, offset, limit



