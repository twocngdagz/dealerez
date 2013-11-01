<script>
var SITE_PATH="<?php echo SITE_URL; ?>";

function get_listing(action,make,price_from,price_to,listing_id,extra_parameter)
{
	document.getElementById("loading_div").style.display="block";
	xmlHttp=get_xmlhttp();
	
	if(listing_id)
	{
			var url="ajax_listing_view.php?action="+action+"&make="+make+"&price_from="+price_from+"&price_to="+price_to+"&listing_id="+listing_id+"&sid="+Math.random()+"&";
	}
	else
	{

	var url="ajax_listing_view.php?action="+action+"&make="+make+"&price_from="+price_from+"&price_to="+price_to+"&sid="+Math.random()+"&";
	}
	xmlHttp.onreadystatechange=function()
	{
	  if(xmlHttp.readyState==4)
	   { 
			values=xmlHttp.responseText;

			document.getElementById("search_contents_div").innerHTML=values;
			
			if(extra_parameter=='get_listing_detail' && listing_id)
			{
				get_listing_detail('get_detail',listing_id,'','');
			}
	   }  
		 
	}
	
	 var str=url;
	 xmlHttp.open('GET',str,true);
	 xmlHttp.send(null);
}
function get_listing_detail(action,listing_id)
{
	xmlHttp=get_xmlhttp();
	var url="ajax_listing_detail.php?action="+action+"&listing_id="+listing_id+"&sid="+Math.random()+"&";
	document.getElementById("loading_detail_div").style.display="block";
	xmlHttp.onreadystatechange=function()
	{
	  
	    if(xmlHttp.readyState==3)
	   { 	
			//document.getElementById("loading_div").style.display="block";		
	   }  
	    if(xmlHttp.readyState==2)
	   { 			
			//document.getElementById("loading_div").style.display="block";
	   }  
	  if(xmlHttp.readyState==4)
	   { 
	   		document.getElementById("loading_detail_div").style.display="none";
			document.getElementById("div_listing_detail").style.display='block';
	   		document.getElementById("div_feature_listing").style.display='none';
			values=xmlHttp.responseText;
			document.getElementById("div_listing_detail").innerHTML=values;	
				
	   		
	   }  
		 
	}
	
	 var str=url;
	 xmlHttp.open('GET',str,true);
	 xmlHttp.send(null);
}
function get_search_contents_bylink(url_detail)
{
	xmlHttp=get_xmlhttp();
	var url=url_detail;
	document.getElementById("loading_div").style.display="block";	
	
	xmlHttp.onreadystatechange=function()
	{
	  
	   
	  if(xmlHttp.readyState==4)
	   { 
			values=xmlHttp.responseText;

			
					 
			document.getElementById("search_contents_div").innerHTML=values;
			
			
	   }  
		 
	}
	
	 var str=url;
	 xmlHttp.open('GET',str,true);
	 xmlHttp.send(null);
	
	
}
function get_xmlhttp(){

var xmlHttp;
  try
    {
    // Firefox, Opera 8.0+, Safari
    xmlHttp=new XMLHttpRequest();
    }
  catch (e)
    {
    // Internet Explorer
    try
      {
      xmlHttp=new ActiveXObject('Msxml2.XMLHTTP');
      }
    catch (e)
      {
      try
        {
        xmlHttp=new ActiveXObject('Microsoft.XMLHTTP');
        }
      catch (e)
        {
        alert('Your browser does not support AJAX!');
        return false;
        }
      }
    }
   
   return  xmlHttp;
}

function showPic(whichpic) {
if (document.getElementById) {
document.getElementById('large_photo').src = whichpic.src;
  if (whichpic.title) {
   //document.getElementById('desc').childNodes[0].nodeValue = whichpic.title;
  } else {
   //document.getElementById('desc').childNodes[0].nodeValue = whichpic.childNodes[0].nodeValue;
  }
  return false;
 } else {
  return true;
 }
}

function show_large_photo(whichpic)
{
	//window.open (whichpic.src,"mywindow");
	
	mywindow = window.open (whichpic.src,"mywindow","location=1,status=1,scrollbars=1,width=500,height=400");
	mywindow.moveTo(0,0);
}
function reload_page(make_combo)
{
	
	var selObj = document.getElementById(make_combo);
	var selIndex = selObj.selectedIndex;

	make=selObj.options[selIndex].value;
	
	get_listing("get_listing",make,'','');


}


