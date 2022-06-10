
// var delayInMilliseconds = 30000; //1 second
if (!(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))) {
  $(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 800) {
      $(".container__order").css('visibility: hidden;');
      $(".showScroll").show();
    }
    if (scroll <= 550) {
      $(".container__order").css('visibility: visible;');

      $(".showScroll").hide();

    }
  }); //missing );


} else {

  $(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll >= 1000) {
      $(".bottom__mobile").css('display', 'flex');
    }
    if (scroll <= 550) {
      $(".bottom__mobile").css('display', 'none');

    }
  }); //missing );

}


(function () {
  $(document).ready(function () { update(); });

  function update() {
    var oldvalue = $('.quantity').text();

    var newvalue = oldvalue - 1;

    if (oldvalue > 5) {
      $('.quantity').text(newvalue)
      setTimeout(update, 30000);
    }

  }
}
)();


(function () {
  $(document).ready(function () { update(); });

  function update() {
    var oldvalue = $('.quantity2').text();

    var newvalue = oldvalue - 1;

    if (oldvalue > 5) {
      $('.quantity2').text(newvalue)
      setTimeout(update, 30000);
    }

  }
}
)();






let reverse = false;
function product_scroll() {
  const for_scroll = document.getElementsByClassName('other-products');
  const product = for_scroll[0].getElementsByClassName('product');
  if (product.length == 0) return;
  const marginLeft = getComputedStyle(product[0]).marginRight;
  const size = product[0].offsetWidth + parseInt(marginLeft);
  const scroll_size = for_scroll[0].scrollWidth - for_scroll[0].offsetWidth;
  if (!reverse) {
    //for_scroll[0].scrollLeft+=size;
    $('.other-products')[0].style.scrollBehavior = 'auto';
    $('.other-products').animate({
      scrollLeft: for_scroll[0].scrollLeft + size
    }, 800);
  }
  if (for_scroll[0].scrollLeft >= scroll_size) {
    reverse = true;
  }
  if (reverse) {
    //for_scroll[0].scrollLeft-=size;
    $('.other-products')[0].style.scrollBehavior = 'auto';
    $('.other-products').animate({
      scrollLeft: for_scroll[0].scrollLeft - size
    }, 800);
  }
  if (for_scroll[0].scrollLeft <= 0) {
    //for_scroll[0].scrollLeft+=size;
    $('.other-products')[0].style.scrollBehavior = 'auto';
    $('.other-products').animate({
      scrollLeft: for_scroll[0].scrollLeft + size
    }, 800);
    reverse = false;
  }
}
let slider_auto_move = setInterval(product_scroll, 3000);

function change_cursor(value) {
  const product = document.getElementsByClassName('product');
  for (element of product) {
    element.style.cursor = value;
  }
}
const slider = document.getElementsByClassName('other-products')[0];

slider.addEventListener("mouseover", event => {
  if (slider_auto_move !== null) {
    clearInterval(slider_auto_move);
  }
  $('.other-products').stop();
  slider_auto_move = null;
});

// For mobile version
slider.addEventListener("touchstart", event => {
  //console.log("touchstart");
  if (slider_auto_move !== null) {
    clearInterval(slider_auto_move);

  }
  $('.other-products').stop();
  slider_auto_move = null;
});
slider.addEventListener("touchend", event => {
  //console.log("touchend");
  slider_auto_move = setInterval(product_scroll, 3000);
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
  change_cursor("grabbing");
  slider.style.cursor = "grabbing";
});

slider.addEventListener("mouseleave", () => {
  slider_auto_move = setInterval(product_scroll, 3000);
  isDown = false;
  slider.style.scrollBehavior = "smooth";
});

let not_moved = true;
slider.addEventListener("mouseup", (e) => {
  isDown = false;
  slider.style.cursor = "smooth";
  change_cursor("pointer");

  if (e.target.className == 'product') {
    if (not_moved) {
      const product_link = e.target.getAttribute("data-title");
      window.open(`./?id=${product_link}`, '_self');
    } else {
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
    left: scrollLeft - move,
    behavior: 'auto'
  });
  not_moved = false;
});
// End of bottom slider


//Main image change
const product_images = document.getElementById("images");
product_images.addEventListener("click", (e) => {
  const main_image = document.getElementById("main_image");
  const active_image = document.getElementsByClassName("active")[0];
  if (e.target.localName == "img") {
    main_image.src = e.target.src;
    active_image.classList.remove("active");
    e.target.className = "active";

    //For mobile dot's that are located under the images slider
    const current = Array.prototype.indexOf.call(product_images.children, e.target);
    let in_group = parseInt(product_images.children.length / 3);
    if (in_group == 0) in_group += 1;

    let active_dot = parseInt(current / in_group);
    if (active_dot > 2) {
      active_dot = 2
    }
    //console.log(current,active_dot,parseInt(product_images.children.length/3));
    const dots = document.getElementsByClassName("for-image-dots")[0];

    if (dots !== undefined && dots !== null) {
      dots.getElementsByClassName("active")[0].classList.remove("active");
      dots.children[active_dot].className = "active";
    }
  }

});
//End main change image

//Change main image with buttons
let start_position = 1
let end_position = 4

