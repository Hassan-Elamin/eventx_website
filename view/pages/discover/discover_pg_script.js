let m_ev_btn = document.getElementsByClassName('m-ev-btn')[0];

let url = new URL(window.location.href);
let params = url.searchParams;
let follow_check = params.get('following')

m_ev_btn.addEventListener('click', function () {
    navigateToEvent(parseInt(m_ev_btn.getAttribute('id')))
})

$(function () {

    $('.category-sort-item').on('click', function (obj) {
        addParam('category', obj.target.innerHTML);
    })

    $('.state-sort-item').on('click', function (obj) {
        addParam('sort', obj.target.innerHTML);
    })

    if (follow_check === 'true') {
        $('#followingCheck').attr('checked', 'true')
        $('#followingCheck').attr('value', 'false')
    }

    if (params.get('sort') !== null) {
        console.log('here')
        $('#sort-cancel').css("display", "block")
    } else {
        console.log('no here')
        $('#sort-cancel').css('display', 'none')
    }
    if (params.get('category') !== null) {
        $('#category-cancel').css('display', 'block')
    } else {
        $('#category-cancel').css('display', 'none')
    }

    $('#category-cancel').click(() => { removeParam('category') })
    $('#sort-cancel').click(() => { removeParam('sort') })

    $('#followingCheck').on('input', function (obj) {
        if (obj.target.value == 'true') {
            addParam('following', 'true')
        } else {
            removeParam('following')
        }
    })

})



function addParam(key, value) {
    var params = new URLSearchParams(window.location.search);
    params.set(key, value);
    window.location.search = params.toString();
}

function removeParam(key) {
    var url = new URL(window.location.href);
    url.searchParams.delete(key);
    window.location.href = url.toString();
}


