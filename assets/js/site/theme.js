/* =========================================================
   THEME
========================================================= */

function toggleTheme(){

    document.body.classList.toggle("light");

    localStorage.setItem(
        "arka-theme",
        document.body.classList.contains("light") ? "light" : "dark"
    );

}


/* LOAD THEME */

if(localStorage.getItem("arka-theme") === "light"){

    document.body.classList.add("light");

}