const left_slider_button = document.getElementById("left_slider_button");
const right_slider_button = document.getElementById("right_slider_button");
left_slider_button.addEventListener("click", () => {
  const main_image = document.getElementById("main_image");
  const active_image = document.getElementsByClassName("active")[0];
  const real_element_size = parseInt(getComputedStyle(active_image).marginRight) + active_image.offsetWidth;
  const previous_element = active_image.previousElementSibling;
  if (previous_element !== null) {
    main_image.src = previous_element.src;
    previous_element.className = "active";
    active_image.classList.remove("active");
    const current = active_image.offsetLeft / real_element_size;
    if (current < start_position) {
      start_position = current;
      end_position = start_position + 3;
      //product_images.scrollLeft = real_element_size*(current-1);
      $('#images')[0].style.scrollBehavior = 'auto';
      $('#images').animate({
        scrollLeft: real_element_size * (current - 1)
      }, 300);

    }
  } else {
    end_position = product_images.childElementCount;
    start_position = end_position - 3;
    last_image = product_images.getElementsByTagName("img");
    if (last_image.length > 0) {
      main_image.src = last_image[end_position - 1].src;
      active_image.classList.remove("active");
      last_image[end_position - 1].className = "active";
      //product_images.scrollLeft = last_image[end_position-1].offsetLeft;
      $('#images')[0].style.scrollBehavior = 'auto';
      $('#images').animate({
        scrollLeft: last_image[end_position - 1].offsetLeft
      }, 300);

    }

  }
});

right_slider_button.addEventListener("click", () => {
  const main_image = document.getElementById("main_image");
  const active_image = document.getElementsByClassName("active")[0];
  const real_element_size = parseInt(getComputedStyle(active_image).marginRight) + active_image.offsetWidth;
  const next_element = active_image.nextElementSibling;
  if (next_element !== null) {
    main_image.src = next_element.src;
    next_element.className = "active";
    active_image.classList.remove("active");
    const current = active_image.offsetLeft / real_element_size + 2;
    if (current > end_position) {
      start_position = end_position - 2;
      end_position += 1;
      //product_images.scrollLeft = active_image.offsetLeft-real_element_size*2;
      $('#images')[0].style.scrollBehavior = 'auto';
      $('#images').animate({
        scrollLeft: active_image.offsetLeft - real_element_size * 2
      }, 300);

    }
  } else {
    start_position = 1;
    end_position = 4;
    first_image = product_images.getElementsByTagName("img");

    if (first_image.length > 0) {
      main_image.src = first_image[0].src;
      active_image.classList.remove("active");
      first_image[0].className = "active";
    }

    //product_images.scrollLeft = 0;
    $('#images')[0].style.scrollBehavior = 'auto';
    $('#images').animate({
      scrollLeft: 0
    }, 300);
  }
});
//End change main image with buttons


//Change user images with buttons
// const user_images_left_slider_button = document.getElementById("user_images_left_slider_button");
// const user_images_right_slider_button = document.getElementById("user_images_right_slider_button");
// user_images_left_slider_button.addEventListener("click", () => {
//   const user_images = document.getElementById("user_images");
//   const images = user_images.getElementsByTagName("img");
//   if (images.length > 0) {
//     const margin_right = parseInt(getComputedStyle(images[0]).marginRight);
//     const real_element_size = margin_right + images[0].offsetWidth;
//     const img = images[0];
//     user_images.scrollLeft -= real_element_size;
//   }
// });

// user_images_right_slider_button.addEventListener("click", () => {
//   const user_images = document.getElementById("user_images");
//   const images = user_images.getElementsByTagName("img");
//   if (images.length > 0) {
//     const margin_right = parseInt(getComputedStyle(images[0]).marginRight);
//     const real_element_size = margin_right + images[0].offsetWidth;
//     const img = images[0];
//     user_images.scrollLeft += real_element_size;
//   }
// });

// let loade_more_image = true;
// document.getElementById("user_images").addEventListener("scroll", (e) => {
//   const scroll_left = e.target.scrollLeft;
//   const client_width = e.target.clientWidth;
//   const object_width = document.getElementById("user_images").scrollWidth;
//   const last_image_id = document.getElementById("last_user_image");

//   //add_user_image(data,reverse=false)
//   //console.log(last_image_id.value);
//   //console.log(scroll_left+client_width,object_width)
//   if ((scroll_left + client_width) > (object_width - 150) && last_image_id.value !== "0" && loade_more_image) {
//     loade_more_image = false;
//     const data = new FormData();
//     data.append("last_id", last_image_id.value);
//     data.append("pr_id", pr_id);
//     fetch('./templates/load_more_user_images.php', {
//       method: 'POST',
//       body: data
//     })
//       .then((response) => {
//         return response.text();
//       })
//       .then(data => {
//         console.log(data);
//         const response = JSON.parse(data);
//         if (response["status"] === true) {
//           for (element of response["data"]) {
//             add_user_image(element[1], true);

//           }
//           loade_more_image = true;
//           last_image_id.value = response["data"][response["data"].length - 1][0];
//         } else if (response["message"] == "There is no any record") {
//           last_image_id.value = "0";
//         }
//       })
//       .catch((error) => {
//         console.log("error during users more image load", error);
//       });
//   }

// });
// //End change user images with buttons


const body = document.querySelector("body");
//Zoom main image

