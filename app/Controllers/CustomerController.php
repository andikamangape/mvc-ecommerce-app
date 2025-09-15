<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(): void
    {
        // ambil data via model
        $customers = Customer::all();

        // panggil view dan kirim data
        $this->view('customers/index', ['customers' => $customers]);
    }
}
