function changeImage(imgId){
    // lay duong dan anh cua the html co id=imgId truyen vao
    var imgSrc  = document.getElementById(imgId).getAttribute('src');
    // tac dong vao id=img- main, thay doi gia tri thuoc tuinh src
    document.getElementById("img-main").setAttribute('src',imgSrc);
    //reset duong vien cac anh
    document.getElementById("img1").removeAttribute('style');
    document.getElementById("img2").removeAttribute('style');
    document.getElementById("img3").removeAttribute('style');
    // ---
    // set duong vien cua thẻ co id truyen vao
    document.getElementById(imgId).setAttribute('style','border:1px solid red;');
}
// tạo nút ấn phần mô tả
function toggleContent() {
    var contentDiv = document.getElementById("content");
    var button = document.getElementById("toggle-button");
    if (contentDiv.style.overflow === "hidden") {
        contentDiv.style.overflow = "auto";
        contentDiv.style.height = "440px";
        contentDiv.style.backgroundImage = "none";
        contentDiv.style.position = "static";
        button.innerHTML = "Thu gọn";
    } else {
        contentDiv.style.overflow = "hidden";
        contentDiv.style.height = "200px";
        contentDiv.style.backgroundImage = "linear-gradient(to bottom, rgba(255, 255, 255, 0), white)";
        contentDiv.style.position = "relative";
        button.innerHTML = "Xem tất cả";
    }
    }
// tạo click 2 tab mô tả sản phẩm và đánh giá
function handleClick(){
    var div1 = document.getElementById("box-tab-1");
    var div2 = document.getElementById("box-tab-2");
    var button1 = document.getElementById("tab1");
    var button2 = document.getElementById("tab2");
    // Tạo sự kiện click cho nút nhấn 1
    button1.addEventListener("click", function() {
      // Ẩn nội dung của div 1
      div2.classList.add("hidden");
      // Hiển thị nội dung của div 2
      div1.classList.remove("hidden");
      button2.style.backgroundColor = " #f2f2f2";
      button1.style.backgroundColor = " #eb3e32";
      button2.style.color = " #444";
      button1.style.color = " white";
    });

    // Tạo sự kiện click cho nút nhấn 2
    button2.addEventListener("click", function() {
      // Ẩn nội dung của div 2
      div1.classList.add("hidden");
      // Hiển thị nội dung của div 1
      div2.classList.remove("hidden");
      button1.style.backgroundColor = " #f2f2f2";
      button2.style.backgroundColor = " #eb3e32";
      button1.style.color = " #444";
      button2.style.color = " white";
    });
}
let selectedStar = 0;

function changeClass(element) {
    if (selectedStar === 0) {
        const stars = document.querySelectorAll(".star .fa-regular");
        const currentIndex = Array.from(stars).findIndex(star => star === element);
        stars.forEach((star, index) => {
            if (index <= currentIndex) {
                star.classList.add("fa-solid");
                star.classList.remove("fa-regular");
            } else {
                star.classList.remove("fa-solid");
                star.classList.add("fa-regular");
            }
        });
    }
}
function toggleStar(starIndex) {
    const star = document.getElementById(`icon-star-${starIndex}`);
    if (selectedStar === starIndex) {
        selectedStar = 0;
    } else {
        selectedStar = starIndex;
    }
    changeClass(star);
}

function removeClass() {
    if (selectedStar === 0) {
        const solidStars = document.querySelectorAll(".star .fa-solid");
        solidStars.forEach(star => {
            star.classList.remove("fa-solid");
            star.classList.add("fa-regular");
        });
    }
}
