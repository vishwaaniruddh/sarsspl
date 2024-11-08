function openform() {
    var itemid = $("#item_id").val();
    var length = $("#length").val();
    var breadth = $("#breadth").val();
    var height = $("#height").val();
    var weight = $("#weight").val();
    $("#length_" + itemid).val(length);
    $("#breadth_" + itemid).val(breadth);
    $("#height_" + itemid).val(height);
    $("#weight_" + itemid).val(weight);
    $("#length").val('');
    $("#breadth").val('');
    $("#height").val('');
    $("#weight").val('');
    $("#item_id").val('');
    if (length != '' && breadth != '' && height != '' && weight != '') {
        // alert("All Set Call API");
        // sendOrderShipRocket(itemid);
        CheckStatusResponse(itemid);
    }
    $('#form').modal('hide');
    return false;
}

function SetId(id) {
    $("#item_id").val(id);
    // alert(id);
}

function CheckStatusResponse(itemid) { debugger;
    // alert(itemid);
    var postdata = JSON.stringify({
        "itemid": itemid,
        "CheckStatusResponse": 1
    });
    $('.loader').show();
    $.ajax({
        type: "POST",
        url: "testingdata.php",
        data: postdata,
        success: function(res) { debugger;
            // alert(res);
            var result = JSON.parse(res);
            var status = result.status;
            var message = result.message;
            
            if (status == 1) {
                console.log(message);
                sendOrderShipRocket(itemid);
                // sendOrderToShipRocket('1551804', itemid);

            } else if (status == 2) {
                console.log(message);
                sendOrderShipRocket(itemid);
                // sendOrderToShipRocket('1551804', itemid);
            } else if (status == 3) {
                console.log(message);
                var channelid = result.data.channelid;
                sendOrderToShipRocket(channelid, itemid);
            } else if (status == 4) {
                console.log(message);
                var order_ids = result.data.order_ids;
                CheckCourier(itemid, order_ids);
            } else if (status == 7) {
                console.log(message);
                alert("All Steps Completed");
            } else {
                alert('Error occurs!');
            }
            $('.loader').hide();
        },
        error: function() {
            $('.loader').hide();
            alert('Error occurs!');
        }
    });
}

function CheckCourier(itemid, order_ids) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/courier/serviceability?order_id=" + order_ids,
        "method": "GET",
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        var status_code = response.status;
        if (status_code == 200) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&responce2=' + res2 + '&CheckCourier=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        var url = "ShippingDetails.php?itemid=" + itemid;
                        window.location.href = url;
                        // generate_awb(shipment_id, itemid);
                        $('.loader').hide();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'item_id=' + itemid + '&responce2=' + res2 + '&CheckCourier=1',
            success: function(msg) {
                console.log(msg);
                if (msg == 1) {
                    $('.loader').hide();
                    alert(message);
                    location.reload();
                }
            }
        });
    });
}

function sendOrderShipRocket(itemid) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/channels",
        "method": "GET",
        "timeout": 0,
         "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        var gfg = JSON.stringify(response);
        $("#responce1").val(gfg);
        var res = response.data;
        var channelid = 0;
        for (var i = 0; i < res.length; i++) {
            var res_status = res[i].status;
            if (res_status == 'Active') {
                channelid = res[i].id;
            }
        }
        // channel id = 1551804
        if (channelid > 0) {
            $('.loader').hide();
            sendOrderToShipRocket(channelid, itemid);
        }
        // alert(channelid);
    });
}

