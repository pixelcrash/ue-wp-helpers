<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script>
<script type="text/javascript">
  window.openMailchimpPopup = function() {
    window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us1.list-manage.com","uuid":"b3c9481896f69023d2a99ec3d","lid":"446ae93e9a","uniqueMethods":true}) })
    document.cookie = 'MCPopupClosed=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
    document.cookie = 'MCPopupSubscribed=;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
  }

jQuery(document).ready(function($){
  //you can now use $ as your jQuery object.
  $( '.mailchimppopup' ).click(function(){
     console.log("click");
    openMailchimpPopup();
  });
 
});
</script>

// You can load the popup form mailchimp and get the baseurl, uuid, and lid from the loaded js
