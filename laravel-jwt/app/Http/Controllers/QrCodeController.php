<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generateQR(Request $request)
    {
        $data = $request->input('data'); // Ambil data untuk dimasukkan ke dalam QR code
        $qrCode = QrCode::format('png')->size(200)->generate($data); // Buat QR code dari data

        // Tampilkan QR code dalam bentuk image
        return response($qrCode)->header('Content-type', 'image/png');
    }
}
