//TODO Adicionar mensagens de erro
attachEvents()
updatePrice()

function attachEvents() {
    for (const button of document.getElementsByClassName('delete-detail'))
        button.addEventListener('click', deleteProduct)
    for (const button of document.getElementsByClassName('update-quantity'))
        button.addEventListener('change', updateQuantity)
}

function deleteProduct(elem) {
    let token = document.getElementsByName('_token')[0].value
    let detail = elem.target.id
    const request = new XMLHttpRequest()
    request.open('delete', '/api/shopping-cart', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('id_detail=' + detail + '&_token=' + token)

    request.onload = function () {
        if (request.status == 200) {
            (document.getElementById('row-' + detail)).remove()
        } else {
            console.log('ERROR!')
        }
    }
    updatePrice()
}

function updateQuantity(elem) {
    let token = document.getElementsByName('_token')[0].value
    let detail = elem.target.id
    let quantity = elem.target.value

    const request = new XMLHttpRequest()
    request.open('PATCH', '/api/shopping-cart', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('id_detail=' + detail + '&quantity=' + quantity + '&_token=' + token)


    request.onload = function () {
        if (request.status == 400) {
            let response = JSON.parse(request.responseText)
            elem.target.value = response['quantity']
            console.log('Error! Bad request!')
        } else if (request.status == 200) {
            document.getElementById('quantity-'+detail).innerText = quantity
            console.log('OK!')
        } else {
            console.log('Error!')
        }
    }
    updatePrice()
}

function updatePrice() {
    let subtotalElem = document.getElementById('subtotal')
    let discountElem = document.getElementById('discount')
    let totalElem = document.getElementById('total')

    let subtotal = 0
    let discount = 0
    let total = 0

    let ids = document.getElementsByClassName('row-product')
    for(const idElem of ids){
        id = idElem.id.substring(4)
        quantity = document.getElementById('quantity-'+id).innerText
        //subtotal += document.getElementById('original-price-'+id).innerText.slice(0,-1) * quantity
        discount += (document.getElementById('original-price-'+id).innerText.slice(0,-1) - document.getElementById('final-price-'+id).innerText.slice(0,-1)) * quantity
        total += document.getElementById('final-price-'+id).innerText.slice(0,-1) * quantity
    }
    
    subtotalElem.innerText = subtotal + '€'
    discountElem.innerText = discount + '€'
    totalElem.innerText = total + '€'
}