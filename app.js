const logoutBtn = document.getElementById("logout");
logoutBtn.addEventListener("click", () => {
  window.location.href = "logout.php";
});

let addTitle = document.getElementById("addTitle");
let addTxt = document.getElementById("addTxt");
let userid = document.getElementById("userid");
const addBtn = document.getElementById("addBtn");

showNotesById(userid.value);
// display all notes of particular user according to his/her id

// function to add notes
addBtn.addEventListener("click", (e) => {
  e.preventDefault();
  if (addTxt.value == "" && addTitle.value == "") {
    showAlert("Please fill out all fields!", "danger");
  } else {
    let notesObj = {
      title: addTitle.value,
      text: addTxt.value,
      userid: userid.value,
    };
    let data = Object.keys(notesObj)
      .map((key) => {
        return key + "=" + notesObj[key];
      })
      .join("&");

    fetch("http://localhost:8081/php-notes-app/insert-notes.php", {
        method: "POST",
        body: data,
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      })
      .then((response) => response.json())
      .then((data) => {
        if (data.className == "success") {
          showAlert(data.msg, data.className);
        }
        if (data.className == "danger") {
          showAlert(data.msg, data.className);
        }
        // Dismiss after 2 seconds
        setTimeout(function () {
          document.getElementById("alert").remove();
        }, 2000);
        addTxt.value = "";
        addTitle.value = "";
        showNotesById(userid.value);
      })
      .catch((error) => {
        console.log(error);
      });
  }
});

// generic function to diplay alerts
const showAlert = (msg, className) => {
  const div = document.createElement("div");
  div.className = `alert alert-${className} font-weight-bolder`;
  div.id = `alert`;
  div.appendChild(document.createTextNode(msg));
  const note = document.querySelector(".note");
  const alert_div_before = document.querySelector(".alert-div-before");
  note.insertBefore(div, alert_div_before);

  // Dismiss after 2 seconds
  setTimeout(function () {
    document.getElementById("alert").remove();
  }, 2000);
};

// function to show notes according to user id
function showNotesById(userid) {
  let notesElem = document.getElementById("notes");
  let html = "";
  let userObj = {
    userid: userid,
  };
  var data = Object.keys(userObj)
    .map(function (key) {
      return key + "=" + userObj[key];
    })
    .join("&");

  fetch("http://localhost:8081/php-notes-app/show-notes-by-id.php", {
      method: "POST",
      body: data,
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      }
    })
    .then((response) => response.json())
    .then((data) => {
      for (let i = 0; i < data.length; i++) {
        if (data[i].userid == userid) {
          // let result;
          let description = data[i].text;
          console.log(description);
          
          let maxLength = 40;
          
          let result = description.length > 40 ? description.substring(0, maxLength) + "..." : description;
          html += `<div class="noteCard card col-md-3" style="margin: 7px 7px";>
                    <div class="card-body rounded">
                    <div class="texts">
                        <h6 class="card-title text-white text-wrap">${data[i].title} </h6>
                        <p class="card-text text-white">${result}</p>
                    </div>
                        <button id="${data[i].id}" class="btns delete text-center" onclick="deleteNote(this.id)" ><i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                        <button id="${data[i].id}" class="btns edits text-center" onclick="editNote(this.id)" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>
                    </div>
                  </div>`;

          notesElem.innerHTML = html;
        }
      }
      if (data.length == 0) {
        notesElem.innerHTML = `<div class="col-md-6 alert alert-warning container-fluid mx-auto"            role="alert">
                Nothing to show. Please use <a href="#" class="alert-link">'Add a Note'</a> button to add notes!'
                </div>`;
      }
    })
    .catch((error) => {
      console.log("error: ", error);
    });
}

// function to delete note according to its id
function deleteNote(index) {
  let noteObj = {
    id: index,
  };

  var data = Object.keys(noteObj)
    .map(function (key) {
      return key + "=" + noteObj[key];
    })
    .join("&");


  fetch("http://localhost:8081/php-notes-app/delete-note-by-id.php", {
      body: data,
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === "success") {
        showAlert("Note Deleted!", "danger");
        showNotesById(userid.value);
      }
    })
    .catch(error => {
      console.log('error: ', error);
    });
}

// function to edit note by its id
function editNote(index) {  
  let modalContent = document.getElementById("openModal");
  let html = `<div class="form-group">
                <h5 class="title text-dark">Edit title</h5>
                <input type="text" class="form-control" id="editTitle">
              </div>
              <button type="button" class="close cross" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
              <div class="form-group">
                <h5 class="card-title text-dark">Edit your note</h5>
                <textarea class="form-control" id="editTxt" rows="5" required></textarea>
              </div>
              <button class="btn btn-info updateButn" id="${index}" onclick="UpdateButn(this.id)" data-dismiss="modal">Update Note</button>`;
  modalContent.innerHTML = html;
  let noteObj = {
    id: index,
  };

  var data = Object.keys(noteObj)
    .map(function (key) {
      return key + "=" + noteObj[key];
    })
    .join("&");


  fetch("http://localhost:8081/php-notes-app/edit-note-by-id.php", {
      body: data,
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded"
      }
    })
    .then(response => response.json())
    .then(data => {
      for(let i = 0; i < data.length; i++){
        if (data.length > 0) {
          document.getElementById("editTxt").value = (data[i].text);
          document.getElementById("editTitle").value = (data[i].title);
        }
      }   
    })
    .catch(error => {
      console.log('error: ', error);
    });
}

// function to update note
function UpdateButn(index){
  let editTitle = document.getElementById('editTitle');
  let editTxt = document.getElementById("editTxt");
    let notesObj = {
      title: editTitle.value,
      text: editTxt.value,
      id: index,
    };
    let data = Object.keys(notesObj)
      .map((key) => {
        return key + "=" + notesObj[key];
      })
      .join("&");

    fetch("http://localhost:8081/php-notes-app/update-note.php", {
        method: "POST",
        body: data,
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        }
      })
      .then((response) => response.json())
      .then((data) => {
        if (data.className == "success") {
          showAlert(data.msg, data.className);          
        }
        if (data.className == "danger") {
          showAlert(data.msg, data.className);
        }
        // Dismiss after 2 seconds
        setTimeout(function () {
          document.getElementById("alert").remove();
        }, 2000);
        editTxt.value = "";
        editTitle.value = "";
        showNotesById(userid.value);
      })
      .catch((error) => {
        console.log(error);
      });
  }

// function to search by title