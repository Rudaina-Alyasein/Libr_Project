<!-- <php

namespace App\Controllers;

require 'vendor/autoload.php';

use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;

class QRController {
    public function generateQR() {
        $url = 'http://localhost:8080/home';

        $renderer = new Png();
        $renderer->setHeight(300);
        $renderer->setWidth(300);
        $writer = new Writer($renderer);
        $qrCode = QrCode::encode($url);
        
        $qrImagePath = '/assets/qr_codes/your_page_qr.png';

        file_put_contents($qrImagePath, $writer->write($qrCode));

        
        
        echo view('/UserInterface/header');
        echo '<img src="' . $qrImagePath . '" alt="QR Code for Your Page">';
        echo view('/UserInterface/home');
        echo view('/UserInterface/footer');
    }
}

$qrController = new QRController();
$qrController->generateQR();


 -->



<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use BaconQrCode\Encoder\QrCode;
use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;

class QRController extends CI_Controller {

    public function generateQR() {
        // العنوان URL للصفحة الكاملة التي تريد إنشاء رمز QR لها
        $url = '/home';

        // توليد الرمز QR
        $renderer = new Png();
        $renderer->setHeight(300);
        $renderer->setWidth(300);
        $writer = new Writer($renderer);
        $qrCode = QrCode::encode($url);

        // تحديد مكان حفظ ملف الصورة لرمز QR
        $qrImagePath = '/assets/qr_codes';

        // حفظ الرمز QR كملف صورة
        file_put_contents($qrImagePath, $writer->write($qrCode));

        // إرسال بيانات الصورة للعرض في الـ View
        $data['qrImagePath'] = $qrImagePath;

        // تحميل الـ View وإرسال البيانات
        $this->load->view('/UserInterface/home', $data);
        // echo view('/UserInterface/header');
        // echo '<img src="' . $qrImagePath . '" alt="QR Code for Your Page">';
        // echo view('/UserInterface/home');
        // echo view('/UserInterface/footer');
    }

}


