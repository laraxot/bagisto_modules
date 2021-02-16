<?php

namespace Modules\Tax\Repositories;

use Modules\Core\Eloquent\Repository;

class TaxCategoryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\Tax\Contracts\TaxCategory';
    }

    /**
     * @param  \Modules\Tax\Contracts\TaxCategory  $taxCategory
     * @param  array  $data
     * @return bool
     */
    public function attachOrDetach($taxCategory, $data)
    {
        $taxRates = $taxCategory->tax_rates;

        $this->model->findOrFail($taxCategory->id)->tax_rates()->sync($data);

        return true;
    }
}