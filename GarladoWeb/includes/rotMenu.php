<!--My Round Menu Div-->
<div class="container-fluid">
    <div class="row">
        <p id="main" class="main menu"><i class="fa fa-plus"></i></p>
        <div class="myDiv">
            <div class="opt2">
                <div class="optContent">
                    <div class="contentData">
                        <h4 class="text-center"><span class="dataTitle">Login <i class="fa fa-user"></i></span><span class="close pull-right">&times;</span></h4>
                        <hr/>
                        <div class="Data">
                         
                        </div>
                    </div>
                </div>
            </div>
            <div class="opt1" id="menuDiv">
                <p class="menu m1"><i class="fa fa-home"></i></p>
                <p class="menu m2"><i class="fa fa-cart-arrow-down"></i></p>
                <p class="menu m3"><i class="fa fa-question"></i></p>
                <p class="menu m4"><i class="fa fa-user"></i></p>
            </div>
        </div>
    </div>
</div>

<style>
    .myDiv{
        /*border: 1px solid #999;*/
        position: fixed;
        vertical-align: baseline;
        bottom: 45px;
        right: 12px;
        padding: 0;
        display: none;
        /*background: #fff;*/
        padding-right: 5px;
        z-index: 2;
        overflow: hidden;
    }
    .myDiv .opt1{
        /*border: 1px dotted blue;*/
        /* 270 on displaying some more items*/
        height: 0;
        display: inline-block;
        vertical-align: bottom;
        transition: .5s;
        overflow: hidden;
    }
    .myDiv .opt2{
        /*border : 1px dashed red;*/
        display: inline-block;
        height: 100%;
        /*display: none;*/
        vertical-align: top;
        overflow: hidden;
    }
    .myDiv .opt2 .optContent .contentData .Data{
       padding: 5px;
       
    }
    .menu{
        /*padding : 10px;*/
        border : 1px solid #118c8b;
        width: 50px;
        background-color: #118c8b;
        text-align: center;
        font-size: 13px;
        padding-top: 18px;
        padding-bottom: 21px;
        height: 52px;
        border-radius: 50%;
        color :#fff;
        box-shadow: 0 1px 2px 0 rgba(0,0,0,0.3);
        cursor: pointer;
    }
    .main{
        background-color: #F2746B;
        border-color: #F2746B;
        position: fixed;
        z-index: 3;
        margin : 0;
        bottom: 11px;
        right: 13px;
        width: 59.5px;
        height: 62px;
        padding-top: 20.5px;
        /* padding-bottom: 24.5px; */
        transition: .5s;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        display: none;
    }
    .main i{
        transition: .5s;
    }

    .optContent{
        padding : 10px;
        border : 1px solid #118c8b;
        margin: 5px;
        border-radius: 7px;
        max-width: 350px;
        width: 260px;
        display: none;
        background: #fff;
    }
    .optContent h4, .optContent hr{
        margin: 0;
        margin-bottom: 4px;
    }
    .optContent .contentData{ 
        border-radius: 4px;
        border-width: 1px;
        border-style: solid;
        border-color: aliceblue;
        
    }
    .optContent .close{
        cursor: pointer;
    }
    @media(max-width:529px){
        #main, .menus{
            display: block;
        }
        .myDiv{
            display: block;
        }
    }
    @media(max-width:320px){
        .optContent{
            margin: 0px;
            border-radius: 7px;
            width: 225px;
        }
    }
</style>