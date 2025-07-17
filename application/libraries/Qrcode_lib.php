<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class Qrcode_lib {

    public function generate($data, $filename, $path = './public/assets/qrcode/')
    {
        $writer = new PngWriter();

        $qr = QrCode::create($data)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->setSize(300)
            ->setMargin(10);

        $result = $writer->write($qr);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $result->saveToFile($path . $filename);

        return $filename;
    }
}
