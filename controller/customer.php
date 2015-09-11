<?php
	class Customer extends CI_Controller {
		public function __construct() {
    		parent::__construct();
    		$this->load->model('address_model');
    		$this->load->model('specials_model');
    		$this->load->model('categories_model');
    		$this->load->model('products_model');
    		$this->load->model('customer_model');
    		$this->load->model('cart_model'); 
    		$this->load->model('order_model');
    		$this->load->model('account_model');
    		//$this->load->model('news_model');
    		//$data['title'] = 'c';
    		//$this->load->view('test_view',$data);
  		}
  		
		function index() {
			 	//$data['specials'] = $this->specials_model->get_all_special();
			 	//$data['categories'] = $this->categories_model->get_all_categories();
			//if($this->agent->is_mobile()) {
			//	$this->load->view('mobile_view_head');
			//}
			//else {
				$this->load->view('view_head');
				//$this->displayNavBar();
				$this->load->view('view_middle');
				//$this->load->view('view_home', $data);
				$this->load->view('view_foot');
			//}
			 
		}
		
		
		function butt_change_1() {
			$this->load->view('view_butt_change_1');
		}
		function butt_change_0() {
			$this->load->view('view_butt_change_0');
		}
		function edit_prof_succeed() {
			$this->load->view('view_edit_prof_succeed');
		}
		function create_acc_succeed() {
			$this->load->view('view_create_acc_succeed');
		}
		function change_pw_succeed() {
			$this->load->view('view_change_pw_succeed');
		}
		function view_edit_profile_password() {
			$this->time_out_logout();
			$this->load->view('view_edit_profile_password');
		}
		function change_password_disp() {
			$this->time_out_logout();
			$this->load->view('view_change_password_disp');
		}
		function time_out_logout() {
			if($this->session->userdata('timeout_customer') !== false) {
    			if($this->session->userdata('timeout_customer') + 1800 < time()){
    				$this->session->sess_destroy();
    				$this->load->view('view_log_out');
    				$this->output->_display();	
    				exit();
    			} 
			}
		}
		function startpage() {

			$this->time_out_logout();





			$data['specials'] = $this->specials_model->get_all_special();
			$data['categories'] = $this->categories_model->get_all_categories();
			$this->load->view('view_home', $data);
		}
		function displayNavBar() {
			$customer_id = $this->session->userdata('customer_id');
   			if(!empty($customer_id)) {
        		$this->load->view('view_nav_bar_logged');
        	} else {
				$this->load->view('view_nav_bar_unlogged');
        	}   
		}
		function regularPage() {
			$this->time_out_logout();
			$category_id = $this->input->post('cid');
			$data['category_id'] = $category_id;
			$data['category_name'] = $this->categories_model->get_certian_category($category_id);
			$this->load->view('view_regular_page0',$data);

			$cer_specials = array();
			$cer_specials = $this->specials_model->get_certain_special($category_id);
			//$data['cer_specials'] = 
			if(count($cer_specials) == 0) {
				$this->load->view('view_reg_page_no_special');
			}
			else {
				$i = 0;
				if($this->agent->is_mobile()) {
					while(($i < count($cer_specials)) && ($i < 2)) {// $cer_specials as $data['special_item']
						$data['special_item'] = $cer_specials[$i];
						$this->load->view('view_reg_page_specials', $data);
						$i++;
					}
					if(count($cer_specials) > 2) {
						$this->load->view('view_reg_page_spe_more', $data);
					}
				}
				else{
					while(($i < count($cer_specials)) && ($i < 4)) {// $cer_specials as $data['special_item']
					$data['special_item'] = $cer_specials[$i];
					$this->load->view('view_reg_page_specials', $data);
					$i++;
					}
					if(count($cer_specials) > 4) {
						$this->load->view('view_reg_page_spe_more', $data);
					}
				}
				
			}
			$this->load->view('view_regular_page1',$data);
			//
			$cer_products = array();
			$cer_products = $this->products_model->get_certian_products($category_id);
			if(count($cer_products) == 0) {
				$this->load->view('view_reg_page_no_products');
			}
			else {
				foreach($cer_products as $product_item) {
					$isSpecial = array();
					$isSpecial = $this->specials_model->is_special($product_item['productid']);
					$pro = array();
					$pro['product_item'] = $product_item;
					$this->load->view('view_reg_page_pro0', $pro);
					if(count($isSpecial) == 0) {
						$this->load->view('view_reg_page_price_normal', $pro);
					}
					else {
						$pro['special_price'] = $isSpecial[0];
						$this->load->view('view_reg_page_price_special', $pro);
					}
					$this->load->view('view_reg_page_pro1', $pro);
				}
			}
			$this->load->view('view_regular_page2');
		}
		function display_special() {
			$this->time_out_logout();
			$data['category_id_special'] = $this->input->post('cid');
			
			if($data['category_id_special'] != -1) {
				$data['c_name'] = $this->categories_model->get_certian_category($data['category_id_special']); 
				$data['specials'] = $this->specials_model->get_certain_special($data['category_id_special']);
			}
			else {
				$data['specials'] = $this->specials_model->get_all_special();
			}
			 
				$this->load->view('view_specials', $data);
 

			 
		}
		function disp_login_page() {
			$this->time_out_logout();
			$this->load->view('view_login_page');
		}
		function display_create_acc() {
			$this->time_out_logout();
			$this->load->view('view_create_acc');
		}
		function login_confirm() {
			$this->time_out_logout();
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if(($username==''||$username==null)&&($password==''||$password==null)) {
        		echo '1';
        		exit();
    		}
    		if(($username==''||$username==null)||($password==''||$password==null)) {
        		echo '2';
        		exit();
    		}
    		$cus_account = array();
    		$cus_account = $this->customer_model->does_exist($username, $password);
    		if(count($cus_account) == 1) {
		        
		        $this->session->set_userdata('customer_first_name', $cus_account[0]['cus_fname']);
		        $this->session->set_userdata('customer_id', $cus_account[0]['customerid']);
		        $this->session->set_userdata('timeout_customer', time());
		        //$_SESSION['timeout_customer'] = time();
		         
		        $this->cartMerge();
		        if($this->session->userdata('login_flag')) {
		            
		            $this->session->unset_userdata('login_flag');
		            echo '3'; // send to cart
		            exit();
		        }
		        else {
		            echo '0';
		            exit();
		        }
	        //echo '0';
	    	}
	    	else {
	        	echo '2';
	        	exit();
	    	} 
		}
		function cartMerge() {
			if ($this->session->userdata('cart') !== false) {
				$cart_arr = array();
				$cart_arr = $this->session->userdata('cart');
            if(count($cart_arr)!=0) {
                // merge
                foreach($cart_arr as $key => $item) {
                    //$sql_check = 'select * from cart where customerid="'.$_SESSION['customer_id'].'" and productid="'.$item['pro_id'].'";';
                    //$res_check = mysql_query($sql_check);
                    $cart_db = array();
    				$cart_db = $this->cart_model->does_exist($this->session->userdata('customer_id'), $item['pro_id']);
                    if(count($cart_db)==0) {
                        //$sql_merge='INSERT INTO cart(cartindex,customerid,productid,productqtty) VALUES (NULL , "'.$_SESSION['customer_id'].'", "'.$item['pro_id'].'", "'.$item['qty'].'");';
                        //echo $sql_merge.'     ';///
                        //exit();
                        $this->cart_model->cart_insert($this->session->userdata('customer_id'), $item['pro_id'], $item['qty']);
                    }
                    else {
                        //$row_merge = mysql_fetch_assoc($res_check);
                        $merged_qty=$cart_db[0]['productqtty']+$item['qty'];
                        //$sql_merge='UPDATE cart SET productqtty = "'.$merged_qty.'" WHERE customerid="'.$_SESSION['customer_id'].'" and productid="'.$item['pro_id'].'" ;';//'NSERT INTO cart(cartindex,customerid,productid,productqtty) VALUES (NULL , "'.$_SESSION['customer_id'].'", "'.$item['pro_id'].'", "'.$merged_qty.'");';
                        $this->cart_model->cart_update($this->session->userdata('customer_id'), $item['pro_id'], $merged_qty);
                    }
                    //
                    //$res_merge = mysql_query($sql_merge);
                }
            }
            $this->session->unset_userdata('cart');
        	}
		}
		function add_to_cart() {
			$this->time_out_logout();
						$pro_id = $this->input->post('pro_id');
					    if($this->session->userdata('customer_first_name') === false ) {
					        //if($pid<1 or $q<1) return;
					        if ($this->session->userdata('cart') !== false) {
					                $exists = false;
					                $cart_arr = array();
					                $cart_arr = $this->session->userdata('cart');

					                $max=count($cart_arr);
					                for ($i=0; $i < $max; $i++) {
					                    if($cart_arr[$i]['pro_id'] == $pro_id) {
					                        $cart_arr[$i]['qty']++;
					                        $exists = true;
					                        break;
					                    }
					                }
					                if (!$exists) {
					                    $cart_arr[$max]['pro_id']=$pro_id;
					                    $cart_arr[$max]['qty'] = 1;
					                }
					                $this->session->set_userdata('cart', $cart_arr);// = ;
					                //$_SESSION['cart']['itemId']['qty']= $_SESSION['cart']['itemId']['qty'] + $q;
					                //$max=count($_SESSION['cart']);
					                //echo "SECOND";
					        }
					        else {
					                $cart_arr=array();
					                $cart_arr[0]['pro_id']=$pro_id;
					                $cart_arr[0]['qty'] = 1;
					                $this->session->set_userdata('cart', $cart_arr);
					                //$max=count($_SESSION['cart']);
					        }

					    }
					    else {
					        //$sql_check = 'select productqtty from cart where customerid='.$_SESSION['customer_id'].' and productid='.$pro_id;
					        //$sql_insert = 'INSERT INTO cart (cartindex,customerid,productid,productqtty)VALUES (NULL , "'.$_SESSION['customer_id'].'", "'.$pro_id.'", "1");  ';
					        //$sql_update = 'UPDATE `test`.`cart` SET `productqtty` = '2' WHERE `cart`.`cartindex` =1 LIMIT 1 ;';

					        $c_arr = array();
					        $c_arr = $this->cart_model->does_exist($this->session->userdata('customer_id'), $pro_id);
					         
					        //$res_check = mysql_query($sql_check);
					        
					         
					         if(count($c_arr) != 0) {
					             
					            $qty = $c_arr[0]['productqtty'];
					            $qty++;
					            //$sql_update = 'UPDATE cart SET productqtty = "'.$qty.'" WHERE customerid='.$_SESSION['customer_id'].' and productid='.$pro_id.';';
					            //$res_update = mysql_query($sql_update);
					            $q = $this->cart_model->cart_update($this->session->userdata('customer_id'), $pro_id, $qty);
					            if($q) {// update success
					                echo '0';
					            }
					            else {// update fail
					                echo '1';
					            }
					         }
					         else {
					            $q = $this->cart_model->cart_insert($this->session->userdata('customer_id'), $pro_id, "1");
					            if($q) {// insert success
					                echo '2';
					            }
					            else {// insert fail
					                echo '3';
					            }
					         }
					    }
		}
		function cus_log_out() {
			$this->session->sess_destroy();
		}
		function nav_bar_cart_num() {
				if($this->session->userdata('customer_id') === false ) {
  
			        if($this->session->userdata('cart') === false) {
			            echo '0';
			            exit();
			        }
			        else {
			            echo count($this->session->userdata('cart'));
			            exit();
			        }
			    }
			    else {
			        echo $this->cart_model->cart_num($this->session->userdata('customer_id'));
			        exit();
			    }
		}
		function cart_display() {
			$this->time_out_logout();
				if($this->session->userdata('customer_id') === false) {
			        if ($this->session->userdata('cart') !== false) {
			            //echo 'abc';
			            //$result=$frag0.$frag1.'';
			            $this->load->view('view_cart_display0');
			            //$max=count($_SESSION['cart']);
			            foreach($this->session->userdata('cart') as $item) {
			            	//echo 'def';
			                $cart_arr = array();
			                $cart_arr = $this->products_model->get_a_product($item['pro_id']);
			                //echo $item['pro_id'];
			                $data['isSpecial'] = false;
			                $data['specialprice'] = '';
			                $data['startdate'] = '';
			                $data['enddate'] = '';
			                $data['totPrice'] = 0;
			                if(count($cart_arr) != 0) {
			                    //$row = mysql_fetch_assoc($res0);
			                	$spe_arr = array();
			                	$spe_arr = $this->specials_model->is_special($item['pro_id']);
			                    
			                    if(count($spe_arr) != 0) {
			                    	$data['isSpecial'] = true;
			                    	$data['specialprice'] = $spe_arr[0]['specialprice'];
			                		$data['startdate'] = $spe_arr[0]['startdate'];
			                		$data['enddate'] = $spe_arr[0]['enddate'];
			                		$data['totPrice'] = $spe_arr[0]['specialprice']*$item['qty'];
			                		//echo $spe_arr[0]['specialprice'].' | '.$item['qty'].' | '.$data['totPrice'];
			                		//exit();
			                    }
			                    else {
			                    	$data['isSpecial'] = false;
			                		$data['specialprice'] = '';
			                		$data['startdate'] = '';
			                		$data['enddate'] = '';
			                		$data['totPrice'] = $cart_arr[0]['productprice']*$item['qty'];
			                    }
			                    $data['productimg'] = $cart_arr[0]['productimg'];
			                    $data['productname'] = $cart_arr[0]['productname'];
			                    $data['categoryname'] = $cart_arr[0]['categoryname'];
			                    $data['singer'] = $cart_arr[0]['singer'];
			                    $data['pro_id'] = $item['pro_id'];
			                    $data['qty'] =  $item['qty'];
			                    $data['price'] = $cart_arr[0]['productprice'];


			                    $this->load->view('view_cart_display', $data);

			                    //$result=$result.$frag2_0.$row['productimg'].$frag2_1.$row['productname'].$frag3.$row['categoryname'].$frag4.$row['singer'].$frag5.$price_info.$frag8.$item['pro_id'].$frag8_0.'$'.$totprice.$frag9_0.$item['pro_id']
			                      //      .$frag9_0_0.$item['pro_id'].$frag9_1.$item['qty'].$frag9_2.$item['pro_id'].$frag9_2_0.$item['pro_id'].$frag9_2_1.$item['pro_id'].$frag9_3.$item['pro_id'].$frag9_4;
			                }
			                else {
			                    // need to modify
			                }
			            } 
			            $this->load->view('view_cart_display_foot');
			            //$result=$result.$frag10.$frag11; 
			            //echo $result;
			             //mysql_close($con);

			        }
			        else {
			            $this->load->view('view_cart_display_empty');
			        }
			    }
			    else {
			        $c_arr = array();
			        $c_arr = $this->cart_model->cart_certain_customer($this->session->userdata('customer_id'));
			        if(count($c_arr) != 0) {
			            $this->load->view('view_cart_display0');
			            //$max=count($_SESSION['cart']);
			            foreach($c_arr as $item ) {
			                $cart_arr = array();
			                $cart_arr = $this->products_model->get_a_product($item['productid']);
			                $data['isSpecial'] = false;
			                $data['specialprice'] = '';
			                $data['startdate'] = '';
			                $data['enddate'] = '';
			                if(count($cart_arr) != 0) {
			                    $spe_arr = array();
			                	$spe_arr = $this->specials_model->is_special($item['productid']);
			                    if(count($spe_arr) != 0) {
			                    	$data['isSpecial'] = true;
			                    	$data['specialprice'] = $spe_arr[0]['specialprice'];
			                		$data['startdate'] = $spe_arr[0]['startdate'];
			                		$data['enddate'] = $spe_arr[0]['enddate'];
			                		$data['totPrice'] = $spe_arr[0]['specialprice']*$item['productqtty'];
			                        
			                    }
			                    else {
			                    	$data['isSpecial'] = false;
			                		$data['specialprice'] = '';
			                		$data['startdate'] = '';
			                		$data['enddate'] = '';
			                		$data['totPrice'] = $cart_arr[0]['productprice']*$item['productqtty'];
			                    }
			                    $data['productimg'] = $cart_arr[0]['productimg'];
			                    $data['productname'] = $cart_arr[0]['productname'];
			                    $data['categoryname'] = $cart_arr[0]['categoryname'];
			                    $data['singer'] = $cart_arr[0]['singer'];
			                    $data['pro_id'] = $item['productid'];
			                    $data['qty'] =  $item['productqtty'];
			                    $data['price'] = $cart_arr[0]['productprice'];


			                    $this->load->view('view_cart_display', $data);
			                }
			                else {
			                    // need to modify
			                }
			            }
			            $this->load->view('view_cart_display_foot');
			        }
			        else {
			            $this->load->view('view_cart_display_empty');
			        }


			    }
		}
		function cart_qty_input() {
			$this->time_out_logout();
			$id=$this->input->post('id');
			$mode=$this->input->post('mode');
			$qty=$this->input->post('qty');
			 
			    if($this->session->userdata('customer_id') === false) {
			        if($mode==-1) {
			        	$cart_arr = array();
			        	$cart_arr = $this->session->userdata('cart');
			            foreach($cart_arr as $key => $item) {
			                if($item['pro_id']==$id) {
			                	unset($cart_arr[$key]);

			                	$count_number_0123 = 0;
			                	$cart_arr_new = array();
			                	foreach ($cart_arr as $cart_arr_old_item) {
			                		$cart_arr_new[$count_number_0123] = $cart_arr_old_item;
			                		$count_number_0123++;
			                	}
			                	$this->session->set_userdata('cart', $cart_arr_new);
			                	//$delete_item = array('pro_id' => $item['pro_id'], 'qty' => $item['qty']);
								//$this->session->unset_userdata($delete_item);
			                    //$this->session->unset_userdata('cart');//unset($_SESSION['cart'][$key]);
			                }
			            }
			            if(count($this->session->userdata('cart'))==0) {
			                $this->session->unset_userdata('cart');
			            }
			           

			        }
			        if($mode==1) {
			            if (preg_match('/^[1-9][0-9]*$/', $qty)) {
			                
			                $cart_arr = array();
			        		$cart_arr = $this->session->userdata('cart');
			                foreach($cart_arr as $key1 => $item1) {
			                    if($item1['pro_id']==$id) {
			                        //$_SESSION['cart'][$key1]['qty']=$qty;
			                        $cart_arr[$key1]['qty']=$qty;
			                        $this->session->set_userdata('cart', $cart_arr);
			                    }
			                }
			                //print_r($_SESSION['cart']);
			                echo '1';
			            }
			            else {
			                
			                $cart_arr = array();
			        		$cart_arr = $this->session->userdata('cart');
			                foreach($cart_arr as $key1 => $item1) {
			                    if($item1['pro_id']==$id) {
			                        $cart_arr[$key1]['qty']=1;
			                        $this->session->set_userdata('cart', $cart_arr);
			                    }
			                }
			               // print_r($_SESSION['cart']);
			                echo '-1';

			            }
			   

			        }
			       
			    }
			    else {
			        if($mode==-1) {
			            $this->cart_model->cart_delete($this->session->userdata('customer_id'), $id);
			        }
			        if($mode==1) {
			            if (preg_match('/^[1-9][0-9]*$/', $qty)) {
			                //echo '1';
			                //$sql_update='UPDATE cart SET productqtty = "'.$qty.'" WHERE  customerid='.$_SESSION['customer_id'].' and productid = '.$id.' LIMIT 1 ;';
			                //$res_update = mysql_query($sql_update);
			                $cart_update_result = $this->cart_model->cart_update($this->session->userdata('customer_id'), $id, $qty);
			                if($cart_update_result === false) {
			                    echo '2';
			                }
			                else {
			                    echo '1';
			                }
			                //print_r($_SESSION['cart']);
			            }
			            else {
			                //echo '-1';
			                $cart_update_result = $this->cart_model->cart_update($this->session->userdata('customer_id'), $id, 1);
			                if($cart_update_result === false) {
			                    echo '2';
			                }
			                else {
			                    echo '-1';
			                }
			               // print_r($_SESSION['cart']);
			            }

			        }

			    } 
		}
		function cart_total_price() {
			    $id=$this->input->post('id');

			    if($this->session->userdata('customer_id') === false) {
			            foreach($this->session->userdata('cart') as $item) {
			                if($item['pro_id']==$id) {
			                    $spe_arr = array();
			                	$spe_arr = $this->specials_model->is_special($id);
			                    if(count($spe_arr) != 0) {
			                     
			                        
			                        $totprice = $spe_arr[0]['specialprice']*$item['qty'];
			                        echo '$'.$totprice;
			                        exit();
			                    }
			                    $cart_arr = array();
			                	$cart_arr = $this->products_model->get_a_product($id);
			                    if(count($cart_arr) != 0) {
			                        $totprice = $cart_arr[0]['productprice']*$item['qty'];
			                        echo '$'.$totprice;
			                        exit();
			                    }
			                }
			            }
			    }
			    else {
			                //$sql_qty='select productqtty from cart WHERE customerid='.$_SESSION['customer_id'].' and productid = '.$id.' LIMIT 1;';
			                //$res_qty = mysql_query($sql_qty);
			    			$arr = array();
			    			$arr = $this->cart_model->does_exist($this->session->userdata('customer_id'), $id);
			                if(count($arr) != 0) {
			                         

			                    $spe_arr = array();
			                	$spe_arr = $this->specials_model->is_special($id);
			                    if(count($spe_arr) != 0) {
			                        
			                        $totprice = $spe_arr[0]['specialprice']*$arr[0]['productqtty'];
			                        echo '$'.$totprice;
			                        exit();
			                    }
			                    $cart_arr = array();
			                	$cart_arr = $this->products_model->get_a_product($id);
			                    if(count($cart_arr) != 0) {
			                        $totprice = $cart_arr[0]['productprice']*$arr[0]['productqtty'];
			                        echo '$'.$totprice;
			                        exit();
			                    }
			                }

			              
			            

			    }
		}
		function recommand() {
			$cart_arr_recommand = array();
			if($this->session->userdata('customer_id') === false) {  // not logged in
				if(($this->session->userdata('cart') === false) || (($this->session->userdata('cart') !== false) && count($this->session->userdata('cart')) == 0) ) { 
					exit();
				} 
				$cart_arr_recommand = $this->session->userdata('cart');
			} 
			else {
			    $cart_arr_recommand = $this->cart_model->cart_all($this->session->userdata('customer_id'));
			    if(count($cart_arr_recommand) == 0) {
			    	exit();
			    }
			}
			$cart = array();
			$cart = $this->cart_model->recommand($cart_arr_recommand);
			if(count($cart) == 0) {
				$this->load->view('view_recommand_empty');
		    }
		    else {
		    	$data['isSpecial'] = false;
			    $data['specialprice'] = '';
			    $data['startdate'] = '';
			    $data['enddate'] = '';
		    	foreach($cart as $row_recommand) {
		    					$spe_arr = array();
			                	$spe_arr = $this->specials_model->is_special($row_recommand['proid']);
			                    if(count($spe_arr) != 0) {
			                    	$data['isSpecial'] = true;
			                    	$data['specialprice'] = $spe_arr[0]['specialprice'];
			                		$data['startdate'] = $spe_arr[0]['startdate'];
			                		$data['enddate'] = $spe_arr[0]['enddate'];
			                    }
			                    else {
			                    	$data['isSpecial'] = false;
			                		$data['specialprice'] = '';
			                		$data['startdate'] = '';
			                		$data['enddate'] = '';
			                    }
			                    $data['productimg'] = $row_recommand['productimg'];
			                    $data['productname'] = $row_recommand['productname'];
			                    $data['categoryname'] = $row_recommand['categoryname'];
			                    $data['singer'] = $row_recommand['singer'];
			                    $data['pro_id'] = $row_recommand['proid'];
			                   // $data['qty'] =  $row_recommand['productqtty'];
			                    $data['price'] = $row_recommand['productprice'];
			                    $data['s'] = $row_recommand['s'];

			                    $this->load->view('view_recommand_display', $data);
		    	}
		    }


		}
		function orders_placed_display() {
			if($this->session->userdata('customer_id') === false) {
				$this->load->view('view_order_not_logged');
				$this->output->_display();
	        	exit();
    		}
    		$this->time_out_logout();	
    		$order_arr = array();
			$order_arr = $this->order_model->orders($this->session->userdata('customer_id'));
    		if(count($order_arr) == 0) {
    			$this->load->view('view_order_empty');
    		}
    		else {
		    $order_smry = '';
		    $this->load->view('view_order_head');
		    //  view_order_foot.php  view_order_content.php
		    foreach($order_arr as $row) {
		        if($row['shipping_addr'] == null || $row['shipping_addr'] == '') {
		            $fn = '';
		        }
		        else {
		            $sa_arr = array();
		            $sa_arr = split (",", $row['shipping_addr']);///^[,]$/
		            $fn = $sa_arr[0];
		        }
		        //echo $fn;
		        if($row['orderdate'] == null || $row['orderdate'] == '') {
		            $date = '';
		        }
		        else {
		            $od_arr = array();
		            $od_arr = split("-", $row['orderdate']);
		            $y = $od_arr[0];
		            $m = $od_arr[1];
		            $d = $od_arr[2];
		            //echo $y.' '.$m.' '.$d;
		            $m = $this->month_proc($m);
		            $date = $m.' '.$d.', '.$y;
		        }
		        $data['orderindex'] = $row['orderindex'];
		        $data['orderdate'] = $date;
		        $data['order_totalcost'] = $row['totalcost'];
		        $data['order_fn'] = $fn;
		        $this->load->view('view_order_content', $data);        
		    }
		    $this->load->view('view_order_foot');
    		}
		}
		function details_of_orders_display() {
			$id=$this->input->post('id');
			if($this->session->userdata('customer_id') === false) {
				$this->load->view('view_order_not_logged');
	        	$this->output->_display();
				exit(); 
    		}
    		$this->time_out_logout();	
    		$order_arr = array();
			$order_arr = $this->order_model->order_detail($id);
    		if(count($order_arr) != 0) {
    			$data['totalcost'] = $order_arr[0]['totalcost'];

	        	if($order_arr[0]['orderdate'] == null || $order_arr[0]['orderdate'] == '') {
	            	$data['date'] = '';
	        	}
	        	else {
		            $y = ''; $m = ''; $d = '';
		            $date_arr = array();
		            $date_arr = split("-", $order_arr[0]['orderdate']);
		            $y = $date_arr[0]; $m = $date_arr[1]; $d = $date_arr[2];
		            $m = $this->month_proc($m);
		            $data['date'] = $m.' '.$d.', '.$y;
	        	}

        // shipping addr
		        $data['sa1'] = '';$data['sa2'] = '';$data['sa3'] = '';$data['sa4'] = '';$data['sa5'] = '';
		        $data['ba1'] = '';$data['ba2'] = '';$data['ba3'] = '';$data['ba4'] = '';$data['ba5'] = '';
		        
		        $sa_arr = array();
		        $sa_arr = split (",", $order_arr[0]['shipping_addr']);///^[,]$/
		        $data['sa1'] = $sa_arr[0]; $data['sa2'] = $sa_arr[1]; $data['sa3'] = $sa_arr[2].', '.$sa_arr[3];
		        $data['sa4'] = $sa_arr[4]; $data['sa5'] = $sa_arr[5];

		        $ba_arr = array();
		        $ba_arr = split (",", $order_arr[0]['billing_addr']);///^[,]$/
		        $data['ba1'] = $ba_arr[0]; $data['ba2'] = $ba_arr[1]; $data['ba3'] = $ba_arr[2].', '.$ba_arr[3];
		        $data['ba4'] = $ba_arr[4]; $data['ba5'] = $ba_arr[5];
		    }
		    else {
		    	$this->load->view('view_oder_detail_error');
		    	$this->output->_display();
				exit(); 
		    }
		    $order01_arr = array();
			$order01_arr = $this->order_model->one_order_detail($id);
			if(count($order01_arr) == 0) {
				$this->load->view('view_oder_detail_error1');
		    	$this->output->_display();
				exit(); 
    		}
    		$data['order_id'] = $id;
    		$this->load->view('view_order_detail_head', $data);
    		foreach($order01_arr as $od_row) {
    			$res = array();
				$res = $this->products_model->get_a_product($od_row['proid']);
				$temp = array();
				$temp['proprice'] = $od_row['proprice'];
				$temp['tot_price_0'] = $od_row['proprice'] * $od_row['proqtty'];
				$temp['proqtty'] = $od_row['proqtty'];
				if(count($res) != 0) {
					$temp['productimg'] =$res[0]['productimg'];
					$temp['productname'] = $res[0]['productname'];
					$temp['categoryname'] = $res[0]['categoryname'];
					$temp['singer'] = $res[0]['singer'];
            		//$content = $content.$c0.$row_pro['productimg'].$c1.$row_pro['productname'].$c2.$row_pro['categoryname'].$c3.$row_pro['singer'].$c4.$row_order_detail['proprice'].$c5
            		//.$tot_price_0.$c6.$row_order_detail['proqtty'].$c7;
        		}
        		else {
        			$temp['productimg'] ='';
					$temp['productname'] = '';
					$temp['categoryname'] = '';
					$temp['singer'] = '';
            		//$content = $content.$c0.$c1.$c2.$c3.$c4.$row_order_detail['proprice'].$c5
            		//.$tot_price_0.$c6.$row_order_detail['proqtty'].$c7;
        		}
        		$this->load->view('view_order_detail_content', $temp);
    		}
    		$this->load->view('view_order_detail_foot');
		}
		function month_proc($m) {
			if($m == 1 || $m == '01') {
                $m = 'Jan';
            }
            if($m == 2 || $m == '02') {
                $m = 'Feb';
            }
            if($m == 3 || $m == '03') {
                $m = 'Mar';
            }
            if($m == 4 || $m == '04') {
                $m = 'Apr';
            }
            if($m == 5 || $m == '05') {
                $m = 'May';
            }
            if($m == 6 || $m == '06') {
                $m = 'Jun';
            }
            if($m == 7 || $m == '07') {
                $m = 'Jul';
            }
            if($m == 8 || $m == '08') {
                $m = 'Aug';
            }
            if($m == 9 || $m == '09') {
                $m = 'Sep';
            }
            if($m == 10 || $m == '10') {
                $m = 'Oct';
            }
            if($m == 11 || $m == '11') {
                $m = 'Nov';
            }
            if($m == 12 || $m == '12') {
                $m = 'Dec';
            }
            return $m;
		}
		function proceed_to_co() {
			$this->time_out_logout();
			    if($this->session->userdata('customer_id') === false) {
        			$this->session->set_userdata('login_flag', 1);
        			echo '0';
    			}
    			else {
        			echo '1';
    			}
		}
		function check_out_shipping_addr() {
			if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
			}
			$this->time_out_logout();
			$addr_arr = array();
			$addr_arr = $this->address_model->shipping_addr_retrieve($this->session->userdata('customer_id'));
			
			$data['sa_fn'] = '';   $data['sa_addr'] = '';  $data['sa_ct'] = '';
			$data['sa_st'] = '';   $data['sa_zip'] = '';  $data['sa_pn'] = ''; 
			if(count($addr_arr) != 0) {
				$data['sa_fn'] = ' value="'.$addr_arr[0]['fullname'].'" ';    $data['sa_addr'] = ' value="'.$addr_arr[0]['addressline'].'" ';  
				$data['sa_ct'] = ' value="'.$addr_arr[0]['city'].'" ';        $data['sa_st'] = ' value="'.$addr_arr[0]['state'].'" ';    
				$data['sa_zip'] = ' value="'.$addr_arr[0]['zip'].'" ';  	  $data['sa_pn'] = ' value="'.$addr_arr[0]['phonenumber'].'" '; 
    		}
    		$this->load->view('view_co_shipping_addr', $data);
		}
		function add_update_shipping_addr() {
			if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
			}
			$this->time_out_logout();
			$sa_fn = $this->input->post('sa_fn');
    		$sa_addr = $this->input->post('sa_addr');
    		$sa_city = $this->input->post('sa_city');
    		$sa_state = $this->input->post('sa_state');
    		$sa_zip = $this->input->post('sa_zip');
    		$sa_pn = $this->input->post('sa_pn');
    		if($sa_fn==null || $sa_fn=='') {
        		echo '4';
        		exit();
    		}
		    if(!preg_match('/^[a-zA-Z ]{1,50}$/',$sa_fn)){
		        echo '5';
		        exit();
		    }
		    if($sa_addr==null || $sa_addr=='') {
		        echo '6';
		        exit();
		    }
		    if(!preg_match('/^[a-zA-Z0-9 ]{1,100}$/',$sa_addr)){
		        echo '7';
		        exit();
		    }
		    if($sa_city==null || $sa_city=='') {
		        echo '8';
		        exit();
		    }
		    if(!preg_match('/^[a-zA-Z ]{1,30}$/',$sa_city)){
		        echo '9';
		        exit();
		    }
		    if($sa_state==null || $sa_state=='') {
		        echo '10';
		        exit();
		    }
		    if(!preg_match('/^[a-zA-Z ]{1,20}$/',$sa_state)){
		        echo '11';
		        exit();
		    }
		    if($sa_zip==null || $sa_zip=='') {
		        echo '12';
		        exit();
		    }
		    if(!preg_match('/^\d{5}(?:[-\s]\d{4})?$/',$sa_zip)){
		        echo '13';
		        exit();
		    }
		    if($sa_pn==null || $sa_pn=='') {
		        echo '14';
		        exit();
		    }
		    if(!preg_match('/^(?:\([2-9][0-9]{2}\)\ ?|[2-9][0-9]{2}(?:\-?|\ ?))[2-9][0-9]{2}[- ]?[0-9]{4}$/',$sa_pn)){ 
		        echo '15';
		        exit();
		    }
		    $addr_arr = array();
			$addr_arr = $this->address_model->shipping_addr_retrieve($this->session->userdata('customer_id'));
			if(count($addr_arr) != 0) {
        		$mode = 1;
    		}
    		else {
        		$mode=0;
    		}
    		if($mode==0) {
        		$res = $this->address_model->shipping_addr_insert($this->session->userdata('customer_id'), $sa_fn, $sa_addr, $sa_city, $sa_state, $sa_zip, $sa_pn);
    		}
    		else {
        		$res = $this->address_model->shipping_addr_update($this->session->userdata('customer_id'), $sa_fn, $sa_addr, $sa_city, $sa_state, $sa_zip, $sa_pn);
    		}
    		if($res) {
		        if($mode==0) {
		            echo '0';//'An shipping address has been successfully added.'; //succeed
		            exit();
		        }
		        else {
		            echo '1';//'The shipping address has been successfully updated.';// unknown error
		            exit();
		        }
	        
	    	}
	    	else {
		        if($mode==0) {
		            echo '2';//'Error: the shipping address can not be added.'; //succeed
		            exit();
		        }
		        else {
		            echo '3';//'Error: the shipping address can not be updated.';// unknown error
		            exit();
		        }
	    	}
		}
		function check_out_credit_card() {
			if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
			}
			$this->time_out_logout();
			$billing_addr_arr = array();
			$billing_addr_arr = $this->address_model->billing_addr_retrieve($this->session->userdata('customer_id'));
			$card_info_arr = array();
			$card_info_arr = $this->address_model->card_info_retrieve($this->session->userdata('customer_id'));
				$data['ba_nm'] = '';    
		        $data['ba_cn'] = '';    
		        $data['expire_month'] = '';
		        $data['expire_year'] = '';
		        $data['ba_cvv'] = '';       
		        $data['ba_addr'] = '';   
		        $data['ba_ct'] = '';   
		        $data['ba_st'] = '';   
		        $data['ba_zip'] = '';   
		        $data['ba_pn'] = ''; 
		    if((count($card_info_arr) != 0)&&(count($billing_addr_arr) != 0)) {
		        $row0 = $card_info_arr[0];
		        $row1 = $billing_addr_arr[0];
		        //$ba_button = '<input type="button" value="Update" class="cl_butt_login" onclick="addUpdateCreditCard()" style="width:180px;height:30px;font-size:13pt">';   
		        $data['ba_nm'] = ' value="'.$row0['nameoncard'].'" ';    
		        $data['ba_cn'] = ' value="'.$row0['cardnumber'].'" ';    
		        $data['expire_month'] = $row0['expire_month'];
		        $data['expire_year'] = $row0['expire_year'];
		        $data['ba_cvv'] = ' value="'.$row0['cvv'].'" ';       
		        $data['ba_addr'] = ' value="'.$row1['b_addressline'].'" ';   
		        $data['ba_ct'] = ' value="'.$row1['b_city'].'" ';   
		        $data['ba_st'] = ' value="'.$row1['b_state'].'" ';   
		        $data['ba_zip'] = ' value="'.$row1['b_zip'].'" ';   
		        $data['ba_pn'] = ' value="'.$row1['b_phonenumber'].'" ';   
        		
    		}
    		$this->load->view('view_co_card_info', $data);
		}
		function add_update_card_billing_addr() {
			if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
			}
			$this->time_out_logout();
			$ba_nm = $this->input->post('ba_nm');
		    $ba_cn = $this->input->post('ba_cn');
		    $ba_month = $this->input->post('ba_month');
		    $ba_year = $this->input->post('ba_year');
		    $ba_cvv = $this->input->post('ba_cvv');
		    $ba_addr = $this->input->post('ba_addr');
		    $ba_ct = $this->input->post('ba_ct');
		    $ba_st = $this->input->post('ba_st');
		    $ba_zip = $this->input->post('ba_zip');
		    $ba_pn = $this->input->post('ba_pn');
		    if($ba_nm==null || $ba_nm=='') {
        		echo '4';
        		exit();
    		}
		    if(!preg_match('/^[a-zA-Z ]{1,50}$/',$ba_nm)){
		        echo '5';
		        exit();
		    }
		    if($ba_cn==null || $ba_cn=='') {
		        echo '6';
		        exit();
		    }
		    if(!preg_match('/^[0-9]{16}$/',$ba_cn)){
		        echo '7';
		        exit();
		    }
		    if($ba_month==null || $ba_month=='' || $ba_year==null || $ba_year=='') {
		        echo '8';
		        exit();
		    }
		    if($ba_cvv==null || $ba_cvv=='') {
		        echo '9';
		        exit();
		    }
		    if(!preg_match('/^[0-9]{3}$/',$ba_cvv)){
		        echo '10';
		        exit();
		    }
		    if($ba_addr==null || $ba_addr=='') {
		        echo '11';
		        exit();
		    }
		    if(!preg_match('/^[a-zA-Z0-9 ]{1,100}$/',$ba_addr)){
		        echo '12';
		        exit();
		    }

		    if($ba_ct==null || $ba_ct=='') {
		        echo '13';
		        exit();
		    }
		    if(!preg_match('/^[a-zA-Z ]{1,30}$/',$ba_ct)){
		        echo '14';
		        exit();
		    }
		    if($ba_st==null || $ba_st=='') {
		        echo '15';
		        exit();
		    }
		    if(!preg_match('/^[a-zA-Z ]{1,20}$/',$ba_st)){
		        echo '16';
		        exit();
		    }
		    if($ba_zip==null || $ba_zip=='') {
		        echo '17';
		        exit();
		    }
		    if(!preg_match('/^\d{5}(?:[-\s]\d{4})?$/',$ba_zip)){
		        echo '18';
		        exit();
		    }
		    if($ba_pn==null || $ba_pn=='') {
		        echo '19';
		        exit();
		    }
		    if(!preg_match('/^(?:\([2-9][0-9]{2}\)\ ?|[2-9][0-9]{2}(?:\-?|\ ?))[2-9][0-9]{2}[- ]?[0-9]{4}$/',$ba_pn)){ 
		        echo '20';
		        exit();
		    }
		    $billing_addr_arr = array();
			$billing_addr_arr = $this->address_model->billing_addr_retrieve($this->session->userdata('customer_id'));
			$card_info_arr = array();
			$card_info_arr = $this->address_model->card_info_retrieve($this->session->userdata('customer_id'));
			if((count($card_info_arr) != 0)&&(count($billing_addr_arr) != 0)) {
        		$mode = 1;
    		}
    		else {
        		$mode = 0;
    		}
    		if($mode==0) {
        		$res_0 = $this->address_model->card_info_insert($this->session->userdata('customer_id'), $ba_nm, $ba_cn, $ba_month, $ba_year, $ba_cvv);
        		$res_1 = $this->address_model->billing_addr_insert($this->session->userdata('customer_id'), $ba_addr, $ba_ct, $ba_st, $ba_zip, $ba_pn);
    		}
    		else {
        		$res_0 = $this->address_model->card_info_update($this->session->userdata('customer_id'), $ba_nm, $ba_cn, $ba_month, $ba_year, $ba_cvv);
				$res_1 = $this->address_model->billing_addr_update($this->session->userdata('customer_id'), $ba_addr, $ba_ct, $ba_st, $ba_zip, $ba_pn);
    		}
    		if($res_0&&$res_1) {
        		if($mode==0) {
            		echo '0';//'The credit card and billing address has been successfully added.'; //succeed
            		exit();
        		}
        		else {
            		echo '1';//'The credit card and billing address have been successfully updated.';// unknown error
            		exit();
        		}
        
    		}
    		else {
        		if($mode==0) {
            		echo '2';//'Error: the credit card and billing address can not be added.'; //succeed
            		exit();
        		}
        		else {
            		echo '3';//'Error: the credit card and billing address can not be updated.';// unknown error
            		exit();
        		}
    		}
		}
		function place_order() {

			//function place_order_display() {
			//	$this->load->view('view_place_order_display');
			//}




			if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
			}
			$this->time_out_logout();
			$parameter_po = array();
			$cart_po = array();
    		$cart_po = $this->cart_model->cart_certain_customer($this->session->userdata('customer_id'));
    		if(count($cart_po) == 0) {
        		$parameter_po['select'] = 1;
        		$this->load->view('view_place_order_display', $parameter_po);
        		$this->output->_display();
        		exit();
    		}
    		$order_history = array();
    		$order_history = $this->order_model->all_orders();
    		if(count($order_history)==0) {
        		$orderindex=1;
    		}
    		else {
        		$orderindex = $this->order_model->max_order_index();
        		$orderindex++;
    		}
    		$date = date("Y-m-d");
    		$totalprice = 0;
    		$price_array = array();
    		$is_special_array = array();
    		foreach($cart_po as $cart_item ) {
		        $singleprice = 0;
		        ////////////////////////////////
		        //$sql_check_special = 'select * from special s where s.productid='.$row_cart['productid'];
		        //$res_check_special = mysql_query($sql_check_special);
		        $ch_specials = array();
				$ch_specials = $this->specials_model->is_special($cart_item['productid']);
				//$data['cer_specials'] = 
				if(count($ch_specials) != 0) { 
					$singleprice = $ch_specials[0]['specialprice'];
		            //$price_array["'".$row_cart['productid']."'"] = $singleprice;
		            $price_array[$cart_item['productid']] = $singleprice;
		            $is_special_array[$cart_item['productid']] = 1;
		        }
		        else {
		            //$sql_regular_price = 'select productprice from products where productid='.$row_cart['productid'];
		            //$res_regular_price = mysql_query($sql_regular_price);
		            $reg_price = array();
					$reg_price = $this->products_model->get_a_certain_product_price($cart_item['productid']);
		            if(count($reg_price) != 0) {
		                $singleprice = $reg_price[0]['productprice'];
		                //$price_array["'".$row_cart['productid']."'"] = $singleprice;
		                $price_array[$cart_item['productid']] = $singleprice;
		                $is_special_array[$cart_item['productid']] = 0;
		            }
		            else {
		                $singleprice = 0;  // if this product is in cart but not in product table. need to modify 
		                //$price_array["'".$row_cart['productid']."'"] = 0;
		                $price_array[$cart_item['productid']] = 0;
		                $is_special_array[$cart_item['productid']] = 0;
		            }
		        }
		        $totalprice = $totalprice + $singleprice * $cart_item['productqtty'];
		        //echo 'pro id: '.$row_cart['productid'].' | '.$price_array["'".$row_cart['productid']."'"].'  ';
		        //echo 'pro id: '.$row_cart['productid'].' | '.$price_array[$row_cart['productid']].'  ';
    		}







	//$sql_shipping_addr = 'select * from address where customerid='.$_SESSION['customer_id'];
    //$res_shipping_addr = mysql_query($sql_shipping_addr);
    $addr_arr0 = array();
	$addr_arr0 = $this->address_model->shipping_addr_retrieve($this->session->userdata('customer_id'));
    if(count($addr_arr0) != 0) {
        $shipping_addr = $addr_arr0[0]['fullname'].','.$addr_arr0[0]['addressline'].','.$addr_arr0[0]['city'].','.$addr_arr0[0]['state']
                        .','.$addr_arr0[0]['zip'].','.$addr_arr0[0]['phonenumber'];
    }
    else {
        $shipping_addr = '';
    }


    //$sql_card_info = 'select * from cardinfo where customerid='.$_SESSION['customer_id'];
    //$res_card_info = mysql_query($sql_card_info);
    //if($row_card_info = mysql_fetch_assoc($res_card_info)) {
    $card_arr0 = array();
	$card_arr0 = $this->address_model->card_info_retrieve($this->session->userdata('customer_id'));
    if(count($card_arr0) != 0) {
        $billing_addr = $card_arr0[0]['nameoncard'].',';
    }
    else {
        $billing_addr = ',';
    }


    //$sql_billing_addr = 'select * from billing_address where b_customerid='.$_SESSION['customer_id'];
    //$res_billing_addr = mysql_query($sql_billing_addr);
    //if($row_billing_addr = mysql_fetch_assoc($res_billing_addr)) {
    $b_addr_arr0 = array();
	$b_addr_arr0 = $this->address_model->billing_addr_retrieve($this->session->userdata('customer_id'));
    if(count($b_addr_arr0) != 0) {
        $billing_addr = $billing_addr.$b_addr_arr0[0]['b_addressline'].','.$b_addr_arr0[0]['b_city'].','.$b_addr_arr0[0]['b_state'].','.$b_addr_arr0[0]['b_zip']
                        .','.$b_addr_arr0[0]['b_phonenumber'];
    }
    else {
        $billing_addr = '';
    }

    //echo $billing_addr;
    //$sql_add_order = 'INSERT INTO placedorder (orderindex,customerid,orderdate,totalcost,billing_addr,shipping_addr)
    //                  VALUES ("'.$orderindex.'", "'.$_SESSION['customer_id'].'", "'.$date.'", "'.$totalprice.'", "'.$billing_addr.'", "'.$shipping_addr.'");';
    //$res_add_order = mysql_query($sql_add_order); 
    $res_add_order = $this->order_model->place_order($orderindex, $this->session->userdata('customer_id'), $date, $totalprice, $billing_addr, $shipping_addr);
    if($res_add_order) {
        //$sql_cart = 'select * from cart where customerid='.$_SESSION['customer_id'];
        //$res_cart = mysql_query($sql_cart);
        $res_cart = array();
        $res_cart = $this->cart_model->cart_certain_customer($this->session->userdata('customer_id'));
        $add_order_detail_correct = true;
        foreach($res_cart as $row_cart ) {
        	//echo ' '.$orderindex.' '.$row_cart['productid'].' '.$row_cart['productqtty'].' '.$price_array[$row_cart['productid']].' '.$is_special_array[$row_cart['productid']];
            //$sql_add_order_detail = 'INSERT INTO orderdetail (od_index,orderindex,proid,proqtty,proprice, is_special)VALUES 
             //                        (NULL ,"'.$orderindex.'","'.$row_cart['productid'].'","'.$row_cart['productqtty'].'","'.$price_array[$row_cart['productid']].'","'.$is_special_array[$row_cart['productid']].'");';
            $res_add_order_detail = $this->order_model->insert_order_detail($orderindex, $row_cart['productid'], $row_cart['productqtty'], $price_array[$row_cart['productid']], $is_special_array[$row_cart['productid']]);
            if(!$res_add_order_detail) {
                $add_order_detail_correct = false;
            }
        }
        
        //$sql_cart_delete = 'DELETE FROM cart WHERE customerid ='.$_SESSION['customer_id'];
        $res_cart_delete = $this->cart_model->cart_delete_all($this->session->userdata('customer_id'));
        if(!$add_order_detail_correct) {
            $parameter_po['select'] = 3;
        		$this->load->view('view_place_order_display', $parameter_po);
        		$this->output->_display();
            exit();
        }
        if(!$res_cart_delete) {
            $parameter_po['select'] = 4;
        		$this->load->view('view_place_order_display', $parameter_po);
        		$this->output->_display();
            exit();
        }
       $parameter_po['select'] = 5;
        		$this->load->view('view_place_order_display', $parameter_po);
        		$this->output->_display();
        exit();

    }
    else {
        $parameter_po['select'] = 2;
        		$this->load->view('view_place_order_display', $parameter_po);
        		$this->output->_display();
        exit();
    }
	}

	function create_acc_confirm() {
		$un = $this->input->post('un'); $pw0 = $this->input->post('pw0'); $pw1 = $this->input->post('pw1');
    	$fn = $this->input->post('fn'); $ln = $this->input->post('ln'); $em = $this->input->post('em');
    	if($un==null || $un=='') {
        	echo '3';
        	exit();
    	}
	    if(!preg_match('/^[a-zA-Z0-9_]{3,30}$/',$un)){
	        echo '4';
	        exit();
	    }

	    if(($pw0==null || $pw0=='')&&($pw1==null||$pw1=='')) {
	        echo '0';
	        exit();
	    }
	    if(($pw0==null || $pw0=='')||($pw1==null||$pw1=='')) {
	        echo '1';
	        exit();
	    }
	    if($pw0!=$pw1) {
	        echo '2';
	        exit();
	    }
	    if(strlen($pw0)<6) {
	        echo '0';
	        exit();
	    }

	    if($fn==null || $fn=='') {
	        echo '6'; //6: Please enter your first name.
	        exit();
	    }
	    $regExp = '/^[a-zA-Z]{1,30}$/';
	    if(!preg_match($regExp,$fn)){
	        echo '7'; //7: Only letters, commas, periods, single quotes and hyphens are allowed in name.
	        exit();
	    }

	    if($ln==null || $ln=='') {
	        echo '8'; //8: Please enter your last name.
	        exit();
	    }
	    if(!preg_match($regExp,$ln)){
	        echo '7'; //7: Only letters, commas, periods, single quotes and hyphens are allowed in name.
	        exit();
	    }

	    if($em==null || $em=='') {
	        echo '9'; //9: Please enter your email address.
	        exit();
	    }
	    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$em)){
	        echo '10'; //10: Invalid email address.
	        exit();
	    }
	    $res_check_un = array();
	    $res_check_un = $this->account_model->check_username($un);
	    if(count($res_check_un) == 0) {
        $res = $this->account_model->create_new_account($un, $pw0, $fn, $ln, $em);
        if($res) {
            //$sql_retr_cid='select * from customers where cus_username="'.$un.'"';
            //$res_retr_cid = mysql_query($sql_retr_cid);
            $res_retr_cid = array();
            $res_retr_cid = $this->account_model->retrieve_userid($un);
            if(count($res_retr_cid) != 0) {
                $cid=$res_retr_cid[0]['customerid'];
                $this->session->set_userdata('customer_id', $cid);
                $this->session->set_userdata('customer_first_name', $fn);
            }
            else {
                echo '11'; //
                exit();
            }

            
            $this->cartMerge();
            if($this->session->userdata('login_flag') !== false) {
                $this->session->unset_userdata('login_flag');
                echo '13'; // send to cart
                exit();
            }
            else {
                echo '14'; // sent to home page(logged in)
                exit();
            }
        }
        else {
            echo '12';// unknown error
            exit();
        }
        
    }
    else {
        echo '5';
        exit();
    }
	}	
	function edit_profile_display() {
		$this->time_out_logout();
		if($this->session->userdata('customer_id') === false) {
				$this->load->view('view_create_account_error');
		    	$this->output->_display();
				exit(); 
        }
        $res_check_un = array();
        $res_check_un = $this->account_model->retrieve_acc_info($this->session->userdata('customer_id'));
        $data['un'] = '';
    	$data['fn'] = '';
    	$data['ln'] = '';
    	$data['em'] = '';
    if(count($res_check_un) != 0) {
        $data['un'] = $res_check_un[0]['cus_username'];
        $data['fn'] = $res_check_un[0]['cus_fname'];
        $data['ln'] = $res_check_un[0]['cus_lname'];
        $data['em'] = $res_check_un[0]['cus_email'];
    }
    $this->load->view('view_edit_profile_display', $data);
	}
	function edit_profile_confirm() {
		if($this->session->userdata('customer_id') === false) {
				$this->load->view('view_create_account_error');
		    	$this->output->_display();
				exit(); 
        }
        $this->time_out_logout();
        $un = $this->input->post('un');
    	$fn = $this->input->post('fn');
    	$ln = $this->input->post('ln');
    	$em = $this->input->post('em');
        if($un==null || $un=='') {
        	echo '3';
        	exit();
    	}
	    if(!preg_match('/^[a-zA-Z0-9_]{3,30}$/',$un)){
	        echo '4';
	        exit();
	    }

	  

	    if($fn==null || $fn=='') {
	        echo '6'; //6: Please enter your first name.
	        exit();
	    }
	    $regExp = '/^[a-zA-Z]{1,30}$/';
	    if(!preg_match($regExp,$fn)){
	        echo '7'; //7: Only letters, commas, periods, single quotes and hyphens are allowed in name.
	        exit();
	    }

	    if($ln==null || $ln=='') {
	        echo '8'; //8: Please enter your last name.
	        exit();
	    }
	    if(!preg_match($regExp,$ln)){
	        echo '7'; //7: Only letters, commas, periods, single quotes and hyphens are allowed in name.
	        exit();
	    }

	    if($em==null || $em=='') {
	        echo '9'; //9: Please enter your email address.
	        exit();
	    }
	    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$em)){
	        echo '10'; //10: Invalid email address.
	        exit();
	    }
	    $res_check_un = array();
	    $res_check_un = $this->account_model->check_username($un);
	    if(count($res_check_un) != 0) {
	    	if($res_check_un[0]['customerid'] != $this->session->userdata('customer_id')) {
            	echo '5';
            	exit();
        	}
	    }

