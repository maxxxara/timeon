let reverse = false;
function product_scroll(slider_id){
  const for_scroll = document.querySelectorAll(`#${slider_id}`);
  const product = for_scroll[0].getElementsByClassName('product');
  if(product.length == 0) return;
  const marginLeft = getComputedStyle(product[0]).marginRight;
  const size = product[0].offsetWidth+parseInt(marginLeft);
  const scroll_size = for_scroll[0].scrollWidth-for_scroll[0].offsetWidth;
  if(!reverse){
    //for_scroll[0].scrollLeft+=size;
    for_scroll[0].style.scrollBehavior = 'auto';
    $(`#${slider_id}`).animate({
        scrollLeft: for_scroll[0].scrollLeft+size
    }, 800);
  }
  if(for_scroll[0].scrollLeft>=scroll_size){
    reverse=true;
  }
  if(reverse){
    //for_scroll[0].scrollLeft-=size;
    for_scroll[0].style.scrollBehavior = 'auto';
    $(`#${slider_id}`).animate({
        scrollLeft: for_scroll[0].scrollLeft-size
    }, 800);
  }
  if(for_scroll[0].scrollLeft<=0){
    //for_scroll[0].scrollLeft+=size;
    for_scroll[0].style.scrollBehavior = 'auto';
    $(`#${slider_id}`).animate({
        scrollLeft: for_scroll[0].scrollLeft+size
    }, 800);
    reverse=false;
  }
}

let sliders = {
  "other_products":setInterval(product_scroll,3000,"other_products"),
  "weekly_promotion": setInterval(product_scroll,3000,"weekly_promotion")
};

function make_slider(slider_id){

  function change_cursor(value,slider_obj){
    const product = slider_obj.getElementsByClassName('product');
    for(element of product){
      element.style.cursor = value;
    }
  }
  const slider = document.querySelector(`#${slider_id}`);

  slider.addEventListener("mouseover",  event => {
    if(sliders[slider_id] !== null){
      clearInterval(sliders[slider_id]);
    }
    $(`#${slider_id}`).stop();
    sliders[slider_id] = null;
  });

  // For mobile version
  slider.addEventListener("touchstart",  event => {
    //console.log("touchstart");
    if(sliders[slider_id] !== null){
      clearInterval(sliders[slider_id]);
    }
    $(`#${slider_id}`).stop();
    sliders[slider_id] = null;
  });
  slider.addEventListener("touchend",  event => {
      //console.log("touchend");
    sliders[slider_id] = setInterval(product_scroll, 3000, slider_id);
  });
  //End for mobile version


  let isDown = false;
  let startX;
  let scrollLeft;

  slider.addEventListener("mousedown", e => {
    isDown = true;
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;

    slider.style.scrollBehavior = "auto";
    change_cursor("grabbing",slider);
    slider.style.cursor = "grabbing";
  });

  slider.addEventListener("mouseleave", () => {
    sliders[slider_id] = setInterval(product_scroll, 3000, slider_id);
    isDown = false;
    slider.style.scrollBehavior = "smooth";
  });

  let not_moved = true;
  slider.addEventListener("mouseup", (e) => {
    isDown = false;
    slider.style.cursor = "smooth";
    change_cursor("pointer",slider);

    if(e.target.className == 'product'){
      if(not_moved){
        const product_link = e.target.getAttribute("data-title");
        window.open(`./?id=${product_link}`,'_self');
      }else{
        not_moved = true;
      }
    }
  });

  slider.addEventListener("mousemove", e => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const move = x - startX;
    //slider.scrollLeft = scrollLeft - walk;

    slider.scrollTo({
      left: scrollLeft-move,
      behavior: 'auto'
    });
    not_moved = false;
  });
  // End of bottom slider

}


make_slider("weekly_promotion");
make_slider("other_products");



const body = document.querySelector("body");

//Start create review
let reverse_main_slider = false;
function main_slider(){
  const slider = document.getElementById("images");
  if(slider.childElementCount<=1){
    return;
  }

  const size = slider.children[0].offsetWidth;
  const scroll_size = slider.scrollWidth-size;
  slider.style.scrollBehavior = 'auto';
  //console.log(slider.scrollLeft,scroll_size);
  if(slider.scrollLeft==scroll_size){
    reverse_main_slider=true;
  }else if(slider.scrollLeft==0){
    reverse_main_slider=false;
  }
  const scroll_left = size*Math.round((slider.scrollLeft+size)/size);
  if(!reverse_main_slider){
    $(`#images`).animate({
        scrollLeft: scroll_left
    }, 1300);
  }

  const scroll_right = size*Math.round((slider.scrollLeft-size)/size);

  if(reverse_main_slider){
    $(`#images`).animate({
        scrollLeft: scroll_right
    }, 1300);
  }
}
//let x = setInterval(main_slider,5000);

