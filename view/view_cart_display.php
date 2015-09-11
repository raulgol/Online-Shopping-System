              <div class="product_content_general" style="padding:5px;height: 180px;border-top:1px solid white">

                                <div>
                                <div class="pro_con_img" style="width:180px;height:180px;float:left;margin-bottom:0px;margin-left:10px;margin-right:10px">
                                    <img src="<?=base_url().'application/other/'.$productimg?>"  alt="Picture Not Found." style="width:180px;height:180px;"/>
                                </div>

                                <div style="width:280px;float:left;margin-bottom:0px;height:180px;margin-right:10px">
                                    <div id="" class="special_img_text_sm" style="height:30px;"></div>
                                    <div id="" class="special_img_text_sm" style="font-size:14pt;color:#46A3FF;height:60px;">
                                      <?=$productname?>
                                  
                               </div>
                                    <div id="" class="special_img_text_sm" style="height:40px;font-size:13pt"> 
                                       <?=$categoryname?>
                                   </div>
                                    <div id="" class="special_img_text_sm" style="height:40px;font-size:13pt"> 
                                      <?=$singer?>
                                    </div>
                                    
                                     
                                </div>


                                <div style="width:250px;float:left;margin-bottom:0px;height:180px;margin-right:10px">
                                    <div id="" class="special_img_text_sm" style="height:60px;"></div>

                                    <div id="" class="special_img_text_sm" style="font-size:16pt;height:35px;"> 
                          <?php if($isSpecial): ?>
                                             <span style="text-decoration:line-through;">$<?=$price?></span>&nbsp
                                                <span style="color:#EA0000; ">$<?=$specialprice?></span>
                                            </div>
             
                                            <div id="" class="special_img_text_sm" style="height:22px;font-size:12pt">Start Date:  
                                                    <?=$startdate?>
                                            </div>
                                            <div id="" class="special_img_text_sm" style="height:22px;font-size:12pt">End Date: 
                                                    <?=$enddate?>
                                            </div> </div>
                          <?php else: ?>
                                            <span style="">$<?=$price?></span>
                                            </div></div>
                          <?php endif; ?>
                                     
                                 

                              <div style="width:150px;float:left;margin-bottom:0px;height:180px;margin-right:10px">
                                     <div id="" class="special_img_text_sm" style="height:60px;"></div>
                                    <div id="cart_total_price_<?=$pro_id?>" class="special_img_text_sm" style="font-size:16pt;height:40px;">$<?=$totPrice?></div>
                                     
                                     
                                </div>


                               <div style="width:160px;float:left;margin-bottom:0px;height:180px; ">
                                     <div id="" class="special_img_text_sm" style="height:25px;color:red">  </div>
                                     <div id="cart_err_msg_<?=$pro_id?>" class="special_img_text_sm" style="height:30px;color:red;font-size:15pt"></div>
 
                                    
                                    <div id="" class="special_img_text_sm" style="height:45px;font-size:13pt;">
                                        <input type="button" value="-" onclick="cartQtyMinus(<?=$pro_id?>)"  style="height:25px;font-size:11pt;"> 
                                         <input type="text" value="<?=$qty?>" size="4" onchange="cartQtyInput(this.value, <?=$pro_id?>)" id="cartqtyinput_<?=$pro_id?>" style="height:25px;font-size:11pt"> 
                                         <input type="button" value="+" onclick="cartQtyPlus(<?=$pro_id?>)"  style="height:25px;font-size:11pt;"> 
                                    </div>

                                    <div id="" class="special_img_text_sm" style="height:34px;font-size:12pt;">
                                        <a href="javascript:void(0);" onclick="cartItermDelete(<?=$pro_id?>)" >Delete</a>
                                    </div>
                                     
                                </div>
                                
                                </div>
                                <div style="clear:both"></div> 
                            </div>








