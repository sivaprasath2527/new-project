const navDropdown = (p) => {
  var userTag = document.querySelector("#user-navbar");
  var dropdownTag = document.querySelector(`.${p}`);
  dropdownTag.classList.toggle("hidden");
};
function dropdown(p) {
  var btn = document.querySelector(".btn-profile");
  var dropdownDiv = document.querySelector(".profile-dropdown");
  switch (p) {
    case true:
      dropdownDiv.style.position = "absolute";
      dropdownDiv.style.top = `${btn.offsetTop + 30}px`;
      dropdownDiv.style.left = `${btn.offsetLeft}px`;
      dropdownDiv.classList.remove("hidden");
      break;
    case false:
      dropdownDiv.classList.add("hidden");
      break;
  }
}


