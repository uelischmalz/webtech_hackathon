console.log("jscipt.js wird geladen.");

function neuenUserSpeichern(firstname, lastname, email, password, role){
  let formData = new FormData();
  formData.append('firstname', firstname);        // Wert aus Fuktionsparameter
  formData.append('lastname', lastname);      // Wert aus Fuktionsparameter
  formData.append('email', email);      // Wert aus Hauptvariablen
  formData.append('password', password);
  // fetch-Aufruf mit zusätzlichem ...
  fetch("system/neuerUserSpeichern.php",
    {
        body: formData,  // body:   Objekt mit zu übertranden Daten
        method: "post"   // method: Art der Übertragung (get/post)
    })
    .then((response) => {
      return response.text();
    })
    .then((neueId) => {  // erwartet die id des neuen Beitrags
      console.log(neueId);
    })
    .catch(function(error) {
      console.log('Error: ' + error.message);
    });
}


let speichernBtn = document.querySelector('#userSpeichern');
  speichernBtn.addEventListener("click", function(){
  neuenUserSpeichern(firstname.value, lastname.value, email.value, password.value);
})

// neuenUserSpeichern("Anja", "Leu", "test@anja.ch", "testpasswort");