document.getElementById("images").addEventListener("mouseover",(e)=>{

  // if(x !== null){
  //   clearInterval(x);
  //   x=null;
  // }
});
document.getElementById("images").addEventListener("mouseleave",(e)=>{
  //
  // if(x === null){
  //   x = setInterval(main_slider,5000);
  // }
});
document.getElementById("images").addEventListener("touchstart",(e)=>{
  // if(x !== null){
  //   clearInterval(x);
  //   x=null;
  // }
});
document.getElementById("images").addEventListener("touchend",(e)=>{
  // if(x === null){
  //   x = setInterval(main_slider,5000);
  // }
});
document.getElementById("left_slider_button").addEventListener("click",()=>{
  const slider = document.getElementById("images");
  let images = null;
  if(window.innerWidth<=640){
    images = slider.querySelectorAll(".mobile");
    if(images.length<=1){
      return;
    }
  }else{
    images = slider.querySelectorAll(".desktop");
    if(images.length<=1){
      return;
    }
  }
  const size = images[0].offsetWidth;
  if(slider.scrollLeft>0){
    const scroll = size*Math.round((slider.scrollLeft-size)/size);

    $(`#images`).animate({
        scrollLeft: scroll
    }, 1000);
  }

});
document.getElementById("right_slider_button").addEventListener("click",()=>{
  const slider = document.getElementById("images");
  let images = null;
  if(window.innerWidth<=640){
    images = slider.querySelectorAll(".mobile");
    if(images.length<=1){
      return;
    }
  }else{
    images = slider.querySelectorAll(".desktop");
    if(images.length<=1){
      return;
    }
  }


  const size = images[0].offsetWidth;
  const scroll_size = slider.scrollWidth-size;
  //console.log(slider.scrollLeft<scroll_size,);

  if(slider.scrollLeft<scroll_size){

    const scroll_right = size*Math.round((slider.scrollLeft+size)/size);
    //console.log(scroll_right);
    $('#images').stop();
    $(`#images`).animate({
        scrollLeft: scroll_right
    }, 1000);
  }

});
//Hide section-0,1,2 main.

