<?php  session_start();

include("includes.php");

$listing_obj = new Listing;

$mysql		 = new Mysql;



include("header.php");



$_make 	= $_REQUEST['make'];

$_model	= $_REQUEST['model'];

$_year	= $_REQUEST['year'];

$_vin	= $_REQUEST['vin'];

$_price	= $_REQUEST['price'];

$_vendor= $_REQUEST['vendor'];

$_city	= $_REQUEST['city'];

$_state	= $_REQUEST['state'];

$_phone	= $_REQUEST['phone'];

$_fax	= $_REQUEST['fax'];



?>



<script type="text/javascript">



$(function() {



	//DIV with inputs descendant

	  grey = $('div.grey_box').find('input[type=text]');

	  grey.css({color:'grey'});

	 

	  var vehicle_form	  = $(':input[type=text],select', '#getapproved');

	  var monthly_payment = $('#monthly_payment').val();

	  var monthly_income  = $('#monthly_income').val();

	  var email			  = $('#email').val();

	  

	  //check if it is number

	 	

	  //execute every onchange

	  vehicle_form.each(function() 

	  {

		  $(this).on('change',function(){

			  			  

			  if($(this).val().length === 0 || $(this).val()=== ''){

				$(this).css({border:'1px solid red'});

				  e.preventDefault();			  

			  }

			  else if($(this).val().length > 0){

				$(this).css({border:'1px solid #A7A6AA'});	

			  }	

			  

		  });

	  });

	   //validate email input

	   $('#email').on('change',function(e){

		   		

			  if(validateEmail(email)){

				  alert('valid!');

				  $(this).css({border:'1px solid #A7A6AA'});	

			  }

			  else{

				   alert('invalid!')

				  $(this).css({border:'1px solid red'});

				   e.preventDefault();

			  }

	   });

	  

	  //execute when form submit click

	  $('#getapproved').submit(function(e){

		

		undone 	= true;

		vehicle_form.each(function() {

            if($(this).val().length === 0 || $(this).val()=== ''){

				$(this).css({border:'1px solid red'});

				undone = false;

				$('#gohere').focus();

				  e.preventDefault();

				  

			}

			else if($(this).val().length > 0){

				$(this).css({border:'1px solid #A7A6AA'});	

			}

			

        });

		if(undone==true){

			if($('#agree').is(":checked")==false){

				$('#agree').focus();

				alert("You must agree the agreement to receive Electronic Documents");

				e.preventDefault();

			}

		}

		

	});

		//clear vehicle datas

		$('#clr_vehicle_data').on('click',function() {

			grey.val("");

		});

		//As indicated below - vehicle datas

		$('#as_is').on('click',function() {

			if(grey.is(':disabled')){

				grey.removeAttr("disabled");

			}

			else {

				grey.attr({disabled:'disabled'});

			}

		});

		//select only after  approval.

		$('#select_after').on('click',function(){

			if(grey.is(':disabled')){

				grey.removeAttr("disabled");

				grey.css("color","grey")

			}

			else {

				grey.css("color","#fff")

					.attr({disabled:'disabled'});

			}

		});

	

});

</script>



      <div class="container_12">

         <?php include("menu.inc.php");?>

        <div class="grid_3 inh">

          <img src="images/approved/get_approved.jpg" width="225" height="454" alt="">

          <div class="clear"></div>

          <div class="g_approved_confident">

          <div class="conf_title">Apply with confidence</div>

          <div>To assure your privacy, all data is sent via SSL encrypted secure server.</div>

          <div class="conf_title">Bad Credit Car Loans</div>

          <div>Applying online for fast auto financing has never been easier. Event if you have a history of bad credit, no credit, we can get you financed for a new or used car.</div>

          </div>

<div class="clear"></div>

