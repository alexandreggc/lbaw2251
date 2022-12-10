attachEvents()

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


}