function zoom_image(image_path) {
  const main_zoom = document.createElement("div");
  main_zoom.className = "main-zoom";
  const main_div = document.createElement("div");
  main_div.className = "main-image-zoom";
  const zoom_component = document.createElement("div");
  zoom_component.className = "image-zoom";
  const img = document.createElement("img");
  img.src = image_path;//main_image_for_zoom.src;
  const icon = document.createElement("img");
  icon.src = "./icons/zoom-x.png";
  icon.onclick = () => {
    main_zoom.remove();
  };
  zoom_component.appendChild(icon);
  zoom_component.appendChild(img);
  main_div.appendChild(zoom_component);
  main_zoom.appendChild(main_div);
  body.appendChild(main_zoom);
}

const main_image_for_zoom = document.getElementById("main_image");
main_image_for_zoom.addEventListener("click", () => {
  zoom_image(main_image_for_zoom.src);
});
//End zoom main image

//Zoom user's image
// const for_user_image_zoom = document.getElementById("user_images");
// for_user_image_zoom.addEventListener("click", (e) => {
//   if (e.target && e.target.tagName == "IMG") {
//     zoom_image(e.target.src);
//   }
// });
//End zoom user's image

//Start create review
function add_user_image(data, reverse = false) {
  const up = document.querySelector(".photos .up");
  const down = document.querySelector(".photos .down");
  const img = document.createElement("img");
  img.src = `./user_images/${data}`;
  if (_info["mobile"] === false) {
    if (up.childElementCount <= down.childElementCount) {
      if (reverse === true) {
        up.append(img);
      } else {
        up.prepend(img);
      }
    } else {
      if (reverse === true) {
        down.append(img);
      } else {
        down.prepend(img);
      }
    }
  } else {
    if (reverse === true) {
      down.append(img);
    } else {
      up.prepend(img);
    }
  }
}
const comments = document.querySelector(".comments");
function create_review_for_append(data, update = false, reverse = false) {

  const comment_block = document.createElement("div");
  comment_block.className = "comment-block";
  const user_data = document.createElement("div");
  user_data.className = "user-data";
  const name_rate = document.createElement("div");
  name_rate.className = "name-rate";
  const rate = document.createElement("div");
  rate.className = "rate";

  const avatar = document.createElement("img");
  avatar.src = `./user_images/avatars/${data["avatar"]}`;
  avatar.className = 'user-avatar';
  user_data.appendChild(avatar);

  const name_surname = document.createElement("p");
  name_surname.textContent = `${data["name"]} ${data["surname"]}`;
  name_rate.appendChild(name_surname);

  for (let i = 0; i < 5; i++) {
    const start_img = document.createElement("img");
    if (i < data["rate"]) {
      start_img.src = "./icons/filled_star.png";
    } else {
      start_img.src = "./icons/empty_star.png";
    }
    rate.appendChild(start_img);
  }
  name_rate.appendChild(rate);
  user_data.appendChild(name_rate);
  comment_block.appendChild(user_data);
  const comment = document.createElement("p");
  comment.textContent = data["comment"];
  comment.className = "comment";
  comment_block.appendChild(comment);
  if (reverse) {
    comments.insertBefore(comment_block, comments.lastElementChild);
  } else {
    comments.prepend(comment_block);
  }


  if (update) {
    if (data["user_image"] !== null) {
      add_user_image(data["user_image"]);
    }
    review_data[5 - data["rate"]] += 1;
    create_review_bar();
    comment_quantity[0] = parseInt(comment_quantity[0]) + 1;
    const rate_nums = document.querySelector(".rate-nums p:first-child");
    let total = 0;
    for (let i = 1; i <= 5; i++) {
      total += review_data[5 - i] * i;
    }
    let avg = 0;
    if (total != 0) {
      avg = Math.round(total / comment_quantity[0]);
      rate_nums.textContent = `${avg}.0`;
    } else {
      rate_nums.textContent = `0.0`;
    }

    document.querySelector(".rate-count-text").textContent = `(${comment_quantity[0]} შეფასება)`;
    document.querySelector(".rate p").textContent = `(${comment_quantity[0]} შეფასება)`;

    const up_star_images = document.querySelectorAll(".rate .stars img");
    let i = 1;
    for (element of up_star_images) {
      if (i <= avg) {
        element.src = './icons/filled_star.png';
      } else {
        element.src = './icons/empty_star.png';
      }
      i += 1;
    }
    const down_star_images = document.querySelectorAll(".left-side .stars img");
    i = 1;
    for (element of down_star_images) {
      if (i <= avg) {
        element.src = './icons/filled_star.png';
      } else {
        element.src = './icons/empty_star.png';
      }
      i += 1
    }
  }
}

const review_component = document.getElementsByClassName("main-create-review")[0];
const close_review = document.getElementById("close_review");
close_review.addEventListener("click", () => {
  review_component.style.display = "none";
});

//For stars selecting

