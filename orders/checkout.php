<?php
include "../connect.php";
$paymentmethod = filterRequest("paymentmethod");
$userId = filterRequest("userId");
$addressId = filterRequest("addressId");
$orderstype = filterRequest("orderstype");
$pricedelivery = filterRequest("pricedelivery");
$ordersprice = filterRequest("ordersprice");
$discount = filterRequest("discount");
$couponid = filterRequest("couponid");


if($orderstype=="1"){
    $pricedelivery=0;
}
$totalprice = $pricedelivery + $ordersprice;
$now = date("Y-m-d H:i:s");// CURRENT DATE OF TODAY
$checkCoupon = getData("coupon","`coupon_id` = '$couponid' AND `coupon_count` > 0 AND `coupon_expiredate` > '$now'",null,false);

if($checkCoupon>0){
    $state = $con->prepare("UPDATE `coupon` SET `coupon_count`= `coupon_count`-1 WHERE `coupon_id`='$couponid'");
    $state->execute();
    $count = $state->rowCount();
    if($count> 0){
        $totalprice = $totalprice - $ordersprice * $discount/100;
    }
}

$data = array(
    'orders_paymentmethod'=>$paymentmethod,
    'orders_userId'=>$userId,
    'orders_addressId'=>$addressId,
    'orders_type'=>$orderstype,
    'orders_pricedelivery'=>$pricedelivery,
    'orders_price'=>$ordersprice,
    'orders_totalprice'=>$totalprice,
    'orders_coupon'=>$couponid);

$count = insertData("orders", $data,false);
if($count> 0){
    //* I ADDED "WHERE orders_userId = '$userId'" 
    //* IN ORDER NOT TO CAUSE CONFUSION OF 'ORDERS' 
    //* BETWEEN TWO USERS IN CASE THE INTERNET IS WEAK
    $statment = $con->prepare("SELECT MAX(orders_id) FROM orders WHERE orders_userId = '$userId'");
    $statment->execute();
    $maxid = $statment->fetchColumn();
    $data = array('cart_orders'=>$maxid);
    updateData("cart",$data,"cart_usersId = $userId AND cart_orders = 0");
    //* send notification to the admin
    insertAdminNotification("Warning", "The order number $maxid is waiting to approve " , "admin" , "none","refershadminpendingorders",null);
    //sendFCMMessage("admin", "Warning", "There Are One Order Waiting To Approve","adminpendingpage","refershadminpendingorders", null);
    //!=================== decrease the count of items ===================
    
    //!===================================================================
    //!=================== store data in order address ===================
    $orderData = getAllData("orders","1=1",null,false);
    $lastElement = end($orderData);
    $data = array(
        'orderAddress_name'=>"none",
        'orderAddress_city'=>"none",
        'orderAddress_street'=>"none",
        'orderAddress_lat'=>"",
        'orderAddress_long'=>"",
        'orderAddress_orderId'=>$lastElement["orders_id"],
        'orderAddress_addressId'=>$addressId);
    if($addressId!="0"){
        $addressData = getAllData("address","address_id = ? ",[$addressId],false);
        if($addressData.count($addressData)> 0){
        $data = array(
            'orderAddress_name'=>$addressData[0]["address_name"],
            'orderAddress_city'=>$addressData[0]["address_city"],
            'orderAddress_street'=>$addressData[0]["address_street"],
            'orderAddress_lat'=>$addressData[0]["address_lat"],
            'orderAddress_long'=>$addressData[0]["address_long"],
            'orderAddress_orderId'=>$lastElement["orders_id"],
            'orderAddress_addressId'=>$addressId);
    }
    insertData("orderAddress", $data,false);}
//!===================================================================
}
//*STEPS OF ORDERS STARTING FROM CART UNTIL ORDER AND PAYMENT
//* 1- ADD ANY ITEMS TO CART  
//* 2- AT THIS MOMENT , THE 'CART_ORDERS' IS EQUAL TO ZERO
//* 3- CHECKOUT ITEMS AND STORE THE ORDER IN 'ODERS TABLE'
//* 4- GET THE 'MAX ID' FOR ORDER ,BECOUSE THIS IS MY CURRENT ORDER
//* 5- CHANGE THE 'CART_ORDERS' FOR ALL THE ITEMS IN 'CART TABLE' TO 'MAX ID'
//!================ REMEMBER =================
//* WE SHOULD ADD THE 'cart_orders = 0' AS CONDITION IN "DELETE , GETCOUNTITEMS , 'cartProducts' VIEW"