function sendOrderToShipRocket(channelid, itemid) {
    debugger;
    $('.loader').show();
    var order_id = $('#order_id').val();
    var billing_customer_name = $('#billing_customer_name').val();
    var billing_last_name = $('#billing_last_name').val();
    var billing_address = $('#billing_address').val();
    var billing_address_2 = $('#billing_address_2').val();
    var billing_city = $('#billing_city').val();
    var billing_pincode = $('#billing_pincode').val();
    var billing_state = $('#billing_state').val();
    var billing_email = $('#billing_email').val();
    var billing_phone = $('#billing_phone').val();
    billing_phone = parseInt(billing_phone, 10);
    var order_date = $('#order_date').val();
    var length = $("#length_" + itemid).val();
    var breadth = $("#breadth_" + itemid).val();
    var height = $("#height_" + itemid).val();
    var weight = $("#weight_" + itemid).val();
    var pickup_location = $('#pickup_locetion').val();
    // var pickup_location = "Allmart";
    alert(pickup_location);
    var sub_total = $('#sub_total').val();
    var order_items = [];
    var orderitems = $('#order_items_' + itemid).val();
    var o_items = JSON.parse(orderitems);
    var order_items = [];
    order_items.push(o_items);
    var jwt_token = $("#jwt_token").val();
    
    if (order_id != '') {
        if (order_date != '') {
            if (pickup_location != '') {
                if (billing_customer_name != '') {
                    if (billing_city != '') {
                        if (billing_pincode != '') {
                            if (billing_state != '') {
                                if (1) {
                                    if (billing_email != '') {
                                        if (billing_phone != '') {
                                            if (order_items != '') {
                                                if (sub_total != '') {
                                                    if (length != '' && breadth != '' && height != '' && weight != '') {
                                                         
                                                        var settings = {
                                                            "url": "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
                                                            "method": "POST",
                                                            "timeout": 0,
                                                            "headers": {
                                                                "Content-Type": "application/json",
                                                                "Authorization": "Bearer " + jwt_token
                                                            },
                                                            "data": JSON.stringify({
                                                                "order_id": order_id,
                                                                "order_date": order_date,
                                                                "pickup_location": pickup_location,
                                                                "channel_id": channelid,
                                                                "comment": "Reseller: Allmart",
                                                                "billing_customer_name": billing_customer_name,
                                                                "billing_last_name": billing_last_name,
                                                                "billing_address": billing_address,
                                                                "billing_address_2": billing_address_2,
                                                                "billing_city": billing_city,
                                                                "billing_pincode": billing_pincode,
                                                                "billing_state": billing_state,
                                                                "billing_country": "India",
                                                                "billing_email": billing_email,
                                                                "billing_phone": billing_phone,
                                                                "shipping_is_billing": true,
                                                                "shipping_customer_name": "",
                                                                "shipping_last_name": "",
                                                                "shipping_address": "",
                                                                "shipping_address_2": "",
                                                                "shipping_city": "",
                                                                "shipping_pincode": "",
                                                                "shipping_country": "",
                                                                "shipping_state": "",
                                                                "shipping_email": "",
                                                                "shipping_phone": "",
                                                                "order_items": order_items,
                                                                "payment_method": "Prepaid",
                                                                "shipping_charges": 0,
                                                                "giftwrap_charges": 0,
                                                                "transaction_charges": 0,
                                                                "total_discount": 0,
                                                                "sub_total": sub_total,
                                                                "length": length,
                                                                "breadth": breadth,
                                                                "height": height,
                                                                "weight": weight,
                                                                "order_type": "ESSENTIALS"
                                                            }),
                                                        };
                                                        $.ajax(settings).done(function(response) {
                                                            debugger;
                                                            console.log(response);
                                                            // var respon = JSON.parse(response);
                                                            var status_code = response.status_code;
                                                            var shipment_id = response.shipment_id;
                                                            var order_ids = response.order_id;
                                                            if (status_code) {
                                                                var responce1 = $("#responce1").val();
                                                                var res2 = JSON.stringify(response);
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "addshippingdata.php",
                                                                    data: 'item_id=' + itemid + '&oid=' + order_id + '&channel_id=' + channelid + '&responce1=' + responce1 + '&responce2=' + res2 + '&shipment_id=' + shipment_id + '&order_ids=' + order_ids + '&sendOrderToShipRocket=1',
                                                                    success: function(msg) {
                                                                        console.log(msg);
                                                                        if (msg == 1) {
                                                                            $('.loader').hide();
                                                                            CheckCourier(itemid, order_ids);
                                                                        }
                                                                    }
                                                                });
                                                            } else {
                                                                var message = response.message;
                                                                var res2 = JSON.stringify(response);
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "addshippingdata.php",
                                                                    data: 'item_id=' + itemid + '&oid=' + order_id + '&channel_id=' + channelid + '&responce1=' + responce1 + '&responce2=' + res2 + '&shipment_id=""&order_ids=""&sendOrderToShipRocket=1',
                                                                    success: function(msg) {
                                                                        console.log(msg);
                                                                        if (msg == 1) {
                                                                            $('.loader').hide();
                                                                            alert(message);
                                                                            location.reload();
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                        }).fail(function(xhr, status, error) {
                                                            console.log(xhr);
                                                            var err = JSON.parse(xhr.responseText);
                                                            var message = err.message;
                                                            var res2 = JSON.stringify(err);
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "addshippingdata.php",
                                                                data: 'item_id=' + itemid + '&oid=' + order_id + '&channel_id=' + channelid + '&responce1=' + responce1 + '&responce2=' + res2 + '&shipment_id=""&order_ids=""&sendOrderToShipRocket=1',
                                                                success: function(msg) {
                                                                    console.log(msg);
                                                                    if (msg == 1) {
                                                                        $('.loader').hide();
                                                                        alert(message);
                                                                    }
                                                                }
                                                            });
                                                        });
                                                    } else {
                                                        alert("length, Breadth, height, weight is Required");
                                                        location.reload();
                                                    }
                                                } else {
                                                    alert("SubTotal is Required");
                                                    location.reload();
                                                }
                                            } else {
                                                alert("Order Details is Required");
                                                location.reload();
                                            }
                                        } else {
                                            alert("User Mobile Number is Required");
                                            location.reload();
                                        }
                                    } else {
                                        alert("User Email id is Required");
                                        location.reload();
                                    }
                                } else {
                                    alert("User Country is Required");
                                    location.reload();
                                }
                            } else {
                                alert("User State is Required");
                                location.reload();
                            }
                        } else {
                            alert("User Pincode is Required");
                            location.reload();
                        }
                    } else {
                        alert("User City is Required");
                        location.reload();
                    }
                } else {
                    alert("User Name Required");
                    location.reload();
                }
            } else {
                alert("pickup_location Required");
                location.reload();
            }
        } else {
            alert("Order Date Required");
            location.reload();
        }
    } else {
        alert("Order ID Required");
        location.reload();
    }
}

