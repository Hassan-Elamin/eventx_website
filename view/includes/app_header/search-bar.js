
// getting all required elements
const searchInput = document.querySelector(".searchInput");
const resultBox = searchInput.querySelector(".resultBox");
const icon = searchInput.querySelector(".icon");
let linkTag = searchInput.querySelector("a");
let webLink;

$(() => {
    $('#nav_search_input').keyup(function (e) {
        let userData = e.target.value;
        let emptyArray = [];
        if (userData) {
            emptyArray = suggestions.filter((data) => {
                return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
            });
            emptyArray = emptyArray.map((data) => {
                return data = '<li>' + data + '</li>';
            });
            searchInput.classList.add("active");
            showSuggestions(emptyArray);
            let allList = resultBox.querySelectorAll("li");
            for (let i = 0; i < allList.length; i++) {
                allList[i].setAttribute("onclick", "select(this)");
            }
        } else {
            searchInput.classList.remove("active");
        }
    });

    $('#nav_search_input').on('input', function (e) {
        searchEvents(e.target.value);
    });
})

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

// if user clicks

function searchEvents(input) {
    var data = getTitles(input);
    document.getElementById('nav_search_response').innerHTML = data;
}

function getTitles(input) {

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
            console.log(this.responseText);
            document.getElementById('nav_search_response').innerHTML = this.responseText;
        }
    };
    xhttp.onerror = function () {
        reject(new Error('Request failed'));
    }
    xhttp.open("GET", "http://localhost/eventx_website/data_access/events_data/get_events_suggestions.php?q=" + input);
    xhttp.send();
}
