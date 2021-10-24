const strengthMeter = document.getElementById('strength-meter')
const passwordInput = document.getElementById('password-input')

passwordInput.addEventListener('input', updateStrengthMeter)
updateStrengthMeter()

function updateStrengthMeter() {
  const weaknesses = calculatePasswordStrength(passwordInput.value)

  let strength = 100
  
  weaknesses.forEach(weakness => {
    if (weakness == null) return
    strength -= weakness.deduction
    const messageElement = document.createElement('div')
    messageElement.innerText = weakness.message
    
  })
  strengthMeter.style.setProperty('--strength', strength)
}

function calculatePasswordStrength(password) {
  const weaknesses = []
  weaknesses.push(lengthWeakness(password))
  weaknesses.push(lowercaseWeakness(password))
  weaknesses.push(uppercaseWeakness(password))
  weaknesses.push(numberWeakness(password))
  weaknesses.push(specialCharactersWeakness(password))
  weaknesses.push(repeatCharactersWeakness(password))
  return weaknesses
}

console.log(calculatePasswordStrength('0'))

function lengthWeakness(password) {
  const length = password.length

  if (length <= 5) {
    return {
     
      deduction: 20
    }
  }

  if (length <= 10) {
    return {
  
      deduction: 15
    }
  }
}

function uppercaseWeakness(password) {
  return characterTypeWeakness(password, /[A-Z]/g, 'uppercase characters')

}

function lowercaseWeakness(password) {
  return characterTypeWeakness(password, /[a-z]/g, 'lowercase characters')
}

function numberWeakness(password) {
  return characterTypeWeakness(password, /[0-9]/g, 'numbers')
}

function specialCharactersWeakness(password) {
  return characterTypeWeakness(password, /[^0-9a-zA-Z\s]/g, 'special characters')
}

function characterTypeWeakness(password, regex, type) {
  const matches = password.match(regex) || []

  if (matches.length === 0) {
    return {
      message: `Your password has no ${type}`,
      deduction: 20
    }
  }


}

function repeatCharactersWeakness(password) {
  const matches = password.match(/(.)\1/g) || []
  if (matches.length > 0) {

  }
}
//WP

var getJSON = function(url, callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', url, true);
  xhr.responseType = 'json';
  xhr.onload = function() {
    var status = xhr.status;
    if (status === 200) {
      callback(null, xhr.response);
    } else {
      callback(status, xhr.response);
    }
  };
  xhr.send();
};

var out = '';
getJSON('https://tommieruijgrok.nl/NederlandsePlaatsenAPI/woonplaatsen/index.php?key=VMYPTXPDQJYQTXG',
function(err, data) {
  if (err !== null) {
    alert('Something went wrong: ' + err);
  } else {
    //alert('Your query count: ' + data);
    for (i=0; i < data['content'].length; i++){
      console.log(data['content'][i]['naam']);
      
      out += '<option value="' + data['content'][i]['code'] + '">' + data['content'][i]['naam'] + '</option>'
      
    }
    document.getElementById("WP").innerHTML = out;

  }

});

