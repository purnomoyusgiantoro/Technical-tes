<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\technical_test_orders;

class technical_test_orders_controller
{
    public function showform()
    {
        return view('import');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required']);

        $file = $request->file('file');
        $buka_file = fopen($file->path(), 'r');

        $berhasil = 0;
        $gagal = 0;
        $pesan_gagal = [];
        $baris = 1;

        while (($data = fgetcsv($buka_file, 1000, ',')) !== false) {
            if ($baris == 1) {
                $baris++;
                continue; 
            }
            $order_number = $data[0];
            $sku = $data[1];
            $qty = (int)$data[2];
            $price = (float)$data[3];

            if ($order_number == '') {
                $gagal++;
                $pesan_gagal[] = "Baris $baris - Order Number wajib diisi.";
            } 
            elseif ($sku == '') {
                $gagal++;
                $pesan_gagal[] = "Baris $baris - SKU wajib diisi.";
            } 
            elseif ($qty <= 0) {
                $gagal++;
                $pesan_gagal[] = "Baris $baris - Qty harus lebih besar dari 0.";
            } 
            elseif ($price < 0) {
                $gagal++;
                $pesan_gagal[] = "Baris $baris - Price tidak boleh negatif.";
            } 
            else {
                $cek_duplikat = technical_test_orders::where('order_number', $order_number)->first();
                
                if ($cek_duplikat) {
                    $gagal++;
                    $pesan_gagal[] = "Baris $baris - Order Number sudah ada (duplikat).";
                } else {
                    technical_test_orders::create([
                        'order_number' => $order_number,
                        'sku' => $sku,
                        'qty' => $qty,
                        'price' => $price,
                    ]);
                    $berhasil++;
                }
            }

            $baris++;
        }
        
        fclose($buka_file);

        return back()->with([
            'success' => $berhasil,
            'failed' => $gagal,
            'pesan_gagal' => $pesan_gagal
        ]);
    }

    public function index()
    {
        $orders = technical_test_orders::all();
        return view('index', compact('orders'));
    }
}
