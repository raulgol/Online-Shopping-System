										<div class="product_sm_window" style="width:160px">
		                                <div class="pro_con_img" style="width:140px;height:140px;margin-left:auto;margin-right:auto">
		                                    <img src="<?=base_url().'application/other/'.$productimg?>"  style="width:140px;height:140px" alt="Picture Not Found." />
		                                </div>
		                                 <div id="" class="special_img_text_sm" style="font-size:13pt;color:#46A3FF;height:40px;">
		                               <?=$productname?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="height:34px;">
		                                   <?=$singer?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="">
		                                    <?=$categoryname?>
		                                </div>
		                                

							<?php if($isSpecial): ?>
                                             <div id="" class="special_img_text_sm" style="">
		                                    <span style="text-decoration:line-through;">$<?=$price?></span>&nbsp
		                                    <span style="color:#EA0000; ">$<?=$specialprice?></span>
		                                </div>
		 
		                                <div id="" class="special_img_text_sm" style="height:16px;font-size:10pt">Start Date:  
		                                        <?=$startdate?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="height:16px;font-size:10pt">End Date: 
		                                        <?=$enddate?>
		                                </div>  
                          	<?php else: ?>
                                           <div id="" class="special_img_text_sm" style="padding-top:3px">
		                                    Price:&nbsp<span style="">$<?=$price?></span>
		                              </div>
		                                <div id="" class="special_img_text_sm" style="height:29px"></div>
                          	<?php endif; ?>



		                                <div id="" class="special_img_text_sm" style="color:red;font-size:12pt">
		                                    Recommendation Index: <?=$s?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="width:130px;margin-left:auto;margin-right:auto">
		                                    <input type="button" onclick="addToCart_recommand(<?=$pro_id?>)" value="Add to Cart" style="width:124px;height:26px;font-size:12pt;">
		                                </div>
		                                </div>