//hover_half_filled_star.png
//full_filled_review_star.png
const review_stars = document.getElementById("review_stars");
let review_selected_count = 0;
review_stars.addEventListener("mouseover", (e) => {
  if (e.target.tagName == "IMG") {
    const current_element = Array.prototype.indexOf.call(review_stars.children, e.target);
    let itr = 0;
    for (element of review_stars.children) {
      if (itr <= current_element) {
        element.src = "./icons/hover_half_filled_star.png";
      } else {
        element.src = "./icons/review_empty_star.png";
      }
      itr++;
    }
  }
});
review_stars.addEventListener("mouseleave", (e) => {
  let itr = 0;
  for (element of review_stars.children) {
    if (itr <= review_selected_count) {
      element.src = "./icons/full_filled_review_star.png";
    } else {
      element.src = "./icons/review_empty_star.png";
    }
    itr++;
  }
});
review_stars.addEventListener("click", (e) => {
  if (e.target.tagName == "IMG") {
    const current_element = Array.prototype.indexOf.call(review_stars.children, e.target);
    review_selected_count = current_element;
    let itr = 0;
    for (element of review_stars.children) {
      if (itr <= current_element) {
        element.src = "./icons/full_filled_review_star.png";
      } else {
        element.src = "./icons/review_empty_star.png";
      }
      itr++;
    }
  }
});

const add_review = document.getElementById("add_review");
const about_person = document.getElementById("about_person");
const comment_input = document.getElementById("comment");
const file_input = document.getElementById("file_input");
const profile_file_input = document.getElementById("profile_file_input");
const valid_file_types = ["image/jpeg", "image/png"];
const file_ends = ["jpg", "jpeg", "jfif", "pjpeg", "pjp", "png"];
const review_form = document.getElementById("review_form");


for (element of about_person.children) {
  element.addEventListener("keydown", (e) => {
    e.target.setCustomValidity("");
  });
}
comment_input.addEventListener("keydown", (e) => {
  e.target.setCustomValidity("");
});
add_review.addEventListener("click", (e) => {
  const name = about_person.children[0];
  const surname = about_person.children[1];
  const comment = comment_input;

  if (name.value.replaceAll(" ", "").length == 0) {
    name.setCustomValidity("მიუთითეთ სახელი");
  } else if (name.value.replaceAll(" ", "").length < 2) {
    name.setCustomValidity("სახელი ზედმეტად მოკლეა");
  } else if (name.value.replaceAll(" ", "").length > 15) {
    name.setCustomValidity("სახელი ზედმეტად გრძელია");
  } else {
    name.setCustomValidity("");
  }

  if (surname.value.replaceAll(" ", "").length == 0) {
    surname.setCustomValidity("მიუთითეთ გვარი");
  } else if (surname.value.replaceAll(" ", "").length < 4) {
    surname.setCustomValidity("გვარი ზედმეტად მოკლეა");
  } else if (surname.value.replaceAll(" ", "").length > 40) {
    surname.setCustomValidity("გვარი ზედმეტად გრძელია");
  } else {
    surname.setCustomValidity("");
  }
  if (comment.value.replaceAll(/\n|\r/g, " ").length == 0) {
    comment.setCustomValidity("მიუთითეთ კომენტარი");
  } else if (comment.value.replaceAll(/\n|\r/g, " ").length < 50) {
    comment.setCustomValidity("კომენტარი ზედმეტად მოკლეა");
  } else if (comment.value.replaceAll(/\n|\r/g, " ").length > 600) {
    comment.setCustomValidity("კომენტარი ზედმეტად გრძელია");
  } else {
    comment.setCustomValidity("");
  }

  // let user_image = null;
  // if (file_input.files.length > 0) {
  //   const file_format = file_input.files[0]["name"].split(".");
  //   if (valid_file_types.includes(file_input.files[0]["type"]) && file_ends.includes(file_format[file_format.length - 1])) {
  //     //width user image
  //     if (file_input.files[0].size / 1000000 > 3) {
  //       file_input.setCustomValidity("სურათი არ უნდა აღემატებოდეს 3 მეგაბაიტს");
  //     } else {
  //       file_input.setCustomValidity("");
  //       user_image = file_input;
  //     }
  //   } else {
  //     file_input.setCustomValidity("არასწორი სურათის ფორმატი დასაშვებია png, jpeg");
  //     //create_message("არასწორი სურათის ფორმატი დასაშვებია png, jpeg");
  //   }
  // } else {
  //   file_input.setCustomValidity("");
  // }

  let avatar = null;
  if (profile_file_input.files.length > 0) {
    const file_format = profile_file_input.files[0]["name"].split(".");
    if (valid_file_types.includes(profile_file_input.files[0]["type"]) && file_ends.includes(file_format[file_format.length - 1])) {
      //width user image
      if (profile_file_input.files[0].size / 1000000 > 3) {
        profile_file_input.setCustomValidity("სურათი არ უნდა აღემატებოდეს 3 მეგაბაიტს");
      } else {
        profile_file_input.setCustomValidity("");
        avatar = profile_file_input;
      }
    } else {
      profile_file_input.setCustomValidity("არასწორი სურათის ფორმატი დასაშვებია png, jpeg");
    }
  } else {
    profile_file_input.setCustomValidity("");
  }

  if (review_form.reportValidity()) {
    e.target.disabled = true;
    const data = new FormData();
    data.append("name", name.value);
    data.append("surname", surname.value);
    data.append("comment", comment.value);
    data.append("rate", review_selected_count);
    data.append("pr_id", pr_id);
    if (avatar !== null) {
      data.append("avatar", avatar.files[0])
    };
    // if (user_image !== null) {
    //   data.append("user_image", user_image.files[0])
    // };
    fetch('./templates/add_review.php', {
      method: 'POST',
      body: data
    })
      .then((response) => {
        return response.text();
      })
      .then(data => {
        const response = JSON.parse(data);
        if (response["status"] === true) {
          try {
            create_review_for_append(response["data"], true);
          } catch (e) {
            console.log(e);
          }
          document.querySelector(".main-review-received").style.display = "block";
          setInterval(() => {
            location.reload();
          }, 3000);
        }
        review_component.style.display = "none";
        e.target.disabled = false;
      })
      .catch((error) => {
        review_component.style.display = "none";
        e.target.disabled = false;
      });

    let itr = 0;
    for (element of document.querySelectorAll("#review_stars img")) {
      if (itr == 0) {
        element.src = "./icons/full_filled_review_star.png";
      } else {
        element.src = "./icons/review_empty_star.png";
      }
      itr++;
    }
    review_selected_count = 0;
    name.value = "";
    surname.value = "";
    comment.value = "";
    file_input.value = "";
    profile_file_input.value = "";


  }
  e.preventDefault();

});
//End star selecting

