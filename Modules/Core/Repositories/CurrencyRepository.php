<?php

namespace Modules\Core\Repositories;

use Modules\Core\Eloquent\Repository;
use Prettus\Repository\Traits\CacheableRepository;

class CurrencyRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Core\Contracts\Currency';
    }

    /**
     * Specify Model class name
     *
     * @param  int  $id
     * @return bool
     */
    public function delete($id) {
        if ($this->model->count() == 1) {
            return false;
        } else {
            if ($this->model->destroy($id)) {
                return true;
            } else {
                return false;
            }
        }
    }
}