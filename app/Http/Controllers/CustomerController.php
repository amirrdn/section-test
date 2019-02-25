<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MCustomer;
use App\Clasess\CustomerClass;

use PDF;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->customer         = new CustomerClass;
    }
    public function index()
    {
        $cust                   = $this->customer->getCustomer(10);
        return view('customer.index', compact('cust'));
    }
    public function create()
    {
        $gender                   = 0;
        return view('customer.add', compact('gender'));
    }
    public function store(Request $request)
    {
        $cust                   = $this->customer->store($request);

        $request->session()->flash('alert-success', 'was successful insert!');
		return redirect()->route('indexcust');
    }
    public function edit($id)
    {
        $cust                   = $this->customer->findCustomerById($id);
        $gender                 = $cust->gender;
        return view('customer.edit', compact('cust', 'gender'));
    }
    public function update(Request $request, $id)
    {
        $cust                   = $this->customer->update($request, $id);

        $request->session()->flash('alert-success', 'was successful update!');
		return redirect()->route('indexcust');
    }
    public function delete(Request $request, $id)
    {
        $cust                   = MCustomer::FindOrFail($id);
        $cust->delete();

        $request->session()->flash('alert-success', 'was successful delete!');
		return redirect()->route('indexcust');
    }
    public function Prints(Request $request)
	{

        $so			                    = $this->customer->getCustomer(0);
		
		
		
		$col_first_name			        = "";
		$col_last_name		            = "";
		$col_dob				        = "";
		$col_gender			            = "";
		$col_phone			            = "";
		$col_email_address			    = "";
		$col_companies			        = "";
		$col_no			                = "";
		$n					            = 0;
		foreach($so as $so_d){
            $n++;
			$first_name		            = $so_d->first_name;
			$last_name		            = $so_d->last_name;
            $dob    		            = $so_d->dob;
            if($so_d->gender == 1){
                $gender                 = 'Man';
            }else{
                $gender                 = 'Women';
            }
			$phone      	            = $so_d->phone_number;
			$email_address	            = $so_d->email_address;
            $companies		            = $so_d->company_name;
            
            $col_first_name 		    = $col_first_name.$first_name.' '.$last_name."\n";
			
			$col_dob	 	            = $col_dob.$dob."\n";
			$col_gender 	            = $col_gender.$gender."\n";
			$col_phone 	                = $col_phone.$phone."\n";
			$col_email_address 	        = $col_email_address.$email_address."\n";
			$col_companies 	            = $col_companies.$so_d->company_name."\n";
			$col_no		 	            = $col_no.$n."\n";
		}
		
		
		PDF::SetHeaderMargin(5);
		PDF::SetFooterMargin(18);
		PDF::setMargins(10,10,40);
        PDF::SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
		PDF::AddPage();
        PDF::SetTitle('Data Customer');
        PDF::SetFont('Times','','14');
        PDF::Cell(80);
        PDF::Cell(20,10,'Data Customer',0,1,'C');
		PDF::ln();
		
        PDF::SetX(2);
        PDF::SetFont('Times','','10');
		PDF::setFillColor(230,230,230);
		PDF::Cell(10,10.5,'No.',1,0,'C',1);
		PDF::Cell(30,10.5,'Name ',1,0,'L',1);
		PDF::Cell(25,10.5,'DOB',1,0,'L',1);
		PDF::Cell(30,10.5,'Gender',1,0,'L',1);
		PDF::Cell(30,10.5,'Phone',1,0,'L',1);
		PDF::Cell(40,10.5,'Email',1,0,'L',1);
		PDF::Cell(40,10.5,'Company',1,0,'L',1);
		
		PDF::ln();
		
        PDF::SetX(2);
        PDF::MultiCell(10, 10, $col_no, 1, 'C', 0, 0, '', '', true, 0, false, true, 0);
		PDF::MultiCell(30, 10, $col_first_name, 1, 'L', 0, 0, '', '', true, 0, false, true, 0);
		PDF::MultiCell(25, 10, $col_dob, 1, 'L', 0, 0, '', '', true, 0, false, true, 0);
		PDF::MultiCell(30, 10, $col_gender , 1, 'L', 0, 0, '', '', true, 0, false, true, 0);
		PDF::MultiCell(30, 10, $col_phone, 1, 'L', 0, 0, '', '', true, 0, false, true, 0);
		PDF::MultiCell(40, 10, $col_email_address, 1, 'L', 0, 0, '', '', true, 0, false, true, 0);
		PDF::MultiCell(40, 10, $col_companies, 1, 'L', 0, 0, '', '', true, 0, false, true, 0);
		
		
		

		
		
		PDF::Output(public_path('customer').'/'.$so_d->first_name, 'F');
		PDF::Output(''.$so_d->first_name.'.pdf', 'I');
		//return redirect()->route('details.so_views', $id);
	}
}
