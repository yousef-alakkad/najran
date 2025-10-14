<style>
    *{
        font-family: "DIN Next LT Arabic Light";
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .iti.iti--allow-dropdown.iti--separate-dial-code{
        width: 100%;
        margin-top:2px;
    }
 
    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    * {
        margin: 0;
        padding: 0
    }
    .footer__heading::after{
        content: '';
    }
    .inBahreenSelect,.passportImageDiv{
        display: none;
    }
    .fit-image{
        display: none;
    }
    .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
        width: 100% !important;
        margin-right:-2%;
    }
    .filter-option {
        font-size: .9rem;
        color: #000;
    }
    html {
        height: 100%
        font-family: 'DINNextLTArabic';

    color: #000;
    }
    



    #grad1 {
        background-color: #fff;
        background-image: linear-gradient(120deg, #fff, #fff);
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }
    .form-control{
        padding: 2px;
        font-size: 15px;
    }

    #msform fieldset .form-card {
        background: white;
        border: 0 none;
        border-radius: 0px;
      /*  box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);*/
        padding: 20px 40px 30px 40px;
        box-sizing: border-box;
        width: 94%;
        margin: 0 3% 20px 3%;
        position: relative
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform fieldset .form-card {
        text-align: left;
        color: #9E9E9E
    }

    #msform input,
    #msform textarea {
        padding: 22px 8px 10px 8px;
       /* border: none;*/
       /* border-bottom: 1px solid #ccc;*/
         border: 1px solid #ccc;
           border-radius: 0.25rem;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        color: #2C3E50;
        font-size: 17px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        /*border: none;*/
        font-weight: bold;
        border: 2px solid skyblue;
        outline-width: 0
    }

    #msform .action-button {
     
        color: #fff;
    background-color: #78b7bc;
    border-radius: 30px;
    box-shadow: 5px 5px 1px 0px rgba(16, 117, 176, 0.75);
    transition: all .5s ease-in-out;
    font-size:17px;
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
    }

    select.list-dt {
        border: none;
        outline: 0;
        border-bottom: 1px solid #ccc;
        padding: 2px 5px 3px 5px;
        margin: 2px
    }

    select.list-dt:focus {
        border-bottom: 2px solid skyblue
    }

    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative
    }

    .fs-title {
        font-size: 22px;
        color: #2C3E50;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey;
        display: flex;
    }

    #progressbar .active {
        color: #000000
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 25%;
        float: left;
        position: relative
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f2c2"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f2c1"
    }
    #progressbar #services:before {
        font-family: FontAwesome;
        content: "\f64a"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #c9a73a;
    }

    .radio-group {
        position: relative;
        margin-bottom: 25px
    }

    .radio {
        display: inline-block;
        width: 204;
        height: 104;
        border-radius: 0;
        background: lightblue;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        cursor: pointer;
        margin: 8px 2px
    }

    .radio:hover {
        box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
    }

    .radio.selected {
        box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }

    @media screen and (max-width: 600px) {
        #progressbar li {

            font-size: 10px;
        }

        .fs-title {
            font-size: 18px;

        }

        .msg-content h5{
            font-size:3vw;
        }

        #progressbar li:before {

            display: block;
            font-size: 12px;

        }

        #msform input,
        #msform textarea {

            font-size: 17px;
            letter-spacing: 0px
        }

        .form-control {

            padding: 2px;
            font-size: 12px;

        }

        label.float-right,label.labelFloatRight {
            font-size: 20px;
        }


        .col-md-6.mobile-clas {
            text-align: right;
            margin-bottom: 12px;
        }

        .fit-image {
            width: 100%;
            object-fit: cover;


        }


        .row.box {
            display: flex;
            flex-direction: row-reverse;
        }


        .col-md-6.div1 {
            order: 1;
        }



    }

    section.footer {
        background-color: #0c0c0c;


        background-repeat: no-repeat;
        background-attachment:inherit ;
        background-size: cover;



        position: relative;
        font-family: 'Poppins';
        padding:12px 0px;
    }
    section.header {


        background-color:#fff;
        background-repeat: no-repeat;
        background-attachment:inherit ;
        background-size: cover;
        text-align: center;


        position: relative;
        font-family: 'Poppins';
        padding:10px 0px;
    }
    .fa {
        margin-top:8px !important;
    }
    .footer__content{
        padding: 25px;
        text-align: center;
        color: #fff;


    }
    .footer__content img{
        width: 5%;
        position: absolute;
        top: -50px;
        border: 1px solid red;
    }
    .footer__heading{
        position: relative;
    }
    .footer__heading h2 {
        background-color: #0c0c0c;
        display: inline-block;
        padding: 0px 10px;
        /* border: 1px solid; */
        position: relative;
        z-index: 9999;
    }
    /*.footer__heading::after {*/
    /*    content: "";*/
    /*    position: absolute;*/
    /*    left: 50%;*/
    /*    top: 45%;*/
    /*    height: 5px;*/
    /*    margin: 0;*/
    /*    border-radius: 50px;*/
    /*    width: 20%;*/
    /*    transform: translate(-50% , -50%);*/
    /*    background-color: rgb(255, 255, 255);*/
    /*}*/
    .footer__content p {
        font-size: 20px;
        font-weight: 500;
        padding: 10px 0px;
        font-family: sans-serif;
    }
    a.mail {
        color: #fff;
    }
    ul.social__media{
        margin:0;
        padding: 0;
        display: inline-block;
        margin-top: 15px;
        display: flex;
        justify-content: center;
    }
    ul.social__media li{
        list-style-type:none;
        display:inline-block;
        margin-right: 15px;
    }
    ul.social__media li a{
        color: #FFF;
        font-size: 20px;
    }
    ul.social__media li {

        text-align: center;
        height: 45px;
        width: 45px;
        border-radius: 50px;
        background-color: #bc9432;
        line-height: 40px;
        border: 2px solid #545d5d;
        box-shadow: 0px 1px #FFF;
        box-shadow: 0 2px 10px -1px rgba(0, 0, 0, 0.55), 0 0px 20px 0px rgba(0, 0, 0, 0.55);
    }

    ul.bus__list{
        padding: 0;
        margin: 0;
    }

    ul.bus__list li{
        list-style-type:none;
        margin-bottom: 5px;
    }



    div#main-menu {
        text-align: center;
    }
    .main-menu {
        text-align: center;
    }

    h2.text-date {
        color: #7ac0bb;
        margin-top: 20px;
        font-family: "FrutigerLTArabic-45Light";
        font-size: 25px;
    }


    img.img-line {
        max-height: 15px;
    }

    .col-md-6.mobile-clas {
        text-align: right;
    }

    .bootstrap-select .dropdown-menu.inner,.filter-option-inner-inner {
        text-align:right;
    }







    .new {
        padding: 20px;
        text-align: right;
    }

    .form-group {
        display: block;
        margin-bottom: 15px;
    }

    .form-group input {
        padding: 0;
        height: initial;
        width: initial;
        margin-bottom: 0;
        display: none;
        cursor: pointer;
    }

    .form-group label {
        position: relative;
        cursor: pointer;
    }

    .form-group label:before {
        content:'';
        -webkit-appearance: none;
        background-color: transparent;
        border: 2px solid #4796b9;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
        padding: 10px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        margin-left: 5px;
        margin-right: -2rem !important;
    }

    .form-group input:checked + label:after {
        content: '';
        display: block;
        position: absolute;
        top: 5px;
        right: -22px;
        width: 6px;
        height: 14px;
        border: solid #4796b9;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }


.form-control {
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}


    label.float-right,label.labelFloatRight {
        font-size: 13px;
    }

    .dots-bars-2 {
        margin-top:5rem;
        width: 40px;
        height: 40px;
        --c: linear-gradient(currentColor 0 0);
        --r1: radial-gradient(farthest-side at bottom,currentColor 93%,#c9a73a);
        --r2: radial-gradient(farthest-side at top   ,currentColor 93%,#c9a73a);
        background:
                var(--c) ,
                var(--r1),
                var(--r2),
                var(--c) ,
                var(--r1),
                var(--r2),
                var(--c) ,
                var(--r1),
                var(--r2);
        background-repeat: no-repeat;
        animation: db2 1s infinite alternate;
    }
    @keyframes db2 {
        0%,25% {
            background-size: 8px 0,8px 4px,8px 4px,8px 0,8px 4px,8px 4px,8px 0,8px 4px,8px 4px;
            background-position: 0 50%,0 calc(50% - 2px),0 calc(50% + 2px),50% 50%,50% calc(50% - 2px),50% calc(50% + 2px),100% 50%,100% calc(50% - 2px),100% calc(50% + 2px);
        }
        50% {
            background-size: 8px 100%,8px 4px,8px 4px,8px 0,8px 4px,8px 4px,8px 0,8px 4px,8px 4px;
            background-position: 0 50%,0 calc(0% - 2px),0 calc(100% + 2px),50% 50%,50% calc(50% - 2px),50% calc(50% + 2px),100% 50%,100% calc(50% - 2px),100% calc(50% + 2px);
        }
        75% {
            background-size: 8px 100%,8px 4px,8px 4px,8px 100%,8px 4px,8px 4px,8px 0,8px 4px,8px 4px;
            background-position: 0 50%,0 calc(0% - 2px),0 calc(100% + 2px),50% 50%,50% calc(0% - 2px),50% calc(100% + 2px),100% 50%,100% calc(50% - 2px),100% calc(50% + 2px);
        }
        95%,100% {
            background-size: 8px 100%,8px 4px, 8px 4px,8px 100%,8px 4px,8px 4px,8px 100%,8px 4px,8px 4px;
            background-position: 0 50%,0 calc(0% - 2px),0 calc(100% + 2px),50% 50%,50% calc(0% - 2px),50% calc(100% + 2px),100% 50%,100% calc(0% - 2px),100% calc(100% + 2px);
        }
    }
</style>