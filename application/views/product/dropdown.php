<select id="product" name="products" class="dropdown">
     <option value="">--- Select ---</option>
<?php
        foreach($productData as $product){
?>
          <option value="<?php echo $product->product_id;?>"><?php echo $product->model;?></option>
<?php }?>
</select>