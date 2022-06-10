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

  //Create delivery tag for append
  const delivery_tag = document.createElement("p");
  delivery_tag.className = "delivery-text";
  delivery_tag.textContent = "მიწოდება საქართველოს მასშტაბით";

  //Insert deliver tag and sale value
  const product_data = document.getElementsByClassName("product-data")[0];
  //product_data.prepend(delivery_tag);
  const sale_value = document.getElementsByClassName("sale-value")[0];
  const text = product_data.getElementsByTagName("div")[0];
  text.insertBefore(sale_value,text.children[1]);

  //Is in stock change position
  const information = document.getElementsByClassName("split")[0];
  const in_stock_or_not = document.querySelector("#in_stock_or_not");
  information.insertBefore(in_stock_or_not,information.children[1]);


  //Dots for image
  const image_data = document.getElementsByClassName("image-data")[0];
  const for_image_dots = document.createElement("div");
  for_image_dots.className = "for-image-dots";
  const dot = document.createElement("div");
  for(let i = 0;i<3;i++){
    if(i == 0){
      dot.className = "active";
    }else{
      dot.className = "";
    }
    for_image_dots.append(dot.cloneNode(true));
  }
  image_data.insertBefore(for_image_dots,image_data.children[2]);

  //Rate count change position
  const rate_count_text = document.getElementsByClassName("rate-count-text")[0];
  const for_left_side = document.getElementsByClassName("left-side")[0];
  for_left_side.insertBefore(rate_count_text,for_left_side.children[2])

  //create add review button
  const make_rate = document.getElementsByClassName("make-rate")[0];
  const review_button = document.createElement("button");
  review_button.textContent = "შეფასების დაწერა";
  review_button.id = "make_review";
  review_button.className = "review-button";
  make_rate.appendChild(review_button);

  if(comment_quantity[0] > 3){
    //all review
    const data_last_id = document.getElementsByClassName("show-more")[0];
    if(data_last_id !== undefined && data_last_id !== null){
      const p = document.createElement("p");
      p.id = "load_more_review";
      p.setAttribute("data-last-id",data_last_id.getAttribute("data-last-id"));
      p.style.display =  document.getElementsByClassName("show-more")[0].style.display;
      p.textContent = "ყველა შეფასება";
      p.className = "all-review";
      const arrow_img = document.createElement("img");
      arrow_img.src = "./icons/down_arrow.png";
      p.appendChild(arrow_img);
      make_rate.appendChild(p);
      //remove dektop show more comments button
      document.getElementsByClassName("show-more")[0].remove();
    }

  }
  //remove create review button
  document.querySelector(".left-side button").remove();

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

  //remove delivery tag from .product-data -> .text
  //document.getElementsByClassName("delivery-text")[0].remove();

  //return in_stock_or_not at start position
  const product_data = document.getElementsByClassName("product-data")[0];
  const in_stock_or_not = document.querySelector("#in_stock_or_not");
  const text = product_data.getElementsByTagName("div")[0];
  text.insertBefore(in_stock_or_not,text.children[1]);

  //return sale-value at start position
  const data_0 = document.getElementsByClassName("data")[0];
  const sale_value = document.getElementsByClassName("sale-value")[0];
  data_0.insertBefore(sale_value,data_0.children[1]);

  //remove for-image-dots
  document.getElementsByClassName("for-image-dots")[0].remove();

  //create review button and return in place
  const review_button = document.createElement("button");
  review_button.id = "make_review";
  review_button.textContent = "შეფასების დაწერა";
  const for_review_button = document.getElementsByClassName("left-side")[0];
  for_review_button.insertBefore(review_button,for_review_button.children[2])


  if(comment_quantity[0] > 3){
    //add show more button
    const for_last_comment_id = document.querySelector("#load_more_review");
    if(for_last_comment_id !== undefined && for_last_comment_id !== null){
      const show_more = document.createElement("button");
      show_more.className = "show-more";
      show_more.id = "load_more_review";
      show_more.setAttribute("data-last-id", for_last_comment_id.getAttribute("data-last-id"));
      show_more.style.display = document.querySelector("#load_more_review").style.display;
      show_more.textContent = `ნახეთ ყველა შეფასება +(${comment_quantity[0]})`;
      const make_rate = document.getElementsByClassName("make-rate")[0];
      make_rate.appendChild(show_more);
      document.getElementsByClassName("all-review")[0].remove();
    }

  }
  //remove mobile version add review button
  document.getElementsByClassName("review-button")[0].remove();
  //return rate-count-text at start position
  const head = document.getElementsByClassName("head")[0];
  const rate_count_text = document.getElementsByClassName("rate-count-text")[0];
  head.appendChild(rate_count_text);

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
