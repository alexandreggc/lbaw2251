attachEvents()

function attachEvents() {
    for (const button of document.getElementsByClassName('delete-user'))
        button.addEventListener('click', deleteUser)
}

function deleteUser(elem) {
    let token = document.getElementsByName('_token')[0].value
    const request = new XMLHttpRequest()
    request.open('delete', '/api/admin-panel/users', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('id=' + elem.target.id + '&_token=' + token)

    request.onload = function () {
        if (request.status == 200) {
            document.getElementById('accordion-item-'+elem.target.id).remove()
        }else{
            console.log('ERROR!')
        }
    }

}