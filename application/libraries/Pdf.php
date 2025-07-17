<?php
use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf {
    protected $dompdf;

    public function __construct() {
        require_once APPPATH . '../vendor/autoload.php';

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $this->dompdf = new Dompdf($options);
    }

    public function load_view($view, $data = [], $paper = 'A4', $orientation = 'portrait') {
        $ci = &get_instance();
        $html = $ci->load->view($view, $data, TRUE);
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paper, $orientation);
        $this->dompdf->render();
        $this->dompdf->stream("laporan-transaksi.pdf", array("Attachment" => 0));
    }
}
