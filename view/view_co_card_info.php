<div id="product_content" >
                                <div id="product_head">Credit Card Information & Billing Address</div>

                        <div class="product_content_general" >


                        <div class="cl_div1_2_container" style="padding-top:0px;padding-bottom:50px;width:600px">


                        <div style="height:50px;text-align:center;color:red;font-size:16pt" id="id_error_billing_addr_payment_method_co"></div>
                            <div class="cl_div1_3_left" style="width:240px">
                            Name on Card
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_name_co" <?=$ba_nm?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Card Number
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_card_number_co" <?=$ba_cn?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Expiration Date
                        </div>
                        <div class="cl_div1_3_right">
                            <select onChange="" id="id_ba_expire_mon_co"  name="name_adm_txt_fname">
                                <option value=""></option>


<?php for($i=1;$i<=12;$i++): ?>
        <?php if($i==$expire_month): ?>
                        <option selected="selected" value="<?=$i?>"><?=$i?></option>
        <?php else: ?>
                        <option value="<?=$i?>"><?=$i?></option>
        <?php endif; ?>
<?php endfor; ?>

                      
                            </select>
                            <select onChange="" id="id_ba_expire_year_co"  name="name_adm_txt_fname">
                                <option value=""></option>



<?php for($i=2014;$i<=2032;$i++): ?>
        <?php if($i==$expire_year): ?>
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
                            <input type="text" onChange="" id="id_ba_cvv_co" <?=$ba_cvv?> name="name_adm_txt_fname" size="3">
                        </div>





                        <div class="cl_div1_3_left" style="width:240px">
                            Address
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_addr_co" <?=$ba_addr?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            City
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_city_co" <?=$ba_ct?> name="name_adm_txt_fname">
                        </div>
                        
                        <div class="cl_div1_3_left" style="width:240px">
                            State
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_state_co" <?=$ba_st?> name="name_adm_txt_fname">
                        </div>
                        <div class="cl_div1_3_left" style="width:240px">
                            Zip
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_zip_co" <?=$ba_zip?> name="name_adm_txt_lname">
                        </div>
                       
                        
                        <div class="cl_div1_3_left" style="width:240px">
                            Phone Number
                        </div>
                        <div class="cl_div1_3_right">
                            <input type="text" onChange="" id="id_ba_phone_number_co" <?=$ba_pn?> name="name_adm_txt_email">
                        </div>
                        
                        
                          <div style="clear:both"></div> 
                        
                            <div id="" style="height:25px;"></div>
                            <div id="" style="height:30px;float:left;width:65px;"></div>

                            <div id="" style="height:30px;float:left;width:140px;">
                                <input type="button" id="" value="Previous" onclick="checkOutShippingAddr()" style="width:140px;height:30px;font-size:13pt"> 
                            </div>
                            <div id="" style="height:30px;float:right;width:20px;"></div>
                            <div id="" style="height:30px;float:right;width:140px;">
                                <input type="button" id="" value="Place Order" onclick="checkOutCreditCardConfirm()" style="width:140px;height:30px;font-size:13pt"> 
                            </div>
                      
                         <div style="clear:both"></div> 
                         <div id="" style="height:20px;"></div>
                    </div>                   

                            <div style="clear:both"></div> 
                        </div>
                        <div style="clear:both"></div> 
                    </div>     