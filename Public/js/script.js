window.onscroll = function () {
    var header = document.getElementById('header');

    if (window.pageYOffset > 0) { // Quando a página for rolada para baixo
        header.classList.add("sticky");
    } else { // Quando a página estiver no topo
        header.classList.remove("sticky");
    }
};

let img = document.createElement('img');
img.src = "/img/test.png";
img.width = 300;
img.classList.add("avatar");

let elementImg = document.querySelector("#sobre-mim");

document.querySelector(".avatar").parentNode.removeChild(document.querySelector(".avatar"));
elementImg.appendChild(img);