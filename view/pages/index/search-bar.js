
// getting all required elements
const searchInput = document.querySelector(".searchInput");
const input = searchInput.querySelector("input");
const resultBox = searchInput.querySelector(".resultBox");
const icon = searchInput.querySelector(".icon");
let linkTag = searchInput.querySelector("a");
let webLink;

$('.searchInput input').keyup(function (e) {
    let userData = e.target.value;
    let emptyArray = [];
    if (userData) {
        emptyArray = suggestions.filter((data) => {
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data) => {
            return data = '<li>' + data + '</li>';
        });
        $('.searchInput').addClass('active')
        showSuggestions(emptyArray);
        $('.resultBox > li').each(collection, function (indexInArray, valueOfElement) {
            collection.attr('onclick', 'select(this)')
        });
    } else {
        $('.searchInput').removeClass('active');
    }
});

function showSuggestions(list) {
    let listData;
    if (!list.length) {
        userValue = inputBox.value;
        listData = '<li>' + userValue + '</li>';
    } else {
        listData = list.join('');
    }
    resultBox.innerHTML = listData;
}

$('#nav_search_input').on('input', function (ev) {
    getSuggestions(ev.target.value);
})

function getTitles(input) {
    let res = '';
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.length === '') {
                searchInput.classList.remove("active");
            } else {
                if (!searchInput.classList.contains('active')) {
                    searchInput.classList.add("active");
                }
            }
            res = this.responseText;
            let list = JSON.parse(this.responseText)
            viewList = []
            list.forEach(suggest => {
                viewList.push(`
                    <a class='text-decoration-none' href='http://localhost/eventx_website/view/pages/event_page/event_page.php?eid=` + suggest.eid + `'> <li> ` + suggest.title + ` </li> </a>
                `)
            });
            $("#nav_search_response").html('');
            $('#nav_search_response').html(viewList.join(''));
        }
    };
    xhttp.onerror = function () {
        reject(new Error('Request failed'));
        res = 'error';
    }
    xhttp.open("GET", "http://localhost/eventx_website/business_logic/api/search_suggestions.php?q=" + input);
    xhttp.send();
}

function getSuggestions(input) {
    $.ajax({
        type: "GET",
        url: "http://localhost/eventx_website/business_logic/api/search_suggestions.php?q=" + input,
        dataType: "json",
        success: function (response) {
            console.log(response.suggestions)
            if(response.status === 1){
                if (response.text === '') {
                    searchInput.classList.remove("active");
                } else {
                    if (!searchInput.classList.contains('active')) {
                        searchInput.classList.add("active");
                    }
                }
                let list = response.suggestions
                viewList = []
                list.forEach(suggest => {
                    viewList.push(`
                    <a class='text-decoration-none' href='http://localhost/eventx_website/view/pages/event_page/event_page.php?eid=` + suggest.eid + `'> <li> ` + suggest.title + ` </li> </a>
                `)
                });
                $("#nav_search_response").html('');
                $('#nav_search_response').html(viewList.join(''));
            }else{
                $("#nav_search_response").html('');
                $("#nav_search_response").html('<li>No Results Found</li>');
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}