let imgListEle = document.getElementsByClassName("list");
let btnListEle = document.getElementsByClassName("carousel-btn")[0].children;
let imgLength = btnListEle.length;
let leftBtnEle = document.getElementById("left-btn");
let rightBtnEle = document.getElementById("right-btn");
//默认第一张为当前图片
let currentImg = 0;
for (let i = 0; i < imgLength; i++) {
    btnListEle[i].onclick = ((i) => {
        return function() {
            currentImg = i;
            for (let j = 0; j < imgLength; j++) {
                moveImg(j);
            }
        }
    })(i)
}

function moveImg(j) {
    switch (currentImg) {
        case j:
            imgListEle[j].className = "list list1";
            break;
        case (j - 1 + imgLength) % imgLength:
            imgListEle[j].className = "list list4";
            break;
        case (j + 1) % imgLength:
            imgListEle[j].className = "list list2";
            break;
        default:
            imgListEle[j].className = "list list3";
            break;
    }
    //移动图片时,改变按钮颜色
    setBtnColor();
}

function setBtnColor() {
    for (let i = 0; i < imgLength; i++) {
        btnListEle[i].classList.remove('orangered');
    }
    btnListEle[currentImg].classList.add('orangered');
}
/**
 *   按下左右两侧按钮,图片移动事件
 *   @param dir 按下左边按钮还是右边按钮
 */
function left_right_btn(dir) {
    return function() {
        if (dir === 'left') {
            currentImg--;
            if (currentImg < 0) {
                currentImg = 3;
            }
            for (let i = 0; i < imgLength; i++) {
                moveImg(i);
            }
        } else if (dir === "right") {
            currentImg++;
            if (currentImg >= imgLength) {
                currentImg = 0;
            }
            for (let i = 0; i < imgLength; i++) {
                moveImg(i);
            }
        }
    }
}
leftBtnEle.onclick = left_right_btn('left');
rightBtnEle.onclick = left_right_btn('right');

let curtainEle = document.getElementById('curtain');
let loginWrap = document.getElementById('login-wrap');
let registerWrap = document.getElementById('register-wrap');
let closeCurtainBtn = document.getElementsByClassName('close');
let wrapEle = document.getElementsByClassName('wrap');
let formEle = document.getElementsByTagName('form');

function goTo() {
    curtain.style.display = "";
    goToLogin();
}
//点击 登录/注册 按钮
function goToLogin() {
    loginWrap.classList.add('appearLogin');
    loginWrap.style.display = "";
    registerWrap.style.display = "none";
    setTimeout(() => {
        loginWrap.classList.remove('appearLogin');
    }, 700)
}

//点击 前往注册 按钮
function gotoResigter() {
    setTimeout(() => {
        registerWrap.style.display = "";
        registerWrap.classList.add('appearRegister');
    }, 700)
    setTimeout(() => {
        registerWrap.classList.remove('appearRegister');
    }, 1400)
    loginDisappear();
}

//登录界面消失
function loginDisappear() {
    loginWrap.classList.add('disappearLogin');
    setTimeout(() => {
        loginWrap.style.display = "none";
        loginWrap.classList.remove('disappearLogin');
    }, 700)
}

//注册界面消失
function registerDisappear() {
    registerWrap.classList.add('disappearRegister');
    setTimeout(() => {
        registerWrap.style.display = "none";
        registerWrap.classList.remove('disappearRegister');
    }, 700)
}

//点击 前往登录 按钮
function toLogin() {
    registerDisappear();
    setTimeout(() => {
        goToLogin();
    }, 700)
}

//关闭 登录/注册 界面
for (let i = 0; i < closeCurtainBtn.length; i++) {
    closeCurtainBtn[i].onclick = () => {
        curtainEle.style.display = "none";
        clearInfo();
    }
}

//点击 登录注册 界面外的地方时 登录界面消失
curtainEle.onclick = () => {
    curtainEle.style.display = "none";
    clearInfo();
}

for (let i = 0; i < wrapEle.length; i++) {
    wrapEle[i].onclick = (event) => {
        //子元素阻止父元素的onclick冒泡事件
        event.stopPropagation();
    }
}

//登录/注册页面填过的信息消除
function clearInfo() {
    for (let i = 0; i < formEle.length; i++) {
        let inputEle = formEle[i].getElementsByTagName("input");
        //最后的 input type=submit不用清除值
        for (let j = 0; j < inputEle.length - 1; j++) {
            inputEle[j].value = "";
        }
    }
}