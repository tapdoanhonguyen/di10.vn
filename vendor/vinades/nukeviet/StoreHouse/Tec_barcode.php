<?php
namespace NukeViet\StoreHouse;
use NukeViet\StoreHouse\Barcode;

class Tec_barcode
{
    public function __construct() {
    	
    }

    public function __get($var) {
    }

    public function generate($text, $bcs = 'Code128', $height = 50, $drawText = true, $get_be = false, $re = false) {
        // Barcode::setBarcodeFont('my_font.ttf');
        $check = $this->prepareForChecksum($text, $bcs);
        $barcodeOptions = ['text' => $check['text'], 'barHeight' => $height, 'drawText' => $drawText, 'withChecksum' => $check['checksum'], 'withChecksumInText' => $check['checksum']]; //'fontSize' => 12, 'factor' => 1.5,
        //print_r($this->$this->Settings->barcode_img);die;
        if (true) {
            $rendererOptions = ['imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle'];
            if ($re) {
                Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);
                exit;
            }
            $imageResource = Barcode::draw($bcs, 'image', $barcodeOptions, $rendererOptions);
            ob_start();
            imagepng($imageResource);
            $imagedata = ob_get_contents();
            ob_end_clean();
            if ($get_be) {
                return 'data:image/png;base64,'.base64_encode($imagedata);
            }
            return "<img src='data:image/png;base64,".base64_encode($imagedata)."' alt='{$text}' class='bcimg' />";
        } else {
            $rendererOptions = ['renderer' => 'svg', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle'];
            if ($re) {
                Barcode::render($bcs, 'svg', $barcodeOptions, $rendererOptions);
                exit;
            }
            ob_start();
            Barcode::render($bcs, 'svg', $barcodeOptions, $rendererOptions);
            $imagedata = ob_get_contents();
            ob_end_clean();
            if ($get_be) {
                return 'data:image/svg+xml;base64,'.base64_encode($imagedata);
            }
            return "<img src='data:image/svg+xml;base64,".base64_encode($imagedata)."' alt='{$text}' class='bcimg' />";
        }
        return false;
    }

    protected function prepareForChecksum($text, $bcs) {
        if ($bcs == 'Code25' || $bcs == 'Code39') {
            return ['text' => $text, 'checksum' => false];
        } elseif ($bcs == 'Code128') {
            return ['text' => $text, 'checksum' => true];
        }
        return ['text' => substr($text, 0, -1), 'checksum' => true];
    }
}
