var openNavStatus = false;

var openNav = function() {
	var getNav = document.querySelector(".nav");
	var getNavList = document.querySelector(".nav ul");
	var getNavLinks = document.querySelectorAll(".nav ul li a");

	if(openNavStatus === false){
		getNav.style.width = "250px";
		getNavList.style.visibility = "visible";

		let brLinkova = getNavLinks.length;
		for(let i = 0; i < brLinkova; i++){
			getNavLinks[i].style.opacity = "1";
		}

		openNavStatus = true;
	}
	else if(openNavStatus === true){
		let brLinkova = getNavLinks.length;
		for(let i = 0; i < brLinkova; i++){
			getNavLinks[i].style.opacity = "0";
		}
		getNavList.style.visibility = "hidden";
		getNav.style.width = "0";

		openNavStatus = false;
	}

};