attachEvents()

function attachEvents() {
    for (const button of document.getElementsByClassName('delete-detail'))
        button.addEventListener('click', deleteCart)
}

function deleteCart(elem) {
    let token = document.getElementsByName('_token')[0].value
    let detail = elem.target.id
    const request = new XMLHttpRequest()
    request.open('delete', '/api/shopping-cart', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('id_detail=' + detail + '&_token=' + token)
}