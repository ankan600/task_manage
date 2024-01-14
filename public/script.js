
var token_val = localStorage.getItem("token");
console.log(token_val);

var user_val = localStorage.getItem("user_id");
console.log(user_val);

if(token_val=="" || token_val==null || token_val== undefined){
    window.location.href='/login';
}

function logout(){
    if(confirm("Want to logout?")){
        var token = localStorage.getItem("token");
        $.ajax({
            url: "/api/logout",
            type: "GET",
            error: function(a, b, c) {

                console.log(a);
                console.log(b);
                console.log(c);
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function(response) {
                // console.log(response);
                if (response.status == true) {
                    window.location.href='/';
                    window.localStorage.removeItem('token');
                    
                } else {
                    alert("Something went to wrong !..");
                }
            }
        });
    }
    else{
        return false;
    }
}
