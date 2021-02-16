<?php

namespace Modules\Inventory\Repositories;

use Modules\Core\Eloquent\Repository;

class InventorySourceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Inventory\Contracts\InventorySource';
    }

    /**
     * Returns channel inventory source ids.
     *
     * @return collection
     */
    public function getChannelInventorySourceIds()
    {
        static $channelInventorySourceIds;

        if ($channelInventorySourceIds) {
            return $channelInventorySourceIds;
        }

        $found = core()->getCurrentChannel()->inventory_sources()
            ->where('status', 1)
            ->pluck('id');

        return $channelInventorySourceIds = ($found ? $found : collect([]));
    }
}