function ganerateAWB(shipment_id, itemid) {
    $('.loader').show();
    var courier_id = $("#Courier_id").val();
    if (courier_id != "" && shipment_id != "" && itemid != "") {
        generate_awb(courier_id, shipment_id, itemid);
        // alert(courier_id);
        $('.loader').hide();
    } else {
        alert("Please Select courier Type");
        $('.loader').hide();
    }
}

function generate_awb(courier_id, shipment_id, itemid) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/courier/assign/awb",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
        "data": JSON.stringify({
            "shipment_id": shipment_id,
            "courier_id": courier_id
        }),
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        // var respon = JSON.parse(response);
        var status = response.awb_assign_status;
        var awb_code = response.response.data.awb_code;
        if (status) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&awb_code=' + awb_code + '&responce2=' + res2 + '&generate_awb=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        $('.loader').hide();
                        generate_pickup(shipment_id, itemid, awb_code);
                    }
                }
            });
        } else {
            var message = response.message;
            // var res2 = JSON.stringify(response);
            // $.ajax({
            //     type: "POST",
            //     url: "addshippingdata.php",
            //     data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&awb_code=""&responce2=' + res2 + '&generate_awb=1',
            //     success: function(msg) {
            //         console.log(msg);
            //         if (msg == 1) {
            $('.loader').hide();
            alert(message);
            location.reload();
            //         }
            //     }
            // });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&awb_code=""&responce2=' + res2 + '&generate_awb=1',
            success: function(msg) {
                console.log(msg);
                if (msg == 1) {
                    $('.loader').hide();
                    alert(message);
                    location.reload();
                }
            }
        });
    });
}

function generate_pickup(shipment_id, itemid, awb_code) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    //if request fail then status with value "retry" must include
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/courier/generate/pickup",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
        "data": JSON.stringify({
            "shipment_id": [
                shipment_id
            ]
        }),
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        //  var respon = JSON.parse(response);
        var status = response.pickup_status;
        if (status) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generate_pickup=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        $('.loader').hide();
                        gettrackdetails(awb_code);
                        location.reload();
                    }
                }
            });
        } else {
            var message = response.message;
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generate_pickup=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        $('.loader').hide();
                        gettrackdetails(awb_code);
                        alert(message);
                        location.reload();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generate_pickup=1',
            success: function(msg) {
                console.log(msg);
                if (msg == 1) {
                    $('.loader').hide();
                    gettrackdetails(awb_code);
                    alert(message);
                    location.reload();
                }
            }
        });
    });
}

function generateManifest(shipment_id, itemid) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/manifests/generate",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
        "data": JSON.stringify({
            "shipment_id": [
                shipment_id
            ]
        }),
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        // var respon = JSON.parse(response);
        var status = response.status;
        var manifest_url = response.manifest_url;
        if (status) {
            var res2 = JSON.stringify(response);
            var awb_code = "0";
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generateManifest=1',
                success: function(msg) {
                    console.log(msg);
                    var resp = JSON.parse(msg);
                    var res_status = resp.status
                    var order_ids = resp.order_ids;
                    if (res_status == 1) {
                        $('.loader').hide();
                        location.href = manifest_url;
                        location.reload();
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generateManifest=1',
                success: function(msg) {
                    console.log(msg);
                    var resp = JSON.parse(msg);
                    var res_status = resp.status
                    var order_ids = resp.order_ids;
                    if (res_status == 1) {
                        var message = response.message;
                        alert(message);
                        $('.loader').hide();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generateManifest=1',
            success: function(msg) {
                console.log(msg);
                var resp = JSON.parse(msg);
                var res_status = resp.status
                var order_ids = resp.order_ids;
                if (res_status == 1) {
                    alert(message)
                    $('.loader').hide();
                }
            }
        });
    });
}

