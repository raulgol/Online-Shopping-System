<div class="login_nav_element" style="padding-left:10px;"><a href="javascript:void(0);" onclick="cusLogOut()" style="">Log Out</a></div>
                    <div class="login_nav_element" style="padding-right:10px;padding-left:10px;border-right:1px solid white;"><a href="javascript:void(0);" onclick="cart()" style="">Cart(<span id="nav_bar_cart_number" style="color:red"></span>)</a></div>
                    <div class="login_nav_element" style="padding-right:10px;padding-left:10px;border-right:1px solid white;"><a href="javascript:void(0);" onclick="ordersPlaced()" style="">Your Orders</a></div>
                    <div class="login_nav_element" style="padding-right:10px;padding-left:10px;border-right:1px solid white;border-left:1px solid white"><a href="javascript:void(0);" onclick="addr_payment_display()" style="">Address & Payment Info</a></div>
                     
                    <div class="login_nav_element" style="padding-right:10px;">Hi,&nbsp<a href="javascript:void(0);" onclick="editProfilePassword()" style=""><?=$this->session->userdata('customer_first_name');?></a></div>

                    <div class="login_nav_element" style="float:left"><a href="javascript:void(0);"  onclick="startPage()">HOME</a></div>

                    <div style="clear:both"></div>