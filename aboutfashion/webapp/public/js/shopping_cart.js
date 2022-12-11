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

    subtotal = 0
    discount = 0
    total = 0
    
    let table = document.getElementsByTagName('table')[0]
    let rows = table.rows
    for (const row in rows) {
        

    }
    subtotalElem.innerText = subtotal + '€'
    discountElem.innerText = discount + '€'
    totalElem.innerText = total + '€'
}