<div class="wrapper" style="margin-top:20px;">

          <div class="grid_3" style="margin:0px;">

              <!--========Featured Dealers Start=======================-->
               <?php include_once("featured-dealers-slider.php");?>
              <!--========Featured Dealers End=======================-->
            

          </div>

          

        </div>

        </div>

        <div class="grid_9 fright">

        <form name="getapproved" id="getapproved" action="getapprove_process.php" method="post" enctype="multipart/form-data">

          <div class="g_approved">

            <div class="g_approved_header"><span class="red">GET APPROVED!</span> EASY AS 1 2 3</div>

            <div class="g_approved_Inner">

              <div class="g_approved_title">Auto Loan Application</div>

              <div class="g_approved_safeguard">To safeguard your privacy,<br>all data is encrypted</div>

              <div class="clear"></div>

              <div class="part_one">

              <div class="select_vehicle"><div class="txt01">Selected Vehicle:</div>  <div class="indicate"><input name="as_is" id="as_is" type="checkbox" value=""> As indicated below</div> <div class="aft_approval"><input name="select_after" id="select_after" type="checkbox" value=""> I’ll select after my approval.</div> 

              <div class="clear_data"><a href="#" id="clr_vehicle_data">Clear Vehicle Data</a></div></div>

              <div class="clear"></div>

              <div class="grey_box">

              <div class="col1">

              <div class="row1">

              Make<br>

              <input name="v_make" id="v_make"  type="text" class="frm111" value="<?php echo $_make; ?>" >

              </div>

              <div class="row2">

              Vendor:<br>

              <input name="vendor" id="vendor" type="text" class="frm111" value="<?php echo $_vendor; ?>">

              </div>

              </div>

              <div class="col2">

              <div class="row1">

              Model<br>

              <input name="model" id="model" type="text" class="frm89" value="<?php echo $_model; ?>">

              </div>

              <div class="row2">

              City:<br>

              <input name="v_city" id="v_city" type="text" class="frm89" value="<?php echo $_city; ?>">

              </div>

              </div>

              <div class="col3">

              <div class="row1">

              Year<br>

              <input name="year" id="year" type="text" class="frm36" value="<?php echo $_year; ?>">

              </div>

              <div class="clear"></div>

              <div class="row2">

              State:<br>

              <input name="v_state" id="v_state" type="text" class="frm36" value="<?php echo $_state; ?>">

              </div>

              </div>

              <div class="col4">

              <div class="row1">

              Vin<br>

              <input name="vin" id="vin" type="text" class="frm141" value="<?php echo $_vin; ?>">

              </div>

              <div class="row2">

              Phone:<br>

              <input name="v_phone" id="v_phone" type="text" class="frm141" value="<?php echo $_phone; ?>">

              </div>

              </div>

              <div class="col5">

              <div class="row1">

              Price<br>

              <input name="price" id="price" type="text" class="frm89" value="<?php echo "$".number_format($_price); ?>">

              </div>

              <div class="row2">

              Fax:<br>

              <input name="v_fax" id="v_fax" type="text" class="frm89" value="<?php echo $_fax; ?>">

              </div>

              </div>

              <div class="clear"></div>

              </div>

              

              </div>

              <div class="clear"></div>

              <div class="part_two">

              <div id="gohere" tabindex='1'></div>

              <div class="complete_field">Complete All fields  -  <em>Do not use commas or dashes.</em></div>

              <div class="clear"></div>

              <div class="left_grey_box">

              <div class="part_two_title">Personal Infomation</div>

              <label>Name</label>

              <input name="fname"  id="fname" type="text" class="frm90"><input name="lname" id="lname" type="text" class="frm90" ln>

              <div class="clear"></div>

              <label>Email</label>

              <input name="email" id="email" type="text" class="frm151">

              <div class="clear"></div>

              <label>Day Phone</label>

              <input name="dayphone1" type="text" class="frm47"><input name="dayphone2" type="text" class="frm47"><input name="dayphone3" type="text" class="frm47">

              <label>Cell Phone</label>

              <input name="cellphone1" type="text" class="frm47"><input name="cellphone2" type="text" class="frm47"><input name="cellphone3" type="text" class="frm47">

              <div class="clear"></div>

              <label>Date of Birth</label>

              <select name="date_month" class="frm55">

              <option selected value="">MM</option>

              <option>01</option>

              <option>02</option>

              <option>03</option>

              <option>04</option>

              <option>05</option>

              <option>06</option>

              <option>07</option>

              <option>08</option>

              <option>09</option>

              <option>10</option>

              <option>11</option>

              <option>12</option>

              </select> 

              <select name="date_day" class="frm55">

              <option selected value="">DD</option>

              <option>01</option>

              <option>02</option>

              <option>03</option>

              <option>04</option>

              <option>05</option>

              <option>06</option>

              <option>07</option>

              <option>08</option>

              <option>09</option>

              <option>10</option>

              <option>11</option>

              <option>12</option>

              <option>13</option>

              <option>14</option>

              <option>15</option>

              <option>16</option>

              <option>17</option>

              <option>18</option>

              <option>19</option>

              <option>20</option>

              <option>21</option>

              <option>22</option>

              <option>23</option>

              <option>24</option>

              <option>25</option>

              <option>26</option>

              <option>27</option>

              <option>28</option>

              <option>29</option>

              <option>30</option>

              <option>31</option>

              </select> 

              <select name="date_year" class="frm55">

              <option selected value="">YYYY</option>

              <option>1995</option>

              <option>1994</option>

              <option>1993</option>

              <option>1992</option>

              <option>1991</option>

              <option>1990</option>

              <option>1989</option>

              <option>1988</option>

              <option>1987</option>

              <option>1986</option>

              <option>1985</option>

              <option>1984</option>

              <option>1983</option>

              <option>1982</option>

              <option>1981</option>

              <option>1980</option>

              <option>1979</option>

              <option>1978</option>

              <option>1977</option>

              <option>1976</option>

              <option>1975</option>

              <option>1974</option>

              <option>1973</option>

              <option>1972</option>

              <option>1971</option>

              <option>1970</option>

              <option>1969</option>

              <option>1968</option>

              <option>1967</option>

              <option>1965</option>

              </select>

              <div class="clear"></div>

              <label>Social Security No.</label>

              <input name="ssn1" type="text" class="frm47"><input name="ssn2" type="text" class="frm47"><input name="ssn3" type="text" class="frm47">

              

              </div>

              <div class="right_grey_box">

              <div class="part_two_title">Residential Information</div>

              <div class="clear"></div>

              <label>Street Address</label><input name="address" type="text" class="frm151">

              <div class="clear"></div>

              <label>City</label><input name="city" type="text" class="frm151">

              <div class="clear"></div>

              <label>State</label><input name="state" type="text" class="frm55"> <span class="fleft">zip&nbsp;</span> <input name="zip" type="text" class="frm68">

              <div class="clear"></div>

              <label>Residence Type</label><select name="residence_type" class="frm151"><option>Rent</option><option>Own</option></select>

              <div class="clear"></div>

              <label>Time at Address</label>

              <select name="time_address_year" class="frm68">

              <option selected value="">Year</option>

              <option>1995</option>

              <option>1994</option>

              <option>1993</option>

              <option>1992</option>

              <option>1991</option>

              <option>1990</option>

              <option>1989</option>

              <option>1988</option>

              <option>1987</option>

              <option>1986</option>

              <option>1985</option>

              <option>1984</option>

              <option>1983</option>

              <option>1982</option>

              <option>1981</option>

              <option>1980</option>

              <option>1979</option>

              <option>1978</option>

              <option>1977</option>

              <option>1976</option>

              <option>1975</option>

              <option>1974</option>

              <option>1973</option>

              <option>1972</option>

              <option>1971</option>

              <option>1970</option>

              <option>1969</option>

              <option>1968</option>

              <option>1967</option>

              <option>1965</option>

              </select> 

              <select name="time_address_months" class="frm77">

              <option selected value="">Months</option>

              <option>01</option>

              <option>02</option>

              <option>03</option>

              <option>04</option>

              <option>05</option>

              <option>06</option>

              <option>07</option>

              <option>08</option>

              <option>09</option>

              <option>10</option>

              <option>11</option>

              <option>12</option>

              </select>

              <div class="clear"></div>

              <label>Monthly Payment $</label><input name="monthly_payment" id="monthly_payment" type="text" class="frm55">.00

              </div>

              <div class="clear"></div>

              <div class="full_col">

              <div class="part_two_title">Employment Information</div>

              <div class="full_left_col">

              <label>Employer Name</label><input name="emp_name" type="text" class="frm181">

              <div class="clear"></div>

              <label>Occupation</label><input name="occupation" type="text" class="frm181">

              <div class="clear"></div>

              <label>Work Phone</label><input name="emp_phone1" type="text" class="frm47"><input name="emp_phone2" type="text" class="frm47"><input name="emp_phone3" type="text" class="frm47">

				<div class="clear"></div>

              <label>Employer Zip</label><input name="emp_zip" type="text" class="frm53">





              

              </div>

              <div class="full_right_col">

              <label>Employmnet Type</label><select name="emp_type" class="frm151"><option>Employee</option></select>

              <div class="clear"></div>

              <label>Time with Employer</label><select name="twe_years" class="frm68">

              <option selected value="">Years</option>

              <option>1995</option>

              <option>1994</option>

              <option>1993</option>

              <option>1992</option>

              <option>1991</option>

              <option>1990</option>

              <option>1989</option>

              <option>1988</option>

              <option>1987</option>

              <option>1986</option>

              <option>1985</option>

              <option>1984</option>

              <option>1983</option>

              <option>1982</option>

              <option>1981</option>

              <option>1980</option>

              <option>1979</option>

              <option>1978</option>

              <option>1977</option>

              <option>1976</option>

              <option>1975</option>

              <option>1974</option>

              <option>1973</option>

              <option>1972</option>

              <option>1971</option>

              <option>1970</option>

              <option>1969</option>

              <option>1968</option>

              <option>1967</option>

              <option>1965</option>

              </select>

              <select name="twe_months" class="frm78">

              <option selected value="">Months</option>

              <option>01</option>

              <option>02</option>

              <option>03</option>

              <option>04</option>

              <option>05</option>

              <option>06</option>

              <option>07</option>

              <option>08</option>

              <option>09</option>

              <option>10</option>

              <option>11</option>

              <option>12</option>

              </select>

              <div class="clear"></div>

              <label>Monthly Income $</label><input name="monthly_income" id="monthly_income" type="text" class="frm53">.00 (Before Tax)

              </div>

              <div class="clear"></div>

              

              

              <div class="clear"></div>

              </div>

              <div class="clear"></div>

              <div class="full_col">

              <div class="part_two_title">Additional Informatiion (optional)</div>

              <div class="additional_txt">Do you have any of the following payment methods to submit monthly payments?</div>

              <div class="payment_method">Checking Account <select name="ca" class="frm47"><option>ca</option></select></div>

              <div class="payment_method2">Saving Account <select name="sa" class="frm47"><option>sa</option></select></div>

              <div class="payment_method3">Credit Card <select name="cc" class="frm47 padL7px"><option>cc</option></select></div>

              <div class="clear"></div>

              

              </div>

              <div class="clear"></div>

              <div class="authorization_certi">

              <div class="head_auth">Authorization and Certification</div>

              <div class="content_auth"><input name="agree" id="agree" type="checkbox" value=""> I read the <a href="#">Privacy Statement</a>, agreement ot receive Electronic Documents, and state-specific notices.</div><div class="clear"></div>

              <div class="content_auth"><input name="co-buyer" type="checkbox" value=""> Check this box to add a co-buyer, or co-signer, to you application.</div>

              

              </div>

              <div class="part_three">

              

              <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="33" align="left" valign="middle"><img id="tester" style="cursor:pointer;" src="images/three.jpg" width="33" height="32" alt=""></td>

    <td width="155" height="70" align="left" valign="middle">Submit form</td>

    <td width="320" align="left" valign="middle"><input type="image" name="submit_loan" id="submit_loan" src="images/get-approved-btn.jpg" width = "250" height="70"/></td>

    <td align="right" valign="middle"><img src="images/bbb-logo.jpg" width="101" height="39" alt=""></td>

  </tr>

</table>

<div class="clear"></div>

<div class="prt_3_content">By submitting this application, i certify that all information herein is true and complete. I authorize lending institutions and participating auto dealer to retain this application, to rely on the foregoing, to check and verify my credit, employment and salary history, By using our website, you authorize us to provide reposts on hte status of your application, including information concerning whether you pre-qualify for a loan, which lender's loan offer (if any) you choose to accept, whether your application for credit is denied, and whether you accept a loan from that lender. <a href="#">Click here</a> to read the Privacy Statement, agreement to receive Electronic Documents, and state-specific notices.</div>

              </div>       

              </div>

            </div>

          </div>

          </form>

        </div>

        <div class="clear"></div>

      </div>

    </header>

    <span id="sprytrigger1"></span>

    <!--==============================content================================-->

    <section id="content">

      <div class="container_12">

      </div>

    </section>

    

<?php include("footer.php");?>