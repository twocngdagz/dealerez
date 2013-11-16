<?php
session_start();
include("includes.php");
$listing_obj = new Listing;
$mysql       = new Mysql;


$_make      = $_REQUEST['make'];
$_model     = $_REQUEST['model'];
$_year      = $_REQUEST['year'];
$_vin       = $_REQUEST['vin'];
$_price     = $_REQUEST['price'];
$_vendor    = $_REQUEST['vendor'];
$_city      = $_REQUEST['city'];
$_state     = $_REQUEST['state'];
$_phone     = $_REQUEST['phone'];
$_fax       = $_REQUEST['fax'];
$_image_url = $_REQUEST['image_url'];

$listing = $listing_obj->get_listing_by_vin($_vin);
$makes   = $listing_obj->getListingsGroupBy(false, false, "make", "asc", "dealer_id = 306", "make");
$years   = $listing_obj->getListingsGroupBy(false, false, "year", "asc", "dealer_id = 306", "year");
$models  = $listing_obj->getListingsGroupBy(false, false, "model", "asc", "dealer_id = 306", "model");

// foreach ($makes as $make) {
//   $make_name = $make['make'];
//   $vehicles = $listing_obj->getall_listing(false,false,"title","asc","dealer_id = 306 and make='$make_name'");
//   foreach ($vehicles as $vehicle) {
//     echo $vehicle['title']."<br>";
//   }
// }

