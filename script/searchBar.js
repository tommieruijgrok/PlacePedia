document.getElementById('searchBar').addEventListener('keyup', function (){
    console.log("YEAH");
    $.getJSON('https://placepedia.tommieruijgrok.nl/process/search.php?query=' + this.value, function(data) {
        console.log(data);

        document.getElementById('dropdown').innerHTML = '';
        for (i=0; i < data.length; i++){

            x = document.createElement('div');
            xx = document.createElement('p');
            xx.innerText = data[i];
            x.appendChild(xx);
            console.log(x);
            document.getElementById('dropdown').appendChild(x);
        }


    });

})

