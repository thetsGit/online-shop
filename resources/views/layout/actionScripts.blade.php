<script>

const favouriteBtns = document.querySelectorAll(".favouriteBtn");
const likeBtns = document.querySelectorAll(".likeBtn");

favouriteBtns.forEach(favouriteBtn => {
    favouriteBtn.addEventListener("click",async(e)=>{
        console.log(e.target);
        const formData = new FormData();
        formData.append("product",e.target.dataset.productId);
        const spinner = e.target.children[0];
        spinner.classList.remove("d-none");
        const starIcon = e.target.querySelector("i");
        starIcon.classList.add("d-none");
        const {data}= await axios.post("{{url("/toggleFavourite")}}",formData);
        spinner.classList.add("d-none");
        if(data.success.slice(0,7) === "removed"){
            starIcon.classList = "far fa-star";
        }else if(data.success.slice(0,5) === "added"){
            starIcon.classList = "fas fa-star";
        }
        else{
            new Noty({
            type: "error",
            layout: "centerRight",
            text     : data.error,
            timeout: 3000,
            killer: true,
            }).show();
            return;
        }
        new Noty({
        type: "info",
        layout: "centerRight",
        text     : data.success,
        timeout: 3000,
        killer: true,
        }).show();
    });
});

likeBtns.forEach(likeBtn => {
    likeBtn.addEventListener("click",async(e)=>{
        const formData = new FormData();
        formData.append("product",e.target.dataset.productId);
        const spinner = e.target.children[0];
        spinner.classList.remove("d-none");
        const likeIcon = e.target.querySelector("i");
        likeIcon.classList.add("d-none");
        const {data}= await axios.post("{{url("/toggleLike")}}",formData);
        spinner.classList.add("d-none");
        const likeIndicator = e.target.nextElementSibling;
        const likeCount = Number(likeIndicator.innerHTML);
        if(data.success.slice(0,7) === "unliked"){
        likeIcon.classList = "far fa-heart";
        likeIndicator.innerHTML = String(likeCount-1);
        }else if(data.success.slice(0,5) === "liked"){
        likeIcon.classList = "fas fa-heart";
        likeIndicator.innerHTML = String(likeCount+1);
        }
        else{
            new Noty({
            type: "error",
            layout: "centerRight",
            text     : data.error,
            timeout: 3000,
            killer: true,
            }).show();
            return;
        }
        new Noty({
        type: "info",
        layout: "centerRight",
        text     : data.success,
        timeout: 3000,
        killer: true,
        }).show();
    });
});
</script>
