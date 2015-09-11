<div class="product_sm_window"> 
                                <div class="pro_con_img" style="width:180px;height:180px;margin-left:auto;margin-right:auto">
                                    <img src="<?=base_url().'application/other/'.$special_item['productimg']?>" style="width:180px;height:180px;" alt="Picture Not Found." />
                                </div>
                                 <div id="" class="special_img_text_sm" style="font-size:14pt;color:#46A3FF;height:40px;">
                                <?=$special_item['productname']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="height:34px;">
                                    <?=$special_item['singer']?> 
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                    <?=$special_item['categoryname']?> 
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                    Price:&nbsp<span style="text-decoration:line-through;">$<?=$special_item['productprice']?></span>&nbsp
                                    <span style="color:#EA0000;font-size:14pt">$<?=$special_item['specialprice']?></span>
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                    Start date: <?=$special_item['startdate']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="">
                                    End date: &nbsp<?=$special_item['enddate']?>
                                </div>
                                <div id="" class="special_img_text_sm" style="width:160px;margin-left:auto;margin-right:auto">
                                    <input type="button" onclick="addToCart(<?=$special_item['productid']?>)" value="Add to Cart" style="width:160px;height:30px;font-size:12pt;">
                                </div>
                                </div>