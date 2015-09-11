<div id="product_info">
                    <div id="product_content">
                        <div id="product_head">Special Sales in All Categories</div>

                        <?php if (count($specials) == 0): ?>
                        	No special sales.
                        	<div class="product_content_general" >
                        		</div>
                       		 	<div style="clear:both">
                        		</div> 
                    			</div>   
                    			</div>
                        <?php else: ?>
                        	 
                        	<?php $count = 0; ?>  
                        	<?php while(($count < count($specials)) && ($count < 5)): ?> 
                        		<?php if($count == 0): ?>
                        
                        				<div style="width:17.2%;float:left;margin-top:10px;"></div>
                         
			                            <div id="special_img" style="width:40.86%">
			                                <img src="<?=base_url().'application/other/'.$specials[$count]['productimg']?>" style="width:100%;" alt="Picture Not Found." />
			                            </div>
			                            <div id="" class="" style="height:65px;float:left;width:33.118%"></div>
			         
			                            <div id="" class="special_img_text" style="font-size:21pt;color:#46A3FF;">
			                                <?=$specials[$count]['productname']?>
			                            </div>
			                            <div id="" class="special_img_text" style="">
			                                <?=$specials[$count]['singer']?>
			                            </div>
			                            <div id="" class="special_img_text" style="">
			                                <?=$specials[$count]['categoryname']?>
			                            </div>
			                            <div id="" class="special_img_text" style="">
			                                <span style="text-decoration:line-through;">$<?=$specials[$count]['productprice']?></span>&nbsp
			                                <span style="color:#EA0000;font-size:22pt">$<?=$specials[$count]['specialprice']?></span>
			                            </div>
			                            <div id="" class="special_img_text" style="">
			                                Start date: <?=$specials[$count]['startdate']?>
			                            </div>
			                            <div id="" class="special_img_text" style="">
			                                End date: &nbsp<?=$specials[$count]['enddate']?>
			                            </div>
			                            <div id="" class="special_img_text" style="">
			                                <input type="button" onclick="addToCart(<?=$specials[$count]['productid']?>)" value="Add to Cart" style="width:180px;height:45px;font-size:14pt;">
			                            </div>
			                            <div class="product_content_general" >
                        	
                        				 
                        		<?php else: ?>
                        		
                        				<div class="product_sm_window">
		                                <div class="pro_con_img" style="width:180px;height:180px;margin-left:auto;margin-right:auto">
		                                    <img src="<?=base_url().'application/other/'.$specials[$count]['productimg']?>" style="width:180px;height:180px;" alt="Picture Not Found." />
		                                </div>
		                                 <div id="" class="special_img_text_sm" style="font-size:14pt;color:#46A3FF;height:40px;">
		                                <?=$specials[$count]['productname']?> 
		                                </div>
		                                <div id="" class="special_img_text_sm" style="height:34px;">
		                                    <?=$specials[$count]['singer']?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="">
		                                   <?=$specials[$count]['categoryname']?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="">
		                                    Price:&nbsp<span style="text-decoration:line-through;">$<?=$specials[$count]['productprice']?></span>&nbsp
		                                    <span style="color:#EA0000;font-size:14pt">$<?=$specials[$count]['specialprice']?></span>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="">
		                                    Start date: <?=$specials[$count]['startdate']?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="">
		                                    End date: &nbsp<?=$specials[$count]['enddate']?>
		                                </div>
		                                <div id="" class="special_img_text_sm" style="width:160px;margin-left:auto;margin-right:auto">
		                                    <input type="button" onclick="addToCart(<?=$specials[$count]['productid']?>)" value="Add to Cart" style="width:160px;height:30px;font-size:12pt;">
		                                </div>
		                                </div>
                        	
                        			
                        		<?php endif; ?>
                        		<?php $count++; ?>
          					<?php endwhile; ?>
          					<?php if (count($specials) > 5): ?>
          						 
          							<div class="product_sm_window" style="width:60px;font-size:16pt;">
                               		<div style="height:90px;"></div>
                                    	<div class="cl_home_more_0"><a class="more_link" href="javascript:void(0);"  onclick="special(-1)">more...</a></div>
                                	</div>
                                	<div style="clear:both"></div> 
          					 
          					<?php endif; ?>
          					 </div>
                        				<div style="clear:both">
                        				</div> 
                    					</div>   
                    					</div>  
                     
                        <?php endif; ?>



<div id="navlist">
	<?php if (count($categories) == 0): ?>
		No categories.
	<?php else: ?>
		<ul id="nav">
            <li><a href="javascript:void(0);"  onclick="special(-1)">Special Sales</a></li>
            <?php foreach ($categories as $category_item): ?>
    			<li><a href="javascript:void(0);"  onclick="regular_page(<?=$category_item['categoryid']?>)"><?=$category_item['categoryname']?></a></li>
			<?php endforeach ?>
		</ul>
	<?php endif; ?>