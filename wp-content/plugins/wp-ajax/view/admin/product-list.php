<h3 class="my-5">لیست محصولات</h3>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
   افزودن محصول جدید
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">افزودن محصول جدید</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="add_product" >
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="name" class="form-label">نام محصول</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="نام محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="brand" class="form-label">برند</label>
                            <input type="text" class="form-control" id="brand" name="brand" placeholder="برند محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="model" class="form-label">مدل</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="مدل محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="model" class="form-label">قیمت</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="قیمت محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="status" class="form-label">وضعیت محصول</label>

                            <select class="form-select" id="status" name="status">
                                <option value="0">ناموجود</option>
                                <option value="1">موجود</option>
                            </select>
                        </div>
                        <input type="hidden" id="add-product-nonce" value="<?php echo wp_create_nonce(); ?>">
                        <?php wp_nonce_field('test','test-1',false); ?>
                    </div>
                    <div class="modal-footer mt-4">
                        <button type="submit" class="btn btn-success">افزودن</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!--Modal For Edit-->
<!-- Modal -->
<div class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ویرایش محصول</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="update_product" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="name" class="form-label">نام محصول</label>
                            <input type="text" class="form-control" id="p_name" placeholder="نام محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="brand" class="form-label">برند</label>
                            <input type="text" class="form-control" id="p_brand" placeholder="برند محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="model" class="form-label">مدل</label>
                            <input type="text" class="form-control" id="p_model" placeholder="مدل محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-3">
                            <label for="model" class="form-label">قیمت</label>
                            <input type="text" class="form-control" id="p_price" placeholder="قیمت محصول ...">
                        </div>
                        <div class="col-sm-12 col-md-12 mb-3">
                            <label for="status" class="form-label">وضعیت محصول</label>

                            <select class="form-select" id="p_status">
                                <option value="0">ناموجود</option>
                                <option value="1">موجود</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="p_ID">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ثبت</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <table class="table striped border">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام محصول</th>
                    <th scope="col">برند</th>
                    <th scope="col">مدل</th>
                    <th scope="col">قیمت</th>
                    <th scope="col">وضعیت</th>
                    <th scope="col">عملیات</th>
                </tr>
                </thead>
                <tbody>
                <?php $all_products = all_products();
                //var_dump(all_products());
                if($all_products):
                    foreach($all_products as $product):
                    ?>
                        <tr>
                    <th scope="row"><?php echo $product->ID ?></th>
                <td><?php echo $product->p_name ?></td>
                <td><?php echo $product->p_brand ?></td>
                <td><?php echo $product->p_model ?></td>
                <td><?php echo $product->p_price ?></td>
                            <td><?php echo $product->p_status ?></td>
                <td><?php
                    switch ($product->p_status) {
                        case 0:
                            echo '<sapn class="badge text-bg-danger">ناموجود</sapn>';
                            break;
                        case 1:
                            echo '<sapn class="badge text-bg-success">موجود</sapn>';
                            break;
                    }
                    ?></td>
                <td>
                    <i class="bi bi-pencil select-product" data-bs-toggle="modal" data-bs-target="#editProduct" data-id="<?php echo $product->ID ?>" id="delete-item-<?php echo $product->ID ?>"></i>
                    <i class="fas fa-times-circle delete-product" id="delete-item-<?php echo $product->ID ?>" data-id="<?php echo $product->ID ?>" data-nonce="<?php echo wp_create_nonce() ?>"></i>
                </td>
                </tr>
                <!--                --><?php endforeach; ?>
                <!--                --><?php else: ?>
                <div class="alert alert-warning">تاکنون محصولی ثبت نشده است.</div>
                <?php endif; ?>



                </tbody>
            </table>
        </div>
    </div>
</div>