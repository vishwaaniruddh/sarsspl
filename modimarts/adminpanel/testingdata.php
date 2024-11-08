<?php
session_start();
include 'config.php';

$json = file_get_contents('php://input');
$obj  = json_decode($json, true);
$obj['CheckStatusResponse'];
if (isset($obj['CheckStatusResponse'])) {
    $item_id = $obj['itemid'];
    $result  = mysqli_query($con1, "SELECT * FROM `order_shipping` Where item_id='" . $item_id . "' ") or die(mysqli_error($con1));
    $numrows = mysqli_num_rows($result);
    if ($numrows) {
        $ShippingData = mysqli_fetch_assoc($result);

        $item_id               = $ShippingData['item_id'];
        $channel_id            = $ShippingData['channel_id'];
        $shipment_id           = $ShippingData['shipment_id'];
        $order_ids             = $ShippingData['order_ids'];
        $awb_code              = $ShippingData['awb_code'];
        $sendOrderShipRocket   = $ShippingData['sendOrderShipRocket'];
        $sendOrderToShipRocket = $ShippingData['sendOrderToShipRocket'];
        $generate_awb          = $ShippingData['generate_awb'];
        $generate_pickup       = $ShippingData['generate_pickup'];
        $generateManifest      = $ShippingData['generateManifest'];
        $printManifest         = $ShippingData['printManifest'];
        $generateLabel         = $ShippingData['generateLabel'];
        $printInvoice          = $ShippingData['printInvoice'];
        $gettrackdetails       = $ShippingData['gettrackdetails'];
        $courier_list       = $ShippingData['courier_list'];

        // json decoded data
        $ordersjs = json_decode($sendOrderShipRocket);
        // $_ordersjs=$ordersjs->data[0]->status_code;

        $ordertoshiprocket = json_decode($sendOrderToShipRocket);
        // $_ordertoshiprocket=$ordertoshiprocket->status_code;

        $awb_status = json_decode($generate_awb);
        // $_awb_status=$awb_status->awb_assign_status;

        $checkLogin      = preg_replace('/(}")/i', '}', $generate_pickup);
        $checkLogin      = preg_replace('/("{)/i', '{', $checkLogin);
        $generate_pickup = stripcslashes($checkLogin);
        $pickup_status   = json_decode($generate_pickup);
        // $_pickup_status=$pickup_status->pickup_status;

        if ($ordersjs->data[0]->status_code == 1) {
            if ($ordertoshiprocket->status_code == 1) {
                if ($courier_list!='') {
                   
                // if ($awb_status->awb_assign_status == 1) {
                //     if ($pickup_status->pickup_status == 1) {
                        $status  = 7;
                        $message = "All Steps Completed";
                //     } else {
                //         $pickup_status = json_decode($generate_pickup);
                //         $status        = 6;
                //         $message       = $pickup_status->message;
                //     }
                // } else {
                //     $awb_status = json_decode($generate_awb);
                //     $status     = 5;
                //     $message    = $awb_status->message;
                // }
            }
            else
            {
                    $status     = 4;
                    $message    = "Courier Not Selected";

            }
            } else {
                $ordertoshiprocket = json_decode($sendOrderToShipRocket);
                $status            = 3;
                $message           = $ordertoshiprocket->message;
            }

        } else {
            $ordersjs = json_decode($sendOrderShipRocket);
            $message  = $ordersjs->message;
            $status   = 2;
        }

        $response = array(
            'status'  => $status,
            'data'    => $ShippingData,
            'message' => $message,
        );
        echo json_encode($response);
    } else {
        $response = array(
            'status'  => 1,
            'data'    => "null",
            'message' => "New Entry",
        );
        echo json_encode($response);

    }

}