function printManifest(order_id) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/manifests/print",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
        "data": JSON.stringify({
            "order_ids": [
                order_id
            ]
        }),
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        // var respon = JSON.parse(response);
        var status = response.manifest_url;
        if (status != '') {
            var res2 = JSON.stringify(response);
            var awb_code = "0";
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'order_ids=' + order_id + '&responce2=' + res2 + '&printManifest=1',
                success: function(msg) {
                    console.log(msg);
                    var resp = JSON.parse(msg);
                    var res_status = resp.status
                    var shipment_id = resp.shipment_id;
                    var itemid = resp.itemid;
                    if (res_status == 1) {
                        location.href = status;
                        location.reload();
                        $('.loader').hide();
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'order_ids=' + order_id + '&responce2=' + res2 + '&printManifest=1',
                success: function(msg) {
                    console.log(msg);
                    var resp = JSON.parse(msg);
                    var res_status = resp.status
                    var shipment_id = resp.shipment_id;
                    var itemid = resp.itemid;
                    if (res_status == 1) {
                        var message = response.message;
                        alert(message);
                        $('.loader').hide();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'order_ids=' + order_id + '&responce2=' + res2 + '&printManifest=1',
            success: function(msg) {
                console.log(msg);
                var resp = JSON.parse(msg);
                var res_status = resp.status
                var shipment_id = resp.shipment_id;
                var itemid = resp.itemid;
                if (res_status == 1) {
                    alert(message);
                    $('.loader').hide();
                }
            }
        });
    });
}

function generateLabel(shipment_id, itemid) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/courier/generate/label",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
        "data": JSON.stringify({
            "shipment_id": [
                shipment_id
            ]
        }),
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        // var respon = JSON.parse(response);
        var status = response.label_created;
        var label_url = response.label_url;
        if (status) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generateLabel=1',
                success: function(msg) {
                    console.log(msg);
                    var resp = JSON.parse(msg);
                    var res_status = resp.status
                    var order_ids = resp.order_ids;
                    if (res_status == 1) {
                        location.href = label_url;
                        location.reload();
                        $('.loader').hide();
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generateLabel=1',
                success: function(msg) {
                    console.log(msg);
                    var resp = JSON.parse(msg);
                    var res_status = resp.status
                    var order_ids = resp.order_ids;
                    if (res_status == 1) {
                        var message = response.message;
                        alert(message);
                        $('.loader').hide();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'item_id=' + itemid + '&shipment_id=' + shipment_id + '&responce2=' + res2 + '&generateLabel=1',
            success: function(msg) {
                console.log(msg);
                var resp = JSON.parse(msg);
                var res_status = resp.status
                var order_ids = resp.order_ids;
                if (res_status == 1) {
                    alert(message);
                    $('.loader').hide();
                }
            }
        });
    });
}

function printInvoice(order_ids) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/orders/print/invoice",
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
        "data": JSON.stringify({
            "ids": [
                order_ids
            ]
        }),
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        // var respon = JSON.parse(response);
        var status = response.is_invoice_created;
        var invoice_url = response.invoice_url;
        if (status) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'order_ids=' + order_ids + '&responce2=' + res2 + '&printInvoice=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        location.href = invoice_url;
                        location.reload();
                        $('.loader').hide();
                    }
                }
            });
        } else {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'order_ids=' + order_ids + '&responce2=' + res2 + '&printInvoice=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        var message = response.message;
                        alert(message);
                        $('.loader').hide();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'order_ids=' + order_ids + '&responce2=' + res2 + '&printInvoice=1',
            success: function(msg) {
                console.log(msg);
                if (msg == 1) {
                    alert(message);
                    location.reload();
                    $('.loader').hide();
                }
            }
        });
    });
}

