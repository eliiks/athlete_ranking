let ask = (path, id) => {
    let del = confirm("do you want to delete ?");
    console.log(del);
    $.ajax({
        type: "POST",
        url: path,
        data: {id : id, del : del},
        "success":function(data) {
            alert('ok');
        }
    });
}

