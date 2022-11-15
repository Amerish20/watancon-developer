$(".navTrigger").click(function(){
	$(this).toggleClass('active');
    $(".mainmenu.minterface").toggleClass("clicked");
    $(".mainmenu.mmaster").toggleClass("clicked");
    $(".mainmenu.mreport").toggleClass("clicked");
    $(".mainmenu.youtube").toggleClass("clicked");
})