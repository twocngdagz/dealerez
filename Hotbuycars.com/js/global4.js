  // color box
  
  $(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"50%", height:"80%", scroll:"none"});
				$(".inline").colorbox({inline:true, width:"408px"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});


//
$(document).ready(function() {
	var activeTab = 3; //0 based, so 1 = 2nd
			$('#search-form-1').jqTransform({imgPath:'../images/'});
			$('#search-form-2').jqTransform({imgPath:'../images/'});
			//When page loads...
			$(".tab_content").hide(); //Hide all content
			$("ul.tabs li:first").addClass("active").show(); //Activate first tab
			$(".tab_content:first").show(); //Show first tab content
			
			//On Click Event
			$("ul.tabs li").click(function() {
			
				$("ul.tabs li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content").hide(); //Hide all tab content
			
				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});
			
			$(".tab_content-1").hide(); //Hide all content
			$("ul.tabs-1 li").eq(activeTab).addClass("active").show(); //Activate first tab
			$(".tab_content-1").eq(activeTab).show(); //Show first tab content
			
			//On Click Event
			$("ul.tabs-1 li").click(function() {
			
				$("ul.tabs-1 li").removeClass("active"); //Remove any "active" class
				$(this).addClass("active"); //Add "active" class to selected tab
				$(".tab_content-1").hide(); //Hide all tab content
			
				var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});
			

		}); 
		
		
///  scroll

(function($) {
	$(function() {
		$("#scroller").simplyScroll({orientation:'vertical',customClass:'vert'});
	});
})(jQuery);
	
	
  $(function() {
    $('img.image1').data('');
    $('img.image2').data('ad-title', '');
    $('img.image4').data('ad-desc', '');
    $('img.image5').data('ad-desc', '');
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );
  });
  
  
 //  scroll 2
 
 $(function() {

	var dur = 1000;
	var pDur = 3000;

	$('.carousel').carouFredSel({
		items: {
			visible: 1,
			width: 700,
			height: 287
		},
		scroll: {
			fx: 'fade',
			easing: 'swing',
			duration: dur,
			timeoutDuration: pDur,
			onBefore: function( data ) {
				animate( data.items.visible, pDur + ( dur * 3 ) );
			},
			onAfter: function( data ) {
				data.items.old.find( 'img' ).stop().css({
					width: 700,
					height: 287,
					marginTop: 0,
					marginLeft: 0
				});
			}
		},
		onCreate: function( data ) {
			animate( data.items, pDur + ( dur *2 ) );
		}
	});
	
	function animate( item, dur ) {
		var obj = {
			width: 700,
			height: 287
		};
		item.find( 'img' ).animate(obj, dur, 'swing' );
	}

});











//   mycarousel_initCallback

function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        auto: 2,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    });
});

$(function() {
    $('img.image1').data('');
    $('img.image2').data('ad-title', '');
    $('img.image4').data('ad-desc', '');
    $('img.image5').data('ad-desc', '');
    var galleries = $('.ad-gallery').adGallery();
    $('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );
  });
  
  
  
  
