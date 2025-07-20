


let url = window.location.search;
let params = new URLSearchParams(url);

const eid = params.get('eid')
let uid = document.cookie.split(';').find(
    (value) => value.startsWith(' uid')
).replace(' uid=', '')
let oid = 0;

let eventData = {}

let data = {
    'oid': oid,
    'uid': uid,
    'action': "check-follow"
};

let controller;

function buildLocationsList(locations) {
    let locationsHtml = '';
    locations.forEach(location => {
        locationsHtml += `<p> <i class='fa-solid fa-location-dot fa-lg'></i> ${location.location} </p>`;
    });
    return locationsHtml;
}

function buildOrgInfo(org, oid) {
    $('.org-name').text(org.name)
    $('.org-email').text(org.email)
    $('.org-profile > a').attr('href', "../orgfolio/orgfolio.php?oid=" + oid)
}

function buildCategoriesList(categories) {
    let categoriesHtml = '';
    categories.forEach(category => {
        categoriesHtml += `
            <a href='../discover/discover.php?category=${category.name}' class='btn btn-secondary category-btn' > ${category.name} </a>
            `;
    });
    return categoriesHtml;
}

$(() => {
    $.getJSON(
        website_domain + api_endpath + '/events.php?eid=' + eid,
        function (json, status, xhr) {
            console.log(json)
            let event = json.event
            eventData = event;
            let ticket = json.ticket
            let org = json.organizer
            let categories = json.categories
            let locations = json.locations

            data.oid = event.oid

            if (event.event_state === 'continuous' || event.event_state === 'upcoming') {
                $('.ticket-price').removeClass('d-none').text(ticket.price + '$');
            }

            let img = event.img ?? "http://localhost/uploads/eventx/images/defaults/" + categories[0].name + "_event.jpg";

            $('.images_carousal > img').attr('src', img)

            $('.ev_title > #title').text(event.title)
            $('.event-state').addClass(
                ()=> {
                    switch (event.event_state) {
                        case 'upcoming':
                            return 'text-danger';
                        case 'paused':
                            return 'text-warning';
                        case 'finished':
                            return 'text-success';
                        case 'continuous':
                            return 'text-light';
                    }
                }
            )
            $('#event-state-type').text(event.event_state.toUpperCase())

            $('.event-details').text(event.description)
                .append("<br/>")
                .append(" ticket price : <strong>" + ticket.price + "$</strong> ");

            $('.categories-block').html(buildCategoriesList(categories))
            if (locations.length > 0) {
                $('.event_locations').removeClass('d-none')
                $(".event_locations > p").html(buildLocationsList(locations))
            }
            buildOrgInfo(org, event.oid)

            $('.images_carousal').removeClass('d-none')
            $('.ev-page').removeClass('d-none')
            $('.loader').addClass('d-none')

            controller = new FollowController({
                'oid': event.oid,
                'uid': uid,
                'action': "check-follow"
            });

        }
    )

})

