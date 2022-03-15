function myfun(id){
    let role = document.getElementById(id).value;
    console.log(role);
    $.ajax({
        type: "post",
        url: "update.php",
        data: {
            id: id,
            role: role
        },
        success: function (response) {
         console.log(response);    
        },

        error: function (response) {
            console.log(response);    
           }
    });
}