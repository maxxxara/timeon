document.addEventListener("click",(e)=>{
  if(e.target.id == "delete"){
    e.target.disabled = true;
    const review_id = e.target.nextElementSibling.value
    if(confirm("ნამდვილად გსურთ წაშლა?")){
      const data = new FormData();
      data.append("review_id",review_id);
      fetch('./templates/delete_review.php', {
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
          e.target.parentNode.remove();
        }

      })
      .catch((error) => {
        e.target.disabled = false;
      });
    }
  }
});
