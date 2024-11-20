jQuery(document).ready(function ($) {
    $("#add_product").on('submit',function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let brand = $('#brand').val();
        let model = $('#model').val();
        let price = $('#price').val();
        let status = $('#status').val();
        $.ajax({
            url: 'http://localhost/wp-ajax/wp-admin/admin-ajax.php',
            type: 'post',
            data:{
                action:'add_product',
                name:name,
                brand:brand,
                model:model,
                price:price,
                status:status
            },
            success:function (response) {
                console.log("response:",response);
            },
            error:function (error) {
                console.log("error:",error);
            }
        });
    })
    $('.delete-product').on('click', function () {
        let el =  $(this);
        let product_ID = el.data('id');
        //alert(product_ID);
        $.ajax({
            url: 'http://localhost/wp-ajax/wp-admin/admin-ajax.php',
            type: 'post',
            data:{
                action:'delete_product',
                product_ID:product_ID
            },
            success:function (response) {
                console.log("response:",response);
            },
            error:function (error) {
                console.log("error:",error);
            }
        });
    })
    $('.select-product').on('click', function () {
        let el =  $(this);
        let product_ID = el.data('id');
        $.ajax({
            url: 'http://localhost/wp-ajax/wp-admin/admin-ajax.php',
            type: 'post',
            data:{
                action:'select_product_by_id',
                product_ID:product_ID
            },
            success:function (response) {
                let data = JSON.parse(response);
                $('#p_ID').val(data.ID)
                $('#p_name').val(data.p_name);
                $('#p_brand').val(data.p_brand);
                $('#p_model').val(data.p_model);
                $('#p_price').val(data.p_price);
                $('#p_status').val(data.p_status);
                console.log(data);

            },
            error:function (error) {
                console.log("error:",error);
            }
        });
    })

    });