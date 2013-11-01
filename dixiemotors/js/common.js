<!--
//DEFAULT POPUP
var common = null;
function popUpCommon(url,parameters) { //used in various pages: account, messages.xml etc - can be done with jquery
  common = window.open(url,'definePopUp',parameters);
}
//DEFAULT POPUP
var commonstay = null;
function popUpCommonStay(url,parameters) { //found in mortgages-and-home-loans/credit.aspx - can be done with jquery
  commonstay = window.open(url,'fullPopUp',parameters);
}

// HOMES LISTING IMAGE POPUP
function PopupPic(sPicURL) { //found in controls/classifieds - popup can be done with jquery
   window.open("/homes/img_popup.aspx?"+sPicURL, "", "resizable=1,HEIGHT=300,WIDTH=300,location=0");
}

//TRAP ENTER FUNCTIONS
//Note: Rename in future.
function TrapEnterButtonLookupFF(btnName, evt)
{
   var button = null;

   //-Which browser are we using?-
   if (document.all)                 //IE
   {
      button = document.all[btnName];
   }
   else if (document.getElementById) //Mozilla
   {
      button = document.getElementById(btnName);
   }

   //-Do the trap?-
   if (button != null)
   {
      TrapEnterFF(button, evt);
   }
   else
   {
      return !(window.event && window.event.keyCode == 13);
   }
}

function TrapEnterFF(btn, e) {
if(window.event) // IE
  {
  if (window.event.keyCode == 13) 
  {
    window.event.returnValue= false;
   window.event.cancel = true;
   btn.click();
}
  }
else if(e.which) // Netscape/Firefox/Opera
  {
  if (e.which == 13)
   {
   e.returnValue=false;
   e.cancel = true;
   btn.click();
   }
  }
 }

//URL FOR BUTTONS
function MM_goToURL() {
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}

//BOOKMARK THIS PAGE
function addBookmark(title,url) { //addBookmark and Bookmark: should be only one function for page bookmark
   if (window.sidebar) { 
      window.sidebar.addPanel(title, url,""); 
   } else if( document.all ) {
      window.external.AddFavorite( url, title);
   } else if( window.opera && window.print ) {
      return true;
   }
}

//FROM RANDOMURL.JS
   // Set up the variables we need for the random URL selection using 4 arrays.

   var uc = 2;             // Number of URLs
   var u = new Array(uc);           // Array to hold URLs

   var uc1 = 2;               // Number of URLs
   var u1 = new Array(uc1);         // Array to hold URLs
   
   var uc2 = 2;               // Number of URLs
   var u2 = new Array(uc2);         // Array to hold URLs
   
   var uc3 = 2;               // Number of URLs
   var u3 = new Array(uc3);         // Array to hold URLs
   // point to URL
   
   
   // Pre-Qualify
   u[0] = "/fe/redirect.aspx?http%3A//service.bfast.com/bfast/click%3Fbfmid%3D115759%26sourceid%3D40662145%26categoryid%3Dmortgage_loans%26brand%3D40662145";
   u[1] = "/fe/redirect.aspx?http%3A//clk.atdmt.com/HLC/go/brgnchlc00300005hlc/direct/01/";
   
   // Get A Mortgage 
   u1[0] = "/fe/redirect.aspx?http%3A//service.bfast.com/bfast/click%3Fbfmid%3D115759%26sourceid%3D40662145%26categoryid%3Dmortgage_loans%26brand%3D40662145";
   u1[1] = "/fe/redirect.aspx?http%3A//clk.atdmt.com/HLC/go/brgnchlc00300006hlc/direct/01/";
   
   // Refinance
   u2[0] = "/fe/redirect.aspx?http%3A//service.bfast.com/bfast/click%3Fbfmid%3D115759%26sourceid%3D40662145%26categoryid%3Drefinance_loans%26brand%3D40662145";
   u2[1] = "/fe/redirect.aspx?http%3A//clk.atdmt.com/HLC/go/brgnchlc00300002hlc/direct/01/";
   
   // Home Equity Loan 
   u3[0] = "/fe/redirect.aspx?http%3A//service.bfast.com/bfast/click%3Fbfmid%3D115759%26sourceid%3D40662145%26categoryid%3Dhome_equity_loans%26brand%3D40662145";
   u3[1] = "/fe/redirect.aspx?http%3A//clk.atdmt.com/HLC/go/brgnchlc00300003hlc/direct/01/";


   // pickRandom - Return a random number in a given range. This
   // function is 'browser-proofed' to run correctly on older
   // browsers that don't implement 'Math.random'.
   
   function pickRandom(range) {
      if (Math.random)
         return Math.round(Math.random() * (range-1));
      else {
         var   now = new Date();
         return (now.getTime() / 1000) % range;
      }
   }

   // Function: pickRandomURL
   //
   // A very simple function that selects one of the URLs in the
   // 'u' array at random, and returns it as a string.

   function pickPreURL() {
      var choice = pickRandom(uc);
      return u[choice];
   }
   
   function pickMortgageURL() {
      var choice = pickRandom(uc1);
      return u1[choice];
   }
   
    function pickRefinanceURL() {
      var choice = pickRandom(uc2);
      return u2[choice];
   }
   
    function pickEquityURL() {
      var choice = pickRandom(uc3);
      return u3[choice];
   }

