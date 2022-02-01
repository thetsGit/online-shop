<script>
    const cartAddBtns = document.querySelectorAll(".cartAddBtn");
    const cartCount = document.getElementById("cart-count");

    cartAddBtns.forEach(cartAddBtn => {
        cartAddBtn.addEventListener("click",async(e)=>{
            const spinner = e.target.children[0];
            const btnText = e.target.children[1];
            const formData = new FormData();
            const cartCountText = Number(cartCount.innerHTML);
            formData.append("productId",e.target.dataset.productId);
            spinner.classList.remove("d-none");
            btnText.classList.add("d-none");
            e.target.classList.add("disabled");
            const {data} = await axios.post("{{url("/cart/add")}}",formData);
            if(data.success){
                new Noty({
                type: "info",
                layout: "centerRight",
                text     : data.success,
                timeout: 3000,
                killer: true,
                }).show();
                cartCount.innerHTML = String(cartCountText+1);
                cartCount.classList.add("larger");
                anime({
                targets: ".larger",
                scale: [2,1],
                duration: 200
                });
                setTimeout(() => {
                    cartCount.classList.remove("larger");
                }, 300);
            }else{
                new Noty({
                type: "error",
                layout: "centerRight",
                text     : data.error,
                timeout: 3000,
                killer: true,
                }).show();
            }
            spinner.classList.add("d-none");
            btnText.classList.remove("d-none");
            e.target.classList.remove("disabled");
        });
    });
</script>
