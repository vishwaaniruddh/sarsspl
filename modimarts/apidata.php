<?php

function CategoryList($action)
{
    $base_url = "https://thebrandtadka.com/api/index.php?mod=ApiMobile";
    $c_id     = "&api_key=VarifyTADKA7563&company_id=448";
    $token    = "&token=02c276c93ce8508fc578476b99ab4c80";
    $url      = $base_url . $token . $c_id;

    $callurl = $url . "&action=getCategoryList";

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
    return $res_responce->Records;

}


function GetCategoryList($addurl, $action)
{

    $callurl = $addurl . "&action=" . $action;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
    return $res_responce;

}

function GetTotalRecordsByrange($cat_id,$range)
{

    $callurl = "https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=448%20&action=getProductList&token=02c276c93ce8508fc578476b99ab4c80&category_id=".$cat_id."&s_price_range=".$range;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
   $results=$res_responce->Total_records;

    return $results;

}

function GetTotalRecords($cat_id)
{

    $callurl = "https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=448%20&action=getProductList&token=02c276c93ce8508fc578476b99ab4c80&category_id=".$cat_id;;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
   $results=$res_responce->Total_records;

    return $results;

}

function GetcatRecords($cat_id)
{

    $callurl = "https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=448&action=getProductList&token=02c276c93ce8508fc578476b99ab4c80&category_id=".$cat_id;;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
   // $results=$res_responce->Total_records;

    return $res_responce;

}


function GetProductdata($action, $product_id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://thebrandtadka.com/api/index.php?mod=ApiMobile&company_id=448&action=' . $action . '&api_key=VarifyTADKA7563&token=02c276c93ce8508fc578476b99ab4c80&product_id=' . $product_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
// echo $response;
    return $res_responce = json_decode($response);

}



function getProductSizes($action, $product_id, $Sku_id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://thebrandtadka.com/api/index.php?mod=ApiMobile&company_id=448&action=' . $action . '&api_key=VarifyTADKA7563&token=02c276c93ce8508fc578476b99ab4c80&product_id=' . $product_id . '&sku_id=' . $Sku_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $size_res = curl_exec($curl);

    curl_close($curl);
    return $size_res = json_decode($size_res);
}



function getProductColors($action, $product_id, $Sku_id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://thebrandtadka.com/api/index.php?mod=ApiMobile&company_id=448&action=' . $action . '&api_key=VarifyTADKA7563&token=02c276c93ce8508fc578476b99ab4c80&product_id=' . $product_id . '&sku_id=' . $Sku_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $color_res = curl_exec($curl);

    curl_close($curl);
    return $color_res = json_decode($color_res);
}



function getImagesList($action, $product_id)
{

    

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => 'https://thebrandtadka.com/api/index.php?mod=ApiMobile&company_id=448&action=' . $action . '&api_key=VarifyTADKA7563&token=02c276c93ce8508fc578476b99ab4c80&product_id=' . $product_id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $imgresponse = curl_exec($curl);

    curl_close($curl);
    return $imgresponse = json_decode($imgresponse);
}


// function addToCart($action,$product_id,$member_id,$size_id,$color_id)
// {

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=448%20&action=addToCart&token=02c276c93ce8508fc578476b99ab4c80&product_id=20002&member_id=727&size_id=69&color_id=52',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
//   CURLOPT_HTTPHEADER => array(
//     'Cookie: PHPSESSID=12ae5f6d3662d791c906f87fd66246c0'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;

// }

function GetCategoryProduct($catid)
{

    $callurl = 'https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=448&action=getCategoryList&token=02c276c93ce8508fc578476b99ab4c80&category_id='.$catid;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
    $results=$res_responce->Records;

    return $results;

}

function getcatimg($catid)
{

    $url = "assets/apiimages.json";

    $file = file_get_contents($url);
    $data = json_decode($file);
    $jsondata = json_decode($file,true);
    unset($file);
    $image='';

    foreach ($jsondata as $key => $value) {

      if($value[$catid])
      {
        $image=$value[$catid];
      }
    }
 

    if($image=='')
    {


    $callurl = "https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=448%20&action=getProductList&start_point=0&end_point=1&token=02c276c93ce8508fc578476b99ab4c80&category_id=".$catid;;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
    $results=$res_responce->Records;
    $result=$results[0]->Product_image;
    
    $data[] = array($catid=>$results[0]->Product_image);
    //save the file
   file_put_contents($url,json_encode($data));
   unset($data);//release memory
}
else
{
   $result=$image; 
}

    return $result;

}

function Prosearch($s_title)
{

    $callurl = "https://thebrandtadka.com/api/index.php?mod=ApiMobile&api_key=VarifyTADKA7563&company_id=448&action=getProductList&token=02c276c93ce8508fc578476b99ab4c80&start_point=0&end_point=50&s_title=".$s_title;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
    $results=$res_responce->Records;

    return $results;

}

function Prostatus($order_id)
{

    // $callurl = "https://thebrandtadka.com/api/index.php?mod=ApiMobile&company_id=448&action=orderDispatchStatus&api_key=VarifyTADKA7563&token=02c276c93ce8508fc578476b99ab4c80&member_id=1094218&order_id=".$order_id;

    $callurl = "https://thebrandtadka.com/api/index.php?mod=ApiMobile&company_id=448&action=orderDispatchStatus&api_key=VarifyTADKA7563&token=02c276c93ce8508fc578476b99ab4c80&member_id=1094462&order_id=".$order_id;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL            => $callurl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING       => '',
        CURLOPT_MAXREDIRS      => 10,
        CURLOPT_TIMEOUT        => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST  => 'GET',
        CURLOPT_HTTPHEADER     => array(
            'Cookie: PHPSESSID=imvll0qp2rqq2bhe6pqabfd4o2',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res_responce = json_decode($response);
    $results=$res_responce->Records;

    return $results;

}
?>