//ENHANCED STRING FUNCTIONS
String.prototype.trim = function() { return this.replace(/^\s+|\s+$/g, ''); }

function scrollToId(divId){
  window.scrollTo(0,320);
}

//Expand & Collapse, as shown in Propert Reports
function expandCollapse(sId) { // can be done with jquery
   elem = document.getElementById(sId); 
   elem.style.display = (elem.style.display=='block'?'none':'block');
}

//used to show any element with an ID associated with it
function expandAll(sId) { // can be done with jquery
   elem = document.getElementById(sId); 
   if (!elem) {
        return false;
    }
    elem.style.display='block';
}

//used to hide any element with an ID associated with it
function collapseAll(sId) { // can be done with jquery
   elem = document.getElementById(sId);
   if (!elem) {
        return false;
    } 
   elem.style.display='none';
}

//FORECLOSURE LAWS BY STATE
function FocusGoButton() {
document.getElementById('_ctl0_contentBlockdefn_Foreclosurelawsbystate2_FindItButton').focus();
}


// CALCULATORS

//Bookmark this page
function Bookmark(url,title) //addBookmark and Bookmark: should be only one function for page bookmark
{
   if ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4)) 
   {
      window.external.AddFavorite(url,title);
   } 
   else if (navigator.appName == "Netscape") 
   {
      window.sidebar.addPanel(title,url,"");
   } 
   else 
   {
      alert("Press CTRL-D (Netscape) or CTRL-T (Opera) to bookmark");
   }
}

// Go button
function Go()
{
   window.location=document.getElementById("menu").value;
}
// -->

function clearObj(obj){ //text box clear
   if (obj.value == obj.defaultValue)  {
      obj.value="";
   }
}
function replaceObj(obj){
   if (obj.value == "") {
      obj.value = obj.defaultValue;
   }
}


