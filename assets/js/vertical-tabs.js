// JavaScript Document
let tabHeaders = document.querySelectorAll(".tabs .tab-header > div");
let tabContents = document.querySelectorAll(".tabs .tab-content > div");

for(let i=0; i<tabHeaders.length; i++){
	tabHeaders[i].addEventListener("click", function(){
		document.querySelector(".tabs .tab-header > .active").classList.remove("active");
		tabHeaders[i].classList.add("active");
		document.querySelector(".tabs .tab-content >  .active").classList.remove("active");
		tabContents[i].classList.add("active");
	})

}