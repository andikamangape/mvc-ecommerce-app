<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(): void
    {
        // Ambil data via model
        $customers = Customer::all();

        // Panggil view dan kirim data
        $this->view('customers/index', ['customers' => $customers]);
    }

    public function create(): void
    {
        // Tampilkan form tambah user
        $this->view('customers/create');
    }

    public function store(): void
    {
        // Simpan data dari form
        Customer::create(
            $_POST['full_name'],
            $_POST['email'],
            $_POST['phone'] ?? '',
            $_POST['country'] ?? ''
        );

        // Redirect ke halaman daftar customer
        header('Location: /index.php?url=customer/index');
        exit;
    }
}
