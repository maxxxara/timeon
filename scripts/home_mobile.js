function mobile_version(){
  _info["mobile"] = true;
  //Copy search input value
  const desktop_search_input = document.querySelector(".search-container input");
  document.querySelector(".mobile-search-container input").value = desktop_search_input.value;
  const searched_data_style = document.querySelector(".main-search").style.display;
  if(searched_data_style == "block"){
    document.getElementsByClassName("main-search")[0].style.display = "block";
    document.getElementsByClassName("mobile-search-container")[0].style.display = "inline-flex";
    document.querySelector(".mobile-header .right").style.width = '100%';
    document.getElementById("mobile_search").style.display = "none";
  }
  //End copy search input value

  //Footer remake
  const footer = document.getElementsByClassName("footer")[0];
  const last = footer.getElementsByClassName("last")[0];
  const second_div = footer.getElementsByTagName("div")[1];
  second_div.insertBefore(last,second_div.lastElementChild.nextElementSibling);

  //header section
  const header = document.getElementsByClassName("header")[0];
  header.style.display = "none";

  //mobile header
  const mobile_header = document.getElementsByClassName("mobile-header")[0];
  mobile_header.style.display = "flex";
}
function desktop_version(){
  _info["mobile"] = false;
  //Copy search input value
  const mobile_search_input = document.querySelector(".mobile-search-container input");
  document.querySelector(".search-container input").value = mobile_search_input.value;
  //End copy search input value

  //footer change
  const last_element = document.getElementsByClassName("last")[0];
  const footer = document.getElementsByClassName("footer")[0];
  footer.appendChild(last_element);

  //desktop header section
  const header = document.getElementsByClassName("header")[0];
  header.style.display = "flex";

  //mobile header
  const mobile_header = document.getElementsByClassName("mobile-header")[0];
  mobile_header.style.display = "none";

}
_info["mobile"] = false;
if(window.innerWidth <=824){
  _info["mobile"] = true
}
if(_info["mobile"] === true){
  mobile_version();
}

window.addEventListener('resize', ()=>{
  //console.log(window.innerWidth);
  //alert(window.innerWidth);
  try{
    const slider = document.getElementById("images");
    const size = slider.children[0].offsetWidth;
    slider.scrollLeft = size*Math.round((slider.scrollLeft)/size);
  }catch(e){
    //pass
  }

  if(_info["mobile"] === false && window.innerWidth<=824){
    mobile_version();
    _info["mobile"] = true;
    console.log("mobile");
  }else if(_info["mobile"] === true && window.innerWidth>824){
      console.log("desktop",_info["mobile"]);
    desktop_version();
    _info["mobile"]=false;

  }
});
