
let loggedIn = false;
const url="http://localhost:8888/task-nile-1";
let idValue ;
let trackName;

$(document).ready(function() {

  fetch(`${url}/tracks.php`)
    .then(response => response.json())
    .then(data => {
      let output = `
      <h2>songs</h2>
      <table class="table">
      <thead>
      <tr>
        <th scope="col">song name</th>
        <th scope="col">song length</th>
        <th scope="col">artist</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tbody>
      `;
      data.forEach(song => {
        output += `
        <tr>
        <td>${song.name}</td>
        <td>${song.length}</td>
        <td>${song.artist}</td>
        <td><button class='btn btn-success download' id='${song.id}' data-songName='${song.name}-${song.artist}'>download</button></td>
        </tr>`;
      });
      output += `  </tbody>
      </table>`;
      document.getElementById('tracks').innerHTML=output;
    })
    .catch(error => {
      console.log("there was an error", error);
    });
});

$(document).on("click", ".download", function() {
   idValue = $(this).attr("id");
   trackName = this.dataset.songname;

  if (loggedIn==false) {
    document.getElementById('submitForm').removeAttribute("hidden");
    document.getElementById('submitForm').addEventListener('submit', logIn);
  }else{
    
    download(idValue,trackName);
  }


});


function logIn(event) {
  event.preventDefault();
  let userName=document.getElementById('name').value;
  let pass=document.getElementById('pass').value;
  fetch(`${url}/authentication.php`,{
  method: 'POST',
  headers : new Headers(),
  body:JSON.stringify({
    username:userName,
    password:pass})
   } )
  .then(response => response.json())
  .then(data => {
    if (data.login =='successful') {
      document.getElementById('submitForm').setAttribute("hidden",true);
      loggedIn=true;
      download(idValue,trackName);
    }else {
      alert('invalid username or password');
      loggedIn=false
    };
  })
  .catch((err)=>console.log(err));
}


function download(idValue,trackName) {
  downloadTrack(idValue).then(res => {
    if (res) {
      downloadURI(res, `${trackName}.mp3`);
    }
  });

}
 function downloadURI(file, filename) {
  var a = document.createElement("a");
  a.href = window.URL.createObjectURL(file);
  a.download = filename;
  a.style.display = "none";
  document.body.appendChild(a);
  a.click();
  delete a;
}

  function downloadTrack(idValue) {
  
   return fetch(`${url}/links.php?id=${idValue}`).then(res=>res.blob());
  
}