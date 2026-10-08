/* =========================================================
   COURSE FILTER
========================================================= */

let selectedCategory = "all";


function filterCourses(category, button){

    selectedCategory = category;


    document
    .querySelectorAll(".chip")
    .forEach(function(item){

        item.classList.remove("active");

    });


    button.classList.add("active");


    searchCourses();

}
