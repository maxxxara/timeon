document.addEventListener("click",(e)=>{
  if(e.target.id == "delete"){
    const product_id = e.target.getAttribute("data-id");
    if(confirm("ნამდვილად გსურთ პროდუქტის წაშლა?")){
      const data = new FormData();
      data.append("product_id",product_id)
      fetch('./templates/delete_product.php', {
        method: 'POST',
        body: data
      })
      .then((response) => {
        return response.text();
      })
      .then(data => {
        const response = JSON.parse(data);
        //console.log(response);
        if(response["status"] === true){
          e.target.parentElement.parentElement.remove();
        }
      })
      .catch((error) => {
        console.log("Something went wrong",error);
      });
    }
  }
});
