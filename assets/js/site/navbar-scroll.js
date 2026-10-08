/* =========================================================
   SCROLL NAVBAR EFFECT
========================================================= */

window.addEventListener(
    "scroll",
    function(){

        const nav =
            document.querySelector(".nav");

        if(window.scrollY > 30){

            nav.style.boxShadow =
                "0 10px 40px rgba(0,0,0,.18)";

        }else{

            nav.style.boxShadow = "none";

        }

    }
);
