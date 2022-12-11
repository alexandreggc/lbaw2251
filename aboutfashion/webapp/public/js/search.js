showAll()
attachEvents()

function attachEvents() {
    button = document.getElementById('filterButton')
    button.addEventListener('click', selectFilters)
    search = document.getElementById('searchButton')
    search.addEventListener('click', selectSearch)
}

async function showAll() {
    showSpinner();
    const response = await fetch('/api/products')
    const products = await response.json()
    if (response) {
        hideSpinner();
    }
    let oldBody = document.getElementById("data-output")
    let newBody = drawProducts(products)

    oldBody.innerHTML = newBody
}

async function selectSearch(element) {
    showSpinner();
    url = '/api/products?'
    let name = document.getElementById('fname').value
    url += 'product_name='
    url += name

    const response = await fetch(url)
    const products = await response.json()
    if (response) {
        hideSpinner();
    }
    let oldBody = document.getElementById("data-output")
    let newBody = drawProducts(products)

    oldBody.innerHTML = newBody
}


async function selectFilters(element) {
    showSpinner();
    url = '/api/products?'
    category = document.getElementById('category').value
    if (!(category == 'Select category')) {
        url += 'id_category='
        url += category
        url += '&'
    }
    size = document.getElementById('size').value
    if (!(size == 'Select size')) {
        url += 'id_size='
        url += size
        url += '&'
    }

    color = document.getElementById('color').value
    if (!(color == 'Select color')) {
        url += 'id_color='
        url += color
        url += '&'
    }
    valueMin = document.getElementById('value-min').value
    url += 'min_price='
    url += valueMin
    url += '&'

    valueMax = document.getElementById('value-max').value
    url += 'max_price='
    url += valueMax
    url += '&'

    min_classification = document.getElementById('myRange').value
    if (!(min_classification == 0)) {
        url += 'min_classification='
        url += min_classification
    } else {
        url = url.slice(0, -1);
    }

    const response = await fetch(url)
    const products = await response.json()
    if (response) {
        hideSpinner();
    }
    let oldBody = document.getElementById("data-output")
    let newBody = drawProducts(products)

    oldBody.innerHTML = newBody
}

function drawProducts(products) {
    let out = "";
    for (const val of products) {
        out += `
            <div class="col-md-3 col-sm-6 mx-4 mt-2 mb-2 d-inline-block">
                <div class="product-grid">
                    <div class="product-image shadow">
                        <a href="/products/${val.id}" class="image">
                            <img src="${val.images[0]}" width="227" height="313">
                        </a>
                        <span class="product-discount-label">${havePromo(val.promotion.discount)}</span>
                        <ul class="product-links">
                            <li><a href="#"><i class="fa fa-search"></i></a></li>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product-content shadow">
                        <h3 class="title"><a href="/products/${val.id}">${val.name}</a></h3>
                        <div class="price">${havePromo1(val.price, val.promotion.discount)} <span>${havePromo2(val.price, val.promotion.discount)}</span></div>
                    </div>
                </div>
            </div>

        `;
    }

    return out;
}


function havePromo2(value, promo) {
    let result;
    if (promo == undefined) {
        result = "";
    } else {
        result = value + '€';
    }
    return result;
}

function havePromo1(value, promo) {
    let result;
    if (promo == undefined) {
        result = value + '€';
    } else {
        result = Math.round(value - (value * (promo / 100))) + '€';
    }
    return result;
}

function havePromo(promo) {
    let result;
    if (promo == undefined) {
        result = "";
    } else {
        result = '-' + promo + '%';
    }
    return result;
}

function hideSpinner() {
    document.getElementById('spinner').style.display = 'none';
}

function showSpinner() {
    document.getElementById('spinner').style.display = 'block';
    document.getElementById('data-output').innerHTML = '';
}
