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
    likeIcon.addEventListener('click', changeLike)
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
        for (const number of sizes) {
            out += `
                        <label class="radio"> <input type="radio" name="size" value="${number[0]}" checked> <span style="">${number[1]}</span> </label> 
                    `

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
    let size = $('input[name=size]:checked').attr('value')
    let product = document.getElementById('id-product').innerText
    const request = new XMLHttpRequest()
    request.open('post', '/api/shopping-cart', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('id_color=' + color + '&id_size=' + size + '&id_product=' + product + '&_token=' + token)
    let dropdownA = document.getElementById('navbarDropdownMenuLink2');
    let ariaExpandedAttr = dropdownA.getAttribute('aria-expanded');
    if(ariaExpandedAttr=='false'){
        dropdownA.setAttribute('aria-expanded','true');
    };
    if(dropdownA.classList.contains('show')){
        dropdownA.classList.add("show");
    };
    let dropdown = document.getElementById('dropdownSC');
    let dataBsPopperAttr = dropdown.hasAttribute('data-bs-popper');
    if(!(dataBsPopperAttr)){
        dropdown.setAttribute('data-bs-popper','none');
    };
    if(!(dropdown.classList.contains('show'))){
        dropdown.classList.add("show");
    };
    
    return;
}

function dismiss_Dsc(element) {
    let dropdownA = document.getElementById('navbarDropdownMenuLink2');
    dropdownA.setAttribute('aria-expanded','false');
    dropdownA.classList.remove("show");
    let dropdown = document.getElementById('dropdownSC');
    dropdown.removeAttribute('data-bs-popper');
    dropdown.classList.remove("show");
    
    return;

}
function changeLike(element) {
    let likeIcon = document.getElementById('likeIcon');
    let heartIcon = document.getElementById('heartIcon');
    
    if(heartIcon.classList.contains('fa-regular')){
        let out = `<i class="fa-solid fa-heart " id="heartIcon" style="font-size:1.7rem;"></i>`
        likeIcon.innerHTML = out;
    }else{
        let out = `<i class="fa-regular fa-heart " id="heartIcon" style="font-size:1.7rem;"></i>`
        likeIcon.innerHTML = out;
    }
    
    return;

}
