



const updateButtons = document.querySelectorAll(".update_btn");
const categoryNameInput = document.getElementById("categoryNameModify");
const categoryIDInput = document.getElementById("categoryID");

window.addEventListener('load', function() {
  document.getElementById("categoryPopup").style.display = "none";
  document.getElementById("plantPopup").style.display = "none";
});

// Add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Popup functions
function openPopupC() {
  document.getElementById("categoryPopup").style.display = "block";
}

function closePopupC() {
  document.getElementById("categoryPopup").style.display = "none";
}
function openModifyPopup() {
  document.getElementById("modifyPopup").style.display = "block";
}

function closeModifyPopup() {
  document.getElementById("modifyPopup").style.display = "none";
}


function openPopupP() {
  document.getElementById("plantPopup").style.display = "block";
}

function closePopupP() {
  document.getElementById("plantPopup").style.display = "none";
}

updateButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    const categoryName = btn.parentElement.parentElement.childNodes[1].textContent;
    categoryNameInput.value = categoryName;
    categoryIDInput.value = btn.parentElement.childNodes[1].value;
    openModifyPopup();
  });
});



const update_theme_btn = document.querySelectorAll(".update_theme_btn");
const themeNameInput = document.getElementById("themeNameModify")
const themeIdInput = document.getElementById("themeID");


update_theme_btn.forEach(btn => {
  btn.addEventListener("click", () => {
    const themeName = btn.parentElement.parentElement.childNodes[3].textContent;
    themeNameInput.value = themeName;
    
    themeIdInput.value = btn.parentElement.childNodes[1].value;
    console.log(themeIdInput.value);
    // document.getElementById("modifyThemePopup").style.display = "block";
  });
});


function openPopupT() {
  document.getElementById("themePopup").style.display = "block";
}

function closePopupT() {
  document.getElementById("themePopup").style.display = "none";
}
function openModifyPopupT() {
  // console.log("clicked");
  document.getElementById("modifyThemePopup").style.display = "block";
}

function closeModifyPopupT() {
  document.getElementById("modifyThemePopup").style.display = "none";
}

function openPopupTag() {
  document.getElementById("tagPopup").style.display = "block";
}

function closePopupTag() {
  document.getElementById("tagPopup").style.display = "none";
}