include_once("header.php");
?>
<script>
  $(function() {

  //DIV with inputs descendant
  grey = $('#select_vehicle').find('input[type=text]');
  grey.css({color:'grey'});

  var vehicle_form    = $(':input[type=text],select', '#getapproved');
  var monthly_payment = $('#monthly_payment').val();
  var monthly_income  = $('#monthly_income').val();
  var email       = $('#email').val();

  $('#trade_in').on('change', function(e){
    var trade_in = $('#trade_in').val();
    if (trade_in == "Yes") {
      $('#vehicle_trade_in').css('visibility', 'visible');
      $('#owe-trade-in').css('visibility', 'visible');
      $('#condition_trade').css('visibility', 'visible');
      $('#trade-in-make').attr("required","required");
      $('#trade-in-model').attr("required","required");
      $('#trade-in-year').attr("required","required");
      $('#trade-in-color').attr("required","required");
      $('#trade-in-miles').attr("required","required");
      $('#owe_trade_in').attr("required","required");
      $('#condition_trade_rating').attr("required","required");
    } else {
      $('#vehicle_trade_in').css('visibility', 'hidden');
      $('#owe-trade-in').css('visibility', 'hidden');
      $('#condition_trade').css('visibility', 'hidden');
      $('#trade-in-make').removeAttr("required");
      $('#trade-in-model').removeAttr("required");
      $('#trade-in-year').removeAttr("required");
      $('#trade-in-color').removeAttr("required");
      $('#trade-in-miles').removeAttr("required");
      $('#owe_trade_in').removeAttr("required");
      $('#condition_trade_rating').removeAttr("required");
    }
  });

  $('#owe_trade_in').on('change', function(e) {
    var owe_trade_in = $('#owe_trade_in').val();
    if (owe_trade_in == "Yes") {
      $('#input_owe_trade').attr("required", "required");
    } else {
      $('#input_owe_trade').removeAttr("required");
    }
  });

  $('#downpayment').on('change', function(e) {
    var downpayment = $('#downpayment').val();
    if(downpayment == "Yes") {
      $('#downpayment_amount').attr("required", "required");
    } else {
      $('#downpayment_amount').removeAttr("required");
    }
  })

  //check if it is number
  //execute when form submit click
  $('#submit_loan').on('click', function(e) {
    if($('#agree').is(":checked")==false){
      $('#agree').focus();
      alert("You must agree the agreement to receive Electronic Documents");
      e.preventDefault();
    }
  });

  //clear vehicle datas
  // $('#clr_vehicle_data').on('click',function() {
  //   grey.val("");
  // });
  //As indicated below - vehicle datas
  $('#as_is').on('click',function() {
    if(grey.is(':disabled')){
      grey.removeAttr("disabled");
    }
    else {
      grey.attr({disabled:'disabled'});
    }
  });
  if((getQueryVariable('image_url')) == -1) {
    $('.col6').css('display','none');
  }
  $('#vehicle').on('change', function(value) {
    if ($(this).val() !== "") {
      $('.col6').css('display','block');
      var imagepath = "http://www.dealerez.com/sandbox/web/uploads/listing/thumb/";
      $.ajax({
        type:'POST',
        url:"ajax.php",
        data:"id="+$(this).val(),
        dataType: "json",
        success:function(data) {
          imagepath = imagepath + data['imagepath'];
          $('#v_make').val(data['make']);
          $('#model').val(data['model']);
          $('#year').val(data['year']);
          $('#vin').val(data['vin']);
          $('#price').val('$'+data['price']);
          $('#listing_id').val(data['listing_id']);
          $('#vehicle_image').attr('src', imagepath);
        }
      });
    } else {
      $('.col6').css('display','none');
      $('#v_make').val('');
      $('#model').val('');
      $('#year').val('');
      $('#vin').val('');
      $('#price').val('$0');
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

  function getQueryVariable(variable)
  { 
    var query = window.location.search.substring(1); 
    var vars = query.split("&"); 
    for (var i=0;i<vars.length;i++)
    { 
      var pair = vars[i].split("="); 
      if (pair[0] == variable)
      { 
        return pair[1]; 
      } 
    }
    return -1; //not found 
  }

  function addCobuyer(){
    var cb = document.getElementById('cobuyer');
  
    if(cb.checked == true){
      document.getElementById('cobuyer_div').style.display = "block";
      $('#cobuyer_fname').attr("required","required");
      $('#cobuyer_lname').attr("required","required");
      $('#cobuyer_email').attr("required","required");
      $('#cobuyer_cellphone1').attr("required","required");
      $('#cobuyer_date_month').attr("required","required");
      $('#cobuyer_date_day').attr("required","required");
      $('#cobuyer_date_year').attr("required","required");
      $('#cobuyer_ssn1').attr("required","required");
      $('#cobuyer_ssn2').attr("required","required");
      $('#cobuyer_ssn3').attr("required","required");
      $('#cobuyer_address').attr("required","required");
      $('#cobuyer_city').attr("required","required");
      $('#cobuyer_state').attr("required","required");
      $('#cobuyer_zip').attr("required","required");
      $('#cobuyer_residence_type').attr("required","required");
      $('#cobuyer_time_address_year').attr("required","required");
      $('#cobuyer_time_address_months').attr("required","required");
      $('#cobuyer_monthly_payment').attr("required","required");
      $('#cobuyer_emp_name').attr("required","required");
      $('#cobuyer_occupation').attr("required","required");
      $('#cobuyer_emp_phone1').attr("required","required");
      $('#cobuyer_emp_zip').attr("required","required");
      $('#cobuyer_emp_type').attr("required","required");
      $('#cobuyer_twe_years').attr("required","required");
      $('#cobuyer_twe_months').attr("required","required");
      $('#cobuyer_monthly_income').attr("required","required");
      $('#cobuyer_twe_months').attr("required","required");
      $('#cobuyer_twe_months').attr("required","required");
      $('#cobuyer_twe_months').attr("required","required");
      $('#cobuyer_monthly_income').attr("required", "required");
      $('#cobuyer_country').attr("required", "required");
    }else{
      document.getElementById('cobuyer_div').style.display = "none";
      $('#cobuyer_fname').removeAttr("required");
      $('#cobuyer_lname').removeAttr("required");
      $('#cobuyer_email').removeAttr("required");
      $('#cobuyer_cellphone1').removeAttr("required");
      $('#cobuyer_date_month').removeAttr("required");
      $('#cobuyer_date_day').removeAttr("required");
      $('#cobuyer_date_year').removeAttr("required");
      $('#cobuyer_ssn1').removeAttr("required");
      $('#cobuyer_ssn2').removeAttr("required");
      $('#cobuyer_ssn3').removeAttr("required");
      $('#cobuyer_address').removeAttr("required");
      $('#cobuyer_city').removeAttr("required");
      $('#cobuyer_state').removeAttr("required");
      $('#cobuyer_zip').removeAttr("required");
      $('#cobuyer_residence_type').removeAttr("required");
      $('#cobuyer_time_address_year').removeAttr("required");
      $('#cobuyer_time_address_months').removeAttr("required");
      $('#cobuyer_monthly_payment').removeAttr("required");
      $('#cobuyer_emp_name').removeAttr("required");
      $('#cobuyer_occupation').removeAttr("required");
      $('#cobuyer_emp_phone1').removeAttr("required");
      $('#cobuyer_emp_zip').removeAttr("required");
      $('#cobuyer_emp_type').removeAttr("required");
      $('#cobuyer_twe_years').removeAttr("required");
      $('#cobuyer_twe_months').removeAttr("required");
      $('#cobuyer_monthly_income').removeAttr("required");
      $('#cobuyer_twe_months').removeAttr("required");
      $('#cobuyer_twe_months').removeAttr("required");
      $('#cobuyer_twe_months').removeAttr("required");
      $('#cobuyer_monthly_income').removeAttr("required");
      $('#cobuyer_country').removeAttr("required");
    }
  }
</script>
<div class="container_1">
<?php include_once("menu.inc.php");?>
  <div class="container_2">
   <div id="about">
      <h2 style="font-size: 24px; margin: 0px 0px -12px 45px;">Vehicle Loan Application</h2>
      <div class="separator"></div>
      <h3 style="margin-left: 45px; color: #1aa2f1">It's Fast, Secure and Free!</h3>
      <article>
      <section>  
        <form name="getapproved" id="getapproved" action="financeprocess.php" method="post" enctype="multipart/form-data">
          <div class="g_approved">
            <div class="g_approved_Inner">
              <div class="g_approved_safeguard"><img src="img/ssl_secure_icon.png" alt="Comodo Positive 256  Bit Data Encryption Secured" title="Comodo Positive 256  Bit Data Encryption Secured"></div>
              <div class="clear"></div>
              <div class="part_one">
                <div class="select_vehicle" style="color:#fff;">
                  <span style="display:block;height: 30px;width: 30px;text-align: center; background: #1A4782;color: #fff;font-size: 25px;font-weight: bold;">1</span>
                  <div class="txt01">Selected Vehicle:</div>
                <select class="vehicle" id="vehicle">
                  <option value="">Select</option>
                  <optgroup label="MAKES">
                  <?php
                  foreach ($makes as $make) {
                      $make_name = $make['make'];
                      $vehicles  = $listing_obj->getall_listing(false, false, "title", "asc", "dealer_id = 306 and make='$make_name'");
                  ?>
                    <optgroup label="<?php
                      echo $make['make'];
                  ?>">    
                                          <?php
                      foreach ($vehicles as $vehicle) {
                  ?>
                                            <option value="<?php
                          echo $vehicle['listing_id'];
                  ?>"><?php
                          echo $vehicle['title'];
                  ?></option>

                                            <?php
                      }
                  }
                  ?>
                    </optgroup>
                  </optgroup>
                  <option value=""></option>
                  <optgroup label="MODELS">
                    <?php
                      foreach ($models as $model) {
                          $model_name = $model['model'];
                          $vehicles   = $listing_obj->getall_listing(false, false, "title", "asc", "dealer_id = 306 and model='$model_name'");
                      ?>
                        <optgroup label="<?php
                          echo $model['model'];
                      ?>">    
                                              <?php
                          foreach ($vehicles as $vehicle) {
                      ?>
                                                <option value="<?php
                              echo $vehicle['listing_id'];
                      ?>"><?php
                              echo $vehicle['title'];
                      ?></option>

                                                <?php
                          }
                      }
                    ?>
                    </optgroup>
                  </optgroup>

                  <option value=""></option>
                  <optgroup label="YEARS">
                    <?php
                      foreach ($years as $year) {
                          $year_name = $year['year'];
                          $vehicles  = $listing_obj->getall_listing(false, false, "title", "asc", "dealer_id = 306 and year='$year_name'");
                      ?>
                                            <optgroup label="<?php
                          echo $year['year'];
                      ?>">    
                                              <?php
                          foreach ($vehicles as $vehicle) {
                      ?>
                                                <option value="<?php
                              echo $vehicle['listing_id'];
                      ?>"><?php
                              echo $vehicle['title'];
                      ?></option>

                                                <?php
                          }
                      }
                    ?>
                    </optgroup>
                  </optgroup>
                </select>
                <span style="float: left; padding-left: 10px; margin-top: -5px;color:#3399FF;">*</span>
                <div class="indicate"><input name="as_is" id="as_is" type="checkbox" value="" required>Correct as indicated below</div> 
                <div class="clear_data" style="float:left">
                  <span style="color:#3399FF; font-size:10px;"><em>(Required field)</em></span>
               </div> 
             </div>
             <div class="clear"></div>
             <div id="select_vehicle" class="grey_box">
              <div class="col1">
               <div class="row1">
                <input type="hidden" id="listing_id" name="listing_id" value="<?php
                  foreach ($listing as $list) {
                      echo $list['listing_id'];
                  }
                  ?>">
                                  Make<br>
                                  <input name="v_make" id="v_make"  type="text" class="frm111" value="<?php
                  echo $_make;
                  ?>" >
                                </div>
                                <div class="row2">
                                  Vendor:<br>
                                  <input name="vendor" id="vendor" type="text" class="frm111" value="Berge Auto">
                                </div>
                              </div>
                              <div class="col2">
                               <div class="row1">
                                Model<br>
                                <input name="model" id="model" type="text" class="frm89" value="<?php
                  echo $_model;
                  ?>">
                              </div>
                              <div class="row2">
                                City:<br>
                                <input name="v_city" id="v_city" type="text" class="frm89" value="Orem">
                              </div>
                            </div>
                            <div class="col3">
                              <div class="row1">
                                Year<br>
                                <input name="year" id="year" type="text" class="frm36" style="width:62px" value="<?php
                  echo $_year;
                  ?>">
                              </div>
                              <div class="clear"></div>
                              <div class="row2">
                               State:<br>
                               <input name="v_state" id="v_state" type="text" style="width:62px" class="frm36" value="Utah">
                             </div>
                           </div>
                           <div class="col4">
                            <div class="row1">
                              Vin<br>
                              <input name="vin" id="vin" type="text" class="frm141" value="<?php
                  echo $_vin;
                  ?>">
                            </div>
                            <div class="row2">
                             Phone:<br>
                             <input name="v_phone" id="v_phone" type="text" class="frm141" value="801-224-1555 ">
                           </div>
                         </div>
                         <div class="col5">
                          <div class="row1">
                           Price<br>
                           <input name="price" id="price" type="text" class="frm89" value="<?php
                  echo "$" . number_format($_price);
                  ?>">
                         </div>
                         <div class="row2">
                          Fax:<br>
                          <input name="v_fax" id="v_fax" type="text" class="frm89" value="801-224-1556">
                        </div>
                      </div>
                      <div class="col6">
                        Photo<br>
                        <div class="row1">
                          <img src="<?php
                  echo $_image_url;
                  ?>" class="indeximg" alt="" width="100px" height="73px" id="vehicle_image">
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>
<div class="clear"></div>
<div class="part_two">
 <div id="gohere" tabindex='1'></div>
 <div class="complete_field" style="color:#fff;">
   <span style="display:block;height: 30px;width: 30px;text-align: center; background: #1A4782;color: #fff;font-size: 25px;font-weight: bold;">2</span>
   Complete All fields  -  <em>Do not use commas or dashes.</em>
 </div><br/>
 <div class="clear"></div>
 <div class="left_grey_box">
  <div class="part_two_title">Personal Infomation</div>
  <label>Name</label>
  <input name="fname"  id="fname" type="text" class="frm90" placeholder="First" required="required">
  <input name="lname" id="lname" type="text" class="frm90" placeholder="Last" required="required">
  <div class="clear"></div>
  <label>Email</label>
  <input name="email" id="email" type="email" class="frm151" required="required">
  <div class="clear"></div>
  <label>Cell Phone</label>
  <input name="cellphone1" type="text" class="longtxt phone" required="required">
  <div class="clear"></div>
  <label>Date of Birth</label>
  <select name="date_month" class="selectdate" required="required">
    <option selected value="">MM</option>
    <?php
for ($i = 1; $i <= 12; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
  </select> 
  <select name="date_day" class="selectdate" required="required">
    <option selected value="">DD</option>
    <?php
for ($i = 1; $i <= 31; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
  </select> 
  <select name="date_year" class="selectdate" required="required">
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
  <input name="ssn1" type="text" class="frm47" required="required">
  <input name="ssn2" type="text" class="frm47" required="required">
  <input name="ssn3" type="text" class="frm47" required="required">
</div>
<div class="right_grey_box">
  <div class="part_two_title">Residential Information</div>
  <div class="clear"></div>
  <label>Street Address</label>
  <input name="address" type="text" class="frm151" required="required">
  <div class="clear"></div>
  <label>City</label>
  <input name="city" type="text" class="frm151" required="required">
  <div class="clear"></div>
  <label>State / Province</label>
  <input name="state" type="text" class="frm55 required="required""> 
  <label style="width: 35px;">zip/Pc</label>
  <input name="zip" type="text" class="frm68" required="required">
  <label style="width: 46px;">Country</label>
  <input name="country" type="text" class="frm68" required="required">
  <div class="clear"></div>
  <label>Residence Type</label>
  <select name="residence_type" class="frm151" style="height: 23px;" required="required">
   <option value="Rent">Rent</option>
   <option value="Own - Buying">Own - Buying</option>
   <option value="Live with Family">Live with Family</option>
   <option value="Other">Other</option>
 </select>
 <div class="clear"></div>
 <label>Time at Address</label>
 <select name="time_address_year" class="selectdate" required="required">
  <option selected value="">Year</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10+</option>
</select> 
<select name="time_address_months" class="selectdate" required="required">
  <option selected value="">Months</option>
  <?php
for ($i = 1; $i <= 12; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
</select>
<div class="clear"></div>
<label>Monthly Payment $</label><input name="monthly_payment" id="monthly_payment" type="text" class="frm55" required="required">
</div>
<div class="clear"></div>
<div class="full_col">
  <div class="part_two_title">Employment Information</div>
  <div class="full_left_col">
    <label>Employer Name</label>
    <input name="emp_name" type="text" class="longtxt" required="required">
    <div class="clear"></div>
    <label>Occupation / Title</label>
    <input name="occupation" type="text" class="longtxt" required="required">
    <div class="clear"></div>
    <label>Work Phone</label>
    <input name="emp_phone1" type="text" class="longtxt phone" required="required">
    <div class="clear"></div>
    <label>Employer Zip</label>
    <input name="emp_zip" type="text" class="longtxt" required="required">
  </div>
  <div class="full_right_col">
   <label>Employment Type</label>
   <select name="emp_type" class="frm151" style="height: 23px;" required="required">
     <option value="W-2 Employee">W-2 Employee</option>
     <option value="1099 Self Employed">1099 Self Employed</option>
     <option value="Fixed Income">Fixed Income</option>
   </select>
   <div class="clear"></div>
   <label>Time with Employer</label>
   <select name="twe_years" class="selectdate">
    <option selected value="">Years</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10+</option>
  </select>
  <select name="twe_months" class="selectdate" required="required">
    <option selected value="">Months</option>
    <?php
for ($i = 1; $i <= 12; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
  </select>
  <div class="clear"></div>
  <label>Employer Income $</label>
  <input name="monthly_income" id="monthly_income" type="text" class="frm53" required="required">
  <label>per mo.</label>
  <div class="clear"></div>
  <label>Other Income $</label>
  <input name="other_income" id="monthly_income" type="text" class="frm53">
  <label>per mo.</label>
</div>
<div class="clear"></div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="clear"></div>
<div class="part_two">
  <div id="gohere" tabindex='1'></div>
  <div class="complete_field" style="color:#fff;">
   <span style="display:block;height: 30px;width: 30px;text-align: center; background: #1A4782;color: #fff;font-size: 25px;font-weight: bold;">3</span>
   Additional Information  <em>(required)</em>
  </div><br/>
  <div class="full_col">
  <div id="gohere" tabindex='1'></div>
  
    <div class="additional_txt">Do you have any of the following payment methods to submit monthly payments?</div>
    <div class="payment_method">Checking Account 
      <select name="ca" class="" required="required">
        <option value="">Select</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
    </div>
    <div class="payment_method2">Saving Account 
      <select name="sa" class="" required="required">
        <option value="">Select</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
    </div>
    <div class="payment_method3">Credit Card
     <select name="cc" class="padL7px" required="required">
       <option value="">Select</option>
       <option value="Yes">Yes</option>
       <option value="No">No</option>
     </select>
    </div>
    <div class="clear"></div>
    <div style="font-size:14px; text-align:left; margin:12px 0 9px;">Do you have a down payment?
      <select id = "downpayment" name="downpayment" style="padding-left:7px; margin: -10px 10px 0 30px; width: 88px;" required="required">
        <option value="">Select</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
      If Yes, how much? $
      <input name="downpayment_amount" id="downpayment_amount" type="text" style="margin-top: -10px; width: 92px">
    </div>
    <div class="clear"></div>
    <div style="font-size:14px; text-align:left; ">What credit rating do you have?
      <select style="position: relative; top: -11px; margin: 0px 10px 0px 23px;padding-left:7px" id="credit_rating" name="credit_rating" style="padding-left:7px;" required="required">
        <option value="">Select</option>
        <option value="Poor">Poor</option>
        <option value="Fair">Fair</option>
        <option value="Good">Good</option>
        <option value="Excellent">Excellent</option>
      </select>
      Comments
      <textarea name="credit_comment"rows="1" style="position: relative; top: -4px"></textarea>
    </div>
    <div class="clear"></div>
    <div style="font-size:14px; text-align:left; margin-bottom:9px;">Do you have a vehicle trade-in?
      <select id="trade_in" name="trade_in" style="padding-left:7px; margin: -5px 10px 0 24px; width: 88px;" required="required">
        <option value="">Select</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
      If Yes, please complete the field below.
    </div>
    <div class="clear"></div>

    <div id="vehicle_trade_in" class="grey_box" style="visibility: hidden">
      <div class="col1">
        <div class="row1">
          Make<br>
          <input name="trade-in-make" id="trade-in-make" type="text" class="frm111">
        </div>
      </div>
      <div class="col2">
        <div class="row1">
          Model<br>
          <input name="trade-in-model" id="trade-in-model" type="text" class="frm89">
        </div>
      </div>
      <div class="col3">
        <div class="row1">
          Year<br>
          <input name="trade-in-year" id="trade-in-year" type="text" class="frm36" style="width:62px">
        </div>
      </div>
      <div class="col4">
        <div class="row1">
          Color<br>
          <input name="trade-in-color" id="trade-in-color" type="text" class="frm141">
        </div>
      </div>
      <div class="col5">
        <div class="row1">
          Miles<br>
          <input name="trade-in-miles" id="trade-in-miles" type="text" class="frm89">
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div id = "owe-trade-in"style="font-size:14px; text-align:left; margin-bottom:9px;visibility: hidden">Do you owe money on trade-in?
      <select id="owe_trade_in" name="owe_trade_in" style="width: 88px;padding-left:7px; margin: -5px 10px 0 23px;">
        <option value="">Select</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
      If yes how much? $
      <input id="input_owe_trade" name="input_owe_trade" type="text" style="margin: -10px 0 0 10px;width: 92px">
    </div>
    <div class="clear"></div>
    <div id = "condition_trade"style="font-size:14px; text-align:left; margin-bottom:9px;visibility: hidden">What's the condition of trade
      <select id="condition_trade_rating" name="condition_trade_rating" style="padding-left:7px; margin: -5px 10px 0 43px;">
        <option value="">Select</option>
        <option value="Poor">Poor</option>
        <option value="Fair">Fair</option>
        <option value="Good">Good</option>
        <option value="Excellent">Excellent</option>
      </select>
      Vin # <span style="font-size:10px;margin-top:-20px;"><em>(optional)</em></span>
      <input id="trade-in-vin" name="condition_trade" type="text" style="margin: -10px 0 0 10px;">
    </div>
  </div>
</div>

  



<div class="clear"></div>
<br><br>
<div id="cobuyer_div" style="display:none">
 <div class="complete_field" style="color:#fff;">
   <span style="display:block;height: 30px;width: 30px;text-align: center; background: #1A4782;color: #fff;font-size: 25px;font-weight: bold;">4</span>
   Cobuyer Section  -  <em>Do not use commas or dashes.</em>
 </div><br/>
 <div class="clear"></div>
 <div class="left_grey_box">
  <div class="part_two_title">Personal Infomation</div>
  <label>Name</label>
  <input name="cobuyer_fname"  id="cobuyer_fname" type="text" class="frm90" placeholder="First" >
  <input name="cobuyer_lname" id="cobuyer_lname" type="text" class="frm90" placeholder="Last" >
  <div class="clear"></div>
  <label>Email</label>
  <input name="cobuyer_email" id="cobuyer_email" type="email" class="frm151" >
  <div class="clear"></div>
  <label>Cell Phone</label>
  <input name="cobuyer_cellphone1" type="text" class="longtxt phone" id="cobuyer_cellphone1"  />
  <div class="clear"></div>
  <label>Date of Birth</label>
  <select name="cobuyer_date_month" id="cobuyer_date_month" class="selectdate" >
    <option selected value="">MM</option>
    <?php
for ($i = 1; $i <= 12; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
  </select> 
  <select name="cobuyer_date_day" id="cobuyer_date_day" class="selectdate" >
    <option selected value="">DD</option>
    <?php
for ($i = 1; $i <= 31; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
  </select> 
  <select name="cobuyer_date_year" id="cobuyer_date_year" class="selectdate" >
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
  <input name="cobuyer_ssn1" id="cobuyer_ssn1" type="text" class="frm47" >
  <input name="cobuyer_ssn2" id="cobuyer_ssn2" type="text" class="frm47" >
  <input name="cobuyer_ssn3" id="cobuyer_ssn3" type="text" class="frm47">
</div>
<div class="right_grey_box">
  <div class="part_two_title">Residential Information</div>
  <div class="clear"></div>
  <label>Street Address</label>
  <input name="cobuyer_address" id="cobuyer_address" type="text" class="frm151">
  <div class="clear"></div>
  <label>City</label>
  <input name="cobuyer_city" id="cobuyer_city" type="text" class="frm151">
  <div class="clear"></div>
  <label>State / Province</label>
  <input name="cobuyer_state" id="cobuyer_state" type="text" class="frm55"> 
  <label style="width: 35px;">zip/Pc</label>
  <input name="cobuyer_zip" id="cobuyer_zip" type="text" class="frm68">
  <label style="width: 46px;">Country</label>
  <input name="cobuyer_country" id="cobuyer_country" type="text" class="frm68">
  <div class="clear"></div>
  <label>Residence Type</label>
  <select name="cobuyer_residence_type" id="cobuyer_residence_type" class="frm151" style="height: 23px;">
   <option value="Rent">Rent</option>
   <option value="Own - Buying">Own - Buying</option>
   <option value="Live with Family">Live with Family</option>
   <option value="Other">Other</option>
 </select>
 <div class="clear"></div>
 <label>Time at Address</label>
 <select name="cobuyer_time_address_year" id="cobuyer_time_address_year" class="selectdate">
  <option selected value="">Year</option>
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
  <option>6</option>
  <option>7</option>
  <option>8</option>
  <option>9</option>
  <option>10+</option>
</select> 
<select name="cobuyer_time_address_months" id="cobuyer_time_address_months" class="selectdate">
  <option selected value="">Months</option>
  <?php
for ($i = 1; $i <= 12; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
</select>
<div class="clear"></div>
<label>Monthly Payment $</label><input name="cobuyer_monthly_payment" id="cobuyer_monthly_payment" type="text" class="frm55">
</div>
<div class="clear"></div>
<div class="full_col">
  <div class="part_two_title">Employment Information</div>
  <div class="full_left_col">
    <label>Employer Name</label>
    <input name="cobuyer_emp_name" id="cobuyer_emp_name" type="text" class="longtxt">
    <div class="clear"></div>
    <label>Occupation / Title</label>
    <input name="cobuyer_occupation" id="cobuyer_occupation" type="text" class="longtxt">
    <div class="clear"></div>
    <label>Work Phone</label>
    <input name="cobuyer_emp_phone1" id="cobuyer_emp_phone1" type="text" class="longtxt phone">
    <div class="clear"></div>
    <label>Employer Zip</label>
    <input name="cobuyer_emp_zip" id="cobuyer_emp_zip" type="text" class="longtxt">
  </div>
  <div class="full_right_col">
   <label>Employment Type</label>
   <select name="cobuyer_emp_type" id="cobuyer_emp_type" class="frm151" style="height: 23px;">
     <option value="W-2 Employee">W-2 Employee</option>
     <option value="1099 Self Employed">1099 Self Employed</option>
     <option value="Fixed Income">Fixed Income</option>
   </select>
   <div class="clear"></div>
   <label>Time with Employer</label>
   <select name="cobuyer_twe_years" id="cobuyer_twe_years" class="selectdate">
    <option selected value="">Years</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
    <option>8</option>
    <option>9</option>
    <option>10+</option>
  </select>
  <select name="cobuyer_twe_months" id="cobuyer_twe_months" class="selectdate">
    <option selected value="">Months</option>
    <?php
for ($i = 1; $i <= 12; $i++) {
    echo "<option>" . $i . "</option>";
}
?>
  </select>
  <div class="clear"></div>
  <label>Employer Income $</label>
  <input name="cobuyer_monthly_income" id="cobuyer_monthly_income" type="text" class="frm53">
  <label>per mo.</label>
  <div class="clear"></div>
  <label>Other Income $</label>
  <input name="cobuyer_other_income" id="cobuyer_other_income" type="text" class="frm53">
  <label>per mo.</label>
</div>
<div class="clear"></div>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="full_col">
  <div class="part_two_title">Additional Information (required)</div>
  <div class="additional_txt">Do you have any of the following payment methods to submit monthly payments?</div>
  <div class="payment_method">Checking Account 
    <select name="cobuyer_ca" class="">
      <option value="">Select</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
  </div>
  <div class="payment_method2">Saving Account 
    <select name="cobuyer_sa" class="">
      <option value="">Select</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
  </div>
  <div class="payment_method3">Credit Card
    <select name="cobuyer_cc" class="padL7px">
      <option value="">Select</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select>
  </div>
</div>
</div>
<div class="clear"></div>
<div class="authorization_certi">
 <div class="part_two_title">Authorization and Certification</div>
 <div class="content_auth">
  <input name="cobuyer" id="cobuyer" type="checkbox" value="1" onClick="addCobuyer();" /> Check this box to add a co-buyer, or co-signer, to you application.
</div>
<div class="clear"></div>
<div class="content_auth">
  <input name="agree" id="agree" type="checkbox" value=""> I read the <a href="#">Privacy Statement</a>, agreement ot receive Electronic Documents, and state-specific notices.
</div>
</div>
<div class="part_three">
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td width="320" align="left" valign="middle"><input type="submit" name="submit_loan" id="submit_loan" value="Submit Application" style="padding: 4px 8px;height: 35px;width: 150px;"/></td>
     <td align="right" valign="middle"><img src="img/bbb-logo.png" width="101" height="39" alt="" style="border: medium none;"></td>
   </tr>
 </table>
 <div class="clear"></div>
 <div class="prt_3_content">By submitting this application, i certify that all information herein is true and complete. I authorize lending institutions and participating auto dealer to retain this application, to rely on the foregoing, to check and verify my credit, employment and salary history, By using our website, you authorize us to provide reposts on hte status of your application, including information concerning whether you pre-qualify for a loan, which lender's loan offer (if any) you choose to accept, whether your application for credit is denied, and whether you accept a loan from that lender. <a href="privacy.php" style="color: #1aa2f1;" target="_blank">Click here</a> to read the Privacy Statement, agreement to receive Electronic Documents, and state-specific notices.</div>
</div>
</div>
</div>
</div>
</form>
</section>
</article>
</div>      
<?php
include_once("footer.php");
?> 