$res = $this->account_model->update_account($un, $fn, $ln, $em, $this->session->userdata('customer_id'));
if($res) {
   
   $this->session->set_userdata('customer_first_name', $fn);
   echo '100'; //ok
}
else {
    echo '12';  // failed
}
	}
	function change_password() {
		if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
		}
		$this->time_out_logout();
		$pw0 = $this->input->post('pw0');
    	$pw1 = $this->input->post('pw1');
    	if(($pw0==null || $pw0=='')&&($pw1==null||$pw1=='')) {
        	echo '0';
        	exit();
    	}
	    if(($pw0==null || $pw0=='')||($pw1==null||$pw1=='')) {
	        echo '1';
	        exit();
	    }
	    if($pw0!=$pw1) {
	        echo '2';
	        exit();
	    }
	    if(strlen($pw0)<6) {
	        echo '0';
	        exit();
	    }
	    $res = $this->account_model->update_password($pw0, $this->session->userdata('customer_id'));
    	if($res) {
        	echo '3';
    	}
    	else {
        	echo '4';
    	}

	}
	function addr_payment_display() {
		if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
		}
		$this->time_out_logout();
		$res_shipping_addr = array();
		$res_shipping_addr = $this->address_model->shipping_addr_retrieve($this->session->userdata('customer_id'));
    	$res_card_info = array();
    	$res_card_info = $this->address_model->card_info_retrieve($this->session->userdata('customer_id'));
    	$res_billing_addr = array();
    	$res_billing_addr = $this->address_model->billing_addr_retrieve($this->session->userdata('customer_id'));
    	$data['sa_fn'] = '';   $data['sa_addr'] = '';  $data['sa_ct'] = '';   $data['sa_st'] = '';    $data['sa_zip'] = '';   
    	$data['sa_pn'] = '';   $data['ba_nm'] = '';    $data['ba_cn'] = '';   $data['ba_year'] = '';  $data['ba_month'] = '';
    	$data['ba_cvv'] = '';  $data['ba_addr'] = '';  $data['ba_ct'] = '';   $data['ba_st'] = '';    $data['ba_zip'] = '';  $data['ba_pn'] = ''; 
    	$data['sa_button'] = 0;  $data['ba_button'] = 0;
    	$data['month_year_exist'] = false;
    	$data['expire_month'] = '';    $data['expire_year'] = '';
    	if(count($res_shipping_addr) != 0) {
	        $row = $res_shipping_addr[0];
	        $data['sa_button'] = 1;//'<input type="button" value="Update" class="cl_butt_login" onclick="addUpdateShippingAddr()" style="width:180px;height:30px;font-size:13pt">';   
	        $data['sa_fn'] = ' value="'.$row['fullname'].'" ';  
	        $data['sa_addr'] = ' value="'.$row['addressline'].'" '; 
	        $data['sa_ct'] = ' value="'.$row['city'].'" ';  
	        $data['sa_st'] = ' value="'.$row['state'].'" ';   
	        $data['sa_zip'] = ' value="'.$row['zip'].'" ';   
	        $data['sa_pn'] = ' value="'.$row['phonenumber'].'" '; 
    	}
    	if((count($res_card_info) != 0)&&(count($res_billing_addr) != 0)) {
        $row0 = $res_card_info[0];
        $row1 = $res_billing_addr[0];
        $data['ba_button'] = 1;//'<input type="button" value="Update" class="cl_butt_login" onclick="addUpdateCreditCard()" style="width:180px;height:30px;font-size:13pt">';   
        $data['ba_nm'] = ' value="'.$row0['nameoncard'].'" ';    
        $data['ba_cn'] = ' value="'.$row0['cardnumber'].'" ';    
        $data['month_year_exist'] = true;
        $data['expire_month'] = $row0['expire_month'];    $data['expire_year'] = $row0['expire_year'];
        //$ba_year = ' selected="'.$row0['expire_year'].'" ';   
        //$ba_month = ' selected="'.$row0['expire_month'].'" '; 
        /*$ba_month='';
        for($i=1;$i<=12;$i++) {
            if($i==$row0['expire_month']) {
                $ba_month=$ba_month.'<option selected="selected" value="'.$i.'">'.$i.'</option>';
            }
            else {
                $ba_month=$ba_month.'<option value="'.$i.'">'.$i.'</option>';
            }
        }  
        $ba_year='';
        for($i=2014;$i<=2032;$i++) {
            if($i==$row0['expire_year']) {
                $ba_year=$ba_year.'<option selected="selected" value="'.$i.'">'.$i.'</option>';
            }
            else {
                $ba_year=$ba_year.'<option value="'.$i.'">'.$i.'</option>';
            }
        }*/
        $data['ba_cvv'] = ' value="'.$row0['cvv'].'" ';       
        $data['ba_addr'] = ' value="'.$row1['b_addressline'].'" ';   
        $data['ba_ct'] = ' value="'.$row1['b_city'].'" ';   
        $data['ba_st'] = ' value="'.$row1['b_state'].'" ';   
        $data['ba_zip'] = ' value="'.$row1['b_zip'].'" ';   
        $data['ba_pn'] = ' value="'.$row1['b_phonenumber'].'" '; 

        
    }
    $this->load->view('view_addr_pament_method_display', $data);
	}
	/*function add_update_shipping_addr() {
		if($this->session->userdata('customer_id') === false) {
    			echo '';
    			exit();
		}
		$sa_fn = $this->input->post('sa_fn');
	    $sa_addr = $this->input->post('sa_addr');
	    $sa_city = $this->input->post('sa_city');
	    $sa_state = $this->input->post('sa_state');
	    $sa_zip = $this->input->post('sa_zip');
	    $sa_pn = $this->input->post('sa_pn');
	    if($sa_fn==null || $sa_fn=='') {
        	echo '4';
        	exit();
    	}
	    if(!preg_match('/^[a-zA-Z ]{1,50}$/',$sa_fn)){
	        echo '5';
	        exit();
	    }
	    if($sa_addr==null || $sa_addr=='') {
	        echo '6';
	        exit();
	    }
	    if(!preg_match('/^[a-zA-Z0-9 ]{1,100}$/',$sa_addr)){
	        echo '7';
	        exit();
	    }
	    if($sa_city==null || $sa_city=='') {
	        echo '8';
	        exit();
	    }
	    if(!preg_match('/^[a-zA-Z ]{1,30}$/',$sa_city)){
	        echo '9';
	        exit();
	    }
	    if($sa_state==null || $sa_state=='') {
	        echo '10';
	        exit();
	    }
	    if(!preg_match('/^[a-zA-Z ]{1,20}$/',$sa_state)){
	        echo '11';
	        exit();
	    }
	    if($sa_zip==null || $sa_zip=='') {
	        echo '12';
	        exit();
	    }
	    if(!preg_match('/^\d{5}(?:[-\s]\d{4})?$/',$sa_zip)){
	        echo '13';
	        exit();
	    }
	    if($sa_pn==null || $sa_pn=='') {
	        echo '14';
	        exit();
	    }
	    if(!preg_match('/^(?:\([2-9][0-9]{2}\)\ ?|[2-9][0-9]{2}(?:\-?|\ ?))[2-9][0-9]{2}[- ]?[0-9]{4}$/',$sa_pn)){ 
	        echo '15';
	        exit();
	    }
	    $res_shipping_addr = array();
		$res_shipping_addr = $this->address_model->shipping_addr_retrieve($this->session->userdata('customer_id'));
		if(count($res_shipping_addr) != 0) {
        	$mode = 1;
    	}
    	else {
        	$mode=0;
    	}


    	if($mode==0) {
        	//$sql = ' INSERT INTO address(addressid,customerid,fullname,addressline,city,state,zip,phonenumber)VALUES ("", "'.$_SESSION['customer_id'].'", "'.$sa_fn.'", "'.$sa_addr.'", "'.$sa_city.'", "'.$sa_state.'", "'.$sa_zip.'", "'.$sa_pn.'");';
       		$res = $this->address_model->shipping_addr_insert($this->session->userdata('customer_id'), $sa_fn, $sa_addr, $sa_city, $sa_state, $sa_zip, $sa_pn);
    	}
    	else {
    		$res = shipping_addr_update($this->session->userdata('customer_id'), $sa_fn, $sa_addr, $sa_city, $sa_state, $sa_zip, $sa_pn);
        	//$sql = '
        	//UPDATE address SET fullname = "'.$sa_fn.'",addressline = "'.$sa_addr.'",city = "'.$sa_city.'",state = "'.$sa_state.'",zip = "'.$sa_zip.'",phonenumber = "'.$sa_pn.'" WHERE customerid = "'.$_SESSION['customer_id'].'" LIMIT 1; 
        	//';
    	}
 
    if($res) {
        if($mode==0) {
            echo '0';//'An shipping address has been successfully added.'; //succeed
            exit();
        }
        else {
            echo '1';//'The shipping address has been successfully updated.';// unknown error
            exit();
        }
        
    }
    else {
        if($mode==0) {
            echo '2';//'Error: the shipping address can not be added.'; //succeed
            exit();
        }
        else {
            echo '3';//'Error: the shipping address can not be updated.';// unknown error
            exit();
        }
    }
    
	}*/
	}	
?>