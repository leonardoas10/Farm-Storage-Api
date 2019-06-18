const editProducts = document.querySelectorAll(".editProduct");
const deleteProducts = document.querySelectorAll(".deleteProduct");
const productInput = document.getElementById("product");
const priceInput = document.getElementById("price");
const sendInput = document.getElementById("send");
let selectedProdId;

    editProducts.forEach(function(editProduct) {
        editProduct.addEventListener("click", function (e) {
            selectedProdId = e.currentTarget.id;
            const currentProduct = e.currentTarget.dataset.product;
            const currentPrice = e.currentTarget.dataset.price;
            productInput.value = currentProduct;
            priceInput.value = currentPrice; 
            e.preventDefault();
        })
    });

    sendInput.addEventListener("click", function (e) {
        if(selectedProdId) {
            e.preventDefault();
            fetch("http://localhost:8000/curso/" + selectedProdId, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                //Another way to use CSRF Token 
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({
                product: productInput.value,
                price: priceInput.value,
            })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                location.reload();
                }
                else {
                    console.log("error");
                }
            })
            .catch(err => console.log(err, "Fetch Update Error"));
        }
    });

    deleteProducts.forEach(function(deleteProduct) {
        deleteProduct.addEventListener("click", function (e) {
            selectedProdId = e.currentTarget.id;
            e.preventDefault();
                if(selectedProdId) {
                    fetch("http://localhost:8000/curso/" + selectedProdId, {
                    method: 'DELETE',
                    headers: {
                    'Content-Type': 'application/json',
                    //Another way to use CSRF Token 
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
                else {
                    console.log("error");
                }
            })
            .catch(err => console.log(err, "Fetch Delete Error"));
            }
        })
    });