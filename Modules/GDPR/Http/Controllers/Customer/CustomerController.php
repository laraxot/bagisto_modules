<?php

namespace Modules\GDPR\Http\Controllers\Customer;

use Illuminate\Support\Facades\Mail;
use Modules\GDPR\Repositories\GDPRDataRequestRepository;
use Modules\Customer\Repositories\CustomerAddressRepository;
use Modules\GDPR\Mail\DataUpdateRequestMail;
use Modules\GDPR\Mail\DataDeleteRequestMail;
use Modules\Sales\Repositories\OrderRepository;
use Modules\GDPR\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use DB;

class CustomerController extends Controller
{
     /**
     * GDPRDataRequestRepository object
     *
     * @var object
     */
    protected $gdprDataRequestRepository;


     /**
     * CustomerAddressRepository object
     *
     * @var object
     */
    protected $customerAddressRepository;


    /**
     * OrderRepository object
     *
     * @var object
     */
    protected $orderRepository;

    protected $_config;

    public function __construct(
             GDPRDataRequestRepository $gdprDataRequestRepository,
             OrderRepository $orderRepository,
             CustomerAddressRepository $customerAddressRepository)
    {
        
        $this->middleware('customer');

        $this->_config = request('_config');

        $this->gdprDataRequestRepository = $gdprDataRequestRepository;
        $this->orderRepository = $orderRepository;
        $this->customerAddressRepository = $customerAddressRepository;
        
        
    }

    public function index()
    {
        $customer = auth()->guard('customer')->user();
       
        return view($this->_config['view']);
    }

    public function store()
    {  
        $customer = auth()->guard('customer')->user();
        $request_type = request()->request_type;
        
        if ($request_type == 'Update')
        {
            $params = request()->all() + [
                'request_status'=>"Pending",
                'customer_id'=>$customer->id,
                'email'=>$customer->email,
                'message'=>request()->update_message
            ];

            unset($params['update_message']);

        }else {
            $params = request()->all() + [
                'request_status'=>"Pending",
                'customer_id'=>$customer->id,
                'email'=>$customer->email,
                'message'=>request()->delete_message
            ];

            unset($params['delete_message']);
        }
     
        $data = $this->gdprDataRequestRepository->create($params);
        if ($data) {
            if($params['request_type'] == 'Update')
            {
                try{
                        Mail::queue(new DataUpdateRequestMail($params));
                        session()->flash('success', trans('gdpr::app.shop.customer-gdpr-data-request.success-verify'));
                 }catch (\Exception $e) {
                        session()->flash('info', trans('gdpr::app.shop.customer-gdpr-data-request.success-verify-email-unsent'));
                }
                return redirect()->route($this->_config['redirect']);
            }else{

                try{
                    Mail::queue(new DataDeleteRequestMail($params));
                    session()->flash('success', trans('gdpr::app.shop.customer-gdpr-data-request.success-verify'));
                }catch (\Exception $e) {
                    session()->flash('info', trans('gdpr::app.shop.customer-gdpr-data-request.success-verify-email-unsent'));
                }
                return redirect()->route($this->_config['redirect']);
            }
            
        }else{
            session()->flash('error', trans('gdpr::app.shop.customer-gdpr-data-request.unable-to-sent'));

            return redirect()->route($this->_config['redirect']);
        }
    }

    public function pdfview()
    {

        $customer = auth()->guard('customer')->user();
        try{
            $orders = $this->orderRepository->where('customer_id',$customer->id)->get();
            $address = $this->customerAddressRepository->where('customer_id',$customer->id)->get();
            $params = ['customerInformation'=>$customer,
                    'order'=>$orders,
                    'address'=>$address];

            foreach ($params['order'] as $value) {
                $orderData[] = $value;   
            }

            foreach ($params['address'] as $value) {
                $addressData[] = $value;   
            }

            if(!empty($orderData) && !empty($addressData)) {
                $param = ['order' => $orderData,
                    'address' => $addressData,
                    'customerInformation' => $customer];

            } else if(empty($orderData)) {
                $param = ['address' => $addressData,
                    'customerInformation' => $customer];
            } else {
                $param = ['order' => $orderData,
                    'customerInformation' => $customer];
            }

        }catch(\Exception $e){

        $param = ['customerInformation'=>$customer];
        }
        
        $orientation = 'landscape';
        $customPaper = array(0,0,950,950);

        $pdf = PDF::loadView('gdpr::shop.customers.gdpr.pdfview', compact('param'));

        return $pdf->download('customerInfo'.'.pdf');
    }

    public function htmlview()
    {
        
        $customer = auth()->guard('customer')->user();
        try{
            $orders = $this->orderRepository->where('customer_id',$customer->id)->get();
            $address = $this->customerAddressRepository->where('customer_id',$customer->id)->get();
            $params = ['customerInformation'=>$customer,
                    'order'=>$orders,
                    'address'=>$address];

            foreach ($params['order'] as $value) {
                $orderData[] = $value;   
            }

            foreach ($params['address'] as $value) {
                $addressData[] = $value;   
            }

            if(!empty($orderData) && !empty($addressData)) {
                $param = ['order' => $orderData,
                    'address' => $addressData,
                    'customerInformation' => $customer];

            } else if(empty($orderData)) {
                $param = ['address' => $addressData,
                    'customerInformation' => $customer];
            } else {
                $param = ['order' => $orderData,
                    'customerInformation' => $customer];
            }

        }catch(\Exception $e){

        $param = ['customerInformation'=>$customer];
        }

        return view($this->_config['view'],compact('param'));
    }
}
