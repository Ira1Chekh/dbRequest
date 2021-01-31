<?php


namespace App\Services;

use App\Order;

/**
 * Class OrdersService
 * @package App\Services
 */
class OrdersService
{
    const END_DATE_TIME = '23:59:59';

    /**
     * @param array|null $data
     * @return mixed
     */
    public function getOrdersUnion(?array $data)
    {
        return $this->getWaitingForCallEarlierThanToday($data)
            ->union($this->getNewOrders($data))
            ->union($this->getWaitingForCallLaterThanToday($data))
            ->union($this->getInProgress($data))
            ->union($this->getDoneOrders($data))
            ->get();
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    public function getOrdersUnionAll(?array $data)
    {
        return $this->getWaitingForCallEarlierThanToday($data)
            ->unionAll($this->getNewOrders($data))
            ->unionAll($this->getWaitingForCallLaterThanToday($data))
            ->unionAll($this->getInProgress($data))
            ->unionAll($this->getDoneOrders($data))
            ->get();
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    private function getWaitingForCallEarlierThanToday(?array $data)
    {
        return Order::where('status', Order::WAITING_FOR_CALL)
            ->where('created', '<=', date('Y-m-d ' . self::END_DATE_TIME, time()))
            ->when(isset($data['date']), function ($query) use ($data) {
                return $query->filterByDate($data['date']);
            })
            ->when(isset($data['offset']) && isset($data['limit']), function ($query) use ($data) {
                return $query->setOffsetAndLimit($data['offset'], $data['limit']);
            })
            ->orderBy('call_date');
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    private function getNewOrders(?array $data)
    {
        return Order::where('status', Order::NEW_ORDER)
            ->when(isset($data['date']), function ($query) use ($data) {
                return $query->filterByDate($data['date']);
            })
            ->when(isset($data['offset']) && isset($data['limit']), function ($query) use ($data) {
                return $query->setOffsetAndLimit($data['offset'], $data['limit']);
            })
            ->orderBy('created', 'DESC');
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    private function getWaitingForCallLaterThanToday(?array $data)
    {
        return Order::where('status', Order::WAITING_FOR_CALL)
            ->where('created', '>', date('Y-m-d ' . self::END_DATE_TIME, time()))
            ->when(isset($data['date']), function ($query) use ($data) {
                return $query->filterByDate($data['date']);
            })
            ->when(isset($data['offset']) && isset($data['limit']), function ($query) use ($data) {
                return $query->setOffsetAndLimit($data['offset'], $data['limit']);
            })
            ->orderBy('call_date');
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    private function getInProgress(?array $data)
    {
        return Order::where('status', Order::IN_PROGRESS)
            ->when(isset($data['date']), function ($query) use ($data) {
                return $query->filterByDate($data['date']);
            })
            ->when(isset($data['offset']) && isset($data['limit']), function ($query) use ($data) {
                return $query->setOffsetAndLimit($data['offset'], $data['limit']);
            })
            ->orderBy('created');
    }

    /**
     * @param array|null $data
     * @return mixed
     */
    private function getDoneOrders(?array $data)
    {
        return Order::where('status', Order::ORDER_DONE)
            ->when(isset($data['date']), function ($query) use ($data) {
                return $query->filterByDate($data['date']);
            })
            ->when(isset($data['offset']) && isset($data['limit']), function ($query) use ($data) {
                return $query->setOffsetAndLimit($data['offset'], $data['limit']);
            })
            ->orderBy('created', 'DESC');
    }
}
