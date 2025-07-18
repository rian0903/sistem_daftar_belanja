<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . "/third_party/phpqrcode/qrlib.php";

class Ciqrcode
{
    public function generate($params = [])
    {
        $data     = $params['data'] ?? 'QR Code';
        $level    = $params['level'] ?? 'H';
        $size     = $params['size'] ?? 10;
        $savename = $params['savename'] ?? false;

        if ($savename) {
            return QRcode::png($data, $savename, $level, $size);
        } else {
            return QRcode::png($data, false, $level, $size);
        }
    }
}
