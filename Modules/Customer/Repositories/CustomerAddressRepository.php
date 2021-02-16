<?php

namespace Modules\Customer\Repositories;

use Modules\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Event;

class CustomerAddressRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Modules\Customer\Contracts\CustomerAddress';
    }

    /**
     * @param  array  $data
     * @return \Modules\Customer\Contracts\CustomerAddress
     */
    public function create(array $data)
    {
        Event::dispatch('customer.addresses.create.before');

        $data['default_address'] = isset($data['default_address']) ? 1 : 0;

        $default_address = $this
            ->findWhere(['customer_id' => $data['customer_id'], 'default_address' => 1])
            ->first();

        if (isset($default_address->id) && $data['default_address']) {
            $default_address->update(['default_address' => 0]);
        }

        $address = $this->model->create($data);

        Event::dispatch('customer.addresses.create.after', $address);

        return $address;
    }

    /**
     * @param  array  $data
     * @param  int  $id
     * @return \Modules\Customer\Contracts\CustomerAddress
     */
    public function update(array $data, $id)
    {
        $address = $this->find($id);

        Event::dispatch('customer.addresses.update.before', $id);

        $data['default_address'] = isset($data['default_address']) ? 1 : 0;

        $default_address = $this
            ->findWhere(['customer_id' => $address->customer_id, 'default_address' => 1])
            ->first();

        if (isset($default_address->id) && $data['default_address']) {
            if ($default_address->id != $address->id) {
                $default_address->update(['default_address' => 0]);
            }
            
            $address->update($data);
        } else {
            $address->update($data);
        }

        Event::dispatch('customer.addresses.update.after', $id);

        return $address;
    }
}