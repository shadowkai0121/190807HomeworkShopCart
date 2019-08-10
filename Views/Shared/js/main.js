
let url =
    window.location.protocol + "//" +
    window.location.hostname + "/" +
    "190807HomeworkShopCart/";

function addItem(product) {
    let qnt = document.getElementById("quantity" + product).value;
    let uri =
        url +
        "User/addItem/" +
        product + "/" + qnt;

    $.post(uri)
        .then(res => {
            location.reload();
        })
        .catch(err => {
            if (err.status == 401) {
                window.location.href = url + "User";
            }
        });
}

function delItem(product) {
    let uri =
        url +
        "User/delItem/" +
        product;

    $.ajax({
        url: uri,
        type: "DELETE"
    })
        .then(res => {
            location.reload();
        })
        .catch(err => {
            if (err.status == 401) {
                window.location.href = url + "User";
            }
        });
}

function checkOut() {
    let uri =
        url +
        "/User/CheckOut";

    $.post(uri)
        .then(res => {
            console.log(res);
            location.reload();
        })
        .catch(err => {
            console.log(err.response);
            if (err.status == 401) {
                window.location.href = url + "User";
            }
        });
}