//Review recieved close
document.getElementById("close_review_received").addEventListener("click", () => {
  document.querySelector(".main-review-received").style.display = "none";
});
//End review recieved close
//End create review


//Hide section-0,1,2 main.

//Check for class and remove
function remove_specific_class(obj, class_name) {
  if (obj.classList.contains(class_name)) obj.classList.remove(class_name);
}
//End check for class and remove
function hs_body_parts(hide_or_show) {
  const main = document.getElementsByClassName("main")[0];
  const section_0 = document.getElementsByClassName("section-0")[0];
  const section_1 = document.getElementsByClassName("section-1")[0];
  const section_2 = document.getElementsByClassName("section-2")[0];
  if (hide_or_show == "hide") {
    main.style.display = "none";
    section_0.style.display = "none";
    section_1.style.display = "none";
    section_2.style.display = "none";
    remove_specific_class(main, "show-element");
    remove_specific_class(section_0, "show-element");
    remove_specific_class(section_1, "show-element");
    remove_specific_class(section_2, "show-element");
  } else {
    //it's not necessary to check each of element, one will be enough
    if (main.style.display == "none") {
      main.className += " show-element";
      section_0.className += " show-element";
      section_1.className += " show-element";
      section_2.className += " show-element";
      main.style.display = "";
      section_0.style.display = "";
      section_1.style.display = "";
      section_2.style.display = "";
    }
  }
}
//End hide

