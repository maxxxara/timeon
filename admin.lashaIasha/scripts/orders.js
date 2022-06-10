document.addEventListener("click",(e)=>{
  if(e.target.id == "delete" || e.target.id == "called"){
    const data = new FormData();
    let makeit = true;
    const order_id = e.target.parentElement.parentElement.lastElementChild.value;
    if(e.target.id == "delete"){
      makeit = confirm("ნამდვილად გსურთ შეკვეთის წაშლა?");
      data.append("order_id", order_id);
    }else{
      let checkbox = 0;
      if(e.target.checked == true){
        checkbox = 1;
      }
      data.append("order_id", order_id);
      data.append("data", checkbox);
    }

    if(makeit){
      fetch('./templates/orders_action.php', {
        method: 'POST',
        body: data
      })
      .then((response) => {
        return response.text();
      })
      .then(data => {
        const response = JSON.parse(data);
        console.log(response);
        if(response["status"] === true){
          if(e.target.id == "delete"){
            e.target.parentElement.parentElement.remove();
          }
        }

      })
      .catch((error) => {
        e.target.disabled = false;
      });
    }
  }
});
