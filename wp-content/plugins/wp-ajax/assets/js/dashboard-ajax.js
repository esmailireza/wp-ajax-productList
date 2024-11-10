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
});