//Create about, privacy, deliver component
function createComponent(component) {
  const about_container = document.querySelector(".container-about");
  if (component == "ჩვენ შესახებ") {
    about_container.children[0].textContent = "ჩვენ შესახებ";
    about_container.children[1].textContent = `Moco - წარმოადგენს ონლაინ პლატფორმას, სადაც მომხმარებელს აქვს შესაძლებლობა სახლიდან გაუსვლელად, მარტივი პროცედურის გავლით, მიიღოს სასურველი ნივთი ქვეყნის  ნებისმიერ წერტილში.

ჩვენი უპირატესობები:`;
    about_container.children[2].textContent = `• სწრაფი მიწოდების სერვისი მთელი საქართველოს მასშტაბით.
• სააქციოდ წარმოდგენილი ნივთების დიდი ასორტიმენტი.
• საგარანტიო სერვისი.
• 24/7 დახმარება.
• წარმოდგენილი ნივთის/ების დეტალურად აღწერა
• დაბრუნების პოლიტიკა`;

  } else if (component == "კონფიდენციალურობა") {
    about_container.children[0].textContent = "კონფიდენციალურობა";
    about_container.children[1].textContent = `პერსონალური მონაცემები ნიშნას ნებისმიერ ინფორმაციას, რომელიც პირდაპირ ან ირიბად უკავშირდება კონკრეტულ ან იდენტიფიცირებად პირს (მოქალაქეს).

ჩვენ ვამუშავებთ და ვუზრუნველყოფბთ პერსონალური მონაცემების უსაფრთხოებას საქართველოს კანონმდებლობით მინიჭებული უფლებებით.

პერსონალური მონაცემების დამუშავება ხორციელდება მხოლოდ პერსონალური მონაცემების სუბიექტის თანხმობით, გამოხატული ნებისმიერი ფორმით, რაც საშუალებას იძლევა დაადასტუროს თანხმობის მიღების ფაქტი.

Moco - თქვენი ნებართვის გარეშე არ უზიარებს თქვენს მიერ მოწოდებულ პერსონალურ ინფორმაციას მესამე მხარეს - თუმცა იტოვებს უფლებას მითითებულ საკონტაქტო ინფორმაციაზე გამოგიგზავნოთ სხვადასხვა ინფორმაცია ჩვენი სიახლეების,აქციების,განახლებების შესახებ.

რა დროით ვინახავთ პერსონალურ მონაცემებს?

თქვენს პერსონალურ ინფორმაციას ვინახავთ 2 წლამდე ვადით.

საიტის გამოყენებით თქვენ ეთანხმებით მოცემულ წესებს, წინააღმდეგ შემთხვევაში ნუ ისარგებლებთ ჩვენი კომპანიის მომსახურებით. `;
  } else if (component == "მიწოდება") {
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


document.addEventListener('click', (e) => {

  if (e.target && e.target.id == 'make_review') {
    review_component.style.display = "block";
  }
  //For search close
  let node = e.target;
  let close = true;
  let image_close = true;

  try {
    while (node.tagName != "BODY") {
      if (e.target.className == "searched-data" ||
        node.parentNode.className == "searched-data" ||
        (node.parentNode.className == "search-container") ||
        (node.parentNode.className == "mobile-search-container")) close = false;

      if (e.target.tagName == "IMG") {
        image_close = false;
      }
      node = node.parentNode;
    }
  } catch (e) {
    //pass don't need it
  }
  if (image_close) {
    try {
      document.getElementsByClassName("main-zoom")[0].remove();
    } catch (e) {
      //pass
    }
  }
  if (close) {
    document.getElementsByClassName("main-search")[0].style.display = "none";
    document.getElementsByClassName("mobile-search-container")[0].style.display = "none";
    document.getElementById("mobile_search").style.display = "";
    document.querySelector(".mobile-header .right").style.width = 'auto';
    document.getElementById("show_main_mobile").style.display = "";
  }
  //End for search close

  //Open search from mobile
  if (e.target && (e.target.tagName == "IMG" && e.target.id == "mobile_search")) {
    document.getElementsByClassName("main-search")[0].style.display = "block";
    document.getElementsByClassName("mobile-search-container")[0].style.display = "inline-flex";
    document.querySelector(".mobile-header .right").style.width = '100%';
    document.getElementById("show_main_mobile").style.display = "none";
    e.target.style.display = "none";
  }
  //End open search from mobile
  if (e.target && e.target.textContent == "კონტაქტი" && e.target.tagName == "A") {
    if (contact.style.display == "") {
      contact.className += " show-element";
      contact.style.display = "block";
      hs_body_parts("hide");
      remove_specific_class(about, "show-element");
      about.style.display = "";
    }
    document.querySelector("header").scrollIntoView({ "behavior": "smooth" });
  } else if (e.target && (e.target.id == "market" || e.target.id == "show_main_mobile")) {
    window.location.hash = "";
    hs_body_parts("show");
    remove_specific_class(about, "show-element");
    about.style.display = "";
    remove_specific_class(contact, "show-element");
    contact.style.display = "";
  } else if (e.target && ["ჩვენ შესახებ", "მიწოდება", "კონფიდენციალურობა"].includes(e.target.textContent) && e.target.tagName == "A") {
    createComponent(e.target.textContent);
    if (about.style.display == "") {
      about.className += " show-element";
      about.style.display = "block";
      hs_body_parts("hide");
      remove_specific_class(contact, "show-element");
      contact.style.display = "";
    }
    document.querySelector("header").scrollIntoView({ "behavior": "smooth" });
  }

  //load more comments

  if (e.target.id === "load_more_review") {
    e.target.disabled = true;
    const last_id = e.target.getAttribute("data-last-id");
    const data = new FormData();
    data.append("last_id", last_id);
    data.append("pr_id", pr_id);

    fetch('./templates/load_more_review.php', {
      method: 'POST',
      body: data
    })
      .then((response) => {
        return response.text();
      })
      .then(data => {
        const response = JSON.parse(data);
        console.log(response);
        if (response["status"] === true) {
          for (element of response["data"]) {
            create_review_for_append(element, false, true);
          }
        }
      })
      .catch((error) => {
        console.log("error", error);
      });
    e.target.setAttribute("data-last-id", 0);
    e.target.style.display = "none";
  }

});
//end document listener all in one

window.addEventListener('load', () => {
  if (window.location.hash === "#contact-page") {
    contact.className += " show-element";
    contact.style.display = "block";
    hs_body_parts("hide");
    remove_specific_class(about, "show-element");
    about.style.display = "";
  } else if (["#about-us", "#deliver", "#privacy-policy"].includes(window.location.hash)) {
    if (window.location.hash === "#about-us") {
      createComponent("ჩვენ შესახებ");
    } else if (window.location.hash === "#deliver") {
      createComponent("მიწოდება");
    } else {
      createComponent("კონფიდენციალურობა");
    }
    about.className += " show-element";
    about.style.display = "block";
    hs_body_parts("hide");
    remove_specific_class(contact, "show-element");
    contact.style.display = "";
  }
});

//Search open
document.getElementsByClassName("search-container")[0].addEventListener("click", (e) => {
  if (e.target && (e.target.tagName == "IMG" || e.target.tagName == "INPUT")) {
    document.getElementsByClassName("main-search")[0].style.display = "block";
  }
});
//End search open
//Search data
function create_search_result(data) {

  searched_data = document.querySelector(".searched-data");
  searched_data.innerHTML = '';
  for (element of data) {
    //if something went wrong change a tag with div
    const searched_product = document.createElement("a");
    searched_product.className = "searched-product";
    const img = document.createElement("img");
    img.src = `./images/${element[4]}`;
    searched_product.appendChild(img);
    searched_product.id = element[0];
    //searched_product.setAttribute('onclick',`window.open('./?id=${element[0]}','_self')`);
    searched_product.href = `./?id=${element[0]}`;
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
    percentage.textContent = `-${Math.round(((element[3] - element[2]) / element[3]) * 100)}%`;
    price_data.appendChild(sale_price);
    price_data.appendChild(price);
    price_data.appendChild(percentage);
    product_data.appendChild(price_data);
    searched_product.appendChild(product_data);
    searched_data.appendChild(searched_product);
    //console.log(searched_product);

  }
}

async function search(text) {
  const data = new FormData();
  data.append("text", text);
  data.append("pr_id", pr_id);
  await fetch('./templates/search.php', {
    method: 'POST',
    body: data
  })
    .then((response) => {
      return response.text();
    })
    .then(data => {
      const response = JSON.parse(data);
      if (response["status"] === true) {
        create_search_result(response["data"]);
      } else {
        searched_data = document.querySelector(".searched-data");
        searched_data.innerHTML = '';
      }
    })
    .catch((error) => {
      console.log("error during product search", error)
    });
}
document.addEventListener("keyup", (e) => {

  if (e.target.tagName == "INPUT") {
    if (e.target.id == "mobile_search_input") {
      const text = e.target.value;
      if (text.length > 2) {
        search(text);
      } else {
        searched_data = document.querySelector(".searched-data");
        searched_data.innerHTML = '';
      }

    } else if (e.target.id == "desktop_search_input") {
      document.getElementById("show_main_mobile").style.display = "none";
      const text = e.target.value;
      if (text.length > 2) {
        search(text);
      } else {
        searched_data = document.querySelector(".searched-data");
        searched_data.innerHTML = '';
      }
    }
  }
});
//End search data

//Buy item
// const main_buy_now = document.getElementsByClassName("main-buy-now")[0];
// document.getElementById("buy_now").addEventListener("click", () => {
//   main_buy_now.style.display = "block";
// });
// document.getElementById("close_buy_now").addEventListener("click", () => {
//   main_buy_now.style.display = "none";
// });

//for checkbox
const checkbox = document.getElementById("privacy_checkbox");
checkbox.addEventListener("click", (e) => {
  if (e.target && e.target.tagName == "INPUT") {
    e.target.setCustomValidity("");
    if (checkbox.children[0].checked) {
      checkbox.children[1].src = "./icons/checked.png";
      checkbox.children[0].checked = true;
    } else {
      checkbox.children[1].src = "./icons/unchecked.png";
      checkbox.children[0].checked = false;
    }
  }
});

const checkbox2 = document.getElementById("privacy_checkbox_2");
checkbox2.addEventListener("click", (e) => {
  if (e.target && e.target.tagName == "INPUT") {
    e.target.setCustomValidity("");
    if (checkbox2.children[0].checked) {
      checkbox2.children[1].src = "./icons/checked.png";
      checkbox2.children[0].checked = true;
    } else {
      checkbox2.children[1].src = "./icons/unchecked.png";
      checkbox2.children[0].checked = false;
    }
  }
});
//end for checkbox

//Close order pupup
const order_received_container = document.getElementsByClassName("main-order-received")[0];
document.getElementById("close_order_received").addEventListener("click", () => {
  order_received_container.style.display = "none";
  window.location.reload();
});
//End close order popup

document.getElementById("make_order").addEventListener("click", (e) => {

  const inputs = e.target.parentNode.querySelectorAll("input");
  const name_surname = inputs[0];
  const phone_number = inputs[1];
  const checkbox = inputs[2];


  console.log(inputs)
  console.log(name_surname)
  console.log(phone_number)
  console.log(checkbox)

  if (name_surname.value.length == 0) {
    name_surname.setCustomValidity("მიუთითეთ სახელი, გვარი");
  } else if (name_surname.value.length < 4) {
    name_surname.setCustomValidity("სახელი, გვარი ზედმეტად მოკლეა");
  } else if (name_surname.value.length > 60) {
    name_surname.setCustomValidity("სახელი, გვარი ზედმეტად გრძელია");
  } else {
    name_surname.setCustomValidity("");
  }

  if (phone_number.value.length == 0) {
    phone_number.setCustomValidity("მიუთითეთ ნომერი");
  } else if (phone_number.validity.patternMismatch ||
    phone_number.value.length > 12 ||
    phone_number.value.length < 6) {
    phone_number.setCustomValidity("ნომერი არასწორია");
  } else {
    phone_number.setCustomValidity("");
  }

  if (!checkbox.checked) {
    checkbox.setCustomValidity("გთხოვთ დაეთანხმოთ პირობებს");
  } else {
    checkbox.setCustomValidity("");
  }
  if (e.target.parentNode.reportValidity()) {
    e.target.disabled = true;
    const data = new FormData();
    data.append("name_surname", name_surname.value);
    data.append("phone", phone_number.value);
    data.append("checkbox", checkbox.checked);
    data.append("pr_id", pr_id);

    fetch('./templates/order.php', {
      method: 'POST',
      body: data
    })
      .then((response) => {
        return response.text();
      })
      .then(data => {
        //console.log(data);
        const response = JSON.parse(data);

        if (response["status"] === true) {
          order_received_container.style.display = "block";
        }

        // order_received_container.style.display = "block";

        // main_buy_now.style.display = "none";
        e.target.disabled = false;
      })
      .catch((error) => {
        // main_buy_now.style.display = "none";
        e.target.disabled = false;
      });
    name_surname.value = "";
    phone_number.value = "";
    e.preventDefault();
  }
});


document.getElementById("make_order2").addEventListener("click", (e) => {

  const inputs = e.target.parentNode.querySelectorAll("input");
  const name_surname = inputs[0];
  const phone_number = inputs[1];
  const checkbox = inputs[2];


  console.log(inputs)
  console.log(name_surname)
  console.log(phone_number)
  console.log(checkbox)

  if (name_surname.value.length == 0) {
    name_surname.setCustomValidity("მიუთითეთ სახელი, გვარი");
  } else if (name_surname.value.length < 4) {
    name_surname.setCustomValidity("სახელი, გვარი ზედმეტად მოკლეა");
  } else if (name_surname.value.length > 60) {
    name_surname.setCustomValidity("სახელი, გვარი ზედმეტად გრძელია");
  } else {
    name_surname.setCustomValidity("");
  }

  if (phone_number.value.length == 0) {
    phone_number.setCustomValidity("მიუთითეთ ნომერი");
  } else if (phone_number.validity.patternMismatch ||
    phone_number.value.length > 12 ||
    phone_number.value.length < 6) {
    phone_number.setCustomValidity("ნომერი არასწორია");
  } else {
    phone_number.setCustomValidity("");
  }

  if (!checkbox.checked) {
    checkbox.setCustomValidity("გთხოვთ დაეთანხმოთ პირობებს");
  } else {
    checkbox.setCustomValidity("");
  }
  if (e.target.parentNode.reportValidity()) {
    e.target.disabled = true;
    const data = new FormData();
    data.append("name_surname", name_surname.value);
    data.append("phone", phone_number.value);
    data.append("checkbox", checkbox.checked);
    data.append("pr_id", pr_id);

    fetch('./templates/order.php', {
      method: 'POST',
      body: data
    })
      .then((response) => {
        return response.text();
      })
      .then(data => {
        //console.log(data);
        const response = JSON.parse(data);
        if (response["status"] === true) {
          order_received_container.style.display = "block";
        }
        main_buy_now.style.display = "none";
        e.target.disabled = false;
      })
      .catch((error) => {
        main_buy_now.style.display = "none";
        e.target.disabled = false;
      });
    name_surname.value = "";
    phone_number.value = "";
    e.preventDefault();
  }
});

for (element of document.querySelectorAll(".main-buy-now form input")) {
  if (element.type !== 'checkbox') {
    element.addEventListener("keydown", (e) => {
      e.target.setCustomValidity("");
    });
  }
}
//End Buy item


//Scroll to
// document.getElementById("show_all").addEventListener("click", () => {
//   //  document.getElementsByClassName("section-0")[0].scrollIntoView({
//   //    "behavior":"smooth"
//   //  })
//   $('html, body').animate({
//     scrollTop: $(".section-0").offset().top
//   }, 1000);
// });
//End scroll to

//Show features
// const features = document.getElementsByClassName("main-feature")[0];
// document.getElementById("see_all").addEventListener("click", () => {
//   features.style.display = "block";
// });
// document.getElementById("close_features").addEventListener("click", () => {
//   features.style.display = "none";
// });
//End show features


//Create progress bar from data
function create_review_bar() {
  const lines = document.querySelectorAll(".rate-bar .right-side .fill");
  const percentage = document.querySelectorAll(".rate-bar .right-side .data .percentage");
  const total = review_data.reduce(function (a, b) { return a + b })
  for (let i = 0; i < lines.length; i++) {
    let line_size = 0;
    if (total != 0) {
      line_size = Math.round((review_data[i] / total) * 100);
    }
    percentage[i].textContent = `${line_size}%`;
    lines[i].style.width = `${line_size}%`;
  }
}
create_review_bar();
//End progress bar from data




//create countdown

const countdown_text = document.querySelector(".countdown .text");
const clock = document.querySelector(".clock");
function c_function() {

  const changes = document.querySelector(".clock").querySelectorAll("div p:first-of-type");

  //const now = new Date().getTime();
  const now = new Date(new Date().toLocaleString('en-US', { timeZone: 'Asia/Tbilisi' })).getTime()
  const distance = end_time - now;

  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);

  days = (days < 10) ? '0' + days : days;
  hours = (hours < 10) ? '0' + hours : hours;
  minutes = (minutes < 10) ? '0' + minutes : minutes;
  seconds = (seconds < 10) ? '0' + seconds : seconds;

  if (Math.floor(distance / 1000) <= 0) {
    clearInterval(countdown);
    countdown_text.textContent = "აქცია დასრულდა";
    const buy_now = document.getElementById("buy_now");
    buy_now.disabled = true;
    buy_now.style.cursor = "not-allowed";
    const make_order = document.getElementById("make_order");
    make_order.disabled = true;
    make_order.style.cursor = "not-allowed";
    changes[0].textContent = "00";
    changes[1].textContent = "00";
    changes[2].textContent = "00";
    changes[3].textContent = "00";
  } else {
    changes[0].textContent = days;
    changes[1].textContent = hours;
    changes[2].textContent = minutes;
    changes[3].textContent = seconds;
  }
}

let countdown;
// if (Math.floor((end_time - new Date().getTime()) / 1000) > 0) {
//   countdown = setInterval(c_function, 1000);
// } else {
//   countdown_text.textContent = "აქცია დასრულდა";
//   const buy_now = document.getElementById("buy_now");
//   buy_now.disabled = true;
//   buy_now.style.cursor = "not-allowed";
//   const make_order = document.getElementById("make_order");
//   make_order.disabled = true;
//   make_order.style.cursor = "not-allowed";
// }
//End create countdown
//Created by Jagata


