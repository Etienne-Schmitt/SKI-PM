let
    btnRaceList = document.getElementsByClassName('btn-categories'),
    raceListParent = document.getElementById('races-list'),
    path = '';

(window.location.pathname === "/races") ? path = '' : path = getPrefix();

function getPrefix() {
    //TODO get prefix
    return "prefix/";
}


async function getListData(raceCategory) {

    let data = await fetch(path + '/api/races/list/' + raceCategory, {
        headers: {
            "Content-Type": "application/json",
            "X-NoBrowser": 'true'
        },
        credentials: "omit"
    })
        .then(response => {
            if (response.ok) {
                return response;
            } else {
                return Promise.reject('Error: ' + response.status)
            }
        })
        .catch(error => {
            console.log(error);
        });

    return data.json();
}

for (let raceBtn of btnRaceList) {

    let raceCategory = raceBtn.innerText;
    raceBtn.addEventListener('click', () => {

        if (!raceBtn.classList.contains('clicked')) {
            for (let btn of btnRaceList) {
                if (btn.classList.contains('clicked')) {
                    btn.classList.remove('clicked');
                    raceListParent.innerHTML = null;
                }
            }
            raceBtn.classList.add('clicked');
            raceListParent.innerHTML = null;
            showCategory(raceCategory);
        } else {
            raceBtn.classList.remove('clicked');
            raceListParent.innerHTML = null;
        }
    });
}

function showCategory(raceCategory) {

    let raceList = getListData(raceCategory);

    raceList.then(races => {

        races.forEach(race => {


            let raceDiv = document.createElement("div");
            raceDiv.classList.add("race-elements");

            let raceDate = race.date.date.split(' ')[0];

            raceDiv.innerHTML =
                '<a href="' + '/races/' + race.name + '">' + race.name + ' ' + raceDate + '</a>'
            ;

            raceListParent.appendChild(raceDiv);
        });

    });
}



