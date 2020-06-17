<?php
namespace App\Services\Impl;

use App\Repositories\CustomerRepository;
use App\Services\CustomerService;

class CustomerServiceImpl implements CustomerService
{
    protected $customerRepository;


    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAll()
    {
        $data = $this->customerRepository->getAll();

        return $data;
    }

    public function findById($id)
    {
        $data = $this->customerRepository->findById($id);

        $status = 200;
        if (!$data)
            $status = 404;

            $data = [
                'status' => $status,
                'data' => $data
            ];

        return $data;
    }

    public function create($request)
    {
        $data = $this->customerRepository->create($request);

        $status = 201;
        if (!$data)
            $status = 500;

        $data = [
            'status' => $status,
            'data' => $data
        ];

        return $data;
    }

    public function update($request, $id)
    {
        $oldCustomer = $this->customerRepository->findById($id);

        if (!$oldCustomer) {
            $newCustomer = null;
            $status = 404;
        } else {
            $newCustomer = $this->customerRepository->update($request, $oldCustomer);
            $status = 200;
        }

        $data = [
            'status' => $status,
            'data' => $newCustomer
        ];
        return $data;
    }

    public function destroy($id)
    {
        $data = $this->customerRepository->findById($id);

        $status = 404;
        $msg = "User not found";
        if ($data) {
            $this->customerRepository->destroy($data);
            $status = 200;
            $msg = "Delete success!";
        }

        $data = [
            'status' => $status,
            'msg' => $msg
        ];
        return $data;
    }
}
