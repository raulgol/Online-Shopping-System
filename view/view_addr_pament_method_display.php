 <div id="product_info" style="width:100%;margin-left:0px">
      <div id="product_content">
                        <div id="product_head">Shipping Address</div>

                        <div class="product_content_general" >




                        <div class="cl_div1_2_container" style="padding-top:0px;padding-bottom:50px;width:600px">


                        <div style="height:50px;text-align:center;color:red;font-size:16pt" id="id_error_shipping_addr"></div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Full Name
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_sa_fn" <?=$sa_fn?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Address
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_sa_addr" <?=$sa_addr?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            City
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_sa_city" <?=$sa_ct?> name="name_adm_txt_fname">
                        </div>
                        
                        <div class="cl_div1_3_left" style="width:240px">
                            State
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_sa_state" <?=$sa_st?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Zip
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_sa_zip" <?=$sa_zip?> name="name_adm_txt_lname">
                        </div>
                       
                        
                        <div class="cl_div1_3_left" style="width:240px">
                            Phone Number
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_sa_phone_number" <?=$sa_pn?> name="name_adm_txt_email">
                        </div>
                        
                        
                        <div class="cl_div_butt_adm_emp_info">


                            <div class="cl_div_login_button" id="addr_pament_display_button_0" style="">
                                <?php if($sa_button==0): ?>
                                    <input type="button" value="Add an Address" class="cl_butt_login" onclick="addUpdateShippingAddr()" style="width:180px;height:30px;font-size:13pt">
                                <?php else: ?>
                                    <input type="button" value="Update" class="cl_butt_login" onclick="addUpdateShippingAddr()" style="width:180px;height:30px;font-size:13pt">
                                <?php endif; ?>
                            </div>
                      
                        </div>
                    </div>                   

                            <div style="clear:both"></div> 
                        </div>
                        <div style="clear:both">
                        </div> 


                    </div>   
                   


                    <div id="product_content" style="margin-top:15px">
                                <div id="product_head">Credit Card Information & Billing Address</div>

                        <div class="product_content_general" >


                        <div class="cl_div1_2_container" style="padding-top:0px;padding-bottom:50px;width:600px">


                        <div style="height:50px;text-align:center;color:red;font-size:16pt" id="id_error_billing_addr_payment_method"></div>
                            <div class="cl_div1_3_left" style="width:240px">
                            Name on Card
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_name" <?=$ba_nm?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Card Number
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_card_number" <?=$ba_cn?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Expiration Date
                        </div>
                        <div class="cl_div1_3_right">
                            <select onChange="" id="id_ba_expire_mon"  name="name_adm_txt_fname">
                                <option value=""></option>
                               


<?php for($i=1;$i<=12;$i++): ?>
        <?php if( ($month_year_exist ===true) && ($i==$expire_month)): ?>
                        <option selected="selected" value="<?=$i?>"><?=$i?></option>
        <?php else: ?>
                        <option value="<?=$i?>"><?=$i?></option>
        <?php endif; ?>
<?php endfor; ?>




                            </select>
                            <select onChange="" id="id_ba_expire_year"  name="name_adm_txt_fname">
                                <option value=""></option>




<?php for($i=2014;$i<=2032;$i++): ?>
        <?php if(($month_year_exist ===true)&&($i==$expire_year) ): ?>
                        <option selected="selected" value="<?=$i?>"><?=$i?></option>
        <?php else: ?>
                        <option value="<?=$i?>"><?=$i?></option>
        <?php endif; ?>
<?php endfor; ?>



                            </select>
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            CVV Number
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_cvv" <?=$ba_cvv?> name="name_adm_txt_fname" size="3">
                        </div>





                        <div class="cl_div1_3_left" style="width:240px">
                            Address
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_addr" <?=$ba_addr?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            City
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_city" <?=$ba_ct?> name="name_adm_txt_fname">
                        </div>
                        
                        <div class="cl_div1_3_left" style="width:240px">
                            State
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_state" <?=$ba_st?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Zip
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_zip" <?=$ba_zip?> name="name_adm_txt_lname">
                        </div>
                       
                        
                        <div class="cl_div1_3_left" style="width:240px">
                            Phone Number
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_phone_number" <?=$ba_pn?> name="name_adm_txt_email">
                        </div>
                        
                        
                        <div class="cl_div_butt_adm_emp_info">


                            <div class="cl_div_login_button" id="addr_pament_display_button_1" style="">
                               <?php if($ba_button==0): ?>
                                    <input type="button" value="Add an Credit Card" class="cl_butt_login" onclick="addUpdateCreditCard()" style="width:180px;height:30px;font-size:13pt">
                                <?php else: ?>
                                    <input type="button" value="Update" class="cl_butt_login" onclick="addUpdateCreditCard()" style="width:180px;height:30px;font-size:13pt">
                                <?php endif; ?>
                            </div>

     
                        </div>
                    </div>

  

                            <div style="clear:both"></div> 
                        </div>
                        <div style="clear:both"></div> 
                        


                    </div> </div>    <div style="clear:both"></div> 