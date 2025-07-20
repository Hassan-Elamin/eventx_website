let categories = []

let images = []

let now = new Date().toISOString().substring(0, 16)

function checkLocationInputs() {
    let inputs = document.getElementsByClassName('ev-loc-input')
    for (let index = 0; index < inputs.length; index++) {
        const element = inputs[index];
        if (!element.value) {
            $('#insert_location_input').addClass('d-none')
            return false
        }
    }
    $('#insert_location_input').hasClass('d-none') ? $('#insert_location_input').removeClass('d-none') : null;
    return true
}

let locInputs = document.getElementsByClassName('ev-loc-input');

for (let index = 0; index < locInputs.length; index++) {
    const element = locInputs[index];
    element.addEventListener('input', function (e) {
        checkLocationInputs()
    })
}

function deleteLocationInput(ev) {
    let loc = ev.parentElement.id
    $("#" + loc).remove();
    checkLocationInputs()
    return false
}

function removeSelectedImage(id) {
    let files = [];
    let imginput = document.getElementById('images')
    let fileObjects = imginput.files
    for (let index = 0; index < fileObjects.length; index++) {
        const element = fileObjects[index];
        files.push(element)
    }

    files.splice(id, 1)
    let list = new DataTransfer()
    files.forEach(img => list.items.add(img))

    imginput.files = list.files;

    $('.remove-image-btn#' + id).parent().remove()
}

function rebuildSelectedCategories() {
    $('#select-categories').empty()
    categories.forEach((element, index) => {
        $('#select-categories').append(`
                <div class="category-item" id='cat${index}' >
                    <span> ${element} </span>
                    <button onclick='deleteCategory(${index})' class="close">&times;</button>
                </div>
        `)
    })
}

function deleteCategory(index) {
    $('#cat' + index).remove()
    categories.splice(index, 1)
}

function getLocations() {
    let locations = []
    let length = $('.ev-loc-input').length

    $('.ev-loc-input').each((index, element) => {
        locations.push(element.value)
    })
    return locations
}

$(function () {
    $('#start_at').attr('min', now)
    $('#start_at').change(() => {
        let s = $('#start_at').val()
        if (s < Date.now()) {
            $('#start_at').removeClass('is-valid').addClass('is-invalid')
            $('#start_at').siblings('.invalid-feedback').text('Start date should be greater than or equal to current date')
        }
        $('#end_at').attr('min', s)
    })

    $("#end_at").on('change', function () {
        let s = $('#start_at').val()
        let e = $(this).val()
        if (e < s) {
            $(this).removeClass('is-valid').addClass('is-invalid')
            $(this).siblings('.invalid-feedback').text('End date should be greater than or equal to start date')
        }
    })

    $('#insert_location_input').click(function (e) {
        e.preventDefault()
        let i = $('.ev-loc-input').length
        let loc = $('.ev-loc-input').val()
        if (loc) {
            var grp = document.createElement('div')
            grp.className = 'input-group loc-input '
            grp.id = 'location-group-' + i
            //
            var inp = document.createElement('input')
            inp.id = 'location' + i
            inp.type = 'text'
            inp.name = 'location' + i
            inp.className = 'form-control ev-loc-input'
            inp.setAttribute(
                'oninput', "checkLocationInputs()");
            //

            var dbtn = document.createElement('button')
            dbtn.className = 'btn btn-danger'
            dbtn.id = "button-addon2"
            dbtn.innerHTML = `<span class="fa-solid fa-trash" style="color: #ffffff;"></span>`
            dbtn.setAttribute(
                'onclick', "deleteLocationInput(this)")
            dbtn.type = 'button'

            grp.append(inp)
            grp.append(dbtn)
            $('.event-locations').append(grp)

        } else {
            alert('Please enter a location')
        }
        checkLocationInputs()
    })

    $('#images').on('input', function (e) {
        let imgFiles = e.target.files

        for (let i = 0; i < imgFiles.length; i++) {
            images.push(imgFiles[i])
        }
        let imgs = []

        images.forEach((img, i) => {
            img = URL.createObjectURL(img)
            imgs.push(`  
                <div class="selected-image">
                        <img src="${img}" alt="${img}" >
                        <span class="remove-image-btn" onclick='removeSelectedImage(${i})' id='${i}'>&times;</span>
                    </div>
                `)
        })

        for (let i = 0; i < images.length; i++) {


        }
        $('.selected-images-view').html(imgs.join(' '))
    })

    $('#event_category').on('input', function (ev) {
        let input = ev.target.value
        if (categories.includes(input)) {
            ev.target.value = ''
            return
        }
        categories.push(input)
        rebuildSelectedCategories()
    })

})

