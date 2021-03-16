function searchProduct(data) {
    console.log(data);

    document.getElementById("livesearch").innerHTML = "";
    document.getElementById("livesearch").style.border = "0px";

    /*
    if (data.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        return;
    }
*/
    $.ajax({
        method: "POST",
        url: "productSearch.php",
        data: {data},
        success: function (response) {
            //console.log(response);

            var elements = JSON.parse(response);

            var html;
            //console.log(elements);

            var d = document.getElementById("livesearch");

            $.map(elements, function (n, i) {
                console.log(n);
                var p = document.createElement("p");
                p.innerHTML = n.sku + ' - ' + n.name;
                p.style.padding = "5px";
                d.appendChild(p);
                d.style.border="1px solid #A5ACB2";
            });
        }
    });

    /*
    var xmlhttp=new XMLHttpRequest();



    xmlhttp.onreadystatechange=function() {
        if (this.readyState===4 && this.status===200) {
            //console.log(this.responseText);
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch")
        }
    }

    xmlhttp.open("GET","index.php?ctrl=product&action=search&q="+data,true);
    xmlhttp.send();

*/
}