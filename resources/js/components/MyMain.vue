<template>
    <div>
        <main>
            <section class="container-md position-relative">
                <div id="food-truck-container" class="position-absolute">
                    <img src="/assets/img/food-truck edit.png" alt="Food truck">

                    <div id="truck-door-container" class="position-absolute">
                        <div id="truck-door" class="position-relative">
                            <div id="truck-door-window" class="position-absolute"></div>
                            <img src="/assets/img/food-truck-door-handle.png" class="position-absolute">
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
export default {
    name: 'MyMain'
}
</script>

<style scoped lang="scss">
    main {
        height: calc(100vh - 80px);
        background-color: beige;
    }

    section {
        height: 100%;
        overflow-x: hidden;
    }

    #food-truck-container {
        bottom: 50px;
        left: -175px;

        img {
            height: 400px;
        }
    }

    #truck-door-container {
        width: 63px;
        height: 138px;

        bottom: 73px;
        left: 356.8px;

        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    #truck-door {
        width: 100%;
        height: 100%;
        background-color: #cd181f;
        box-shadow: inset 0px 0px 0px 1px #000000;

        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        border-bottom-left-radius: 5px;
        border-bottom-right-radius: 5px;

        ////////////////////CARD FLIP HIDDEN HANDLE
        //transform-style: preserve-3d;
        //backface-visibility: hidden;

        img {
            height: 9px;

            top: 86px;
            right: 5px;
        }
    }

    #truck-door-window {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #0ca49b;
        box-shadow: 0px 0px 0px 2px #000000;

        top: 20px;
        left: 50%;
        transform: translateX(-50%);
    }

    #truck-door-container:hover #truck-door {
        animation: open-door 1.5s ease forwards;
    }

    @keyframes open-door {
        0% {
            -webkit-transform: perspective(600) rotateY(0deg);
            transform-origin: 0% 50%;
        }
        100% {
            -webkit-transform: perspective(600) rotateY(-180deg);
            transform-origin: 0% 50%;
        }
    }

</style>