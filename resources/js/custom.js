var searched = 0;


function addProduct(n) {
    //alert("it's okay");

    console.log(n);

    document.getElementById("livesearch").innerHTML = "";
    document.getElementById("product").value = "";

    var tbody = document.getElementById("prod-tbody");

    var tr = document.createElement('tr');

    var td1 = document.createElement('td');
    var td2 = document.createElement('td');

    td1.innerHTML=n.sku;
    td2.innerHTML=n.name;

    tr.appendChild(td1);
    tr.appendChild(td2);

    tbody.appendChild(tr);



}


function searchProduct(data) {
    var elements = null;

    var livesearch = document.getElementById("livesearch");


    livesearch.innerHTML = "";
    livesearch.style.border = "0px";


    if (data.length > 0 && searched == 0) {

        $.ajax({
            method: "POST",
            url: "productSearch.php",
            data: {data},
            success: function (response) {

                elements = JSON.parse(response);

                $.map(elements, function (n, i) {

                    var b = document.createElement("button");
                    var label = n.sku + ' - ' + n.name;
                    b.innerHTML = label;
                    b.setAttribute('class', 'list-group-item list-group-item-action');
                    b.addEventListener('click', (e) => {
                        e.preventDefault();
                        searched = 1;
                        document.getElementById("product").value = label;
                        livesearch.innerHTML = "";
                    });
                    livesearch.appendChild(b);
                });
                //d.style.border = "1px solid #A5ACB2";
            }
        });
    } else {
        data = null;
        elements = null;
        livesearch.innerHTML = "";
        livesearch.style.border = "0px";
    }
}