document.getElementById('searchBar').addEventListener('keyup', function (){
    $.getJSON('https://placepedia.tommieruijgrok.nl/process/search.php?query=' + this.value, function(data) {

        document.getElementById('dropdown').innerHTML = '';
        for (i=0; i < data.length; i++){

            a = document.createElement('a');
            if (data[i].type == 'PF'){
                a.href = "../profile.php?u=" + data[i].id;
            } else {
                a.href = "../place.php?type=" + data[i].type + "&code=" + data[i].code;
            }


            x = document.createElement('div');
            x.classList.add('flex', 'flexSpaceBetween', 'flexAlign');

            xx = document.createElement('p');
            if (data[i].type == "GM"){
                xx.innerText = data[i].gemeenteNaam;
            } else if (data[i].type == "PV"){
                xx.innerText = data[i].provincieNaam;
            } else if (data[i].type == "WP"){
                xx.innerText = data[i].woonplaatsNaam;
            } else if (data[i].type == "PF"){
                xx.innerHTML = '<i class="fas fa-user" style="margin-right: 8px"></i>' + data[i].name;
            }
            x.appendChild(xx);

            if (data[i].type == "GM"){
                xx = document.createElement('p');
                xx.innerText = data[i].provincie;
                xx.classList.add('searchBarProvince');
                x.appendChild(xx);
            } else if (data[i].type == "PV"){
                xx = document.createElement('p');
                xx.innerText = "Nederland";
                xx.classList.add('searchBarProvince');
                x.appendChild(xx);
            } else if (data[i].type == "WP"){
                xx = document.createElement('p');
                xx.innerText = data[i].gemeente;
                xx.classList.add('searchBarProvince');
                x.appendChild(xx);
            } else if (data[i].type == "PF"){
                xx = document.createElement('p');
                xx.innerText = "Profiel";
                xx.classList.add('searchBarProvince');
                x.appendChild(xx);
            }

            a.appendChild(x);

            console.log(a);
            document.getElementById('dropdown').appendChild(a);
        }


    });

})

