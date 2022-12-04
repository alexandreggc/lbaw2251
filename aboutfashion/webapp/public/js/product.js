attachEvents()

function attachEvents() {
    color = document.getElementById("color")
    color.addEventListener("change", addSize)
}

async function addSize(element) {
    color = document.getElementById("color").value
    if (!(color == "Select color")) {
        url = '/api/products/stock?id_product=' + document.getElementById('id-product').innerText + '&id_color=' + color
        const response = await fetch(url)
        const product = await response.json()
        size = document.getElementById('div_size')
        let out = ""
        out += `<div class="sizes mt-5">
                        <h6 class="text-uppercase">Size</h6> `
        let sizes = []
        let p = true
        for (const val of product) {
            for (const i of sizes) {
                if (i[0] === val.size.id) {
                    p = false
                }
            }
            if (p == true) {
                sizes.push([val.size.id, val.size.name])
            }
            p = true
        }

        sizes = sizes.sort()
        for (const number of sizes) {
            out += `
                        <label class="radio"> <input type="radio" name="size" value="${number[0]}" checked> <span style="">${number[1]}</span> </label> 
                    `

        }
        out += `</div>
                    <div class="cart mt-4 align-items-center"> 
                        <button class="btn btn-primary mr-2 px-4" onclick="addProductCart()">Add to cart</button> 
                    </div>`
        size.innerHTML = out;
    } else {
        size = document.getElementById('div_size')
        let out = ""
        size.innerHTML = out;

    }
}