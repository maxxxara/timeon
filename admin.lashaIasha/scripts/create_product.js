let check_link = false;
document.getElementById("submit").addEventListener("click",(e)=>{
  const title = document.getElementsByName("title")[0];
  const price = document.getElementsByName("price")[0];
  const sale_price = document.getElementsByName("sale_price")[0];
  const in_stock = document.getElementsByName("in_stock")[0];
  const end_date = document.getElementsByName("end_date")[0];
  const features = document.getElementsByName("features")[0];
  const images = document.getElementsByName("images[]")[0];

  const left_0 = document.getElementsByName("left_0")[0];
  const left_1 = document.getElementsByName("left_1")[0];
  const left_2 = document.getElementsByName("left_2")[0];
  const right_0 = document.getElementsByName("right_0")[0];
  const right_1 = document.getElementsByName("right_1")[0];
  const right_2 = document.getElementsByName("right_2")[0];
  const video = document.getElementsByName("video")[0];
  const guarantee = document.getElementsByName("guarantee")[0];

  if(title.value.length == 0){
    alert("მიუთითეთ პროდუქტის დასახელება");
    e.preventDefault();
  }else if(price.value.match(/[^0-9.]/i) !== null || price.value.length == 0){
      alert("ფასი არასწორია");
      e.preventDefault();
  }else if(sale_price.value.match(/[^0-9.]/i) !== null || sale_price.value.length == 0){
      alert("გასაყიდი ფასი არასწორია");
      e.preventDefault();
  }else if(end_date.value.length == 0){
      alert("მიუთითეთ აქციის დასასრლის დრო");
      e.preventDefault();
  }else if(images.files.length == 0){
      alert("აირჩიე პროდუქტის სურათი/სურათები");
      e.preventDefault();
  }else if(
    left_0.value.length == 0 || left_1.value.length == 0 || left_1.value.length == 0 ||
    right_0.value.length == 0 || right_1.value.length == 0 || right_2.value.length == 0
  ){
      alert("შეავსეთ ჩამოთვლილთაგან ყველა მოდელი,მწარმოებელი,ქვეყან,გერმანია.........");
      e.preventDefault();
  }else if(guarantee.value.length == 0){
      alert("მიუთითეთ გარანტია");
      e.preventDefault();
  }else if(check_link === false){
    alert("ლინკი არასწორია ან უკვე არსებობს.");
    e.preventDefault();
  }else{
    console.log("submit");
  }


});


const product_link = document.getElementsByName("product_link")[0];
product_link.addEventListener("change", (e)=>{
  if(product_link.value.length == 0){
    alert("მიუთითეთ პროდუქტის ლინკი");
    check_link = false;
  }else if(product_link.value.match(/[._~:/?#\[\]@!$&'()*+, ;=\"<>%{}|\\^`]/i)){
    alert("ლინკი არ უნდა შეიცავდეს /[._~:/?#\[\]@!$&'()*+, ;=\"<>%{}|\\^`]/i");
    check_link = false;
  }else{

    const data = new FormData();
    data.append("product_link",product_link.value);
    data.append("checking",null);
    fetch('./templates/add_product.php', {
      method: 'POST',
      body: data
    })
    .then((response) => {
      return response.text();
    })
    .then(data => {
      const response = JSON.parse(data);

      if(response["status"] === true){
        console.log(response["status"]);
        check_link = true;
      }else{
        alert(response["message"]);
        check_link = false;

      }
    })
    .catch((error) => {
      check_link = false;
    });
  }

});
