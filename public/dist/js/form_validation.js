$(document).ready(function () {
    $("#new_pwd").click(function () {
        var current_pwd = $("#current_pwd").val();
        $.ajax({
            type: 'get',
            url: '/admin/check-pwd',
            data: {current_pwd: current_pwd},
            success: function (resp) {
                if (resp === "false") {
                    $("#chkPwd").html("<font color='red' size='5'>&#10005;</font>");
                } else if (resp === "true") {
                    $("#chkPwd").html("<font color='green' size='6'>&#10003;</font>");
                }
            }, error: function () {
                alert("error");
            }
        });
    });
    //Function to delete User
    $(".deleteUser").click(function () {
        var id = $(this).attr('rel');
        var deleteFunction = $(this).attr('rel1');
        Swal.fire({
            title: 'Are you sure you want to delete this User?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#28a745',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "/admin/user/" + deleteFunction + "/" + id;
            }
        });
    });
    //Automatically close alerts
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 4000);
});
