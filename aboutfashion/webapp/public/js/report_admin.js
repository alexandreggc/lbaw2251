attachEvents()
function attachEvents() {
    for (const button of document.getElementsByClassName('open-report'))
        button.addEventListener('click', openReport)
    for (const button of document.getElementsByClassName('close-report'))
        button.addEventListener('click', closeReport)
}

function openReport(elem) {
    let token = document.getElementsByName('_token')[0].value
    const request = new XMLHttpRequest()
    request.open('PATCH', '/api/admin-panel/reports/open/' + elem.target.id, true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('_token=' + token)

    request.onload = function () {
        if (request.status == 200) {
            document.getElementById('accordion-item-' + elem.target.id).remove()
        } else {
            console.log('ERROR!')
        }
    }
    attachEvents()
}

function closeReport(elem) {
    let token = document.getElementsByName('_token')[0].value
    const request = new XMLHttpRequest()
    request.open('PATCH', '/api/admin-panel/reports/close/' + elem.target.id, true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.send('_token=' + token)

    request.onload = function () {
        if (request.status == 200) {
            document.getElementById('accordion-item-' + elem.target.id).remove()
        } else {
            console.log('ERROR!')
        }
    }
    attachEvents()
}