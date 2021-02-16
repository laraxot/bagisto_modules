<?php

namespace Modules\Admin\Http\Controllers\Customer;

use Modules\Admin\Http\Controllers\Controller;
use Modules\Customer\Repositories\CustomerGroupRepository;

class CustomerGroupController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
    */
    protected $_config;

    /**
     * CustomerGroupRepository object
     *
     * @var \Modules\Customer\Repositories\CustomerGroupRepository
    */
    protected $customerGroupRepository;

     /**
     * Create a new controller instance.
     *
     * @param  \Modules\Customer\Repositories\CustomerGroupRepository  $customerGroupRepository;
     * @return void
     */
    public function __construct(CustomerGroupRepository $customerGroupRepository)
    {
        $this->_config = request('_config');

        $this->middleware('admin');

        $this->customerGroupRepository = $customerGroupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
    */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view($this->_config['view']);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'code' => ['required', 'unique:customer_groups,code', new \Modules\Core\Contracts\Validations\Code],
            'name' => 'required',
        ]);

        $data = request()->all();

        $data['is_user_defined'] = 1;

        $this->customerGroupRepository->create($data);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Customer Group']));

        return redirect()->route($this->_config['redirect']);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $group = $this->customerGroupRepository->findOrFail($id);

        return view($this->_config['view'], compact('group'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate(request(), [
            'code' => ['required', 'unique:customer_groups,code,' . $id, new \Modules\Core\Contracts\Validations\Code],
            'name' => 'required',
        ]);

        $this->customerGroupRepository->update(request()->all(), $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Customer Group']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customerGroup = $this->customerGroupRepository->findOrFail($id);

        if ($customerGroup->is_user_defined == 0) {
            session()->flash('warning', trans('admin::app.customers.customers.group-default'));
        } elseif (count($customerGroup->customers) > 0) {
            session()->flash('warning', trans('admin::app.response.customer-associate', ['name' => 'Customer Group']));
        } else {
            try {
                $this->customerGroupRepository->delete($id);

                session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Customer Group']));

                return response()->json(['message' => true], 200);
            } catch(\Exception $e) {
                session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Customer Group']));
            }
        }

        return response()->json(['message' => false], 400);
    }
}