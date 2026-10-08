/* =========================================================
   COURSE SEARCH
========================================================= */

function searchCourses(){

    const search =
        document
        .getElementById("courseSearch")
        .value
        .toLowerCase()
        .trim();


    const cards =
        document
        .querySelectorAll("#coursesGrid .card");


    let visible = 0;


    cards.forEach(function(card){

        const title =
            card.dataset.title
            .toLowerCase();


        const category =
            card.dataset.cat;


        const searchMatch =
            title.includes(search);


        const categoryMatch =
            selectedCategory === "all"
            ||
            category === selectedCategory;


        if(
            searchMatch &&
            categoryMatch
        ){

            card.style.display = "";

            visible++;

        }else{

            card.style.display = "none";

        }

    });

}