//Check for class and remove
function remove_specific_class(obj,class_name){
  if(obj.classList.contains(class_name)) obj.classList.remove(class_name);
}
//End check for class and remove
function hs_body_parts(hide_or_show){
  const main = document.getElementsByClassName("main")[0];
  const section_0_0 = document.getElementsByClassName("section-0")[0];
  const section_1_0 = document.getElementsByClassName("section-1")[0];
  const section_1_1 = document.getElementsByClassName("section-1")[1];
  const section_2_0 = document.getElementsByClassName("section-2")[0];
  const section_2_1 = document.getElementsByClassName("section-2")[1];
  if(hide_or_show == "hide"){
    main.style.display = "none";
    section_0_0.style.display = "none";
    section_1_0.style.display = "none";
    section_1_1.style.display = "none";
    section_2_0.style.display = "none";
    section_2_1.style.display = "none";
    remove_specific_class(main,"show-element");
    remove_specific_class(section_0_0,"show-element");
    remove_specific_class(section_1_0,"show-element");
    remove_specific_class(section_1_1,"show-element");
    remove_specific_class(section_2_0,"show-element");
    remove_specific_class(section_2_1,"show-element");
  }else{
    //it's not necessary to check each of element, one will be enough
    if(main.style.display == "none"){
        main.className += " show-element";
        section_0_0.className += " show-element";
        section_1_0.className += " show-element";
        section_1_1.className += " show-element";
        section_2_0.className += " show-element";
        section_2_1.className += " show-element";
        main.style.display = "";
        section_0_0 .style.display = "";
        section_1_0.style.display = "";
        section_1_1.style.display = "";
        section_2_0.style.display = "";
        section_2_1.style.display = "";
    }
  }
}
//End hide
//Create about, privacy, deliver component
function createComponent(component){
  const about_container = document.querySelector(".container-about");
  if(component == "ჩვენ შესახებ"){
    about_container.children[0].textContent = "ჩვენ შესახებ";
    about_container.children[1].textContent = `Moco - წარმოადგენს ონლაინ პლატფორმას, სადაც მომხმარებელს აქვს შესაძლებლობა სახლიდან გაუსვლელად, მარტივი პროცედურის გავლით, მიიღოს სასურველი ნივთი ქვეყნის  ნებისმიერ წერტილში.

ჩვენი უპირატესობები:`;
about_container.children[2].textContent = `• სწრაფი მიწოდების სერვისი მთელი საქართველოს მასშტაბით.
• სააქციოდ წარმოდგენილი ნივთების დიდი ასორტიმენტი.
• საგარანტიო სერვისი.
• 24/7 დახმარება.
• წარმოდგენილი ნივთის/ების დეტალურად აღწერა
• დაბრუნების პოლიტიკა`;

  }else if(component == "კონფიდენციალურობა"){
    about_container.children[0].textContent = "კონფიდენციალურობა";
    about_container.children[1].textContent = `პერსონალური მონაცემები ნიშნას ნებისმიერ ინფორმაციას, რომელიც პირდაპირ ან ირიბად უკავშირდება კონკრეტულ ან იდენტიფიცირებად პირს (მოქალაქეს).

ჩვენ ვამუშავებთ და ვუზრუნველყოფბთ პერსონალური მონაცემების უსაფრთხოებას საქართველოს კანონმდებლობით მინიჭებული უფლებებით.

პერსონალური მონაცემების დამუშავება ხორციელდება მხოლოდ პერსონალური მონაცემების სუბიექტის თანხმობით, გამოხატული ნებისმიერი ფორმით, რაც საშუალებას იძლევა დაადასტუროს თანხმობის მიღების ფაქტი.

Moco - თქვენი ნებართვის გარეშე არ უზიარებს თქვენს მიერ მოწოდებულ პერსონალურ ინფორმაციას მესამე მხარეს - თუმცა იტოვებს უფლებას მითითებულ საკონტაქტო ინფორმაციაზე გამოგიგზავნოთ სხვადასხვა ინფორმაცია ჩვენი სიახლეების,აქციების,განახლებების შესახებ.

რა დროით ვინახავთ პერსონალურ მონაცემებს?

თქვენს პერსონალურ ინფორმაციას ვინახავთ 2 წლამდე ვადით.

საიტის გამოყენებით თქვენ ეთანხმებით მოცემულ წესებს, წინააღმდეგ შემთხვევაში ნუ ისარგებლებთ ჩვენი კომპანიის მომსახურებით. `;
  }else if(component == "მიწოდება"){
    about_container.children[0].textContent = "მიწოდება";
    about_container.children[1].textContent = `მიწოდების სერვისი - მთელი საქართველოს მასშტაბით
ანგარიშსწორების ტიპი: ადგილზე ნივთის მიღებისას (ნაღდი ანგარიშსწორებით), გადმორიცხვით, ონლაინ გადახდით

მიწოდების ვადა:
თბილისი - შეკვეთიდან მეორე დღეს.
რეგიონი - 2-3 სამუშაო დღეში.

სააქციოდ წარმოდგენილი ნივთების მიწოდება თბილისის მასშტაბით - უფასოა.`;
    about_container.children[2].textContent = ``;
  }

}
//End create about, privacy, deliver component

//Document listener all in one
const contact = document.getElementById("contact");
const about = document.getElementById("about");
document.addEventListener('click',(e)=>{
  if(e.target && e.target.id == 'make_review'){
    review_component.style.display = "block";
  }
  //For search close
  let node = e.target;
  let close = true;
  try{
    while(node.tagName != "BODY"){
      if(e.target.className == "searched-data" ||
           node.parentNode.className == "searched-data" ||
           (node.parentNode.className == "search-container") ||
           (node.parentNode.className == "mobile-search-container")) close = false;
      node = node.parentNode;
    }
  }catch(e){
    //pass don't need it
  }
  if(close){
    document.getElementsByClassName("main-search")[0].style.display = "none";
    document.getElementsByClassName("mobile-search-container")[0].style.display = "none";
    document.getElementById("mobile_search").style.display = "";
    document.querySelector(".mobile-header .right").style.width = 'auto';
    document.getElementById("show_main_mobile").style.display = "";
  }
  //End for search close

  //Open search from mobile
  if(e.target && (e.target.tagName == "IMG" && e.target.id == "mobile_search")){
    document.getElementsByClassName("main-search")[0].style.display = "block";
    document.getElementsByClassName("mobile-search-container")[0].style.display = "inline-flex";
    document.querySelector(".mobile-header .right").style.width = '100%';
    document.getElementById("show_main_mobile").style.display = "none";
    e.target.style.display = "none";
  }
  //End open search from mobile
  if(e.target && e.target.textContent == "კონტაქტი" && e.target.tagName == "A"){
    if(contact.style.display == ""){
      contact.className+=" show-element";
      contact.style.display = "block";
      hs_body_parts("hide");
      remove_specific_class(about,"show-element");
      about.style.display = "";
    }
    document.querySelector("header").scrollIntoView({"behavior":"smooth"});
  }else if(e.target && (e.target.id == "market" || e.target.id == "show_main_mobile")){
    window.location.hash = "";
    hs_body_parts("show");
    remove_specific_class(about,"show-element");
    about.style.display = "";
    remove_specific_class(contact,"show-element");
    contact.style.display = "";
  }else if(e.target && ["ჩვენ შესახებ","მიწოდება","კონფიდენციალურობა"].includes(e.target.textContent) && e.target.tagName == "A"){
    createComponent(e.target.textContent);
    if(about.style.display == ""){
      about.className+=" show-element";
      about.style.display = "block";
      hs_body_parts("hide");
      remove_specific_class(contact,"show-element");
      contact.style.display = "";
    }
    document.querySelector("header").scrollIntoView({"behavior":"smooth"});
  }


});
//end document listener all in one

