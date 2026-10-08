window.addEventListener("load", function(){

    const editBox =
        document.getElementById("edit");

    if(editBox){

        setTimeout(function(){

            editBox.scrollIntoView({
                behavior:"smooth",
                block:"start"
            });

        },200);

    }

});
