document.addEventListener("DOMContentLoaded", function(){
    var divs = document.querySelectorAll('.ancestor-wrapper .sub-menu-toggle');
	for (i = 0; i < divs.length; ++i) {
	  let button = divs[i];
	  let sibling = divs[i].previousElementSibling;
	  sibling.onclick = function(){
		button.click();
	  };
	}
});