function gettrackdetails(awb_code) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    // var awb_code = "";
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/courier/track/awb/" + awb_code,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        var status = response.tracking_data.track_status;
        if (status) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'awb_code=' + awb_code + '&responce2=' + res2 + '&gettrackdetails=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        // location.href = invoice_url;
                        location.reload();
                        $('.loader').hide();
                    }
                }
            });
        } else if (status == 0) {
            var message = response.tracking_data.error;
            alert(message);
            location.reload();
        } else {
            var message = response.message;
            alert(message);
            location.reload();
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'awb_code=' + awb_code + '&responce2=' + res2 + '&gettrackdetails=1',
            success: function(msg) {
                console.log(msg);
                if (msg == 1) {
                    alert(message);
                    $('.loader').hide();
                }
            }
        });
    });
}

function CancelOrder(order_ids, awb_code) {
    debugger;
    $('.loader').show();
    var con = confirm("Are You Sure Cancel This Order");
    if (con) {
        var jwt_token = $("#jwt_token").val();
        var settings = {
            "url": "https://apiv2.shiprocket.in/v1/external/orders/cancel",
            "method": "POST",
            "timeout": 0,
            "headers": {
                "Content-Type": "application/json",
                "Authorization": "Bearer " + jwt_token
            },
            "data": JSON.stringify({
                "ids": [order_ids]
            }),
        };
        $.ajax(settings).done(function(response) {
            debugger;
            console.log(response);
            var status = response.status_code;
            var message = response.message;
            if (status == 200) {
                var res2 = JSON.stringify(response);
                $.ajax({
                    type: "POST",
                    url: "addshippingdata.php",
                    data: 'order_ids=' + order_ids + '&responce2=' + res2 + '&CancelOrder=1',
                    success: function(msg) {
                        debugger;
                        console.log(msg);
                        if (msg == 1) {
                            $('.loader').hide();
                            gettrackdetails(awb_code);
                        }
                    }
                });
            } else {
                var res2 = JSON.stringify(response);
                $.ajax({
                    type: "POST",
                    url: "addshippingdata.php",
                    data: 'order_ids=' + order_ids + '&responce2=' + res2 + '&CancelOrder=1',
                    success: function(msg) {
                        debugger;
                        console.log(msg);
                        if (msg == 1) {
                            alert(message);
                            $('.loader').hide();
                        }
                    }
                });
            }
        }).fail(function(xhr, status, error) {
            console.log(xhr);
            var err = JSON.parse(xhr.responseText);
            var message = err.message;
            var res2 = JSON.stringify(err);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'order_ids=' + order_ids + '&responce2=' + res2 + '&CancelOrder=1',
                success: function(msg) {
                    debugger;
                    console.log(msg);
                    if (msg == 1) {
                        alert(message);
                        $('.loader').hide();
                    }
                }
            });
        });
    }
}

function gettrackdetailsUser(awb_code) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    // var awb_code = "";
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/courier/track/awb/" + awb_code,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        var status = response.tracking_data.track_status;
        if (status) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'awb_code=' + awb_code + '&responce2=' + res2 + '&gettrackdetails=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        $('.loader').hide();
                        // location.href = invoice_url;
                        // location.reload();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'awb_code=' + awb_code + '&responce2=' + res2 + '&gettrackdetails=1',
            success: function(msg) {
                console.log(msg);
                if (msg == 1) {
                    alert(message);
                    $('.loader').hide();
                }
            }
        });
    });
}

function autotrack(awb_code) {
    debugger;
    $('.loader').show();
    var jwt_token = $("#jwt_token").val();
    // var awb_code = "";
    var settings = {
        "url": "https://apiv2.shiprocket.in/v1/external/courier/track/awb/" + awb_code,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + jwt_token
        },
    };
    $.ajax(settings).done(function(response) {
        debugger;
        console.log(response);
        var status = response.tracking_data.track_status;
        if (status) {
            var res2 = JSON.stringify(response);
            $.ajax({
                type: "POST",
                url: "addshippingdata.php",
                data: 'awb_code=' + awb_code + '&responce2=' + res2 + '&autotrack=1',
                success: function(msg) {
                    console.log(msg);
                    if (msg == 1) {
                        $('.loader').hide();
                        // location.href = invoice_url;
                        // location.reload();
                    }
                }
            });
        }
    }).fail(function(xhr, status, error) {
        console.log(xhr);
        var err = JSON.parse(xhr.responseText);
        var message = err.message;
        var res2 = JSON.stringify(err);
        $.ajax({
            type: "POST",
            url: "addshippingdata.php",
            data: 'awb_code=' + awb_code + '&responce2=' + res2 + '&gettrackdetails=1',
            success: function(msg) {
                console.log(msg);
                if (msg == 1) {
                    alert(message);
                    $('.loader').hide();
                }
            }
        });
    });
}