//=============================================================================
// Function
// Note: Common Ajax call
//=============================================================================
function createRequest()
{
   try
   {
      //Non-Microsoft
      request = new XMLHttpRequest();
   }
   catch (tryMS)
   {
      try
      {
         //Microsoft
         request = new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch (otherMS)
      {
         try
         {
            //Microsoft
            request = new ActiveXObject("Microsoft.XMLHTTP");
         }
         catch (failed)
         {
            request = null;
         }
      }
   }
   
   return request;
}

//=============================================================================
// Function for Multiple Event Handlers
//=============================================================================
function addEventHandler(obj, eventName, handler)
{
  if (document.attachEvent)
  {
    obj.attachEvent("on" + eventName, handler);
  }
  else if (document.addEventListener)
  {
    obj.addEventListener(eventName, handler, false);
  }
}

//=============================================================================
// Function for getting the object that triggered the event
//=============================================================================
function getActivatedObject(e) {
  var obj;
  if (!e) //Early IE
  {
    obj = window.event.srcElement;
  }
  else if (e.srcElement) //IE 7 or later
  {
    obj = e.srcElement;
  }
  else  //DOM Level 2
  {
    obj = e.target;  
  }

  return obj;
}

//=============================================================================
// Function for Unica
//=============================================================================
function NormalizeURLHost(url)
{
   var hostToken = 'HOST_TOKEN';

   //---Remove port numbers after host name---
   var portPatt = /:\d{1,5}/;
   if (portPatt.test(url) == true)
      url = RegExp.leftContext + RegExp.rightContext;
   
   //---Replace with Temp Token---
   //Note: Order matters!
   url = url.replace('localhost', hostToken);
   url = url.replace('alpha.foreclosedhomes.com', hostToken);
   url = url.replace('beta.foreclosedhomes.com', hostToken);
   url = url.replace('www.foreclosedhomes.com', hostToken); //Necessary
   url = url.replace('foreclosedhomes.com', hostToken);
   
   //---Use Standard Host---
   url =  url.replace(hostToken, 'www.foreclosedhomes.com');
   
   //---Special Case: Requested by Deborah---
   if (url == 'http://www.foreclosedhomes.com/')
      url += 'default.aspx';

   return url;
}

//==========================================================================
// functions from refineSearchWidget control
//==========================================================================

function clearTextSearch_Focus2(){	
	if (document.getElementById(CityStateOrZipBoxId).value == " city, state or zip")
	{
		document.getElementById(CityStateOrZipBoxId).value = "";
	}
	searchErrorPopUpClose1();
}
		
function addTextSearch_Blur1(){
	if(document.getElementById(CityStateOrZipBoxId).value == "")
	{
		document.getElementById(CityStateOrZipBoxId).value = " city, state or zip";
	}
}

function getBrowser() {
	var browser=navigator.appName;
	return browser;
}

function searchErrorPopupOpen1(){	
	if (getBrowser() == "Microsoft Internet Explorer") {
		if (typeof document.body.style.maxHeight == "undefined") {
			document.getElementById(popupid1).style.display='block';
			document.getElementById(errorid1).style.display='block';
		} else {
			document.getElementById(popupid1).style.display='block';
			document.getElementById(errorid1).style.display='block';
		}
	} else {
		document.getElementById(popupid1).style.display='block';
	}
}
function searchErrorPopUpClose1(){
	document.getElementById(popupid1).style.display='none';	
	document.getElementById(errorid1).style.display='none';
}

function dropDownListOnChange()
{
		var ddmin = document.getElementById(MinPriceDropDownListId);
		var ddmax = document.getElementById(MinPriceDropDownListId);
		var selectedIndex = ddmin.selectedIndex;
		var selectedValueMax = ddmax.options[ddmax.selectedIndex].value;
		
		if (ddmax.length < ddmin.length) 
		{	
			restoreMaxPriceDDList();
		}
		
		for(var i = selectedIndex - 1; i > 0; i --)
		{
			 ddmax.remove(i);
		}
		
		for (var i = 0; i < ddmax.length; i++)
			if (ddmax.options[i].value == selectedValueMax)
				ddmax.options[i].selected = true; 
}

function restoreMaxPriceDDList()
{
		var i;
		var ddmin = document.getElementById(MinPriceDropDownListId);
		var ddmax = document.getElementById(MaxPriceDropDownListId);
		
		for(i = ddmax.length - 1; i >= 1; i--)
		{
			ddmax.remove(i);
		}
		
		var index = ddmin.length;
		i = 1;
		
		while ( i < index)
		{
			var opt = document.createElement("option");
			ddmax.options.add(opt);
			opt.text = ddmin.options[i].text; 
			opt.value = ddmin.options[i].value;
			i = i + 1;
		}
}
function getSearchValue(searchValueId){				
		searchValue = document.getElementById(searchValueId).value;
		if ( (searchValue.length > 14) && (searchValue != ' Enter "zip code" or "city, state"') ) 
		{
			searchValue = 'for "' + searchValue.substring(0,14) + '...' + '" ';
			document.getElementById('errorValue').innerHTML = searchValue;		
		}
		else if ( (searchValue.length == 0) || (searchValue == ' Enter "zip code" or "city, state"'))
		{
			searchValue = '';
			document.getElementById('errorValue').innerHTML = searchValue;
				//document.write('<strong>' + searchValue + '</strong>');
		}
		else
			document.getElementById('errorValue').innerHTML = 'for ' + '"' + searchValue + '" ';
}


//==========================================================================
// functions from mapSearch control
//==========================================================================

function newImage(arg) {
	if (document.images) {
		rslt = new Image();
		rslt.src = arg;
		return rslt;
	}
}

function changeImages() {
	if (document.images && (preloadFlag == true)) {
		for (var i=0; i<changeImages.arguments.length; i+=2) {
			document[changeImages.arguments[i]].src = changeImages.arguments[i+1];
		}
	}
}
		
function preloadImages() {
	if (document.images) {

		usa_ok_over = newImage("/images/homes/map/usa_ok_over.jpg");
		usa_id_over = newImage("/images/homes/map/usa_id_over.jpg");
		usa_al_over = newImage("/images/homes/map/usa_al_over.jpg");
		usa_wi_over = newImage("/images/homes/map/usa_wi_over.jpg");
		usa_me_over = newImage("/images/homes/map/usa_me_over.jpg");
		usa_nc_over = newImage("/images/homes/map/usa_nc_over.jpg");
		usa_AZ_over = newImage("/images/homes/map/usa_az_over.jpg");
		usa_ma_over = newImage("/images/homes/map/usa_ma_over.jpg");
		usa_ca_over = newImage("/images/homes/map/usa_ca_over.jpg");
		usa_oh_over = newImage("/images/homes/map/usa_oh_over.jpg");
		usa_ar_over = newImage("/images/homes/map/usa_ar_over.jpg");
		usa_in_over = newImage("/images/homes/map/usa_in_over.jpg");
		usa_il_over = newImage("/images/homes/map/usa_il_over.jpg");
		usa_va_over = newImage("/images/homes/map/usa_va_over.jpg");
		usa_ct_over = newImage("/images/homes/map/usa_ct_over.jpg");
		usa_pa_over = newImage("/images/homes/map/usa_pa_over.jpg");
		usa_ne_over = newImage("/images/homes/map/usa_ne_over.jpg");
		usa_UT_over = newImage("/images/homes/map/usa_ut_over.jpg");
		usa_fl_over = newImage("/images/homes/map/usa_fl_over.jpg");
		usa_TX_over = newImage("/images/homes/map/usa_tx_over.jpg");
		usa_sd_over = newImage("/images/homes/map/usa_sd_over.jpg");
		usa_mt_over = newImage("/images/homes/map/usa_mt_over.jpg");
		usa_md_over = newImage("/images/homes/map/usa_md_over.jpg");
		usa_nv_over = newImage("/images/homes/map/usa_nv_over.jpg");
		usa_wv_over = newImage("/images/homes/map/usa_wv_over.jpg");
		usa_wy_over = newImage("/images/homes/map/usa_wy_over.jpg");
		usa_nm_over = newImage("/images/homes/map/usa_nm_over.jpg");
		usa_tn_over = newImage("/images/homes/map/usa_tn_over.jpg");
		usa_mi_over = newImage("/images/homes/map/usa_mi_over.jpg");
		usa_ky_over = newImage("/images/homes/map/usa_ky_over.jpg");
		usa_nd_over = newImage("/images/homes/map/usa_nd_over.jpg");
		usa_KS_over = newImage("/images/homes/map/usa_ks_over.jpg");
		usa_vt_over = newImage("/images/homes/map/usa_vt_over.jpg");
		usa_co_over = newImage("/images/homes/map/usa_co_over.jpg");
		usa_ri_over = newImage("/images/homes/map/usa_ri_over.jpg");
		usa_wa_over = newImage("/images/homes/map/usa_wa_over.jpg");
		usa_ga_over = newImage("/images/homes/map/usa_ga_over.jpg");
		usa_ak_over = newImage("/images/homes/map/usa_ak_over.jpg");
		usa_ia_over = newImage("/images/homes/map/usa_ia_over.jpg");
		usa_nh_over = newImage("/images/homes/map/usa_nh_over.jpg");
		usa_nj_over = newImage("/images/homes/map/usa_nj_over.jpg");
		usa_de_over = newImage("/images/homes/map/usa_de_over.jpg");
		usa_dc_over = newImage("/images/homes/map/usa_dc_over.jpg");
		usa_hi_over = newImage("/images/homes/map/usa_hi_over.jpg");
		usa_ms_over = newImage("/images/homes/map/usa_ms_over.jpg");
		usa_mn_over = newImage("/images/homes/map/usa_mn_over.jpg");
		usa_MO_over = newImage("/images/homes/map/usa_mo_over.jpg");
		usa_sc_over = newImage("/images/homes/map/usa_sc_over.jpg");
		usa_la_over = newImage("/images/homes/map/usa_la_over.jpg");
		usa_ny_over = newImage("/images/homes/map/usa_ny_over.jpg");
		usa_or_over = newImage("/images/homes/map/usa_or_over.jpg");
		preloadFlag = true;
	}
}
//==========================================================================
// function for My Searches/My properties delete
//==========================================================================
	function confirm_delete(panel)
	{
		var data = document.getElementById(panel);
		var inputs = data.getElementsByTagName('input');
		var isChecked = false;
		//alert(inputs.length);
		for(var i=0;i<inputs.length;i++)
		{
			if(inputs[i].type == 'checkbox')
				if (inputs[i].checked)
				{
					//alert(inputs[i].name);
					isChecked = true;
					i = inputs.length;
				}
		}	
		if(isChecked)
		{
			if (confirm("Yo are about to permanently delete the selected item(s) in your favorites.")==true)
				return true;
			else
				return false;
		}
		else
		{
			alert("Please select at least one item to delete.");
			return false;
		}
	}