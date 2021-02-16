<?php

namespace Modules\Tax\Repositories;

use Modules\Core\Eloquent\Repository;

class TaxMapRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Tax\Contracts\TaxMap';
    }

    /**
     * @param  array  $data
     * @return \Modules\Tax\Contracts\TaxMap
     */
    public function create(array $data)
    {
        $taxMap = $this->model->create($data);

        return $taxMap;
    }

    /**
     * @param  array  $data
     * @param  int  $id
     * @param  string  $attribute
     * @return \Modules\Tax\Contracts\TaxMap
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $taxMap = $this->find($id);

        $taxMap->update($data);

        return $taxMap;
    }
}