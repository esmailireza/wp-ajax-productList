jQuery(document).ready(function ($) {
    $('#add_product').on('submit', function (e) {
        e.preventDefault();
        // alert('ajax');
        let name = $('#name').val();
        let brand = $('#brand').val();
        let model = $('#model').val();
        let price = $('#price').val();
        let status = $('#status').val();
        let nonce = $('#test-1').val();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'add_product',
                name: name,
                brand: brand,
                model: model,
                price: price,
                status: status,
                nonce : nonce
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {

            }
        });
    });
    $('.delete-product').on('click',function (){
        let el = $(this);
        let product_ID = el.data('id');
        let nonce = el.data('nonce');
        // alert(product_ID);
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'delete_product',
                product_ID: product_ID,
                nonce:nonce
            },
            beforeSend : function (){
                el.removeClass('fa-times-circle').addClass('fa-sync fa-spin');
            },
            success: function (response) {
                if(response.success){
                    // alert(response.message);
                    // Swal.fire(response.message);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                    el.parents('tr').remove();
                }
            },
            error: function (error) {

            },
            complete : function (){

            }
        });
    })
    $('.select-product').on('click',function (){
        let el = $(this);
        let product_ID = el.data('id');
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'post',
            data: {
                action: 'find_product_by_ID',
                product_ID: product_ID
            },
            success: function (response) {
                let data = JSON.parse(response);
                // console.log(data);
                $('#p_ID').val(data.ID);
                $('#p_name').val(data.p_name);
                $('#p_brand').val(data.p_brand);
                $('#p_model').val(data.p_model);
                $('#p_price').val(data.p_price);
                $('#p_status').val(data.p_status);
            },
            error: function (error) {

            }
        });
    })
    $('#update_product').on('submit', function (e) {
        e.preventDefault();
        // alert('ajax');
        let p_ID = $('#p_ID').val();
        let p_name = $('#p_name').val();
        let p_brand = $('#p_brand').val();
        let p_model = $('#p_model').val();
        let p_price = $('#p_price').val();
        let p_status = $('#p_status').val();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'post',
            dataType: 'json',
            data: {
                action: 'update_product',
                p_ID :p_ID,
                p_name: p_name,
                p_brand: p_brand,
                p_model: p_model,
                p_price: p_price,
                p_status: p_status
            },
            success: function (response) {
            console.log(response);
            if(response.success){
                // alert(response.message);
                // Swal.fire(response.message);
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            },
            error: function (error) {
                if(error.error){
                    // alert(error.responseJSON.message);
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: error.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    });
});

