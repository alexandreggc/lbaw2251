attachEvents()

if (document.getElementById('color').value != 'Select Color') {
    addSize()
}

function attachEvents() {
    let color = document.getElementById("color")
    color.addEventListener("change", addSize)
    let dismissDSC = document.getElementById("dismissDSC")
    dismissDSC.addEventListener('click', dismiss_Dsc)
    let likeIcon = document.getElementById('likeIcon');
    if (likeIcon != null || likeIcon != undefined) {
        likeIcon.addEventListener('click', changeLike)
    }
} 
async function addSize(element) {
    let color = document.getElementById('color').value
    if (color == 'Select color') {
        (document.getElementById('div_size')).innerHTML = '';
    } else {
        const response = await fetch('/api/products/stock?id_product=' + document.getElementById('id-product').innerText + '&id_color=' + color)
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
        n = sizes.length
        for (const number of sizes) {
            if(n==sizes.length){
                out += `
                        <label class="radio"> <input type="radio" name="size" id="${number[1]}" value="${number[0]}" checked > <span id="" ><input type="hidden" id="size_name" value="${number[1]}"> ${number[1]}</span> </label> 
                    `
            }
            else{
                out += `
                        <label class="radio"> <input type="radio" name="size" id="${number[1]}" value="${number[0]}" checked> <span id="" ><input type="hidden" id="size_name" value="${number[1]}"> ${number[1]}</span> </label> 
                    `
            }
            n=n-1
            
        }
        out += `</div>
                    <div class="cart mt-4 align-items-center"> 
                        <button class="btn btn-primary mr-2 px-4" id='add-to-cart'>Add to cart</button> 
                    </div>`
        size.innerHTML = out;
        (document.getElementById('add-to-cart')).addEventListener('click', addToCart);
    }
}

async function addToCart(element) {
    let token = document.getElementsByName('_token')[0].value
    let color = document.getElementById('color').value
    var select = document.getElementById('color');
    var color_name = select.options[select.selectedIndex].text;
    let final_price = document.getElementById('final_price').value
    let size_name = $('input[name=size]').filter(function(){ return $(this).css('background-color') === 'rgb(44,62,80)';}).attr('id')
    console.log(size_name)
    let size = $('input[name=size]:checked').attr('value')
    let product = document.getElementById('id-product').innerText
    let product_name = document.getElementById('product_name').innerText
    let product_price = document.getElementById('product_price').value
    let img = document.getElementById("main-image").src;
    const request = new XMLHttpRequest()
    request.open('post', '/api/shopping-cart', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('id_color=' + color + '&id_size=' + size + '&id_product=' + product + '&_token=' + token)
    request.unload
    let tbody = document.getElementById('shop-pop');
    let out = `<tr id="row-${product}" class="row-product">
    <td class=" align-middle justify-content-center"style="width:8rem;"
        data-th="Produtoooooooooooooooooo">
        <div class="row">
            <div class="col-md-6 text-left">
                <img src="${img}"
                    alt=""
                    class="img-fluid d-none d-md-block rounded mt-3 shadow ">
            </div>
            <div
                class="col-md-6  align-middle text-left mt-sm-2 mx-auto">
                <h6 style="font-size:0.8em;">
                    ${product_name}</h6>
                <p class="font-weight-light"
                    style="font-size:0.5rem;">Size:
                    ${size_name} <br>
                    Color: ${color_name}</p>
            </div>
        </div>
    </td>
    <td class=" align-middle justify-content-center"
        style="width:2rem;" data-th="preço">
        <div class=" mt-sm-2">
            <p class="font-weight-light" style="font-size:0.7rem;">
                ${final_price}€`
                if(Number(final_price)==Number(product_price)) {
                    out +=`</p>`
                }
                else{
                    out +=`<small class="dis-price"
                    style="color: #888;text-decoration: line-through;">${product_price}€</small>
                </p>`
                }
            
            out +=`
                <span id="original-price-${product}"
                style="display: none">${product_price}</span>
                <span id="final-price-${product}"
                style="display: none">${final_price}</span>

                </div>
                </td>
                <td class=" align-middle justify-content-center" style="width:3rem;"
                data-th="quanti">
                <input type="number" style="margin:0;"
                class="form-control form-control-sm text-center update-quantity"
                value="1" min="1"
                style="padding:0;width:2.5rem;" id=${product}>
                <span id="quantity-${product}"
                style="display: none">1</span>
                </td>
                <td class="actions align-middle " style="width:2rem" data-th="">
                <div class="text-right justify-content-center">
                <button class="btn btn-white d-flex mx-auto bg-white btn-md delete-detail "
                id=${product}>
                <i class="fas fa-trash" id=${product}></i>
                </button>
                </div>
                </td>
                </tr>`
                tbody.innerHTML = out;
    let dropdownA = document.getElementById('navbarDropdownMenuLink2');
    let ariaExpandedAttr = dropdownA.getAttribute('aria-expanded');
    if (ariaExpandedAttr == 'false') {
        dropdownA.setAttribute('aria-expanded', 'true');
    };
    if (dropdownA.classList.contains('show')) {
        dropdownA.classList.add("show");
    };
    let dropdown = document.getElementById('dropdownSC');
    let dataBsPopperAttr = dropdown.hasAttribute('data-bs-popper');
    if (!(dataBsPopperAttr)) {
        dropdown.setAttribute('data-bs-popper', 'none');
    };
    if (!(dropdown.classList.contains('show'))) {
        dropdown.classList.add("show");
    };

    return;
}

function dismiss_Dsc(element) {
    let dropdownA = document.getElementById('navbarDropdownMenuLink2');
    dropdownA.setAttribute('aria-expanded', 'false');
    dropdownA.classList.remove("show");
    let dropdown = document.getElementById('dropdownSC');
    dropdown.removeAttribute('data-bs-popper');
    dropdown.classList.remove("show");

    return;

}

function changeLike(element) {
    let likeIcon = document.getElementById('likeIcon')
    let heartIcon = document.getElementById('heartIcon')
    let product = document.getElementById('id-product').innerText
    let token = document.getElementsByName('_token')[0].value

    const request = new XMLHttpRequest()
    request.open('post', '/api/wishlist', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('id_product=' + product + '&_token=' + token)
    request.onload = function () {
        if (request.status == 200) {
            if (heartIcon.classList.contains('fa-regular')) {
                let out = `<i class="fa-solid fa-heart " id="heartIcon" style="font-size:1.7rem;"></i>`
                likeIcon.innerHTML = out
            } else {
                let out = `<i class="fa-regular fa-heart " id="heartIcon" style="font-size:1.7rem;"></i>`
                likeIcon.innerHTML = out
            }
        } else {
            //TODO adicionar mensagem de erro
            console.log('Error')
        }
    }
}
