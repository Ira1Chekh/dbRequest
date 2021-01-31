<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 */
class Order extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    const NEW_ORDER = 1;
    const WAITING_FOR_CALL = 2;
    const IN_PROGRESS = 3;
    const ORDER_DONE = 4;

    /**
     * @param $query
     * @param string $date
     * @return mixed
     */
    public function scopeFilterByDate($query, $date)
    {
        return $query->where('created', '<=', date('Y-m-d', strtotime($date)));
    }

    /**
     * @param $query
     * @param int $offset
     * @param int $limit
     * @return mixed
     */
    public function scopeSetOffsetAndLimit($query, $offset, $limit)
    {
        return $query->offset($offset)
        ->limit($limit);
    }
}
