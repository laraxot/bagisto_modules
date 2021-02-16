<?php

namespace Modules\Sales\Repositories;

use Modules\Core\Eloquent\Repository;
use Modules\Sales\Contracts\OrderComment;

class OrderCommentRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return OrderComment::class;
    }
}
