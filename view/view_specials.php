<div id="product_content">
                <div id="product_head">
					<?php if($category_id_special == -1): ?>
						Special Sales in All Categories
					<?php else: ?>
						Special Sales in Category: <?=$c_name?>
					<?php endif; ?>
                </div>


                	<?php if(count($specials) == 0): ?>
						 <p style="font-size:18pt;text-align:center">No special sales.</p>
					<?php else: ?>
						 <?php foreach ($specials as $item): ?> 
						 		<div class="product_sm_window">
                                <div class="pro_con_img" style="width:180px;height:180px;margin-left:auto;margin-right:auto">
                                    <img src="<?=base_url().'application/other/'.$item['productimg']?>" style="width:180px;height:180px;" alt="Picture Not Found." />
                                </div>
                                 <div id="" class="special_img_text_sm" style="font-size:14pt;color:#46A3FF;height:40px;">
                                <?=$item['productname']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="height:34px;">
                                    <?=$item['singer']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                   <?=$item['categoryname']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                    Price:&nbsp<span style="text-decoration:line-through;">$<?=$item['productprice']?></span>&nbsp
                                    <span style="color:#EA0000;font-size:14pt">$<?=$item['specialprice']?></span>
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                    Start date: <?=$item['startdate']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                    End date: &nbsp<?=$item['enddate']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="width:160px;margin-left:auto;margin-right:auto">
                                    <input type="button" onclick="addToCart(<?=$item['productid']?>)" value="Add to Cart" style="width:160px;height:30px;font-size:12pt;">
                                </div>
                                </div>
						 <?php endforeach; ?> 
					<?php endif; ?>



                <div style="clear:both"></div> 
            </div>