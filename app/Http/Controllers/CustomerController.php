<?php
namespace App\Http\Controllers;

use App\Http\Requests\CrudValidation;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
      return view('customer');
    }

    public function getAll()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function show($id)
    {
        $dataCustomer = $this->customerService->findById($id);
        return response()->json(['data' => $dataCustomer], 200);
    }


    public function findById($id)
    {
        $dataCustomer = $this->customerService->findById($id);

        return response()->json($dataCustomer['data'], $dataCustomer['status']);
    }

    public function store(CrudValidation $request)
    {
        $atribute = $request->all();

        if($request->hasFile('image')){
            $image = base64_encode(file_get_contents($request->file('image')));
            $atribute['image'] = 'data:image/;base64,'.$image;
        }

        Customer::create($atribute);

       return response()->json($atribute);
    }

    public function update(CrudValidation $request, $id)
    {
        $product = Customer::findOrFail($id);
        $atribute = $request->all();

        if($request->hasFile('image')){
            // lấy file image
            $image = base64_encode(file_get_contents($request->file('image')));
            $atribute['image'] = 'data:image/;base64,'.$image; //gán thêm đuôi
        }
        $product->update($atribute);


       return response()->json($atribute);
    }

    public function destroy($id)
    {
        $dataCustomer = $this->customerService->destroy($id);

        return response()->json($dataCustomer['msg'], $dataCustomer['status']);
    }





}
