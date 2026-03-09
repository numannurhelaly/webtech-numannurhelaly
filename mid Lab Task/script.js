// form submit
document.getElementById("student-form").addEventListener("submit", addStudent);

// enable button when typing
document.getElementById("name").addEventListener("input", checkInput);

// search
document.getElementById("search").addEventListener("input", searchStudent);

// sort
document.getElementById("sortBtn").addEventListener("click", sortStudents);

// highlight
document.getElementById("highlightBtn").addEventListener("click", highlightFirst);

let total = 0;
let present = 0;


// check input
function checkInput(){

let name = document.getElementById("name").value;

if(name === ""){
document.getElementById("addBtn").disabled = true;
}
else{
document.getElementById("addBtn").disabled = false;
}

}


// add student
function addStudent(e){

e.preventDefault();

let roll = document.getElementById("roll").value;
let name = document.getElementById("name").value;

if(name === "" || roll === ""){
alert("Enter roll and name");
return;
}

let li = document.createElement("li");
li.classList.add("student");


// name text
let span = document.createElement("span");
span.textContent = roll + " - " + name;


// present checkbox
let checkbox = document.createElement("input");
checkbox.type = "checkbox";

checkbox.addEventListener("change", function(){

if(checkbox.checked){
li.classList.add("present");
present++;
}
else{
li.classList.remove("present");
present--;
}

updateAttendance();

});


// edit button
let edit = document.createElement("button");
edit.textContent = "Edit";
edit.classList.add("btn-edit");

edit.addEventListener("click", function(){
editStudent(span);
});


// delete button
let del = document.createElement("button");
del.textContent = "Delete";
del.classList.add("btn-delete");

del.addEventListener("click", function(){
deleteStudent(li);
});


li.appendChild(span);
li.appendChild(checkbox);
li.appendChild(edit);
li.appendChild(del);

document.getElementById("student-list").appendChild(li);

total++;

updateTotal();
updateAttendance();

document.getElementById("roll").value="";
document.getElementById("name").value="";

}


// delete
function deleteStudent(el){

let confirmDelete = confirm("Are you sure you want to delete this student?");

if(confirmDelete){

if(el.classList.contains("present")){
present--;
}

el.remove();

total--;

updateTotal();
updateAttendance();

}

}


// edit
function editStudent(span){

let text = span.textContent.split(" - ");

let newRoll = prompt("Edit Roll", text[0]);
let newName = prompt("Edit Name", text[1]);

if(newRoll !== null && newName !== null){
span.textContent = newRoll + " - " + newName;
}

}


// total update
function updateTotal(){

document.getElementById("total").textContent = "Total students: " + total;

}


// attendance update
function updateAttendance(){

let absent = total - present;

document.getElementById("attendance").textContent =
"Present: " + present + " , Absent: " + absent;

}


// search
function searchStudent(){

let text = document.getElementById("search").value.toLowerCase();

let students = document.querySelectorAll(".student");

students.forEach(function(item){

let name = item.textContent.toLowerCase();

if(name.includes(text)){
item.style.display = "flex";
}
else{
item.style.display = "none";
}

});

}


// sort
function sortStudents(){

let list = document.getElementById("student-list");

let items = Array.from(list.children);

items.sort(function(a,b){

let A = a.textContent.toLowerCase();
let B = b.textContent.toLowerCase();

if(A > B) return 1;
if(A < B) return -1;
return 0;

});

items.forEach(function(li){
list.appendChild(li);
});

}


// highlight first
function highlightFirst(){

let students = document.querySelectorAll(".student");

students.forEach(function(s){
s.classList.remove("highlight");
});

if(students.length > 0){
students[0].classList.add("highlight");
}

}