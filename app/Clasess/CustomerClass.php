<?php
 
namespace App\Clasess;

use Illuminate\Http\Request;
use App\Models\MCustomer;

class CustomerClass {
    public function getCustomer($paginate)
    {
        $cust                   = MCustomer::orderBy('id', 'desc');
        if($paginate > 0){
            return $cust->paginate($paginate);
        }else{
            return $cust->get();
        }
    }
    public function store(Request $request)
    {
        $cust                   = new MCustomer;

        $cust->first_name       = $request->first_name;
        $cust->last_name        = $request->last_name;
        $cust->dob              = $request->dob;
        $cust->gender           = $request->gender;
        $cust->phone_number     = $request->phone_number;
        $cust->email_address    = $request->email_address;
        $cust->company_name     = $request->company_name;
        
        $cust->save();

        return $cust;
    }
    public function findCustomerById($id)
    {
        return MCustomer::find($id);
    }
    public function update(Request $request, $id)
    {
        $cust                   = MCustomer::find($id);

        $cust->first_name       = $request->first_name;
        $cust->last_name        = $request->last_name;
        $cust->dob              = $request->dob;
        $cust->gender           = $request->gender;
        $cust->phone_number     = $request->phone_number;
        $cust->email_address    = $request->email_address;
        $cust->company_name     = $request->company_name;
        
        $cust->save();

        return $cust;
    }
}