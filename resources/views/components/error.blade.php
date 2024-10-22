<div class="container">
    <div class="circle-border"></div>
    <div class="circle">
        <div class="error"></div>
    </div>
</div>
</div>
<style>
.circle,
.circle-border {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}

.circle {
    z-index: 1;
    position: relative;
    background: white;
    transform: scale(1);
    animation: success-anim 700ms ease;
}

.circle-border {
    z-index: 0;
    position: absolute;
    transform: scale(1.1);
    animation: circle-anim 400ms ease;
    background: red;
}

.error {
    position: absolute;
    top: 50%;
    left: 30%;
}

@keyframes success-anim {
    0% {
        transform: scale(0);
    }

    30% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes circle-anim {
    from {
        transform: scale(0);
    }

    to {
        transform: scale(1.1);
    }
}

.error::before,
.error::after {
    content: "";
    display: block;
    height: 4px;
    background: red;
    position: absolute;
}

.error::before {
    width: 40px;
    top: 48%;
    left: 16%;
    transform: rotateZ(50deg);
}

.error::after {
    width: 40px;
    top: 48%;
    left: 16%;
    transform: rotateZ(-50deg);
}
</style>
