<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Billing
{

    public function getIndianCurrency(float $number)
    {
        $decimal       = round($number - ($no = floor($number)), 2) * 100;
        $hundred       = null;
        $digits_length = strlen($no);
        $i             = 0;
        $str           = array();
        $words         = array(0 => '', 1          => 'One', 2        => 'Two',
            3                        => 'Three', 4     => 'Four', 5       => 'Five', 6 => 'Six',
            7                        => 'Seven', 8     => 'Eight', 9      => 'Nine',
            10                       => 'Ten', 11      => 'Eleven', 12    => 'Twelve',
            13                       => 'Thirteen', 14 => 'Fourteen', 15  => 'Fifteen',
            16                       => 'Sixteen', 17  => 'Seventeen', 18 => 'Eighteen',
            19                       => 'Nineteen', 20 => 'Twenty', 30    => 'Thirty',
            40                       => 'Forty', 50    => 'Fifty', 60     => 'Sixty',
            70                       => 'Seventy', 80  => 'Eighty', 90    => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = (2 == $i) ? 10 : 100;
            $number  = floor($no % $divider);
            $no      = floor($no / $divider);
            $i += 10 == $divider ? 1 : 2;
            if ($number) {
                $plural  = (($counter = count($str)) && $number > 9) ? null : null;
                $hundred = (1 == $counter && $str[0]) ? ' And ' : null;
                $str[]   = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else {
                $str[] = null;
            }

        }
        $Rupees = implode('', array_reverse($str));
        $paise  = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . ' only';
    }

    public function getnetamount($amount, $percent)
    {
        $gst_amount  = $amount - ($amount * (100 / (100 + $percent)));
        $percentcgst = number_format($gst_amount / 2, 2);
        $percentsgst = number_format($gst_amount / 2, 2);

        $withoutgst = number_format($amount - $gst_amount, 2, '.', '');
        return $withoutgst;
    }

    public function getSGST($amount, $percent)
    {
        $gst_amount  = $amount - ($amount * (100 / (100 + $percent)));
        $percentcgst = number_format($gst_amount / 2, 2, '.', '');
        $percentsgst = number_format($gst_amount / 2, 2, '.', '');
        return $percentsgst;

    }

    public function getGST($amount, $percent)
    {
        $gst_amount  = $amount - ($amount * (100 / (100 + $percent)));
        $percentcgst = number_format($gst_amount, 2, '.', '');
        return $percentcgst;

    }

    public function simplegstexcluded($amount, $percent)
    {
        $gst_amount  = ($amount * $percent) / 100;
        $total       = number_format($amount + $gst_amount, 2);
        $percentcgst = number_format($gst_amount / 2, 3);
        $percentsgst = number_format($gst_amount / 2, 3);
        return number_format($percentcgst,2, '.', '');
    }

    public function getgstamount($amount, $percent)
    {
        if($amount!=0 && $percent!=0)
        {
        $amount=number_format($amount,2, '.', '');

        $gst_amount  = ($amount * $percent) / 100;
        $totalamt=$amount+$gst_amount;
        return  number_format($totalamt,2, '.', '');
        }
        else
        {
            return 0;

        }
    }
    public function getdiscamount($amount, $percent)
    {
        $gst_amount  = ($amount * $percent) / 100;
        return number_format($gst_amount,2, '.', '');
    }

}
