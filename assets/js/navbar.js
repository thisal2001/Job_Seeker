

document.querySelector("#hamburger").addEventListener("click", function (e) { 
    e.preventDefault();
    if(document.querySelector("#hamburger").getAttribute("toggle") == "off"){
        document.querySelector("#hamburger").setAttribute("toggle", "on");
        document.querySelector("#navbar-sm > .nav-item-wrapper").classList.remove("d-none");
        document.querySelector("#hamburger").setAttribute("src", "/jobseeker/assets/svg/close.svg");
    }else{
        document.querySelector("#hamburger").setAttribute("toggle", "off");
        document.querySelector("#navbar-sm > .nav-item-wrapper").classList.add("d-none");
        document.querySelector("#hamburger").setAttribute("src", "/jobseeker/assets/svg/hamburger.svg");
    }
});