function display_street_view(user_id)
{

var url="street_view.php?user_id="+user_id+"&";

window.open(url,'hi','width=510,height=310,left=500, top=100,resizable=no,scrollbars=no,toolbar=no,status=no');
}

function print_brochure(action,listing_id)
{
var url="print_brochure.php?action="+action+"&listing_id="+listing_id+"&";

window.open(url,'hi','width=650,height=900,left=100, top=100,resizable=no,scrollbars=yes,toolbar=no,status=no');
}
function send_to_friend(listing_id)
{
var url="send_to_friend.php?listing_id="+listing_id+"&";

window.open(url,'hi','width=650,height=550,left=100, top=100,resizable=no,scrollbars=yes,toolbar=no,status=no');
}



function close_listing_detail()
{

			document.getElementById("div_feature_listing").style.display='block';
			document.getElementById("div_listing_detail").innerHTML="";	
			document.getElementById("div_listing_detail").style.display='none';
			

}

function show_monthly_load(amount)
{
var url="monthly_loan.php?amount="+amount+"&";

window.open(url,'hi','width=300,height=350,left=100, top=100,resizable=yes,scrollbars=auto,toolbar=no,status=no');
return true;

}


// declare a global  XMLHTTP Request object
var XmlHttpObj;

// create an instance of XMLHTTPRequest Object, varies with browser type, try for IE first then Mozilla
function CreateXmlHttpObj()
{
	// try creating for IE (note: we don't know the user's browser type here, just attempting IE first.)
	try
	{
		XmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			XmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch(oc)
		{
			XmlHttpObj = null;
		}
	}
	// if unable to create using IE specific code then try creating for Mozilla (FireFox) 
	if(!XmlHttpObj && typeof XMLHttpRequest != "undefined") 
	{
		XmlHttpObj = new XMLHttpRequest();
	}
}

// called from onChange or onClick event of the continent dropdown list
function get_make_model(repose_td) 
{

    var make_combo = document.getElementById("make");
	var model_td = document.getElementById(repose_td);
    
    // get selected continent from dropdown list
    var make_name = make_combo.options[make_combo.selectedIndex].value;
    
   	xmlHttp=get_xmlhttp();
	var url="../ajax_get_model.php?action=get_model&make_name="+make_name+"&sid="+Math.random()+"&";
	xmlHttp.onreadystatechange=function()
	{
	  if(xmlHttp.readyState==4)
	   { 
			model_td.innerHTML=xmlHttp.responseText;
			
			
	   }  
		 
	}
	
	 var str=url;
	 xmlHttp.open('GET',str,true);
	 xmlHttp.send(null);
	 
}


// this function called when state of  XmlHttpObj changes
// we're interested in the state that indicates data has been
// received from the server
function StateChangeHandler()
{
	// state ==4 indicates receiving response data from server is completed
	if(XmlHttpObj.readyState == 4)
	{
		// To make sure valid response is received from the server, 200 means response received is OK
		if(XmlHttpObj.status == 200)
		{			
			PopulateCountryList(XmlHttpObj.responseXML.documentElement);
		}
		else
		{
			alert("problem retrieving data from the server, status code: "  + XmlHttpObj.status);
		}
	}
}

// populate the contents of the country dropdown list
function PopulateModelList(modelNode)
{
    var model_combo = document.getElementById("model");
	
	// clear the country list 
	for (var count = model_combo.options.length-1; count >-1; count--)
	{
		model_combo.options[count] = null;
	}
alert("asdasd");
	var modelNodes = modelNode.getElementsByTagName('firstname');
	var idValue;
	var textValue; 
	var optionItem;
	// populate the dropdown list with data from the xml doc
	for (var count = 0; count < modelNodes.length; count++)
	{
   		textValue = modelNodes[count].nodeValue;
		
		optionItem = new Option( textValue, false,  false, false);
		model_combo.options[model_combo.length] = optionItem;
	}
}



</script>