window.addEventListener('load', () => {
  if(window.location.hash === "#contact-page"){
    contact.className+=" show-element";
    contact.style.display = "block";
    hs_body_parts("hide");
    remove_specific_class(about,"show-element");
    about.style.display = "";
  }else if(["#about-us","#deliver","#privacy-policy"].includes(window.location.hash)){
    if(window.location.hash === "#about-us"){
      createComponent("ჩვენ შესახებ");
    }else if(window.location.hash === "#deliver") {
      createComponent("მიწოდება");
    }else{
      createComponent("კონფიდენციალურობა");
    }
    about.className+=" show-element";
    about.style.display = "block";
    hs_body_parts("hide");
    remove_specific_class(contact,"show-element");
    contact.style.display = "";
  }
});

//Search open
document.getElementsByClassName("search-container")[0].addEventListener("click",(e)=>{
  if(e.target && (e.target.tagName == "IMG" || e.target.tagName == "INPUT")){
    document.getElementsByClassName("main-search")[0].style.display = "block";
  }
});
//End search open
//Search data
function create_search_result(data){

  searched_data = document.querySelector(".searched-data");
  searched_data.innerHTML = '';
  for(element of data){
    //if something went wrong change a tag with div
    const searched_product = document.createElement("a");
    searched_product.className = "searched-product";
    const img = document.createElement("img");
    img.src = `./images/${element[4]}`;
    searched_product.appendChild(img);
    searched_product.id= element[0];
    //searched_product.setAttribute('onclick',`window.open('./?id=${element[0]}','_self')`);
    searched_product.href = `./?id=${element[0]}`;
    //searched_product.target = '_blank';
    const product_data = document.createElement("div");
    product_data.className = "product-data";
    const p = document.createElement("p");
    p.textContent = element[1];
    product_data.appendChild(p);
    const price_data = document.createElement("div");
    price_data.className = "price-data";
    const sale_price = document.createElement("p");
    const price = document.createElement("p");
    const percentage = document.createElement("p");

    sale_price.textContent = `${element[2]}₾`;
    price.textContent = `${element[3]}₾`;
    percentage.textContent = `-${Math.round(((element[3]-element[2])/element[3])*100)}%`;
    price_data.appendChild(sale_price);
    price_data.appendChild(price);
    price_data.appendChild(percentage);
    product_data.appendChild(price_data);
    searched_product.appendChild(product_data);
    searched_data.appendChild(searched_product);
    //console.log(searched_product);

  }
}

async function search(text){
  const data = new FormData();
  data.append("text",text);
  data.append("pr_id",null);
  await fetch('./templates/search.php', {
    method: 'POST',
    body: data
  })
  .then((response) => {
      return response.text();
  })
  .then(data => {
    const response = JSON.parse(data);
     if(response["status"] === true){
       create_search_result(response["data"]);
     }else{
       searched_data = document.querySelector(".searched-data");
       searched_data.innerHTML = '';
     }
  })
  .catch((error) => {
    console.log("error during product search",error)
  });
}
document.addEventListener("keyup",(e)=>{

  if(e.target.tagName == "INPUT"){
    if(e.target.id == "mobile_search_input"){
      const text = e.target.value;
      if(text.length > 2){
        search(text);
      }else{
        searched_data = document.querySelector(".searched-data");
        searched_data.innerHTML = '';
      }

    }else if(e.target.id == "desktop_search_input"){
      document.getElementById("show_main_mobile").style.display = "none";
      const text = e.target.value;
      if(text.length > 2){
        search(text);
      }else{
        searched_data = document.querySelector(".searched-data");
        searched_data.innerHTML = '';
      }
    }
  }
});
//End search data

//Created by Jagata
